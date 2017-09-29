<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $formacao
 * @property int $idPalestrante
 * @property int $idPessoa
 * @property Pessoa $pessoa
 * @property Atividade[] $atividades
 */
class Palestrante extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'palestrante';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idPalestrante';

    public $incrementing = 'idPalestrante';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['formacao', 'idPessoa'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa', 'idPessoa', 'idPessoa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function atividades()
    {
        return $this->belongsToMany('App\Atividade', 'palestrante_atividade', 'idPalestrante', 'Atividade_idAtividade');
    }
}
