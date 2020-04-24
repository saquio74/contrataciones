<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    protected $table        = 'proveedors';
    protected $primaryKey   = 'id';
    protected $fillable     = ['proveedor','nombre','apellido','dni','cuil','matricula','genero'];
}
