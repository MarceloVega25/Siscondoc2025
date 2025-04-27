@extends('layouts.admin')

@section('title', '403 - Acceso Denegado')

@section('content')

<div class="content" style="margin-left: 20px">
    <h1 class="text-danger">Acceso Restringuido</h1>

<div class="container text-center mt-5">
    <h1 class="display-4"></h1>
    <h3>No tenés permiso para acceder a esta página.</h3>
    <a href="{{ url('/') }}" class="btn btn-success mt-3">Ir al inicio</a>
</div>
</div>
@endsection
