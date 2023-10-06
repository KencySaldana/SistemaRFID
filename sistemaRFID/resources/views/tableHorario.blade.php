@extends('layouts.app')

@section('contenido-admin')
    <!-- component -->
    <div class="overflow-x-auto">
        <div
            class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- Botón agregado arriba de la card y cargado a la derecha -->
            <h1 class="absolute font-black top-20 right-0  mr-[675px] mt-180 px-3 py-3  tracking-wider text-black rounded-full h">TABLA DE HORARIO</h1>
            <a
                class="absolute top-0 right-0 bg-blue-600 mt-32 mr-24 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-blue-500 m-4"
                type="button" aria-label="like" href="{{route('form-horario')}}">Agregar Horario</a>
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Día</th>
                                <th class="py-3 px-6 text-left">Hora de Inicio</th>
                                <th class="py-3 px-6 text-left">Hora de Fin</th>
                                <th class="py-3 px-6 text-left">Materia</th>
                                <th class="py-3 px-6 text-left">Profesor</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach($horarios as $horario)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $horario->dia }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->hora_inicio }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->hora_fin }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->materia->nombre }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->profesor->user->nombre }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('contenido-profesor')
    <!-- component -->
    <div class="overflow-x-auto">
        <div
            class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- Botón agregado arriba de la card y cargado a la derecha -->
            <a
                class="absolute top-0 right-0 bg-blue-600 mt-32 mr-24 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-blue-500 m-4"
                type="button" aria-label="like" href="{{route('form-horario')}}">Agregar Horario</a>
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Día</th>
                                <th class="py-3 px-6 text-left">Hora de Inicio</th>
                                <th class="py-3 px-6 text-left">Hora de Fin</th>
                                <th class="py-3 px-6 text-left">Materia</th>
                                <th class="py-3 px-6 text-left">Profesor</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach($horarios as $horario)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $horario->dia }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->hora_inicio }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->hora_fin }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->materia->nombre }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->profesor->user->nombre }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contenido-alumno')
    <!-- component -->
    <div class="overflow-x-auto">
        <div
            class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- Botón agregado arriba de la card y cargado a la derecha -->
            <a
                class="absolute top-0 right-0 bg-blue-600 mt-32 mr-24 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-blue-500 m-4"
                type="button" aria-label="like" href="{{route('form-horario')}}">Agregar Horario</a>
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Día</th>
                                <th class="py-3 px-6 text-left">Hora de Inicio</th>
                                <th class="py-3 px-6 text-left">Hora de Fin</th>
                                <th class="py-3 px-6 text-left">Materia</th>
                                <th class="py-3 px-6 text-left">Profesor</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach($horarios as $horario)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $horario->dia }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->hora_inicio }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->hora_fin }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->materia->nombre }}</td>
                                <td class="py-3 px-6 text-left">{{ $horario->profesor->user->nombre }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
