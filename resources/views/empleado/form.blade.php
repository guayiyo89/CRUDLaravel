<!-- In this document we generate the form that will be used in both Edit and Create views. -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{$modo}} usuario</h2>
    @if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
        </ul>
    </div>


    @endif

    <!-- old() is for conservate the data on the form after showing the error -->

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" name="nombre" value="{{ isset($empleado->nombre)?$empleado->nombre:old('nombre') }}" id="nombre"><br>
    </div>
    <div class="form-group">
        <label for="apellidoP">Apelido Paterno</label>
        <input type="text" class="form-control" name="apellidoP" value="{{ isset($empleado->apellidoP)?$empleado->apellidoP:old('apellidoP') }}" id="apellidoP"><br>
    </div>
    <div class="form-group">
        <label for="apellidoM">Apellido Materno</label>
        <input type="text" class="form-control" name="apellidoM" value="{{ isset($empleado->apellidoM)?$empleado->apellidoM:old('apellidoM') }}" id="apellidoM"><br>
    </div>
    <div class="form-group">
        <label for="correo">Correo</label>
        <input type="text" class="form-control" name="correo" value="{{ isset($empleado->correo)?$empleado->correo:old('correo') }}" id="correo"><br>
    </div>
    <div class="form-group">
        <label for="foto">Foto</label><br>
        @if(isset($empleado->foto))
        <img src="{{ asset('storage').'/'.$empleado->foto }}" alt="" width="120px"> 
        @endif
        <input type="file" name="foto" id="foto"><br>
        <br>
        <input type="submit" value="Guardar" class="btn btn-success">
        <a href="{{ url('/empleado') }}" class="btn btn-success">Regresar</a>
    </div>

</div>
@endsection