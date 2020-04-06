@extends('welcome')

@section('contenido')
    <h1>Listado total de Hospitales</h1>

    <ul class="list-group">
        @foreach ($hospitales as $hosp)
             <a href="hospitales/{{$hosp->ID}}">
                <li class="list-group-item">
                {{$hosp->HOSPITAL}}
                
            </li>
            </a>
            
        @endforeach
        
    </ul>
    
@stop