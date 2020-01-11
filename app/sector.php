<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sector extends Model
{
    protected $table = 'sector';

    public function agentes()
    {
       return $this->hasMany('App\agente', 'ID' );
    }
}
