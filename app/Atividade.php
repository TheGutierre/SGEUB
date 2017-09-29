<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idAtividade
 * @property string $horaIni
 * @property string $horaFim
 * @property string $desc
 * @property int $idL
 * @property int $idEvent
 * @property Local $local
 * @property Evento $evento
 * @property Frequencium[] $frequencias
 * @property Palestrante[] $palestrantes
 */
class Atividade extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'atividade';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idAtividade';

    /**
     * @var array
     */
    protected $fillable = ['horaIni', 'horaFim', 'desc', 'idL', 'idEvent'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function local()
    {
        return $this->belongsTo('App\Local', 'idL', 'idL');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evento()
    {
        return $this->belongsTo('App\Evento', 'idEvent', 'idEvent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function frequencias()
    {
        return $this->hasMany('App\Frequencium', 'idAtividade', 'idAtividade');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function palestrantes()
    {
        return $this->belongsToMany('App\Palestrante', 'palestrante_atividade', 'Atividade_idAtividade', 'idPalestrante');
    }
}
