<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class libro extends Model
{
    protected $table        = 'libros';
    protected $primaryKey   = 'id';
    protected $fillable     =['agente_id','hospital_id','added_on'];

}
