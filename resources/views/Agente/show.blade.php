@extends('layout')

@section('contenido')
    
    
    
    @if (empty($agente))
        <h1>No existe agente</h1>
    @else
        <h1>Agente {{$agente->NOMBRE}}</h1>
        
        
    @endif
    
    
    
    
    <ul>
       
        
    </ul>
@stop    
