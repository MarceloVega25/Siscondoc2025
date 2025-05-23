@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Datos de la Jerarquía</h1>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title"><b>Datos Registrados</b></h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" value="{{ $jerarquia->nombre }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Siglas</label>
                                    <input type="text" class="form-control" value="{{ $jerarquia->siglas }}" disabled>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <hr>
                                <a href="{{ route('jerarquias.index') }}" class="btn btn-danger">Volver al listado</a>
                                @role('admin|carga')
                                <a href="{{ route('jerarquias.edit', $jerarquia->id) }}" class="btn btn-warning">Editar Jerarquía</a>
                            @endrole
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
