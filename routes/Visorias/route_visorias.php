<?php

use App\Http\Controllers\VisoriasController;

Route::get('/visorias', [VisoriasController::class, 'index'])->name('visorias');
Route::get('/visorias/jugadores/{sede}', [VisoriasController::class, 'listaJugadores'])->name('visorias/jugadores/{sede}');
// Route::get('/sede/busqueda', [VisoriasController::class,'Busqueda'])->name('sede/busqueda');
// Route::post('/sede/createSede',[VisoriasController::class,'createSede'])->name('sede/createSede');
// Route::post('/sede/updateSede', [VisoriasController::class,'updateSede'])->name('sede/updateSede');
// Route::delete('/sede/deleteSede/{id}', [VisoriasController::class,'deleteSede'])->name('sede/deleteSede/{id}');
// Route::get('/sede/infoSede/{id}', [VisoriasController::class,'infoSede'])->name('sede/infoSede/{id}');