@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    <h1>Datos de la Adscripción</h1>

    <div class="row">
        <div class="col-md-11">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>Información de la Adscripción</b></h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Número</label>
                            <input type="text" class="form-control" value="{{ $adscripcion->numero }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Año</label>
                            <input type="text" class="form-control" value="{{ $adscripcion->anio }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Fecha Adscripción</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($adscripcion->fecha_adscripcion)->format('d/m/Y') }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Expediente</label>
                            <input type="text" class="form-control" value="{{ $adscripcion->expediente }}" disabled>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label>Jerarquía</label>
                            <input type="text" class="form-control" value="{{ $adscripcion->jerarquia->nombre ?? '' }}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Tipo de Adscripción</label>
                            <input type="text" class="form-control" value="{{ $adscripcion->tipo_adscripcion }}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Modalidad</label>
                            <input type="text" class="form-control" value="{{ $adscripcion->modalidad_adscripcion }}" disabled>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label>Inicio Publicidad</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($adscripcion->inicio_publicidad)->format('d/m/Y') }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Cierre Publicidad</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($adscripcion->cierre_publicidad)->format('d/m/Y') }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Inicio Inscripción</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($adscripcion->inicio_inscripcion)->format('d/m/Y') }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Cierre Inscripción</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($adscripcion->cierre_inscripcion)->format('d/m/Y') }}" disabled>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>Observaciones</label>
                        <textarea class="form-control" disabled>{{ $adscripcion->observaciones }}</textarea>
                    </div>

                    <hr>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label>Asignaturas</label>
                            <select class="form-control select2" multiple disabled>
                                @foreach ($adscripcion->asignaturas as $a)
                                    <option selected>{{ $a->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Departamentos</label>
                            <select class="form-control select2" multiple disabled>
                                @foreach ($adscripcion->departamentos as $d)
                                    <option selected>{{ $d->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Carreras</label>
                            <select class="form-control select2" multiple disabled>
                                @foreach ($adscripcion->carreras as $c)
                                    <option selected>{{ $c->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Docentes Titulares</label>
                                @foreach ($adscripcion->docentesTitulares as $docente)
            <input type="text" class="form-control mb-2" value="{{ $docente->nombre_apellido }}, DNI: {{ $docente->dni }}, Institución: {{ $docente->institucion }}" disabled>
        @endforeach
                        </div>
                        <div class="col-md-6">
                            <label>Docentes Suplentes</label>
                            @foreach ($adscripcion->docentesSuplentes as $docente)
            <input type="text" class="form-control mb-2" value="{{ $docente->nombre_apellido }}, DNI: {{ $docente->dni }}, Institución: {{ $docente->institucion }}" disabled>
        @endforeach
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Estudiantes Titulares</label>
                            @foreach ($adscripcion->estudiantesTitulares as $estudiante)
            <input type="text" class="form-control mb-2" value="{{ $estudiante->nombre_apellido }}, DNI: {{ $estudiante->dni }}, Institución: {{ $estudiante->institucion }}" disabled>
        @endforeach
                        </div>
                        <div class="col-md-6">
                            <label>Estudiantes Suplentes</label>
                            @foreach ($adscripcion->estudiantesSuplentes as $estudiante)
            <input type="text" class="form-control mb-2" value="{{ $estudiante->nombre_apellido }}, DNI: {{ $estudiante->dni }}, Institución: {{ $estudiante->institucion }}" disabled>
        @endforeach
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Veedores</label>
                            @foreach ($adscripcion->veedores as $veedor)
            <input type="text" class="form-control mb-2" value="{{ $veedor->nombre_apellido }}, DNI: {{ $veedor->dni }}, Cargo: {{ $veedor->cargo }}" disabled>
        @endforeach
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label>Adscriptos</label>
                            @foreach ($adscripcion->adscriptos as $adscripto)
            <input type="text" class="form-control mb-2" value="{{ $adscripto->nombre_apellido }}, DNI: {{ $adscripto->dni }}, Email: {{ $adscripto->email }}" disabled>
        @endforeach
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label>Designado</label>
                            <input type="text" class="form-control"
                                   value="{{ $adscripcion->designado ? $adscripcion->designado->nombre_apellido . ', DNI: ' . $adscripcion->designado->dni . ', Email: ' . $adscripcion->designado->email : 'Sin designar' }}" disabled>
                        </div>
                    </div>
                    

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <hr>
                            <a href="{{ route('adscripciones.index') }}" class="btn btn-danger">Volver al listado</a>
                            @role('admin|carga')
                                <a href="{{ route('adscripciones.edit', $adscripcion->id) }}" class="btn btn-warning">Editar Adscripción</a>
                            @endrole
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Seleccione una o más opciones',
            allowClear: true
        });
    });
</script>
@endsection
