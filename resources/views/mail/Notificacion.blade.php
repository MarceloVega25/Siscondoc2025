@extends('layouts.admin')
@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="content" style="margin-left: 20px">
    <h1>Enviar Notificación</h1>

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <li>{{ $error }}</li>
        </div>
    @endforeach

    <div class="row">
        <div class="col-md-11">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>COMPLETE LOS DATOS</b></h3>
                </div>

                <div class="card-body">
                    <form id="correoForm" action="{{ route('mail.send') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo del destinatario:</label><b>*</b>
                                    <input type="email" name="email" class="form-control" required>
                                    @error('email')
                                        <small style="color: red;">*Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">Asunto:</label><b>*</b>
                                    <input type="text" name="subject" class="form-control" required>
                                    @error('subject')
                                        <small style="color: red;">*Este campo es requerido</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="body">Mensaje:</label><b>*</b>
                            <textarea name="body" class="form-control" rows="5" required></textarea>
                            @error('body')
                                <small style="color: red;">*Este campo es requerido</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="attachment">Adjuntar archivos:</label>
                            <input type="file" name="attachment[]" class="form-control" id="attachment" multiple>
                            <small id="archivos" class="text-muted"></small>
                        </div>

                        <hr>
                        <div class="form-group">
                            <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
                            <button type="button" class="btn btn-success" onclick="confirmarEnvio()">Enviar Correo</button>
                        </div>
                    </form>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col-md-11 -->
    </div> <!-- row -->
</div> <!-- content -->

{{-- SweetAlert scripts --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Mostrar archivos seleccionados --}}
<script>
    document.getElementById('attachment').addEventListener('change', function (event) {
        const files = event.target.files;
        const fileList = [];

        for (let i = 0; i < files.length; i++) {
            fileList.push(files[i].name);
        }

        document.getElementById('archivos').textContent = fileList.length > 0
            ? "Archivos seleccionados: " + fileList.join(', ')
            : "";
    });
</script>

{{-- Confirmar antes de enviar --}}
<script>
    function confirmarEnvio() {
        Swal.fire({
            title: '¿Confirmar envío?',
            text: "¿Deseás enviar esta notificación por correo electrónico?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, enviar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('correoForm').submit();
            }
        });
    }
</script>

{{-- Mostrar error o éxito con SweetAlert --}}
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

@if (session('mensaje'))
    <script>
        Swal.fire({
            icon: '{{ Str::startsWith(session('mensaje'), "Error") ? "error" : "success" }}',
            title: '{{ Str::startsWith(session('mensaje'), "Error") ? "Error" : "Éxito" }}',
            text: '{{ session('mensaje') }}',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#3085d6',
            timer: 300000
        });
    </script>
@endif
@endsection
