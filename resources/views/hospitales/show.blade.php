@extends('layout')

@section('contenido')
    
    
    
    @if (empty($hospitales))
        {{ $hospitales->HOSPITAL}}
        <h1>No existe Hospital</h1>
    @else
        <h1>Hospital {{$hospitales[0]->HOSPITAL}}</h1>
        <ul>
            @foreach ($hospitales[0]->agentes as $agente)
                <li>
                    {{$agente->HOSPITAL}}
                </li>

            @endforeach

        </ul>
                
    @endif
    
    
    
    
    
@stop    