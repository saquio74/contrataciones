<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\agente;
class hospital extends Model
{
    protected $table = 'hospitales';

    public function agentes()
    {
       return $this->hasMany('App\agente', 'ID' );
    }

}
