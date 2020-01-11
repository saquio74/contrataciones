@extends('layout')

@section('contenido')
    
    
    
    @if (empty($agente))
        <h1>No existe agente</h1>
    @else
        @foreach ($agente as $gente)
             <a href="{{$gente->LEGAJO}}">
                <li class="list-group-item">
                {{$gente->LEGAJO}}-
                {{$gente->NOMBRE}}-
                {{$gente->hospital->HOSPITAL}}
                
            </li>
            </a>
            
        @endforeach
        
        
    @endif
    
    
    
    
    <ul>
       
        
    </ul>
@stop    
