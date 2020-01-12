<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sector extends Model
{
    protected $table = 'sector';
    protected $primaryKey = 'ID';

    public function agentes()
    {
       return $this->hasMany('App\agente', 'sec' );
    }
}
