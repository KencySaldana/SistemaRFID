@extends('layouts.app')

@section('titulo')
    Clase {{ $clase->nombre }}
@endsection

@section('contenido-profesor')
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- Botón agregado arriba de la card y cargado a la derecha -->
            <!--- quiero un formulario con un inout date y un boton de busqueda -->
            <form
                class="absolute top-0 right-30 mt-32 mr-1 px-5 py-2 shadow-sm tracking-wider text-black rounded-full bg-blue-500 m-4"
                action="{{ route('class.show', $clase) }}" method="get">
                @csrf
                <label for="label-start" class="m-4">Fecha de inicio</label>
                <input type="date" name="date_start" class="m-4" value="{{ old('date') }}">

                <label for="label-end" class="m-4">Fecha de corte</label>
                <input type="date" name="date_end" class="m-4" value="{{ old('date_end') }}">
                <button type="submit"
                    class=" text-black border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-black lg:p-0 dark:text-black lg:dark:hover:text-white dark:hover:bg-black dark:hover:text-white lg:dark:hover:bg-transparent dark:border-blue-700">Buscar</button>
            </form>

            {{-- Label para mostrar las fechas de filtrado --}}
            @if (isset($date_start) && isset($date_end))
                <div
                    class="absolute top-48 right-30 mr-1 px-5 py-2 shadow-sm tracking-wider text-black rounded-full bg-blue-500 m-4">
                    <label for="label-start" class="m-4">Fecha de inicio: {{ $date_start }}</label>
                    <label for="label-end" class="m-4">Fecha de corte: {{ $date_end }}</label>
                </div>
            @endif

            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6 mx-4">
                    @if (count($alumnosAsistieron) > 0)
                        <table class="min-w-max w-full mt-60">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">Nombre</th>
                                    <th class="py-3 px-6 text-center">Apellido</th>
                                    <th class="py-3 px-6 text-center">Matrícula</th>
                                    <th class="py-3 px-6 text-center">Fecha</th>
                                    <th class="py-3 px-6 text-center">Hora</th>
                                    <th class="py-3 px-6 text-center">% Asistencia</th>
                                    <th class="py-3 px-6 text-center">Estado</th>
                                    <th class="py-3 px-6 text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach ($alumnosAsistieron as $alumnos)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center">{{ $alumnos['usuario']->nombre }}</td>
                                        <td class="py-3 px-6 text-center">{{ $alumnos['usuario']->apellido }}</td>
                                        <td class="py-3 px-6 text-center">{{ $alumnos['usuario']->username }}</td>
                                        <td class="py-3 px-6 text-center">{{ $alumnos['fecha_asistencia'] }}</td>
                                        <td class="py-3 px-6 text-center">{{ $alumnos['hora_asistencia'] }}</td>
                                        <td class="py-3 px-6 text-center">
                                            @if ($alumnos['porcentaje_asistencia'] >= 80)
                                                <span
                                                    class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ $alumnos['porcentaje_asistencia'] }}%</span>
                                            @elseif ($alumnos['porcentaje_asistencia'] < 80)
                                                <span
                                                    class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{ $alumnos['porcentaje_asistencia'] }}%</span>
                                            @endif
                                        </td>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            @if ($alumnos['asistencia'] == 1)
                                                <span
                                                    class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Asistió</span>
                                            @elseif ($alumnos['asistencia'] == 0)
                                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">No
                                                    asistió</span>
                                            @endif
                                        </td>
                                        <td class="flex py-3 px-6 text-center items-center justify-center">
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">

                                                <a
                                                    href="{{ route('editar-asistencia', ['id' => $alumnos['usuario']->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    @else
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">No se encontraron asistencias</strong>
                            <span class="block sm:inline">No se encontraron asistencias en el rango de fechas
                                seleccionado</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="container w-1/3 mt-72 mx-4 flex justify-center justify-items-center">
                <canvas id="percentageChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
@endsection


@section('contenido-alumno')
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- Botón agregado arriba de la card y cargado a la derecha -->
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">Nombre</th>
                                <th class="py-3 px-6 text-center">Acciones</th> <!-- Cambiado de "Action" a "Acciones" -->
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($alumnosAsistieron as $alumnos)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center">{{ $alumnos['usuario']->nombre }}</td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container w-1/3 mt-4 flex justify-center justify-items-center">
        <canvas id="percentageChart" width="400" height="400"></canvas>
    </div>
@endsection




@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Obtén los porcentajes de asistencias y no asistencias de PHP y pásalos al script JavaScript
        var attendancePercentage = {{ $porcentajeAsistenciasGrupal }};
        var nonAttendancePercentage = {{ $porcentajeFaltasGrupal }};

        // Configura los datos del gráfico
        var data = {
            labels: ["Asistencias", "No asistencias"],
            datasets: [{
                label: "Asistencias",
                data: [attendancePercentage, nonAttendancePercentage],
                backgroundColor: ["#3490dc", "#f6993f"],
                hoverBackgroundColor: ["#227dc7", "#f66a0a"],
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
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: {
                            size: 14,
                        },
                    },
                },
            },
        };
        // Dibuja el gráfico en el lienzo canvas
        var ctx = document.getElementById("percentageChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "bar",
            data: data,
            options: options,
        });

        // Agregar un texto personalizado a la leyenda
        ctx.font = "14px Arial";
        ctx.fillStyle = "black";
        ctx.fillText("Porcentaje de asistencias: {{ $porcentajeAsistenciasGrupal }}%", 10, 10);
    </script>
@endsection
