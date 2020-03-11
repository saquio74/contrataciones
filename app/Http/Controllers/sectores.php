<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sector;
class sectores extends Controller
{
    public function index()
    {
        
        $sectores = sector::all();
        $sectores = json_encode($sectores);
        return $sectores;
    }
}
