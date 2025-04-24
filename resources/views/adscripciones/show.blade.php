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
                                <input type="text" class="form-control" value="{{ $adscripcion->fecha_adscripcion }}" disabled>
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
                                <input type="text" class="form-control" value="{{ $adscripcion->inicio_publicidad }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Cierre Publicidad</label>
                                <input type="text" class="form-control" value="{{ $adscripcion->cierre_publicidad }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Inicio Inscripción</label>
                                <input type="text" class="form-control" value="{{ $adscripcion->inicio_inscripcion }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Cierre Inscripción</label>
                                <input type="text" class="form-control" value="{{ $adscripcion->cierre_inscripcion }}" disabled>
                            </div>
                        </div>

                        

                        <div class="form-group mt-3">
                            <label>Observaciones</label>
                            <textarea class="form-control" disabled>{{ $adscripcion->observaciones }}</textarea>
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
                                <textarea class="form-control" disabled>{{ $adscripcion->asignaturas->pluck('nombre')->implode(', ') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label>Departamentos</label>
                                <textarea class="form-control" disabled>{{ $adscripcion->departamentos->pluck('nombre')->implode(', ') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label>Carreras</label>
                                <textarea class="form-control" disabled>{{ $adscripcion->carreras->pluck('nombre')->implode(', ') }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Docentes Titulares</label>
                                <textarea class="form-control" disabled>{{ lista($adscripcion->docentesTitulares) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Docentes Suplentes</label>
                                <textarea class="form-control" disabled>{{ lista($adscripcion->docentesSuplentes) }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Estudiantes Titulares</label>
                                <textarea class="form-control" disabled>{{ lista($adscripcion->estudiantesTitulares) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Estudiantes Suplentes</label>
                                <textarea class="form-control" disabled>{{ lista($adscripcion->estudiantesSuplentes) }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Veedores</label>
                                <textarea class="form-control" disabled>{{ lista($adscripcion->veedores) }}</textarea>
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Adscriptos</label>
                                <textarea class="form-control" disabled>{{ lista($adscripcion->adscriptos) }}</textarea>
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <hr>
                                <a href="{{ route('adscripciones.index') }}" class="btn btn-danger">Volver al listado</a>
                                <a href="{{ route('adscripciones.edit', $adscripcion->id) }}" class="btn btn-warning">Editar Adscripción</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
