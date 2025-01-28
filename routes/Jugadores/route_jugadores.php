<?php

use App\Http\Controllers\JugadoresController;

Route::get('/jugadores', [JugadoresController::class, 'index'])->name('jugadores');
Route::get('/jugadores/getJugador', [JugadoresController::class, 'getJugador'])->name('jugadores/getJugador');
Route::post('/jugadores/createJugador', [JugadoresController::class, 'createJugador'])->name('jugadores/createJugador');
Route::post('/jugadores/updateJugador', [JugadoresController::class, 'updateJugador'])->name('jugadores/updateJugador');
Route::post('/jugadores/createTutor', [JugadoresController::class, 'createTutor'])->name('jugadores/createTutor');

Route::post('/jugadores/deleteArchivo/{id}',  [JugadoresController::class, 'deleteArchivo'])->name('jugadores/deleteArchivo/{id}');