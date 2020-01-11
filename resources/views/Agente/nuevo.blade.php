@extends('layout')

@section('contenido')
    <h1>Nuevo Agente</h1>
        
    <form class="badge-dark text-white ">
        <hr>
        
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">LEGAJO</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="legajo">
            </div>
        </div>
        <div class="form-group row">
            
            <label for="documento" class="col-sm-2 col-form-label text-center ">DOCUMENTO</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="documento">
            </div>
        </div>
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">HOSPITAL</label>
            <div class="col-sm-5">
                <select multiple class="form-control" id="hospitales">
                    @foreach ($hospitales as $hosp)
                        
                        <select name="{{$hosp->ID}}" id="{{$hosp->ID}}">{{$hosp->HOSPITAL}}</select>
                        
                    @endforeach
                            
                </select>
            </div>
        </div>
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">LEGAJO</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="legajo">
            </div>
        </div>
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">LEGAJO</label>
            <div class="col-sm-5">
                <input type="text" class="form-control badge-secondary" id="legajo">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label text-center">Password</label>
            <div class="col-sm-5">
                <input type="password" class="form-control badge-secondary" id="inputPassword">
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