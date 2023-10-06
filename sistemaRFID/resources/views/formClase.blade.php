@extends('layouts.app')

@section('contenido-admin')
<div class="w-screen h-screen left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"  style="background-image: url(https://images.unsplash.com/photo-1555421689-491a97ff2040?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);" id="modal-id">
    <div class="relative min-h-screen flex flex-col items-center justify-center "> 
        <div class="justify-center">
            <!-- Botón agregado arriba de la card y cargado a la derecha -->
            {{-- <button
                class="absolute top-0 right-0 bg-blue-600 mr-[510px] mt-40 px-3 py-3 shadow-sm tracking-wider text-white rounded-full hover:bg-blue-500 m-4"
                type="button" aria-label="like">Ver clases</button> --}}
            

            <form action="{{route('registrar-clase')}}" method="POST" novalidate>
                @csrf
                <div class="flex justify-center">
                    <div class="bg-white shadow-md w-96 rounded-3xl p-4">
                        <h2 class="block text-black font-bold mb-2">DATOS DE LA CLASE</h2>
                        <label for="input" class="block text-gray-700 font-bold mb-2">Nombre(*):</label>
                        <input
                            name="materia"
                            id="materia"
                            type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-inner focus:outline-none focus:ring focus:border-blue-300"
                            placeholder="Escribe el nombre de la clase"
                        />
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
