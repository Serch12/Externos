<?php

use App\Http\Controllers\PerfilController;

Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
Route::get('/perfil/getPerfil', [PerfilController::class, 'getPerfil'])->name('perfil/getPerfil');
Route::post('/perfil/createPerfil', [PerfilController::class, 'createPerfil'])->name('perfil/createPerfil');
Route::post('/perfil/createDatoBancario', [PerfilController::class, 'createDatoBancario'])->name('perfil/createDatoBancario');
Route::post('/perfil/updateDatoBancario', [PerfilController::class, 'updateDatoBancario'])->name('perfil/updateDatoBancario');
Route::post('/perfil/deleteDatoBancario', [PerfilController::class, 'deleteDatoBancario'])->name('perfil/deleteDatoBancario');
Route::post('/perfil/newDocumento', [PerfilController::class, 'newDocumento'])->name('perfil/newDocumento');
Route::post('/perfil/updateDocumento', [PerfilController::class, 'updateDocumento'])->name('perfil/updateDocumento');
Route::post('/perfil/verContrato', [PerfilController::class, 'verContrato'])->name('perfil/verContrato');