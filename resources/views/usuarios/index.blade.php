@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Listado de Usuarios</h1>

        @if ($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen Trabajo!",
                    text: "{{ $message }}",
                    icon: "success"
                });
            </script>
        @endif


        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title"><b>INSCRIPTOS REGISTRADOS</b></h3>
                        <div class="card-tools">
                            <a href="{{ route('usuarios.buscar') }}" class="btn btn-primary">
                                <i class="bi bi-person-add"></i>Agregar Nuevo Usuario
                            </a>
                                                        
                        </div>
                    </div>

                    <div class="card-body" style="display: block;">

                        <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nombre y Apellido</th>
                                    <!--<th>DNI</th>-->
                                    <!--<th>Fec.Nac</th>-->
                                    <!--<th>Genero</th>-->
                                    <th>Mail</th>
                                    <th>Estado</th>
                                    <!--<th>Direccion</th>-->
                                    <!--<th>Localidad/Ciudad</th>-->
                                    <!--<th>Cv</th>-->
                                    <!--<th>Foto</th>-->
                                    <!--<th>Fecha de Ingreso</th>-->
                                    <th>Rol</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>
                                            <?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $usuario->nombre_apellido }}</td>
                                        <!--<td><td>{{ $usuario->dni }}</td>-->
                                        <!--<td><td>{{ $usuario->fecha_nacimiento }}</td>-->
                                        <!--<td><td>{{ $usuario->genero }}</td>-->
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->estado }}</td>
                                        <!--<td><td>{{ $usuario->direccion }}</td>-->
                                        <!--<td><td>{{ $usuario->localidad_ciudad }}</td>-->
                                        <!--<td><td>{{ $usuario->cv }}</td>-->
                                        <!--<td>{{ \Carbon\Carbon::parse($usuario->fecha_ingreso)->format('d/m/Y') }}</td>-->
                                        <!--<td>{{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y H:i') }}</td>-->
                                        <td>
                                            {{ $usuario->getRoleNames()->map(function($rol) {
                                                return ucfirst($rol);
                                            })->implode(', ') }}
                                        </td>
                                        
                                        
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('/usuarios', $usuario->id) }}" type="button"
                                                    class="btn btn-info"><i class="bi bi-eye"></i></a>

                                                <a href="{{ route('usuarios.edit', $usuario->id) }}" type="button"
                                                    class="btn btn-success"><i class="bi bi-pencil"></i></a>

                                                    <form id="delete-form-{{ $usuario->id }}" action="{{ url('/usuarios', $usuario->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" onclick="confirmarEliminacion({{ $usuario->id }})">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>
                                                    
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            $(function() {
                                $("#example1").DataTable({
                                    "pageLength": 10,
                                    "language": {
                                        "emptyTable": "No hay información",
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                                        "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Usuarios", //hacer hincapie en los _MAYUSCULA_
                                        "loadingRecords": "Cargando...",
                                        "processing": "Procesando...",
                                        "search": "Buscador:",
                                        "zeroRecords": "Sin resultados encontrados",
                                        "paginate": {
                                            "first": "Primero",
                                            "last": "Ultimo",
                                            "next": "Siguiente",
                                            "previous": "Anterior"
                                        }
                                    },
                                    "responsive": true,
                                    "lengthChange": true,
                                    "autoWidth": false,
                                    buttons: [{
                                            extend: 'collection',
                                            text: 'Reportes',
                                            orientation: 'landscape',
                                            buttons: [{
                                                text: 'Copiar',
                                                extend: 'copy',
                                            }, {
                                                extend: 'pdf'
                                            }, {
                                                extend: 'csv'
                                            }, {
                                                extend: 'excel'
                                            }, {
                                                text: 'Imprimir',
                                                extend: 'print'
                                            }]
                                        },
                                        {
                                            extend: 'colvis',
                                            text: 'Visor de columnas',
                                            collectionLayout: 'fixed three-column'
                                        }
                                    ],
                                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tus botones y tabla... -->

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
</script>

@endsection