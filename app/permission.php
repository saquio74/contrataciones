<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    protected $table        = 'permissions';
    protected $primaryKey   = 'id';
    protected $fillable     = ['slug','name','description'];
}
