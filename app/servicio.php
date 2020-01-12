<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'ID';

    public function agentes()
    {
       return $this->hasMany('App\agente', 'idservicio' );
    }
}
