@extends('layouts.app')

@section('titulo', 'dashboard')

@section('contenido-admin')
<div class="w-screen h-screen left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
    style="background-image: url(https://images.unsplash.com/photo-1555421689-491a97ff2040?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);"
    id="modal-id">
    <div class="relative min-h-screen flex flex-col items-center justify-center ">
        <div class="grid mt-8 gap-8 grid-cols-1 md:grid-cols-2 xl:grid-cols-2">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-black mb-4">¡Bienvenido al Sistema de Asistencia!</h1>
                <p class="text-lg text-black">Gracias por unirte a nuestra plataforma. Estamos aquí para ayudarte en tu jornada de asistencia.</p>
            </div>
        </div>
    </div>
</div>
@endsection


@section('contenido-profesor')
<div class="w-screen h-screen left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
    style="background-image: url(https://images.unsplash.com/photo-1555421689-491a97ff2040?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);"
    id="modal-id">
    <div class="relative min-h-screen flex flex-col items-center justify-center ">
        <div class="grid mt-8 gap-8 grid-cols-1 md:grid-cols-2 xl:grid-cols-2">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-black mb-4">¡Bienvenido al Sistema de Asistencia!</h1>
                <p class="text-lg text-black">Profesor</p>
            </div>
        </div>
    </div>
</div>
@endsection


@section('contenido-alumno')
<div class="w-screen h-screen left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
    style="background-image: url(https://images.unsplash.com/photo-1555421689-491a97ff2040?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);"
    id="modal-id">
    <div class="relative min-h-screen flex flex-col items-center justify-center ">
        <div class="grid mt-8 gap-8 grid-cols-1 md:grid-cols-2 xl:grid-cols-2">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-black mb-4">¡Bienvenido al Sistema de Asistencia!</h1>
                <p class="text-lg text-black">Alumno</p>
            </div>
        </div>
    </div>
</div>
@endsection

