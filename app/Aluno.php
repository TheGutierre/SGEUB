<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $matricula
 * @property int $periodo
 * @property int $idPessoa
 * @property Pessoa $pessoa
 * @property Curso[] $cursos
 * @property Certificado[] $certificados
 * @property Frequencium[] $frequencias
 * @property Inscricao[] $inscricaos
 */
class Aluno extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'aluno';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'matricula';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['matricula', 'periodo', 'idPessoa'];

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
    public function cursos()
    {
        return $this->belongsToMany('App\Curso', null, 'matricula', 'idCurso');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificados()
    {
        return $this->hasMany('App\Certificado', 'matricula', 'matricula');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function frequencias()
    {
        return $this->hasMany('App\Frequencia', 'matricula', 'matricula');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscricaos()
    {
        return $this->hasMany('App\Inscricao', 'matricula', 'matricula');
    }
}
