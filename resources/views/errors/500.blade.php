@extends('layouts.admin')

@section('title', '500 - Error del servidor')

@section('content')

<div class="content" style="margin-left: 20px">
    <h1 class="text-danger">Error en Servidor</h1>

<div class="container text-center mt-5">
    <h1 class="display-4">500</h1>
    <h3>Ocurrió un error interno en el servidor. Estamos trabajando en ello.</h3>
    <a href="{{ url('/') }}" class="btn btn-danger mt-3">Volver al inicio</a>
</div>
</div>
@endsection
