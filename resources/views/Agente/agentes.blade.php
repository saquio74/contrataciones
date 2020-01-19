@extends('layout')

@section('contenido')
    <h1>Listado total de Agentes</h1>
    <table class="table table-striped table-dark table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">LEGAJO</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">HOSPITAL</th>
                <th scope="col">SERVICIO</th>
                <th scope="col">SECTOR</th>
                <th scope="col">ACTIVO</th>
                <th scope="col">FECHA DE INGRESO</th>
            </tr>
        </thead>
                
        <tbody>
            @foreach ($gente as $gente)

            <tr onclick="window.location.href='{{action('agentes@show',$gente->LEGAJO)}}'">
                <th>
                    {{$gente->LEGAJO}}
                    
                </th>
                <th>
                    {{$gente->NOMBRE}}
                    
                </th>
                <th>
                    
                    {{$gente->HOSPITAL}}
                </th>
                <th>
                    
                    {{$gente->SERVICIO}}
                </th>
                <th>
                    
                    {{$gente->SECTOR}}
                </th>
                @if ($gente->ACTIVO==0)
                    <th>
                        Activo
                    </th>
                @else
                    <th>
                        Baja
                    </th>
                @endif
                <th>
                    
                    {{$gente->fecha_ingreso}}
                </th>
                
            </tr>
                    
            @endforeach
        </tbody>
    
    </table>
@stop    
