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
                    class=" top-0 right-300  mr-1 px-5 py-2 shadow-sm tracking-wider text-black rounded-full bg-blue-500 m-4">
                    <label for="label-start" class="m-4">Fecha de inicio: {{ $date_start }}</label>
                    <label for="label-end" class="m-4">Fecha de corte: {{ $date_end }}</label>
                </div>
            @endif

            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    @if (count($alumnosAsistieron) > 0)
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">Nombre</th>
                                    <th class="py-3 px-6 text-center">Apellido</th>
                                    <th class="py-3 px-6 text-center">RFID</th>
                                    <th class="py-3 px-6 text-center">Estado</th>
                                    <th class="py-3 px-6 text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach ($alumnosAsistieron as $alumnos)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center">{{ $alumnos->nombre }}</td>
                                        <td class="py-3 px-6 text-center">{{ $alumnos->apellido }}</td>
                                        <td class="py-3 px-6 text-center">{{ $alumnos->numero_tarjeta_rfid }}</td>
                                        <td class="py-3 px-6 text-center">
                                            @if ($alumnos->alumno->asistencia == 1)
                                                <span
                                                    class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Asistió</span>
                                            @elseif ($alumnos->alumno->asistencia == 0)
                                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">No
                                                    asistió</span>
                                            @endif
                                        </td>
                                        <td class="flex py-3 px-6 text-center items-center justify-center">
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">

                                                <a href="{{ route('editar-asistencia', ['id' => $alumnos->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>

                                            </div>

                                            <a href="#"
                                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
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
                                    <td class="py-3 px-6 text-center">{{ $alumnos->nombre }}</td>

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
@endsection
