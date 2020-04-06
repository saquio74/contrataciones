@extends('welcome')

@section('contenido')


    <hr>
    <form class="badge-dark text-white " method="POST" action="{{action('agentes@modificar')}}">
        @csrf
        <hr>
        
        <div class="form-group row">
            
            <label for="legajo" class="col-sm-2 col-form-label text-center ">LEGAJO o DNI</label>
            <div class="col-sm-5">
            <input type="text" class="form-control badge-secondary" id="legajo" name='legajo' value='{{old('legajo')}}'>
            </div>
            <button type="submit" class="btn btn-primary">BUSCAR</button>
        </div>
        <hr>
    </form>
    <hr>

    
    
@endsection