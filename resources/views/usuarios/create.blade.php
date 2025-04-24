@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    <h1>Creación de un nuevo Usuario</h1>

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <li>{{ $error }}</li>
        </div>
    @endforeach

    <div class="row">
        <div class="col-md-11">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>COMPLETE LOS DATOS</b></h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre y Apellido</label><b>*</b>
                                            <input type="text" name="nombre_apellido" class="form-control"
                                                value="{{ old('nombre_apellido') }}" placeholder="Ingrese el Nombre y Apellido" required>
                                            @error('nombre_apellido')
                                                <small style="color: red;">*Este campo es requerido</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de Ingreso</label><b>*</b>
                                            <input type="date" name="fecha_ingreso" class="form-control"
                                                value="{{ old('fecha_ingreso') }}" required>
                                            @error('fecha_ingreso')
                                                <small style="color: red;">*Este campo es requerido</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Estado</label><b>*</b>
                                            <select name="estado" class="form-control" required>
                                                <option value="">Seleccione...</option>
                                                <option value="activo">Activo</option>
                                                <option value="inactivo">Inactivo</option>
                                            </select>
                                            @error('estado')
                                                <small style="color: red;">*Este campo es requerido</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Email</label><b>*</b>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ request('email') ?? old('email') }}" placeholder="Ingrese su Email" required>
                                            @error('email')
                                                <small style="color: red;">*Este campo es requerido</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Contraseña</label><b>*</b>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Ingrese una Contraseña" required>
                                            @error('password')
                                                <small style="color: red;">*Este campo es requerido</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="genero">Género</label><b>*</b>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione...</option>
                                                <option value="masculino">Masculino</option>
                                                <option value="femenino">Femenino</option>
                                                <option value="otro">Otro</option>
                                            </select>
                                            @error('genero')
                                                <small style="color: red;">*Este campo es requerido</small>
                                            @enderror
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
                                                <option value="{{ $rol->name }}">{{ ucfirst($rol->name) }}</option>
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
                                    <div id="preview-container">
                                        <center><output id="list"></output></center>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        

                        <!-- Botones -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <div class="form-group">
                                    <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                                </div>
                            </div>
                        </div>
                    </form> <!-- cierre del form -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    document.getElementById('file').addEventListener('change', function(evt) {
        var files = evt.target.files;
        var previewContainer = document.getElementById("list");
        var fileNameDisplay = document.getElementById("file-name");

        previewContainer.innerHTML = "";

        if (files.length > 0) {
            var file = files[0];
            fileNameDisplay.textContent = file.name;

            if (file.type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("thumb");
                    img.style.maxWidth = "50%";
                    img.style.height = "auto";
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = "<p style='color: red;'>Seleccione un archivo de imagen válido.</p>";
            }
        } else {
            fileNameDisplay.textContent = "";
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
