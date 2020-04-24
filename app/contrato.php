<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contrato extends Model
{
    protected $table        = 'contratos';
    protected $primaryKey   = 'id';
    protected $fillable     = ['proveedor_id','especialidad_id','contrato','fecha_inicio','fecha_fin'];
}
