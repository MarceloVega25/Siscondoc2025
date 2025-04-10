@extends('layouts.app')

@section('body-class', 'login-page')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">Registrarse</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre y Apellido -->
                        <div class="row mb-3">
                            <label for="nombre_apellido" class="col-md-4 col-form-label text-md-end">Nombre y Apellido</label>
                            <div class="col-md-6">
                                <input id="nombre_apellido" type="text"
                                       class="form-control @error('nombre_apellido') is-invalid @enderror"
                                       name="nombre_apellido"
                                       placeholder="Ingrese su nombre completo" required autofocus>

                                @error('nombre_apellido')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electrónico</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       placeholder="Ingrese su correo electrónico" required>

                                @error('email')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password"
                                           placeholder="Ingrese una contraseña" required>
                                    <span class="input-group-text" onclick="togglePassword()" style="cursor:pointer;">
                                        <i class="bi bi-eye" id="toggleIcon1"></i>
                                    </span>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmar Contraseña</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password-confirm" type="password"
                                           class="form-control"
                                           name="password_confirmation"
                                           placeholder="Repita la contraseña" required>
                                    <span class="input-group-text" onclick="toggleConfirmPassword()" style="cursor:pointer;">
                                        <i class="bi bi-eye" id="toggleIcon2"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Botón -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrarme
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar/ocultar contraseñas -->
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon1');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye-slash');
        icon.classList.toggle('bi-eye');
    }

    function toggleConfirmPassword() {
        const input = document.getElementById('password-confirm');
        const icon = document.getElementById('toggleIcon2');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye-slash');
        icon.classList.toggle('bi-eye');
    }
</script>
@endsection
