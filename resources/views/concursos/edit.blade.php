@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    <h2>Editar Concurso</h2>

    <form action="{{ route('concursos.update', $concurso) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col">
                <label>Número de Concurso</label>
                <input type="text" name="numero" class="form-control" value="{{ old('numero', $concurso->numero) }}" required>
            </div>
            <div class="col">
                <label>Año</label>
                <input type="number" name="año" class="form-control" value="{{ old('año', $concurso->año) }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Jerarquía</label>
                <select name="jerarquia_id" class="form-control" required>
                    @foreach($jerarquias as $jerarquia)
                        <option value="{{ $jerarquia->id }}" {{ $concurso->jerarquia_id == $jerarquia->id ? 'selected' : '' }}>
                            {{ $jerarquia->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label>Asignatura</label>
                <select name="asignatura_id" class="form-control" required>
                    @foreach($asignaturas as $asignatura)
                        <option value="{{ $asignatura->id }}" {{ $concurso->asignatura_id == $asignatura->id ? 'selected' : '' }}>
                            {{ $asignatura->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label>Departamento</label>
                <select name="departamento_id" class="form-control" required>
                    @foreach($departamentos as $departamento)
                        <option value="{{ $departamento->id }}" {{ $concurso->departamento_id == $departamento->id ? 'selected' : '' }}>
                            {{ $departamento->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Carreras (múltiples)</label>
            <select name="carreras[]" class="form-control" multiple>
                @foreach($carreras as $carrera)
                    <option value="{{ $carrera->id }}" {{ $concurso->carreras->contains($carrera->id) ? 'selected' : '' }}>
                        {{ $carrera->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tipo de Concurso</label>
            <input type="text" name="tipo_concurso" class="form-control" value="{{ old('tipo_concurso', $concurso->tipo_concurso) }}" required>
        </div>

        <div class="mb-3">
            <label>Fecha del Concurso</label>
            <input type="date" name="fecha_concurso" class="form-control" value="{{ old('fecha_concurso', $concurso->fecha_concurso) }}">
        </div>

        <div class="mb-3">
            <label>Expediente</label>
            <input type="text" name="expediente" class="form-control" value="{{ old('expediente', $concurso->expediente) }}">
        </div>

        <div class="mb-3">
            <label>Período de Inscripción</label>
            <textarea name="periodo_inscripcion" class="form-control">{{ old('periodo_inscripcion', $concurso->periodo_inscripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control">{{ old('observaciones', $concurso->observaciones) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <textarea name="estado" class="form-control">{{ old('estado', $concurso->estado) }}</textarea>
        </div>

        <hr>

        <div class="mb-3">
            <label>Inscriptos (múltiples)</label>
            <select name="inscriptos[]" class="form-control" multiple>
                @foreach($inscriptos as $inscripto)
                    <option value="{{ $inscripto->id }}" {{ $concurso->inscriptos->contains($inscripto->id) ? 'selected' : '' }}>
                        {{ $inscripto->nombre_apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Docentes</label>
            @foreach($docentes as $docente)
                @php
                    $tipo = $concurso->docentes->firstWhere('id', $docente->id)?->pivot->tipo;
                @endphp
                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="docentes[{{ $docente->id }}]" value="titular" {{ $tipo === 'titular' ? 'checked' : '' }}>
                    <label class="form-check-label">Titular - {{ $docente->nombre_apellido }}</label>
                    <br>
                    <input class="form-check-input" type="radio" name="docentes[{{ $docente->id }}]" value="suplente" {{ $tipo === 'suplente' ? 'checked' : '' }}>
                    <label class="form-check-label">Suplente - {{ $docente->nombre_apellido }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Estudiantes</label>
            @foreach($estudiantes as $estudiante)
                @php
                    $tipo = $concurso->estudiantes->firstWhere('id', $estudiante->id)?->pivot->tipo;
                @endphp
                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="estudiantes[{{ $estudiante->id }}]" value="titular" {{ $tipo === 'titular' ? 'checked' : '' }}>
                    <label class="form-check-label">Titular - {{ $estudiante->nombre_apellido }}</label>
                    <br>
                    <input class="form-check-input" type="radio" name="estudiantes[{{ $estudiante->id }}]" value="suplente" {{ $tipo === 'suplente' ? 'checked' : '' }}>
                    <label class="form-check-label">Suplente - {{ $estudiante->nombre_apellido }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Veedores (múltiples)</label>
            <select name="veedores[]" class="form-control" multiple>
                @foreach($veedores as $veedor)
                    <option value="{{ $veedor->id }}" {{ $concurso->veedores->contains($veedor->id) ? 'selected' : '' }}>
                        {{ $veedor->nombre_apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-end">
            <a href="{{ route('concursos.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar Concurso</button>
        </div>
    </form>
</div>
@endsection
