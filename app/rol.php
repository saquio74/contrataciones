<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    protected $table        = 'roles';
    protected $primaryKey   = 'id';
    protected $fillable     = ['name','description','special'];
}
