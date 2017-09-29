<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idCurso
 * @property string $nome
 * @property Aluno[] $alunos
 * @property Evento[] $eventos
 */
class Curso extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'curso';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idCurso';

    /**
     * @var array
     */
    protected $fillable = ['nome'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alunos()
    {
        return $this->belongsToMany('App\Aluno', null, 'idCurso', 'matricula');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eventos()
    {
        return $this->belongsToMany('App\Evento', null, 'idCurso', 'idEvento');
    }
}
