<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CerrarSessionController;
use App\Http\Controllers\LogoutController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta principal
Route::get('/', [LoginController::class, 'index'])->name('login');
// Ruta para iniciar sesión
Route::post('/iniciar-sesion', [LoginController::class, 'login'])->name('login-iniciar-sesion');

// Ruta para registrar un usuario
Route::get('/registrar', [RegisterController::class, 'index'])->name('sign-up');

Route::post('/registrar-usuario', [RegisterController::class, 'registrar'])->name('sign-up-registrar');

// Ruta para cerrar sesión
Route::get('/cerrar-sesion', [CerrarSessionController::class, 'cerrarSesion'])->name('cerrar-sesion');

//Ruta para cerrar sesión
Route::get('/logout', [LogoutController::class, 'store'])->name('logout');

// Ruta al dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Ruta a la vista de usuarios
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
Route::get('/addUser',[UserController::class, 'create'])->name('user.create');
Route::post('/addUser',[UserController::class, 'store']);
// Ruta a la vista de clases
Route::get('/form-clases', [DashboardController::class, 'classes'])->name('form-clase');

// Ruta a la vista de horarios
Route::get('/form-horarios', [DashboardController::class, 'horarios'])->name('form-horario');

// Ruta para la tabla de clase
Route::get('/tabla-clase', [TablesController::class, 'classes'])->name('tabla-clases');

// Ruta para la tabla de usuarios
Route::get('/tabla-usuarios', [TablesController::class, 'users'])->name('tabla-usuarios');

// Ruta para la tabla de horarios
Route::get('/tabla-horarios', [TablesController::class, 'horarios'])->name('tabla-horarios');







//Ruta para la vista de asistencias
// Route::get('/asistencias',[LoginController::class,'asistencias'])->name('asistencias');
// Ruta para la asistencia por medio de rfid
Route::post('/activacion', [LoginController::class, 'activacion'])->name('activacion');
// Ruta para la asitencia por medio de teclado
Route::post('/asistencia', [LoginController::class, 'asistencia'])->name('asistencia');

Route::post('/test', [LoginController::class, 'prueba'])->name('test');