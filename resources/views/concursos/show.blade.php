@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Datos del Concurso</h1>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title"><b>Información del Concurso</b></h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Número</label>
                                <input type="text" class="form-control" value="{{ $concurso->numero }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Año</label>
                                <input type="text" class="form-control" value="{{ $concurso->anio }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Fecha Concurso</label>
                                <input type="text" class="form-control" value="{{ $concurso->fecha_concurso }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Expediente</label>
                                <input type="text" class="form-control" value="{{ $concurso->expediente }}" disabled>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label>Jerarquía</label>
                                <input type="text" class="form-control" value="{{ $concurso->jerarquia->nombre ?? '' }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Tipo de Concurso</label>
                                <input type="text" class="form-control" value="{{ $concurso->tipo_concurso }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Modalidad</label>
                                <input type="text" class="form-control" value="{{ $concurso->modalidad_concurso }}" disabled>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label>Inicio Publicidad</label>
                                <input type="text" class="form-control" value="{{ $concurso->inicio_publicidad }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Cierre Publicidad</label>
                                <input type="text" class="form-control" value="{{ $concurso->cierre_publicidad }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Inicio Inscripción</label>
                                <input type="text" class="form-control" value="{{ $concurso->inicio_inscripcion }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Cierre Inscripción</label>
                                <input type="text" class="form-control" value="{{ $concurso->cierre_inscripcion }}" disabled>
                            </div>
                        </div>

                        

                        <div class="form-group mt-3">
                            <label>Observaciones</label>
                            <textarea class="form-control" disabled>{{ $concurso->observaciones }}</textarea>
                        </div>

                        <hr>

                        @php
                            function lista($items) {
                                return $items->pluck('nombre_apellido')->implode(', ');
                            }
                        @endphp

                        <div class="row">
                            <div class="col-md-4">
                                <label>Asignaturas</label>
                                <textarea class="form-control" disabled>{{ $concurso->asignaturas->pluck('nombre')->implode(', ') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label>Departamentos</label>
                                <textarea class="form-control" disabled>{{ $concurso->departamentos->pluck('nombre')->implode(', ') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label>Carreras</label>
                                <textarea class="form-control" disabled>{{ $concurso->carreras->pluck('nombre')->implode(', ') }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Docentes Titulares</label>
                                <textarea class="form-control" disabled>{{ lista($concurso->docentesTitulares) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Docentes Suplentes</label>
                                <textarea class="form-control" disabled>{{ lista($concurso->docentesSuplentes) }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Estudiantes Titulares</label>
                                <textarea class="form-control" disabled>{{ lista($concurso->estudiantesTitulares) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Estudiantes Suplentes</label>
                                <textarea class="form-control" disabled>{{ lista($concurso->estudiantesSuplentes) }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Veedores</label>
                                <textarea class="form-control" disabled>{{ lista($concurso->veedores) }}</textarea>
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Inscriptos</label>
                                <textarea class="form-control" disabled>{{ lista($concurso->inscriptos) }}</textarea>
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <hr>
                                <a href="{{ route('concursos.index') }}" class="btn btn-danger">Volver al listado</a>
                                <a href="{{ route('concursos.edit', $concurso->id) }}" class="btn btn-warning">Editar Concurso</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
