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
                                <input type="text" class="form-control" value="{{ $concurso->fecha_concurso ? \Carbon\Carbon::parse($concurso->fecha_concurso)->format('d/m/Y') : '' }}" disabled>
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
                                <input type="text" class="form-control" value="{{ $concurso->inicio_publicidad ? \Carbon\Carbon::parse($concurso->inicio_publicidad)->format('d/m/Y') : '' }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Cierre Publicidad</label>
                                <input type="text" class="form-control" value="{{ $concurso->cierre_publicidad ? \Carbon\Carbon::parse($concurso->cierre_publicidad)->format('d/m/Y') : '' }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Inicio Inscripción</label>
                                <input type="text" class="form-control" value="{{ $concurso->inicio_inscripcion ? \Carbon\Carbon::parse($concurso->inicio_inscripcion)->format('d/m/Y') : '' }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Cierre Inscripción</label>
                                <input type="text" class="form-control" value="{{ $concurso->cierre_inscripcion ? \Carbon\Carbon::parse($concurso->cierre_inscripcion)->format('d/m/Y') : '' }}" disabled>
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
                                @foreach ($concurso->docentesTitulares as $docente)
                                    <input type="text" class="form-control mb-2" value="{{ $docente->nombre_apellido }}, DNI: {{ $docente->dni }}, Institución: {{ $docente->institucion }}" disabled>
                                @endforeach
                            </div>
                            
                            <div class="col-md-6">
                                <label>Docentes Suplentes</label>
                                @foreach ($concurso->docentesSuplentes as $docente)
                                    <input type="text" class="form-control mb-2" value="{{ $docente->nombre_apellido }}, DNI: {{ $docente->dni }}, Institución: {{ $docente->institucion }}" disabled>
                                @endforeach
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Estudiantes Titulares</label>
                                @foreach ($concurso->estudiantesTitulares as $estudiante)
                                    <input type="text" class="form-control mb-2" value="{{ $estudiante->nombre_apellido }}, DNI: {{ $estudiante->dni }}, Institución: {{ $estudiante->institucion }}" disabled>
                                @endforeach
                            </div>

                            <div class="col-md-6">
                                <label>Estudiantes Suplentes</label>
                                @foreach ($concurso->estudiantesSuplentes as $estudiante)
                                    <input type="text" class="form-control mb-2" value="{{ $estudiante->nombre_apellido }}, DNI: {{ $estudiante->dni }}, Institución: {{ $estudiante->institucion }}" disabled>
                                @endforeach
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Veedores</label>
                                @foreach ($concurso->veedores as $veedor)
                                <input type="text" class="form-control mb-2" value="{{ $veedor->nombre_apellido }}, DNI: {{ $veedor->dni }}, Cargo: {{ $veedor->cargo }}" disabled>
                            @endforeach
                        </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Inscriptos</label>
                                @foreach ($concurso->inscriptos as $inscripto)
            <input type="text" class="form-control mb-2" value="{{ $inscripto->nombre_apellido }}, DNI: {{ $inscripto->dni }}, Email: {{ $inscripto->email }}" disabled>
        @endforeach
    </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Designado</label>
                                <input type="text" class="form-control"
                                       value="{{ $concurso->designado ? $concurso->designado->nombre_apellido . ', DNI: ' . $concurso->designado->dni . ', Email: ' . $concurso->designado->email : 'Sin designar' }}" disabled>
                            </div>
                        </div>
                        
                        
                    </div>
                    

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <hr>
                                <a href="{{ route('concursos.index') }}" class="btn btn-danger">Volver al listado</a>
                                @role('admin|carga')
                                <a href="{{ route('concursos.edit', $concurso->id) }}" class="btn btn-warning">Editar Concurso</a>
                            @endrole
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
