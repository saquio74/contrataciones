<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provhosp extends Model
{
    protected $table        = 'provhosps';
    protected $primaryKey   = 'id';
    protected $fillable     = ['hospital_id','proveedor_id'];
}
