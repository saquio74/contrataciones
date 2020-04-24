@extends('welcome')

@section('contenido')
    <h1>Cargar Proveedores Excel</h1>
    
    @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>    
                @endforeach
            </ul>
        </div>
    @endif



    <form class="badge-dark text-white " method="POST" enctype="multipart/form-data" action="{{action('contratoController@importExcel')}}">
        <hr>
        @csrf
        <input type="hidden" value='0' id="legajo" name='activo'>
        
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">archivo</label>
            <div class="col-sm-5">
            <input type="file" class="form-control badge-secondary" name='files'>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr>
@stop 