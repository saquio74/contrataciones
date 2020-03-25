<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ageninc extends Model
{
    protected $table = 'ageninc';

    protected $primaryKey = 'IDINT';
    protected $fillable=['idagente','idinc'];
}
