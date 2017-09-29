<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $matricula
 * @property int $idCertificado
 * @property string $dataEmissao
 * @property int $cargaHoraria
 * @property int $idEvento
 * @property Aluno $aluno
 * @property Evento $evento
 */
class Certificado extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'certificado';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idCertificado';

    /**
     * @var array
     */
    protected $fillable = ['matricula', 'dataEmissao', 'cargaHoraria', 'idEvento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aluno()
    {
        return $this->belongsTo('App\Aluno', 'matricula', 'matricula');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evento()
    {
        return $this->belongsTo('App\Evento', 'idEvento', 'idEvent');
    }
}
