<?php

use App\Http\Controllers\JugadoresController;

Route::get('/jugadores', [JugadoresController::class, 'index'])->name('jugadores');
Route::get('/jugadores/getJugador', [JugadoresController::class, 'getJugador'])->name('jugadores/getJugador');
Route::post('/jugadores/createJugador', [JugadoresController::class, 'createJugador'])->name('jugadores/createJugador');