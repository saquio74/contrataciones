<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\agente;
class inciso extends Model
{
    protected $table = 'inciso';

    protected $primaryKey = 'ID';
    protected $fillable=['inciso','valor'];

    
}
