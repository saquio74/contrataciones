@extends('layout')

@section('contenido')
    <br>
    <div class="col-sm-12">

    
        <div class="btn-group-vertical text-center text-light col-sm-5">
            <button class="btn btn-default badge-dark text-white" type="button">MENU ADMINISTRATIVO</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='nuevoagente.php' ">Nuevo Agente</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='buscaragente.php'" >Modificar Agente</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='liquidacionhospital.php'">Liquidacion</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='certificacion.html'">Certificaciones</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='modificarprestacion.php'" >Modificar y Borrar prestaciones</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='contaduria.php'" >contaduria</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='borrarliquidacion.php'" >borrar liquidacion</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='complementaria.php'" >Complementaria</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='personal.php'" >Agentes por Hospital</button>
        </div>
        <div class="btn-group-vertical text-center text-light col-sm-5">
            <button class="btn btn-default badge-dark text-white" type="button">MENU ADMINISTRATIVO</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='nuevoagente.php' ">Agregar Hospital</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='buscaragente.php'" >Agregar Inciso</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='liquidacionhospital.php'">Agregar Servicio</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='certificacion.html'">Agregar Sector</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='modificarprestacion.php'" >Agregar Especialidad</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='contaduria.php'" >Agregar Prestacion</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='borrarliquidacion.php'" >Agregar Profesional</button>
            <button class="btn btn-default badge-dark text-white" type="button" onclick="window.location.href='complementaria.php'" >Generar Excel Liquidacion</button>
            <button class="btn btn-default badge-dark text-secondary" type="button" onclick="window.location.href='{{action('agentes@index')}}'" >-</button>
        </div>
        
    </div>    
    <br>

                
@endsection