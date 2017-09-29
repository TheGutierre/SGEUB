<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $matricula
 * @property string $horaEntrada
 * @property string $horaSaida
 * @property boolean $presenca
 * @property int $idAtividade
 * @property Atividade $atividade
 * @property Aluno $aluno
 */
class Frequencia extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'frequencia';

    /**
     * @var array
     */
    protected $fillable = ['matricula', 'horaEntrada', 'horaSaida', 'presenca', 'idAtividade'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function atividade()
    {
        return $this->belongsTo('App\Atividade', 'idAtividade', 'idAtividade');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aluno()
    {
        return $this->belongsTo('App\Aluno', 'matricula', 'matricula');
    }
}
