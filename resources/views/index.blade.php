@extends('layouts.admin')

@section('content')

<div class="content" style="margin: 20px" >
  <h1>¡¡Bienvenido!!</h1>
  <br>

  <div class="row">
    <div class="col-lg-3">
      <!-- small box -->
      <div class="small-box bg-primary" style="height: 160px">
        <div class="inner">
          <?php $contador_de_inscripto = 0; ?>
          @foreach ($inscriptos as $inscripto)
          <?php $contador_de_inscripto = $contador_de_inscripto + 1;?>            
          @endforeach
          <h3><?=$contador_de_inscripto;?></h3>

          <p>Inscriptos</p>
        </div>
        <div class="icon">
          <i class="bi bi-person-badge"></i>
        </div>
        <a href="{{ url('inscriptos') }}" class="small-box-footer" style="margin-top: 20px">Más información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3">
      <!-- small box -->
      <div class="small-box bg-success" style="height: 160px">
        <div class="inner">
          <?php $contador_de_adscripto = 0; ?>
          @foreach ($adscriptos as $adscripto)
          <?php $contador_de_adscripto = $contador_de_adscripto + 1;?>            
          @endforeach
          <h3><?=$contador_de_adscripto;?></h3>

          <p>Adscriptos</p>
        </div>
        <div class="icon">
          <i class="bi bi-file-earmark-person-fill"></i>
        </div>
        <a href="{{ url('adscriptos') }}" class="small-box-footer" style="margin-top: 20px">Más información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3">
      <!-- small box -->
      <div class="small-box bg-warning" style="height: 160px">
        <div class="inner">
          <?php $contador_de_docente = 0; ?>
          @foreach ($docentes as $docente)
          <?php $contador_de_docente = $contador_de_docente + 1;?>            
          @endforeach
          <h3><?=$contador_de_docente;?></h3>

          <p>Docentes</p>
        </div>
        <div class="icon">
          <i class="bi bi-people"></i>
        </div>
        <a href="{{ url('docentes') }}" class="small-box-footer" style="margin-top: 20px">Más información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3">
      <!-- small box -->
      <div class="small-box bg-secondary" style="height: 160px">
        <div class="inner">
          <?php $contador_de_estudiante = 0; ?>
          @foreach ($estudiantes as $estudiante)
          <?php $contador_de_estudiante = $contador_de_estudiante + 1;?>            
          @endforeach
          <h3><?=$contador_de_estudiante;?></h3>

          <p>Estudiantes</p>
        </div>
        <div class="icon">
          <i class="bi bi-person-rolodex"></i>
        </div>
        <a href="{{ url('estudiantes') }}" class="small-box-footer" style="margin-top: 20px">Más información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3">
      <!-- small box -->
      <div class="small-box bg-danger" style="height: 160px">
        <div class="inner">
          <?php $contador_de_veedor = 0; ?>
          @foreach ($veedores as $veedor)
          <?php $contador_de_veedor = $contador_de_veedor + 1;?>            
          @endforeach
          <h3><?=$contador_de_veedor;?></h3>

          <p>Veedores</p>
        </div>
        <div class="icon">
          <i class="bi bi-person-fill-check"></i>
        </div>
        <a href="{{ url('veedores') }}" class="small-box-footer" style="margin-top: 20px">Más información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    
    <!-- ./col -->
    <div class="col-lg-3">
      <!-- small box -->
      <div class="small-box bg-dark" style="height: 160px">
        <div class="inner">
          <?php $contador_de_usuario = 0; ?>
          @foreach ($usuarios as $usuario)
          <?php $contador_de_usuario = $contador_de_usuario + 1;?>            
          @endforeach
          <h3><?=$contador_de_usuario;?></h3>

          <p>Usuarios</p>
        </div>
        <div class="icon">
          <i class="bi bi-person-workspace"></i>
        </div>
        <a href="{{ url('usuarios') }}" class="small-box-footer" style="margin-top: 20px">Más información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

  </div>

</div>

@endsection