@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Nueva Adscripción</h1>
        <form method="POST" action="{{ route('adscripciones.store') }}">
            @csrf
            <!-- tus campos -->
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
