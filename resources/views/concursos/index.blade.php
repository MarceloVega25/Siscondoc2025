@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    <h2>Listado de Concursos</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}

        </div>
    @endif

    <a href="{{ route('concursos.create') }}" class="btn btn-success mb-3">Nuevo Concurso</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Número</th>
                <th>Año</th>
                <th>Jerarquía</th>
                <th>Asignatura</th>
                <th>Departamento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($concursos as $concurso)
                <tr>
                    <td>{{ $concurso->numero }}</td>
                    <td>{{ $concurso->año }}</td>
                    <td>{{ $concurso->jerarquia->nombre ?? 'N/A' }}</td>
                    <td>{{ $concurso->asignatura->nombre ?? 'N/A' }}</td>
                    <td>{{ $concurso->departamento->nombre ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('concursos.show', $concurso) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('concursos.edit', $concurso) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('concursos.destroy', $concurso) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
