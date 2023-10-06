@extends('layouts.app')
@section('contenido-alumno')
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- dropdown agregado encima de la tabla -->
            <h2
                class="text-3xl font-semibold text-indigo-700 absolute top-0 right-0  mt-32 mr-24 px-5 py-2 shadow-sm tracking-wider  m-4">
                Porcentaje de asistencia: {{ $porcentaje }} %</h2>

            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">Fecha</th>
                                <th class="py-3 px-6 text-center">Hora</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($asistencias as $asistencia)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center">{{ $asistencia->fecha }}</td>
                                    <td class="py-3 px-6 text-center">{{ $asistencia->hora }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto mt-4">
        <canvas id="percentageChart" width="400" height="400"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Obtén los porcentajes de asistencias y no asistencias de PHP y pásalos al script JavaScript
        var attendancePercentage = {{ $porcentaje }};
        var nonAttendancePercentage = 100 - attendancePercentage;

        // Configura los datos del gráfico de asistencias
        var attendanceData = {
            labels: ["Asistencias"],
            datasets: [{
                data: [attendancePercentage],
                backgroundColor: ["#3490dc"],
                hoverBackgroundColor: ["#227dc7"],
            }],
        };

        // Configura las opciones de los gráficos
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                },
            },
        };

        // Dibuja el gráfico en el lienzo canvas
        var ctx = document.getElementById("percentageChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "bar",
            data: attendanceData,
            options: options,
        });

        // Agregar un texto personalizado a la leyenda
        ctx.font = "14px Arial";
        ctx.fillStyle = "black";
        ctx.fillText("Porcentaje de asistencias: {{ $porcentaje }}%", 10, 10);
    </script>
@endsection
