@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Datos del Inscripto Registrado</h1>

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
                                            <input type="text" class="form-control" value="{{ $inscripto->nombre_apellido }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>DNI</label>
                                            <input type="number" class="form-control" value="{{ $inscripto->dni }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" value="{{ $inscripto->fecha_nacimiento }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Género</label>
                                            <input type="text" class="form-control" value="{{ $inscripto->genero }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" value="{{ $inscripto->email }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Teléfono</label>
                                            <input type="text" class="form-control" value="{{ $inscripto->telefono }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <input type="text" class="form-control" value="{{ $inscripto->direccion }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Localidad/Ciudad</label>
                                            <input type="text" class="form-control" value="{{ $inscripto->localidad_ciudad }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>CV</label><br>
                                            @if ($inscripto->cv)
                                                <a href="{{ asset('storage/' . $inscripto->cv) }}" target="_blank" class="btn btn-primary btn-sm">Ver CV</a>
                                            @else
                                                <p class="text-muted">No disponible</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Columna derecha: Foto -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fotografía</label>
                                    <center>
                                        @php
                                            $fotoPath = (!empty($inscripto->fotografia) && file_exists(public_path('storage/' . $inscripto->fotografia)))
                                                ? asset('storage/' . $inscripto->fotografia)
                                                : asset('images/' . strtolower($inscripto->genero) . '.jpg');
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
                                <a href="{{ route('inscriptos.index') }}" class="btn btn-danger">Volver al listado</a>
                                @role('admin|carga')
                                <a href="{{ route('inscriptos.edit', $inscripto->id) }}" class="btn btn-warning">Editar Inscripto</a>
                            @endrole
                            </div>
                        </div>

                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-md-11 -->
        </div> <!-- /.row -->
    </div> <!-- /.content -->
@endsection
