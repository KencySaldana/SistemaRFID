@extends('layouts.app')

@section('titulo', 'Asistencias')


@section('contenido-alumno')
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- Botón agregado arriba de la card y cargado a la derecha -->
            <!--- quiero un formulario con un input date y un botón de búsqueda -->
            {{-- <form
                class="absolute top-0 right-30 mt-32 mr-1 px-5 py-2 shadow-sm tracking-wider text-black rounded-full bg-blue-500 m-4"
                action="{{ route('asistencias-filtradas') }}" method="get">
                @csrf
                <label for="label-start" class="m-4">Fecha de inicio</label>
                <input type="date" name="date_start" class="m-4" value="{{ old('date_start') }}">

                <label for="label-end" class="m-4">Fecha de corte</label>
                <input type="date" name="date_end" class="m-4" value="{{ old('date_end') }}">
                <button type="submit"
                    class=" text-black border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-black lg:p-0 dark:text-black lg:dark:hover:text-white dark:hover:bg-black dark:hover:text-white lg:dark:hover:bg-transparent dark:border-blue-700">Buscar</button>
            </form>

            @if (isset($date_start) && isset($date_end))
                <div
                    class="absolute top-48 right-30 mr-1 px-5 py-2 shadow-sm tracking-wider text-black rounded-full bg-blue-500 m-4">
                    <label for="label-start" class="m-4">Fecha de inicio: {{ $date_start }}</label>
                    <label for="label-end" class="m-4">Fecha de corte: {{ $date_end }}</label>
                </div>
            @endif --}}

            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6 mx-4">
                    <table class="min-w-max w-full m-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">Día</th>
                                <th class="py-3 px-6 text-center">Hora</th>
                                <th class="py-3 px-6 text-center">Materia</th>
                                <th class="py-3 px-6 text-center"></th>
                                {{-- <th class="py-3 px-6 text-center"></th> --}}
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($asistencias as $asistencia)
                                <tr class="border-b border-gray-200 hover-bg-gray-100">
                                    <td class="py-3 px-6 text-center">{{ $asistencia->fecha }}</td>
                                    <td class="py-3 px-6 text-center">{{ $asistencia->hora }}</td>
                                    <td class="py-3 px-6 text-center">
                                        @php
                                            $materia = \App\Models\Materia::find($asistencia->materia_id);
                                            if ($materia) {
                                                echo $materia->nombre;
                                            } else {
                                                echo 'Materia no encontrada';
                                            }
                                        @endphp
                                    </td>
                                    {{-- <td class="flex py-3 px-6 text-center items-center justify-center">

                                        <a href="{{ route('asistencias-filtradas') }}"
                                            class="w-4 mr-2 transform hover:text-purple-500 hover-scale-110">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo-bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo-tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo-iconCarrier">
                                                    <path
                                                        d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container w-1/3 m-auto flex justify-center justify-items-center">
                <canvas id="percentageChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Obtén los porcentajes de asistencias y no asistencias de PHP y pásalos al script JavaScript
        var attendancePercentage = {{ $porcentajeAsistencias }};
        var nonAttendancePercentage = {{ $porcentajeFaltas }};

        // Configura los datos del gráfico de asistencias
        var attendanceData = {
            labels: ["Asistencias", "Faltas"],
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
        };

        // Dibuja el gráfico en el lienzo canvas
        var ctx = document.getElementById("percentageChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "bar",
            data: attendanceData,
            options: options,
        });
    </script>
@endsection
