@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    <h1>Creación de un nuevo Concurso</h1>

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
                    <form action="{{ route('concursos.store') }}" method="POST">
                        @csrf

                        <!-- JERARQUÍA -->
                        <div class="form-group">
                            <label>Jerarquía</label><b>*</b>
                            <select name="jerarquia_id" class="form-control selectpicker" data-live-search="true" required>
                                <option value="">Seleccione</option>
                                @foreach ($jerarquias as $jerarquia)
                                    <option value="{{ $jerarquia->id }}">{{ $jerarquia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ASIGNATURA -->
                        <div class="form-group">
                            <label>Asignatura</label><b>*</b>
                            <select name="asignatura_id" class="form-control selectpicker" data-live-search="true" required>
                                <option value="">Seleccione</option>
                                @foreach ($asignaturas as $asignatura)
                                    <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- DEPARTAMENTO -->
                        <div class="form-group">
                            <label>Departamento</label><b>*</b>
                            <select name="departamento_id" class="form-control selectpicker" data-live-search="true" required>
                                <option value="">Seleccione</option>
                                @foreach ($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- CARRERAS -->
                        <div class="form-group">
                            <label>Carreras (múltiples)</label>
                            <select name="carreras[]" class="form-control selectpicker" multiple data-live-search="true" title="Seleccione carreras">
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- DOCENTES TITULARES -->
                        <div class="form-group">
                            <label>Docentes Titulares</label>
                            <select name="docentes_titulares[]" class="form-control selectpicker" multiple data-live-search="true" title="Seleccione docentes titulares">
                                @foreach ($docentes as $docente)
                                    <option value="{{ $docente->id }}">{{ $docente->nombre_apellido }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ESTUDIANTES TITULARES -->
                        <div class="form-group">
                            <label>Estudiantes Titulares</label>
                            <select name="estudiantes_titulares[]" class="form-control selectpicker" multiple data-live-search="true" title="Seleccione estudiantes titulares">
                                @foreach ($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}">{{ $estudiante->nombre_apellido }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ESTUDIANTES SUPLENTES -->
                        <div class="form-group">
                            <label>Estudiantes Suplentes</label>
                            <select name="estudiantes_suplentes[]" class="form-control selectpicker" multiple data-live-search="true" title="Seleccione estudiantes suplentes">
                                @foreach ($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}">{{ $estudiante->nombre_apellido }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- VEEDORES -->
                        <div class="form-group">
                            <label>Veedores</label>
                            <select name="veedores[]" class="form-control selectpicker" multiple data-live-search="true" title="Seleccione veedores">
                                @foreach ($veedores as $veedor)
                                    <option value="{{ $veedor->id }}">{{ $veedor->nombre_apellido }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- OTROS CAMPOS -->
                        <div class="form-group">
                            <label>Tipo de Concurso</label>
                            <input type="text" name="tipo_concurso" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Fecha del Concurso</label>
                            <input type="date" name="fecha_concurso" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Expediente</label>
                            <input type="text" name="expediente" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Período de Inscripción</label>
                            <textarea name="periodo_inscripcion" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="observaciones" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <textarea name="estado" class="form-control"></textarea>
                        </div>

                        <!-- BOTONES -->
                        <hr>
                        <div class="form-group">
                            <a href="{{ route('concursos.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Concurso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========= RECURSOS PARA SELECTPICKER ========= -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 4 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Select -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<!-- Activación -->
<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
</script>
@endsection
