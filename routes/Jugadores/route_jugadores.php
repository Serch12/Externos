<?php

use App\Http\Controllers\JugadoresController;

Route::get('/jugadores', [JugadoresController::class, 'index'])->name('jugadores');
Route::get('/jugadores/getJugador', [JugadoresController::class, 'getJugador'])->name('jugadores/getJugador');
Route::post('/jugadores/createJugador', [JugadoresController::class, 'createJugador'])->name('jugadores/createJugador');
Route::post('/jugadores/updateJugador', [JugadoresController::class, 'updateJugador'])->name('jugadores/updateJugador');
Route::post('/jugadores/createTutor', [JugadoresController::class, 'createTutor'])->name('jugadores/createTutor');
Route::post('/jugadores/cambioEstatus', [JugadoresController::class, 'cambioEstatus'])->name('jugadores/cambioEstatus');
Route::post('/jugadores/deleteJugador', [JugadoresController::class, 'deleteJugador'])->name('jugadores/deleteJugador');
Route::post('/jugadores/deleteArchivo/{id}',  [JugadoresController::class, 'deleteArchivo'])->name('jugadores/deleteArchivo/{id}');
Route::post('/jugadores/verificaDorsal', [JugadoresController::class, 'verificaDorsal'])->name('jugadores/verificaDorsal');
Route::post('/visorias/registro',[JugadoresController::class,'registroVisorias'])->name('visorias/registro');