<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\servicio;
class servicios extends Controller
{
    public function index()
    {
        $servicios = servicio::all();
        $servicios = json_encode($servicios);
        return $servicios;
    }
}
