<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\agente;
class inciso extends Model
{
    protected $table = 'inciso';

    public function agentes()
    {
       return $this->hasMany('App\agente', 'id' );
    }
}
