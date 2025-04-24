@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Actualizar Datos del Usuario</h1>

        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{ $error }}</li>
            </div>
        @endforeach

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>ACTUALICE LOS DATOS</b></h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('/usuarios', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre y Apellido</label><b>*</b>
                                                <input type="text" name="nombre_apellido" class="form-control"
                                                    value="{{ $usuario->nombre_apellido }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Fecha de Ingreso</label><b>*</b>
                                                <input type="date" name="fecha_ingreso" class="form-control"
                                                    value="{{ $usuario->fecha_ingreso }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Estado</label><b>*</b>
                                                <select name="estado" class="form-control" required>
                                                    <option value="">Seleccione...</option>
                                                    <option value="activo" {{ $usuario->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                                    <option value="inactivo" {{ $usuario->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email, Password, Género -->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Email</label><b>*</b>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $usuario->email }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Nueva Contraseña (opcional)</label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="En blanco mantiene la actual">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="genero">Género</label><b>*</b>
                                                <select name="genero" class="form-control" required>
                                                    <option value="">Seleccione...</option>
                                                    <option value="masculino" {{ $usuario->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                                    <option value="femenino" {{ $usuario->genero == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                                    <option value="otro" {{ $usuario->genero == 'otro' ? 'selected' : '' }}>Otro</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="rol">Rol de Usuario</label><b>*</b>
                                                <select name="rol" class="form-control" required>
                                                    <option value="">Seleccione...</option>
                                                    @foreach ($roles as $rol)
                                                        <option value="{{ $rol->name }}" {{ $rolActual == $rol->name ? 'selected' : '' }}>
                                                            {{ ucfirst($rol->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('rol')
                                                    <small style="color: red;">*Este campo es requerido</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                        
                                </div>

                                <!-- Columna Fotografía -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fotografia">Fotografía</label>
                                        <input type="file" name="fotografia" id="file" class="form-control" accept="image/*">
                                        <small id="file-name" class="text-muted"></small>

                                        <center>
                                            @php
                                                if (!empty($usuario->fotografia) && file_exists(public_path('storage/' . $usuario->fotografia))) {
                                                    $fotoPath = asset('storage/' . $usuario->fotografia);
                                                } else {
                                                    $fotoPath = asset('images/' . strtolower($usuario->genero) . '.jpg');
                                                }
                                            @endphp

                                            <img id="preview-image" src="{{ $fotoPath }}" class="img-thumbnail" width="150">
                                        </center>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-group">
                                        <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Actualizar Registro</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para vista previa de foto -->
    <script>
        document.getElementById('file').addEventListener('change', function(event) {
            var file = event.target.files[0];
            document.getElementById('file-name').textContent = file ? file.name : "";
            if (file && file.type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error en el Formulario',
                html: '{!! implode("<br>", $errors->all()) !!}',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif
@endsection
