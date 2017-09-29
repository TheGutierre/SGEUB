<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idPessoa
 * @property string $nome
 * @property string $cpf
 * @property string $funcao
 * @property string $dataNasc
 * @property Aluno[] $alunos
 * @property Palestrante[] $palestrantes
 * @property User[] $users
 */
class Pessoa extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pessoa';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idPessoa';

    public $incrementing = 'idPessoa';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'cpf', 'funcao', 'dataNasc'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alunos()
    {
        return $this->hasMany('App\Aluno', 'idPessoa', 'idPessoa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function palestrantes()
    {
        return $this->hasMany('App\Palestrante', 'idPessoa', 'idPessoa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User', 'idPessoa', 'idPessoa');
    }
}
