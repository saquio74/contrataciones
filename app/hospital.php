<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hospital extends Model
{
    protected $table = 'hospitales';

    public function agentes()
    {
       return $this->hasMany('app\agente', 'id' );
    }

}
