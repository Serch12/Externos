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
//require de rutas de Home
require(__DIR__ . '/Home/route_home.php');
//require de rutas de administrador
require(__DIR__ . '/Administrador/route_administrador.php');
//require de rutas de permisosroles
require(__DIR__ . '/PermisosRoles/route_permisosroles.php');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
