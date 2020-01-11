<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\agente;
use App\hospital;
class hospital extends Model
{
    protected $table = 'hospitales';
    protected $primaryKey = 'ID';

    public function agentes()
    {
       return $this->hasMany('App\agente', 'idhosp' );
    }

}
