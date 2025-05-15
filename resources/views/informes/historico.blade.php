@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    <h1>Historial de Informes Generados</h1>

    {{-- MENSAJES FLASH --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-md-11">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title"><b>Informes registrados</b></h3>
                </div>

                <div class="card-body">
                    @if ($historial->count() > 0)
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <!--<th>#</th>-->
                                <th>Módulo</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Año</th>
                                <th>Generado por</th>
                                <th>Fecha de generación</th>
                                <th>PDF Generado</th>
                                @role('admin')
                                    <th>Acciones</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historial as $item)
                                <tr>
                                    <!--<td>{{ $item->id }}</td>-->
                                    <td>{{ ucfirst($item->modulo) }}</td>
                                    <td>{{ $item->fecha_desde ? \Carbon\Carbon::parse($item->fecha_desde)->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $item->fecha_hasta ? \Carbon\Carbon::parse($item->fecha_hasta)->format('d/m/Y') : '-' }}</td>                                    
                                    <td>{{ $item->anio ?? '-' }}</td>
                                    <td>{{ $item->usuario }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>

                                    <td>
                                        @if ($item->archivo_pdf)
                                            <a href="{{ asset('storage/informes/' . $item->archivo_pdf) }}" class="btn btn-sm btn-success" target="_blank">
                                                <i class="fas fa-file-pdf"></i> Ver PDF
                                            </a>
                                        @else
                                            <span class="text-muted">No disponible</span>
                                        @endif
                                    </td>
                                    
                                    @role('admin')
                                    <td>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('informes.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion({{ $item->id }})">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </td>
                                    @endrole
                                    

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $historial->links() }}
                    </div>
                    @else
                        <div class="alert alert-warning">
                            No se encontraron informes generados.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmarEliminacion(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Buen Trabajo!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33',
        });
    @endif
</script>
@endsection
