<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agenfac extends Model
{
    protected $table = 'agenfac';
    protected $primaryKey = 'ID';
    protected $fillable=['LEG','PERIODO','ANIO','HORAS','INC','VALOR','BONIFICACION','SUBTOT','BONVALOR','TOTAL','HOSPITAL'];
}
