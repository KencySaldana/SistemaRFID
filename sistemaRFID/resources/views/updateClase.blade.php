@extends('layouts.app')

@section('titulo')
    Actualiar clase - {{ $clase->nombre }}
@endsection

@section('contenido-admin')
    <div class="w-screen h-screen left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        style="background-image: url(https://images.unsplash.com/photo-1555421689-491a97ff2040?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <h1 class="font-black top-0 right-0   px-3 py-3  tracking-wider text-black rounded-full h">ACTUALIZAR CLASE</h1>
            <div class="justify-center">
                <form action="{{ route('actualizar-clase', ['id' => $clase->id]) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT') <!-- Utiliza el método PUT para la actualización -->
                    <div class="bg-white shadow-md w-96 rounded-3xl p-4">
                        <h2 class="block text-black font-bold mb-2">DATOS DE LA CLASE</h2>
                        <label for="input" class="block text-gray-700 font-bold mb-2">Nombre(*):</label>
                        <input name="materia" id="materia" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300"
                            placeholder="Escribe el nombre de la clase" value="{{ $clase->nombre }}" />
                        <label for="alumnos" class="block text-gray-700 font-bold mt-4">Seleccionar Alumnos:</label>
                        <select name="alumnos[]" id="alumnos"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300 custom-select"
                            multiple>
                            <!--    Seleecionar multiples alumnos de la varibales todos_los_alumnos
                                                                                y mostrarlos en el select
                                                                        -->
                            @foreach ($todos_los_alumnos as $alumno)
                                <option value="{{ $alumno->id }}"
                                    {{ in_array($alumno->id, $clase->alumnos->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $alumno->username }} - {{ $alumno->nombre }} </option>
                            @endforeach
                        </select>

                        <!-- Espacio para mostrar los alumnos inscritos a la clase -->
                        <div class="mt-4">
                            <h3 class="text-gray-700 font-bold mb-2">Alumnos Inscritos:</h3>
                            <ul class="ml-3">
                                @foreach ($alumnos as $alumno)
                                    <li>{{ $alumno->username }} - {{ $alumno->nombre }}</li>
                                @endforeach
                                {{-- <li>{{ $todos_los_alumnos }}</li> --}}
                            </ul>
                        </div>

                        <!-- Botones para agregar y eliminar alumnos -->
                        <div class="flex space-x-3 text-sm pt-2 font-medium justify-end">
                            <button value="Agregar" name="agregar"
                                class="mb-2 md:mb-0 bg-green-500 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-green-600"
                                aria-label="like">Agregar</button>
                            <button value="Eliminar" name="eliminar"
                                class="mb-2 md:mb-0 bg-red-500 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-red-600"
                                aria-label="like">Eliminar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('contenido-profesor')
    <div class="w-screen h-screen left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        style="background-image: url(https://images.unsplash.com/photo-1555421689-491a97ff2040?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <div class="justify-center">
                <form action="{{ route('actualizar-clase', ['id' => $clase->id]) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT') <!-- Utiliza el método PUT para la actualización -->
                    <div class="bg-white shadow-md w-96 rounded-3xl p-4">
                        <h2 class="block text-black font-bold mb-2">DATOS DE LA CLASE</h2>
                        <label for="input" class="block text-gray-700 font-bold mb-2">Nombre(*):</label>
                        <input name="materia" id="materia" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300"
                            placeholder="Escribe el nombre de la clase" value="{{ $clase->nombre }}" />
                        <label for="alumnos" class="block text-gray-700 font-bold mt-4">Seleccionar Alumnos:</label>
                        <select name="alumnos[]" id="alumnos"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300 custom-select"
                            multiple>
                            <!--    Seleecionar multiples alumnos de la varibales todos_los_alumnos
                                                                                y mostrarlos en el select
                                                                        -->
                            @foreach ($todos_los_alumnos as $alumno)
                                <option value="{{ $alumno->id }}"
                                    {{ in_array($alumno->id, $clase->alumnos->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $alumno->username }} - {{ $alumno->nombre }} </option>
                            @endforeach
                        </select>

                        <!-- Espacio para mostrar los alumnos inscritos a la clase -->
                        <div class="mt-4">
                            <h3 class="text-gray-700 font-bold mb-2">Alumnos Inscritos:</h3>
                            <ul class="ml-3">
                                @foreach ($alumnos as $alumno)
                                    <li>{{ $alumno->username }} - {{ $alumno->nombre }}</li>
                                @endforeach
                                {{-- <li>{{ $todos_los_alumnos }}</li> --}}
                            </ul>
                        </div>

                        <!-- Botones para agregar y eliminar alumnos -->
                        <div class="flex space-x-3 text-sm pt-2 font-medium justify-end">
                            <button value="Agregar" name="agregar"
                                class="mb-2 md:mb-0 bg-green-500 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-green-600"
                                aria-label="like">Agregar</button>
                            <button value="Eliminar" name="eliminar"
                                class="mb-2 md:mb-0 bg-red-500 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-red-600"
                                aria-label="like">Eliminar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('contenido-alumno')
    <div class="w-screen h-screen left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        style="background-image: url(https://images.unsplash.com/photo-1555421689-491a97ff2040?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <div class="justify-center">
                <form action="{{ route('actualizar-clase', ['id' => $clase->id]) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT') <!-- Utiliza el método PUT para la actualización -->
                    <div class="bg-white shadow-md w-96 rounded-3xl p-4">
                        <h2 class="block text-black font-bold mb-2">DATOS DE LA CLASE</h2>
                        <label for="input" class="block text-gray-700 font-bold mb-2">Nombre(*):</label>
                        <input name="materia" id="materia" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300"
                            placeholder="Escribe el nombre de la clase" value="{{ $clase->nombre }}" />
                        <label for="alumnos" class="block text-gray-700 font-bold mt-4">Seleccionar Alumnos:</label>
                        <select name="alumnos[]" id="alumnos"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300"
                            multiple>
                            @foreach ($alumnos as $alumno)
                                <option value="{{ $alumno->id }}"
                                    {{ in_array($alumno->id, $clase->alumnos->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $alumno->nombre }}</option>
                                <!-- Marcar los alumnos que están en la clase actual -->
                            @endforeach
                        </select>

                        <div class="flex space-x-3 text-sm pt-2 font-medium justify-end">
                            <button
                                class="mb-2 md:mb-0 bg-gray-900 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-gray-800"
                                aria-label="like">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
