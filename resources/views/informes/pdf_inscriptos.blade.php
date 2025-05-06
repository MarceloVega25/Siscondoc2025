<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Informe de Inscriptos</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto');
        body { font-family: Roboto, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h3>Informe de Inscriptos</h3>

    @php use Carbon\Carbon; @endphp

    @if (isset($desde) && isset($hasta))
        <p>Desde: {{ Carbon::parse($desde)->format('d/m/Y') }} — Hasta: {{ Carbon::parse($hasta)->format('d/m/Y') }}</p>
    @elseif (isset($anio))
        <p>Año: {{ $anio }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $inscripto)
                <tr>
                    <td>{{ $inscripto->nombre_apellido }}</td>
                    <td>{{ $inscripto->dni }}</td>
                    <td>{{ $inscripto->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 20px;"><strong>Total de inscriptos: {{ $datos->count() }}</strong></p>
</body>
</html>
