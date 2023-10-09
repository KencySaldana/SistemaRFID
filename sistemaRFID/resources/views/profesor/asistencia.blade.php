@extends('layouts.app')

@section('titulo')
    Asistencia
@endsection

@section('contenido-profesor')
    <div class="w-screen h-screen left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        style="background-image: url(https://images.unsplash.com/photo-1555421689-491a97ff2040?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);"
        id="modal-id">
        <div class="relative min-h-screen flex flex-col items-center justify-center ">
            <h1 class="font-black tracking-wider text-black rounded-full h">FORMULARIO DE ASISTENCIA</h1>
            <div class="justify-center items-center">

                <form action="{{ route('actualizar-asistencia'), [] }}" method="POST" novalidate>
                    @csrf

                    @method('PUT')
                    <div class="flex justify-center">
                        <div class="bg-white shadow-md w-96 rounded-3xl p-4">
                            <!-- Campo de edición de asistencia -->
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Asistencia</label>
                                <select name="asistencia"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                    <option value="1" @if ($asistencia && $asistencia->asistencia == 1) selected @endif>Asistió
                                    </option>
                                    <option value="0" @if ($asistencia && $asistencia->asistencia == 0) selected @endif>No asistió
                                    </option>
                                </select>
                            </div>



                            <div class="flex space-x-3 text-sm pt-2 font-medium justify-end">
                                <button
                                    class="mb-2 md:mb-0 bg-gray-900 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-gray-800"
                                    aria-label="like">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
