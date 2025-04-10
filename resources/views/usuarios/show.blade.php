@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Datos del Usuario Registrado</h1>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title"><b>Datos Registrados</b></h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <!-- Columna izquierda -->
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombre y Apellido</label>
                                            <input type="text" class="form-control" value="{{ $usuario->nombre_apellido }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fecha de Ingreso</label>
                                            <input type="date" class="form-control" value="{{ $usuario->fecha_ingreso }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <input type="text" class="form-control" value="{{ ucfirst($usuario->estado) }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" value="{{ $usuario->email }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <input type="password" class="form-control" value="********" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Género</label>
                                            <input type="text" class="form-control" value="{{ $usuario->genero }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Columna Fotografía -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fotografía</label>
                                    <center>
                                        @php
                                            $fotoPath = (!empty($usuario->fotografia) && file_exists(public_path('storage/' . $usuario->fotografia)))
                                                ? asset('storage/' . $usuario->fotografia)
                                                : asset('images/' . strtolower($usuario->genero) . '.jpg');
                                        @endphp
                                        <img src="{{ $fotoPath }}" class="img-thumbnail" width="150">
                                    </center>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <hr>
                                <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Volver al listado</a>
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning">Editar Usuario</a>
                            </div>
                        </div>

                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-md-11 -->
        </div> <!-- /.row -->
    </div> <!-- /.content -->
@endsection
