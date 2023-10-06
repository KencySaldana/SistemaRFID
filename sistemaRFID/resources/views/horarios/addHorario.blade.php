@extends('layouts.app')

@section('contenido-admin')
<div class="w-screen h-screen left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"  style="background-image: url(https://images.unsplash.com/photo-1555421689-491a97ff2040?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);" id="modal-id">
    <div class="relative min-h-screen flex flex-col items-center justify-center "> 
        <div class="justify-center">            
            <div class="flex justify-center">
                <div class="bg-white shadow-md w-96 rounded-3xl p-4">
                    <form action="{{route('horarios.create')}}" method="post">
                        @csrf
                        <h2 class="block text-black font-bold mb-2">DATOS DEL HORARIO</h2>
                        <label for="input" class="block text-gray-700 font-bold mb-2">Materia:</label>
                        <select name="materia" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300">
                            <!-- Opciones del select -->
                            @foreach ($materias as $materia)
                                <option value="{{$materia->id}}">{{$materia->nombre}}</option>
                            @endforeach
                        </select>
                        <label for="input" class="block text-gray-700 font-bold mb-2">Profesor:</label>
                        <select name="profesor" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300">
                            <!-- Opciones del select -->
                            @foreach ($profesores as $profesor)
                                <option value="{{$profesor->id}}">{{$profesor->user->nombre}}</option>
                            @endforeach
                        </select>
                        <label for="input" class="block text-gray-700 font-bold mb-2">Hora inicio(*):</label>
                        <input
                            type="time"
                            name="hora_inicio"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300"
                        />
                        <label for="input" class="block text-gray-700 font-bold mb-2">Hora final(*):</label>
                        <input
                            type="time"
                            name="hora_final"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300"
                        />
                        <label for="input" class="block text-gray-700 font-bold mb-2">Día de la semana(*):</label>
                        <select name="dia" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300">
                            <!-- Opciones del select -->
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miércoles">Miércoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                        </select>
                        
                        <div class="flex space-x-3 text-sm pt-2 font-medium">
                            <button
                                class="mb-2 md:mb-0 bg-gray-900 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-gray-800"
                                type="submit" aria-label="like">Guardar</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
