<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class complementaria extends Model
{
    protected $table        = 'complementaria';
    protected $primaryKey   = 'id';
    protected $fillable     = ['id','leg','periodo','anio','horas','inciso','valor','bonificacion','subtot','bonvalor','total','hospital','fecha','created_at','updated_at'];
}
