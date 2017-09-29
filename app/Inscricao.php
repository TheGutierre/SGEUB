<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $matricula
 * @property int $idInscricao
 * @property string $data
 * @property string $horario
 * @property int $idEvento
 * @property Evento $evento
 * @property Aluno $aluno
 */
class Inscricao extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'inscricao';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idInscricao';

    /**
     * @var array
     */
    protected $fillable = ['matricula', 'data', 'horario', 'idEvento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evento()
    {
        return $this->belongsTo('App\Evento', 'idEvento', 'idEvent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aluno()
    {
        return $this->belongsTo('App\Aluno', 'matricula', 'matricula');
    }
}
