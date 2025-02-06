<?php

use App\Http\Controllers\PerfilController;

Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
Route::get('/perfil/getPerfil', [PerfilController::class, 'getPerfil'])->name('perfil/getPerfil');
Route::post('/perfil/createPerfil', [PerfilController::class, 'createPerfil'])->name('perfil/createPerfil');
// Route::post('/access/deleteRole', [PerfilController::class, 'deleteRole'])->name('access/deleteRole');