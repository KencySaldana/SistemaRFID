@extends('layouts.app')

@section('contenido-admin')
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- Botón agregado arriba de la card y cargado a la derecha -->
            <a class="absolute top-0 right-0 bg-blue-600 mt-32 mr-24 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-blue-500 m-4"
                type="button" aria-label="like" href="{{route('form-clase')}}">Agregar clase</a>
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">ID</th>
                                <th class="py-3 px-6 text-center">Nombre</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach($clases as $clase)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center">{{ $clase->id }}</td>
                                    <td class="py-3 px-6 text-center">{{ $clase->nombre }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            
                                            <!-- Botón para editar -->
                                            <a href="{{ route('editar-clase', ['id' => $clase->id]) }}"
                                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </div>
                                            </a>
                                            <!-- Formulario para eliminar -->
                                            <form action="{{ route('eliminar-clase', ['id' => $clase->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE') <!-- Utiliza el método DELETE para la eliminación -->
                                                <button type="submit" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </div>
                                                </button>
                                            </form>
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

@section('contenido-profesor')
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- Botón agregado arriba de la card y cargado a la derecha -->
            <a class="absolute top-0 right-0 bg-blue-600 mt-32 mr-24 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-blue-500 m-4"
                type="button" aria-label="like" href="{{route('form-clase')}}">Agregar clase</a>
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">ID</th>
                                <th class="py-3 px-6 text-center">Nombre</th>
                                <th class="py-3 px-6 text-center">Acciones</th> <!-- Cambiado de "Action" a "Acciones" -->
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach($clases as $clase)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center">{{ $clase->id }}</td>
                                    <td class="py-3 px-6 text-center">{{ $clase->nombre }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                        <!-- Botón para editar -->    
                                        <a href="{{ route('editar-clase', ['id' => $clase->id]) }}"
                                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <!-- Botón para editar -->
                                            <a href="{{ route('editar-clase', ['id' => $clase->id]) }}"
                                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <!-- Formulario para eliminar -->
                                            <form action="{{ route('eliminar-clase', ['id' => $clase->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE') <!-- Utiliza el método DELETE para la eliminación -->
                                                <button type="submit" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
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

@section('contenido-alumno')
    <!-- component -->
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <!-- dropdown agregado encima de la tabla -->
            
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">Fecha</th>
                                <th class="py-3 px-6 text-center">Hora</th>
                                <th class="py-3 px-6 text-center">Estado</th> <!-- Cambiado de "Action" a "Acciones" -->
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                           
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center"></td>
                                    <td class="py-3 px-6 text-center"></td>
                                    <td class="py-3 px-6 text-center">
                                        
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

