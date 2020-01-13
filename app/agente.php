<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\agente;
use App\hospital;
class agente extends Model
{
    protected $table= 'agentes';
    protected $primaryKey = 'LEGAJO';
    protected $fillable=['legajo','dni','nombre','idhosp','sec','idservicio','','horario','activo'];
    public function hospital()
    {
       return $this->belongsTo(hospital::class, 'IDHOSP');
    }
    
}
