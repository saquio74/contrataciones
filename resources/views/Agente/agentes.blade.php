@extends('layout')

@section('contenido')
    <h1>Listado total de Agentes</h1>
    <ul class="list-group">
        @foreach ($gente as $gente)
             <a href="agentes/{{$gente->LEGAJO}}">
                <li class="list-group-item">
                {{$gente->LEGAJO}}-
                {{$gente->NOMBRE}}-
                {{$gente->HOSPITAL}}
                
            </li>
            </a>
            
        @endforeach
        
    </ul>
@stop    
