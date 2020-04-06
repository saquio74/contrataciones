@extends('welcome')

@section('contenido')
    @if (!empty($mensaje))
        <li class='list-group-item'>

            el agente ya existe
        </li>
    @endif
    
    
    
    @if (empty($agente))
        <h1>No existe agente</h1>
    @else
       
        @foreach ($agente as $gente)
            <a href="{{action('agentes@modificar', [$gente->LEGAJO])}}">
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
