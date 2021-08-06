<!-- Indice de empleados -->

<!-- Show the message when an item is added/modified -->

@extends('layouts.app')

@section('content')
<div class="container">
<h1>Empleados</h1>
@if(Session::has('mensaje'))
<div class="alert alert-primary alert-dismissible">{{ Session::get('mensaje') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times</span>
    </button>
</div>

@endif
<table class="table">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido P</th>
            <th>Apellido M</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
        <tr>
            <td> <img src="{{ asset('storage').'/'.$empleado->foto }}" alt="" width="120px"> </td>
            <td>{{ $empleado->nombre }}</td>
            <td>{{ $empleado->apellidoP }}</td>
            <td>{{ $empleado->apellidoM }}</td>
            <td>{{ $empleado->correo }}</td>
            <td>
                <form action="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="d-inline">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </form> | 
                <form action="{{ url('/empleado/'.$empleado->id) }}" method="post" class="d-inline">
                    @csrf
                    <!-- we must spicify the DELETE Method, because is a POST form -->
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Deseas Borrar a ')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $empleados->links() !!}
<a href="{{ url('/empleado/create') }}" class="btn btn-success">Nuevo</a>
</div>
@endsection