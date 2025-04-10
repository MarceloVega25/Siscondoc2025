@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    <h2>Detalle del Concurso</h2>

    <div class="row mb-3">
        <div class="col">
            <label>Número de Concurso</label>
            <input type="text" class="form-control" value="{{ $concurso->numero }}" disabled>
        </div>
        <div class="col">
            <label>Año</label>
            <input type="text" class="form-control" value="{{ $concurso->año }}" disabled>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label>Jerarquía</label>
            <input type="text" class="form-control" value="{{ $concurso->jerarquia->nombre ?? 'N/A' }}" disabled>
        </div>
        <div class="col">
            <label>Asignatura</label>
            <input type="text" class="form-control" value="{{ $concurso->asignatura->nombre ?? 'N/A' }}" disabled>
        </div>
        <div class="col">
            <label>Departamento</label>
            <input type="text" class="form-control" value="{{ $concurso->departamento->nombre ?? 'N/A' }}" disabled>
        </div>
    </div>

    <div class="mb-3">
        <label>Tipo de Concurso</label>
        <input type="text" class="form-control" value="{{ $concurso->tipo_concurso }}" disabled>
    </div>

    <div class="mb-3">
        <label>Fecha del Concurso</label>
        <input type="text" class="form-control" value="{{ $concurso->fecha_concurso }}" disabled>
    </div>

    <div class="mb-3">
        <label>Expediente</label>
        <input type="text" class="form-control" value="{{ $concurso->expediente }}" disabled>
    </div>

    <div class="mb-3">
        <label>Período de Inscripción</label>
        <textarea class="form-control" disabled>{{ $concurso->periodo_inscripcion }}</textarea>
    </div>

    <div class="mb-3">
        <label>Observaciones</label>
        <textarea class="form-control" disabled>{{ $concurso->observaciones }}</textarea>
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <textarea class="form-control" disabled>{{ $concurso->estado }}</textarea>
    </div>

    <div class="mb-3">
        <label>Carreras</label>
        <ul>
            @forelse($concurso->carreras as $carrera)
                <li>{{ $carrera->nombre }}</li>
            @empty
                <li>No registradas</li>
            @endforelse
        </ul>
    </div>

    <div class="mb-3">
        <label>Inscriptos</label>
        <ul>
            @forelse($concurso->inscriptos as $inscripto)
                <li>{{ $inscripto->nombre_apellido }} (DNI: {{ $inscripto->dni }})</li>
            @empty
                <li>No registrados</li>
            @endforelse
        </ul>
    </div>

    <div class="mb-3">
        <label>Docentes</label>
        <ul>
            @forelse($concurso->docentes as $docente)
                <li>{{ $docente->nombre_apellido }} ({{ ucfirst($docente->pivot->tipo) }})</li>
            @empty
                <li>No registrados</li>
            @endforelse
        </ul>
    </div>

    <div class="mb-3">
        <label>Estudiantes</label>
        <ul>
            @forelse($concurso->estudiantes as $estudiante)
                <li>{{ $estudiante->nombre_apellido }} ({{ ucfirst($estudiante->pivot->tipo) }})</li>
            @empty
                <li>No registrados</li>
            @endforelse
        </ul>
    </div>

    <div class="mb-3">
        <label>Veedores</label>
        <ul>
            @forelse($concurso->veedores as $veedor)
                <li>{{ $veedor->nombre_apellido }} - {{ $veedor->institucion }}</li>
            @empty
                <li>No registrados</li>
            @endforelse
        </ul>
    </div>

    <div class="text-end">
        <a href="{{ route('concursos.index') }}" class="btn btn-danger">Volver al listado</a>
        <a href="{{ route('concursos.edit', $concurso) }}" class="btn btn-primary">Editar</a>
    </div>
</div>
@endsection
