<?php

use App\Http\Controllers\HonorariosController;

Route::get('/honorario', [HonorariosController::class, 'index'])->name('honorario');
Route::get('/honorario/DetalleHonorario/{id}', [HonorariosController::class, 'DetalleHonorario'])->name('honorario/DetalleHonorario/{id}');
Route::post('/honorario/lectorPDF', [HonorariosController::class, 'lectorPDF'])->name('honorario/lectorPDF');
Route::post('/honorario/AgregarHonorario', [HonorariosController::class, 'AgregarHonorario'])->name('honorario/AgregarHonorario');
// Route::post('/jugadores/updateJugador', [HonorariosController::class, 'updateJugador'])->name('jugadores/updateJugador');
// Route::post('/jugadores/createTutor', [HonorariosController::class, 'createTutor'])->name('jugadores/createTutor');
// Route::post('/jugadores/cambioEstatus', [HonorariosController::class, 'cambioEstatus'])->name('jugadores/cambioEstatus');
// Route::post('/jugadores/deleteJugador', [HonorariosController::class, 'deleteJugador'])->name('jugadores/deleteJugador');
// Route::post('/jugadores/deleteArchivo/{id}',  [HonorariosController::class, 'deleteArchivo'])->name('jugadores/deleteArchivo/{id}');
// Route::post('/jugadores/verificaDorsal', [HonorariosController::class, 'verificaDorsal'])->name('jugadores/verificaDorsal');