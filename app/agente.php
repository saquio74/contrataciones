<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\agente;
use App\hospital;
class agente extends Model
{
    protected $table= 'agentes';
    protected $primaryKey = 'LEGAJO';
    public function hospital()
    {
       return $this->belongsTo(hospital::class, 'IDHOSP');
    }
    
}
