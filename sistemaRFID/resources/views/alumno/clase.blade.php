@extends('layouts.app')
@section('contenido-alumno')
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- dropdown agregado encima de la tabla -->
            <h2 class="text-3xl font-semibold text-indigo-700 absolute top-0 right-0  mt-32 mr-24 px-5 py-2 shadow-sm tracking-wider  m-4">Porcentaje de asistencia:{{$porcentaje}} %</h2>

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
                                    <td class="py-3 px-6 text-center">{{$asistencia->fecha}}</td>
                                    <td class="py-3 px-6 text-center">{{$asistencia->hora}}</td>
                                    
                                </tr>
                                @endforeach

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
@endsection