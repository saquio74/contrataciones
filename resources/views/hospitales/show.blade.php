@extends('layout')

@section('contenido')
    
    
    
    @if (empty($hospitales))
        {{ $hospitales->HOSPITAL}}
        <h1>No existe Hospital</h1>
    @else
        <h1>Hospital {{$hospitales[0]->HOSPITAL}}</h1>
        <ul>
            @foreach ($hospitales[0]->agentes as $gente)
                
                <a href="{{action('agentes@show', [$gente->LEGAJO])}}">
                <li class="list-group-item">
                    {{$gente->LEGAJO}}-
                    {{$gente->NOMBRE}}-
                    {{$gente->hospital->HOSPITAL}}
                </li>

            @endforeach

        </ul>
                
    @endif
    
    
    
    
    
@stop    