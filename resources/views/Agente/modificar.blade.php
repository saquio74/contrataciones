@extends('welcome')

@section('contenido')
    <h1>Nuevo Agente</h1>
    
    @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>    
                @endforeach
            </ul>
        </div>
    @endif


     @foreach ($agente as $gente)
    <form class="badge-dark text-white " method="POST" action="{{action('agentes@update')}}">
        <hr>
        @csrf
        <input type="hidden" value='0' id="legajo" name='activo'>
        
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">LEGAJO</label>
            <div class="col-sm-5">
            <input type="text" class="form-control badge-secondary" id="legajo" name='legajo' value='{{$gente->LEGAJO}}'>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="documento" class="col-sm-2 col-form-label text-center ">DNI</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="dni" name='dni' value='{{$gente->DNI}}'>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="horario" class="col-sm-2 col-form-label text-center ">NOMBRE</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="nombre" name='nombre' value='{{$gente->NOMBRE}}'>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="horario" class="col-sm-2 col-form-label text-center ">TELEFONO</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="telefono" name='telefono' value='{{$gente->TELEFONO}}'>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">HOSPITAL</label>
            <div class="col-sm-5">
                <select  class="form-control badge-secondary" id="hospitales" name='idhosp'>
                        <option value="">Seleccione</option>
                            @foreach ($hospitales as $hosp)
                                @if ($gente->IDHOSP == $hosp->ID)
                                    
                                    <option value="{{$hosp->ID}}" id="{{$hosp->ID}}" selected>{{$hosp->HOSPITAL}}</option>
                                @else
                                    <option value="{{$hosp->ID}}" id="{{$hosp->ID}}">{{$hosp->HOSPITAL}}</option>
                                @endif
                                
                            @endforeach
                            
                </select>
            </div>
        </div>
       
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">INCISO</label>
            <div class="col-sm-5">
                <select multiple class="form-control badge-secondary" id="inciso" name='inciso[]'>
                    
                    @foreach ($inciso as $incisos)
                    @php
                        $i=0;    
                    @endphp
                        @foreach ($inc as $incs)
                            @if ($incisos->ID == $incs->IDINC)
                                @php
                                    $i++;
                                @endphp
                            @endif
                            
                        @endforeach

                        @if ($i==1)
                                
                            <option value="{{$incisos->ID}}" id="{{$incisos->ID}}" selected>{{$incisos->INCISO}}</option>
                            
                        @elseif ($i==0)
                        
                            <option value="{{$incisos->ID}}" id="{{$incisos->ID}}">{{$incisos->INCISO}}</option>
                            
                        @endif 
                       
                        
                    
                    @endforeach
                            
                </select>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">SECTOR</label>
            <div class="col-sm-5">
                <select  class="form-control badge-secondary" id="sector" name='sec'>
                        <option value="">Seleccione</option>
                    @foreach ($sector as $sectores)
                        @if ($gente->SEC == $sectores->ID)
                            
                            <option value="{{$sectores->ID}}" id="{{$sectores->ID}}" selected>{{$sectores->SECTOR}}</option>
                        @else
                            <option value="{{$sectores->ID}}" id="{{$sectores->ID}}">{{$sectores->SECTOR}}</option>
                            
                        @endif
                        
                    @endforeach
                            
                </select>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">SERVICIO</label>
            <div class="col-sm-5">
                <select  class="form-control badge-secondary" id="servicio" name='idservicio'>
                        <option value="">Seleccione</option>
                    @foreach ($servicio as $servicio)
                        @if ($gente->IDSERVICIO == $servicio->ID)
                            <option value="{{$servicio->ID}}" id="{{$servicio->ID}}" selected>{{$servicio->SERVICIO}}</option>
                        @else
                            <option value="{{$servicio->ID}}" id="{{$servicio->ID}}">{{$servicio->SERVICIO}}</option>
                        @endif
                        
                        
                    @endforeach
                            
                </select>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="horario" class="col-sm-2 col-form-label text-center ">HORARIO</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="horario" name='horario' value='{{$gente->HORARIO}}'>
            </div>
        </div>
        
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">AGREGAR</button>
    </form>
    <hr>
    @endforeach
@stop    