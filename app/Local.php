<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idL
 * @property int $capacidade
 * @property string $nome
 * @property Atividade[] $atividades
 */
class Local extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'local';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idL';

    /**
     * @var array
     */
    protected $fillable = ['capacidade', 'nome'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function atividades()
    {
        return $this->hasMany('App\Atividade', 'idL', 'idL');
    }
}
