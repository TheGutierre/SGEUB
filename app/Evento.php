<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idEvent
 * @property string $descricao
 * @property string $datafim
 * @property string $dataInicio
 * @property string $cargaHoraria
 * @property string $status
 * @property string $nome
 * @property Atividade[] $atividades
 * @property Certificado[] $certificados
 * @property Curso[] $cursos
 * @property Inscricao[] $inscricaos
 */
class Evento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'evento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idEvent';

    /**
     * @var array
     */
    protected $fillable = ['descricao', 'datafim', 'dataInicio', 'cargaHoraria', 'status', 'nome'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function atividades()
    {
        return $this->hasMany('App\Atividade', 'idEvent', 'idEvent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificados()
    {
        return $this->hasMany('App\Certificado', 'idEvento', 'idEvent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cursos()
    {
        return $this->belongsToMany('App\Curso', null, 'idEvento', 'idCurso');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscricaos()
    {
        return $this->hasMany('App\Inscricao', 'idEvento', 'idEvent');
    }
}
