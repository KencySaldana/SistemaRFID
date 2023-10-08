@extends('layouts.app')

@section('titulo', 'tabla de usuarios')

@section('contenido-admin')
    <!-- component -->
    <div class="overflow-x-auto">
        <div
            class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
            <a
                class="absolute top-0 right-0 bg-blue-600 mt-32 mr-24 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-blue-500 m-4"
                type="button" aria-label="like" href="{{route('user.create')}}">Agregar usuario</a>
            <div class="w-full lg:w-5/6">
                <h1 class="px-3 py-3 font-bold tracking-wider text-black ">TABLA DE USUARIOS</h1>
                <div class="bg-white shadow-md rounded my-6">      
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Nombre</th>
                                <th class="py-3 px-6 text-left">Apellido</th>
                                <th class="py-3 px-6 text-center">Usuario</th>
                                <th class="py-3 px-6 text-center">RFID</th>
                                <th class="py-3 px-6 text-center">Rol</th>
                                {{-- <th class="py-3 px-6 text-center">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($usuarios as $usuario)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <img class="w-6 h-6 rounded-full"
                                                src="https://randomuser.me/api/portraits/men/1.jpg" />
                                        </div>
                                        <span>{{$usuario->nombre}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>{{$usuario->apellido}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <span>{{$usuario->username}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <span>{{$usuario->numero_tarjeta_rfid}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if ($usuario->rol == 1)
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Administrador</span>
                                    @elseif ($usuario->rol == 2)
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Profesor</span>
                                    @elseif ($usuario->rol == 3)
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Alumno</span>
                                    @endif

                                </td>
                                {{-- <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td> --}}
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
            <h1 class="absolute font-black top-20 right-0  mr-[675px] mt-180 px-3 py-3  tracking-wider text-black rounded-full h">TABLA DE USUARIOS</h1>
            <a
                class="absolute top-0 right-0 bg-blue-600 mt-32 mr-24 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-blue-500 m-4"
                type="button" aria-label="like" href="{{route('user.create')}}">Agregar usuario</a>
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Nombre</th>
                                <th class="py-3 px-6 text-left">Apellido</th>
                                <th class="py-3 px-6 text-center">Usuario</th>
                                <th class="py-3 px-6 text-center">RFID</th>
                                <th class="py-3 px-6 text-center">Rol</th>
                                {{-- <th class="py-3 px-6 text-center">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($usuarios as $usuario)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <img class="w-6 h-6 rounded-full"
                                                src="https://randomuser.me/api/portraits/men/1.jpg" />
                                        </div>
                                        <span>{{$usuario->nombre}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>{{$usuario->apellido}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <span>{{$usuario->username}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <span>{{$usuario->numero_tarjeta_rfid}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if ($usuario->rol == 1)
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Administrador</span>
                                    @elseif ($usuario->rol == 2)
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Profesor</span>
                                    @elseif ($usuario->rol == 3)
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Alumno</span>
                                    @endif

                                </td>
                                {{-- <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td> --}}
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
                type="button" aria-label="like" href="{{route('user.create')}}">Agregar usuario</a>
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Nombre</th>
                                <th class="py-3 px-6 text-left">Apellido</th>
                                <th class="py-3 px-6 text-center">Usuario</th>
                                <th class="py-3 px-6 text-center">RFID</th>
                                <th class="py-3 px-6 text-center">Rol</th>
                                {{-- <th class="py-3 px-6 text-center">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($usuarios as $usuario)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <img class="w-6 h-6 rounded-full"
                                                src="https://randomuser.me/api/portraits/men/1.jpg" />
                                        </div>
                                        <span>{{$usuario->nombre}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>{{$usuario->apellido}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <span>{{$usuario->username}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <span>{{$usuario->numero_tarjeta_rfid}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if ($usuario->rol == 1)
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Administrador</span>
                                    @elseif ($usuario->rol == 2)
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Profesor</span>
                                    @elseif ($usuario->rol == 3)
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Alumno</span>
                                    @endif

                                </td>
                                {{-- <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
