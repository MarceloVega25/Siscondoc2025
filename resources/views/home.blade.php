@extends('layouts.app')

@section('body-class', 'login-page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">Registro exitoso</div>

                <div class="card-body text-center">
                    <div class="alert alert-success" role="alert">
                        ¡La cuenta ha sido creada con éxito!
                    </div>

                    <p>¿Qué querés hacer ahora?</p>

                    <div class="d-flex justify-content-center gap-3 mt-4">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                Cerrar sesión
                            </button>
                        </form>

                        <a href="{{ url('/') }}" class="btn btn-primary">
                            Ingresar al sistema
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
