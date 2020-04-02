<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vacaciones extends Model
{
    protected $table='vacaciones';
    protected $primarykey = 'id';
    protected $fillable = ['agente_id','anio','fecha_inicio','fecha_fin'];
    

}
