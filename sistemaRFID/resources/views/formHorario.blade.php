@extends('layouts.app')

@section('contenido')
<div class="w-screen h-screen left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"  style="background-image: url(https://images.unsplash.com/photo-1555421689-491a97ff2040?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);" id="modal-id">
    <div class="relative min-h-screen flex flex-col items-center justify-center "> 
        <div class="justify-center">
            <!-- Botón agregado arriba de la card y cargado a la derecha -->
            {{-- <button
                class="absolute top-0 right-0 bg-blue-600 mr-[510px] mt-40 px-3 py-3 shadow-sm tracking-wider text-white rounded-full hover:bg-blue-500 m-4"
                type="button" aria-label="like">Ver clases</button> --}}
            
            <div class="flex justify-center">
                <div class="bg-white shadow-md w-96 rounded-3xl p-4">
                    <h2 class="block text-black font-bold mb-2">DATOS DEL HORARIO</h2>
                    <label for="input" class="block text-gray-700 font-bold mb-2">Clases(*):</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300">
                        <!-- Opciones del select -->
                        <option value="opcion1">Opcion1</option>
                        <option value="opcion2">Opcion2</option>
                        <option value="opcion3">Opcion3</option>
                    </select>
                    
                    <label for="input" class="block text-gray-700 font-bold mb-2">Hora inicio(*):</label>
                    <input
                        type="time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Nombre del usuario"
                    />
                    <label for="input" class="block text-gray-700 font-bold mb-2">Hora final(*):</label>
                    <input
                        type="time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Apellido del usuario"
                    />
                    <label for="input" class="block text-gray-700 font-bold mb-2">Día de la semana(*):</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300">
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
                            type="button" aria-label="like">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
