<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});





Auth::routes();
//require de rutas de post
require(__DIR__ . '/Password_Reset/route_password.php');
//require de rutas de Home
require(__DIR__ . '/Home/route_home.php');
//require de rutas de administrador
require(__DIR__ . '/Administrador/route_administrador.php');
//require de rutas de permisosroles
require(__DIR__ . '/PermisosRoles/route_permisosroles.php');
//require de rutas de jugadores
require(__DIR__ . '/Jugadores/route_jugadores.php');
//require de rutas de torneo
require(__DIR__ . '/Torneo/route_torneo.php');
//require de rutas de post
require(__DIR__ . '/Post/route_post.php');
//require de rutas de Perfil
require(__DIR__ . '/Perfil/route_perfil.php');
//require de rutas de Notificacion
require(__DIR__ . '/Notificaciones/route_notificacion.php');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
