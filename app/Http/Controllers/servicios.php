<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\servicio;
class servicios extends Controller
{
    public function index()
    {
        $servicios = servicio::all();
        return $servicios;
    }
}
