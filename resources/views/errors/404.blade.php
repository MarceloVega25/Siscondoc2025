@extends('layouts.admin')

@section('title', '404 - Página no encontrada')

@section('content')

<div class="content" style="margin-left: 20px">
    <h1 class="text-danger">Pagina Incorrecta</h1>

<div class="container text-center mt-5">
    <h1 class="display-4"></h1>
    <h3>La página que buscás no existe.</h3>
    <a href="{{ url('/') }}" class="btn btn-success mt-3">Volver al inicio</a>
</div>
</div>
@endsection
