@extends('layout')

@section('contenido')
    <h1>Nuevo Agente</h1>
        
    <form class="badge-dark text-white " method="POST" action="{{action('agentes@store')}}">
        <hr>
        @csrf
        <input type="hidden" value='0' id="legajo" name='activo'>
        
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">LEGAJO</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="documento" class="col-sm-2 col-form-label text-center ">DNI</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="dni" name='dni'>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="horario" class="col-sm-2 col-form-label text-center ">NOMBRE</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="nombre" name='nombre'>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">HOSPITAL</label>
            <div class="col-sm-5">
                <select  class="form-control badge-secondary" id="hospitales" name='idhosp'>
                        <option value="">Seleccione</option>
                    @foreach ($hospitales as $hosp)
                        
                        <option value="{{$hosp->ID}}" id="{{$hosp->ID}}">{{$hosp->HOSPITAL}}</option>
                        
                    @endforeach
                            
                </select>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">INCISO</label>
            <div class="col-sm-5">
                <select multiple class="form-control badge-secondary" id="inciso" name='inciso'>
                        
                    @foreach ($inciso as $incisos)
                        
                        <option value="{{$incisos->ID}}" id="{{$incisos->ID}}">{{$incisos->INCISO}}</option>
                        
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
                        
                        <option value="{{$sectores->ID}}" id="{{$sectores->ID}}">{{$sectores->SECTOR}}</option>
                        
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
                        
                        <option value="{{$servicio->ID}}" id="{{$servicio->ID}}">{{$servicio->SERVICIO}}</option>
                        
                    @endforeach
                            
                </select>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="horario" class="col-sm-2 col-form-label text-center ">HORARIO</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="horario" name='horario'>
            </div>
        </div>
        
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr>
@stop    