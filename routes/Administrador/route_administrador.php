<?php

use App\Http\Controllers\AdministradorController;

Route::get('/administrador', [AdministradorController::class, 'index'])->name('administrador');
Route::get('/administrador/Busqueda', [AdministradorController::class, 'Busqueda'])->name('administrador/Busqueda');
Route::post('/administrador/createUser', [AdministradorController::class, 'createUsuarios'])->name('administrador/createUser');
Route::post('/administrador/updateUsuarios', [AdministradorController::class, 'updateUsuarios'])->name('administrador/updateUsuarios');
Route::post('/administrador/deleteUsuarios/{id}', [AdministradorController::class, 'deleteUsuarios'])->name('administrador/deleteUsuarios/{id}');