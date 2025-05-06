@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Actualizar Datos del Concurso</h1>

        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{ $error }}</li>
            </div>
        @endforeach

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>ACTUALICE LOS DATOS</b></h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('concursos.update', $concurso->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-3">
                                    <label>Número</label><b>*</b>
                                    <input type="number" name="numero" class="form-control" value="{{ $concurso->numero }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Año</label><b>*</b>
                                    <input type="number" name="anio" class="form-control" value="{{ $concurso->anio }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Fecha Concurso</label>
                                    <input type="date" name="fecha_concurso" class="form-control" value="{{ $concurso->fecha_concurso }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Expediente</label>
                                    <input type="text" name="expediente" class="form-control" value="{{ $concurso->expediente }}">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label>Jerarquía</label><b>*</b>
                                    <select name="jerarquia_id" class="form-control" required>
                                        <option value="">Seleccione una Jerarquia</option>
                                        @foreach ($jerarquias as $j)
                                            <option value="{{ $j->id }}" {{ $concurso->jerarquia_id == $j->id ? 'selected' : '' }}>
                                                {{ $j->nombre }} ({{ $j->siglas }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Tipo de Concurso</label><b>*</b>
                                    <select name="tipo_concurso" class="form-control" required>
                                        <option value="Abierto" {{ $concurso->tipo_concurso == 'Abierto' ? 'selected' : '' }}>Abierto</option>
                                        <option value="Cerrado" {{ $concurso->tipo_concurso == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Modalidad</label><b>*</b>
                                    <select name="modalidad_concurso" class="form-control" required>
                                        <option value="Presencial" {{ $concurso->modalidad_concurso == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                        <option value="Virtual" {{ $concurso->modalidad_concurso == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                                        <option value="Mixta" {{ $concurso->modalidad_concurso == 'Mixta' ? 'selected' : '' }}>Mixta</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <label>Inicio Publicidad</label>
                                    <input type="date" name="inicio_publicidad" class="form-control" value="{{ $concurso->inicio_publicidad }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Cierre Publicidad</label>
                                    <input type="date" name="cierre_publicidad" class="form-control" value="{{ $concurso->cierre_publicidad }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Inicio Inscripción</label>
                                    <input type="date" name="inicio_inscripcion" class="form-control" value="{{ $concurso->inicio_inscripcion }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Cierre Inscripción</label>
                                    <input type="date" name="cierre_inscripcion" class="form-control" value="{{ $concurso->cierre_inscripcion }}">
                                </div>
                            </div>

                            

                            <div class="form-group mt-3">
                                <label>Observaciones</label>
                                <textarea name="observaciones" class="form-control">{{ $concurso->observaciones }}</textarea>
                            </div>

                            <hr>

                            @php
                                function isSelected($collection, $id) {
                                    return in_array($id, $collection->pluck('id')->toArray()) ? 'selected' : '';
                                }
                            @endphp

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label>Asignaturas</label>
                                    <select name="asignaturas[]" class="form-control select2" multiple>
                                        @foreach ($asignaturas as $a)
                                            <option value="{{ $a->id }}" {{ isSelected($concurso->asignaturas, $a->id) }}>{{ $a->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Departamentos</label>
                                    <select name="departamentos[]" class="form-control select2" multiple>
                                        @foreach ($departamentos as $d)
                                            <option value="{{ $d->id }}" {{ isSelected($concurso->departamentos, $d->id) }}>{{ $d->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Carreras</label>
                                    <select name="carreras[]" class="form-control select2" multiple>
                                        @foreach ($carreras as $c)
                                            <option value="{{ $c->id }}" {{ isSelected($concurso->carreras, $c->id) }}>{{ $c->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label>Docentes Titulares</label>
                                    <select name="docentes_titulares[]" class="form-control select2" multiple>
                                        @foreach ($docentes as $d)
                                            <option value="{{ $d->id }}" {{ isSelected($concurso->docentesTitulares, $d->id) }}>{{ $d->nombre_apellido }}, DNI: {{ $d->dni }}, Institución: {{ $d->institucion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Docentes Suplentes</label>
                                    <select name="docentes_suplentes[]" class="form-control select2" multiple>
                                        @foreach ($docentes as $d)
                                            <option value="{{ $d->id }}" {{ isSelected($concurso->docentesSuplentes, $d->id) }}>{{ $d->nombre_apellido }}, DNI: {{ $d->dni }}, Institución: {{ $d->institucion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label>Estudiantes Titulares</label>
                                    <select name="estudiantes_titulares[]" class="form-control select2" multiple>
                                        @foreach ($estudiantes as $e)
                                            <option value="{{ $e->id }}" {{ isSelected($concurso->estudiantesTitulares, $e->id) }}>{{ $e->nombre_apellido }}, DNI: {{ $e->dni }}, Institución: {{ $e->institucion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Estudiantes Suplentes</label>
                                    <select name="estudiantes_suplentes[]" class="form-control select2" multiple>
                                        @foreach ($estudiantes as $e)
                                            <option value="{{ $e->id }}" {{ isSelected($concurso->estudiantesSuplentes, $e->id) }}>{{ $e->nombre_apellido }}, DNI: {{ $e->dni }}, Institución: {{ $e->institucion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label>Veedores</label>
                                    <select name="veedores[]" class="form-control select2" multiple>
                                        @foreach ($veedores as $v)
                                            <option value="{{ $v->id }}" {{ isSelected($concurso->veedores, $v->id) }}>{{ $v->nombre_apellido }}, DNI: {{ $v->dni }}, Cargo: {{ $v->cargo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>Inscriptos</label>
                                    <select name="inscriptos[]" class="form-control select2" multiple>
                                        @foreach ($inscriptos as $i)
                                            <option value="{{ $i->id }}" {{ isSelected($concurso->inscriptos, $i->id) }}>{{ $i->nombre_apellido }}, DNI: {{ $i->dni }}, Email: {{ $i->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>Designado</label>
                                    <select name="designado_id" class="form-control">
                                        <option value="">Seleccione un inscripto designado</option>
                                        @foreach ($concurso->inscriptos as $i)
                                            <option value="{{ $i->id }}" {{ $concurso->designado_id == $i->id ? 'selected' : '' }}>
                                                {{ $i->nombre_apellido }}, DNI: {{ $i->dni }}, Email: {{ $i->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>

                            <hr>


                            <div class="form-group mt-4">
                                <a href="{{ route('concursos.index') }}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">Actualizar Registro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert para errores -->
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error en el formulario',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

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
