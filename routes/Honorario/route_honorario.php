<?php

use App\Http\Controllers\HonorariosController;

Route::get('/honorario', [HonorariosController::class, 'index'])->name('honorario');
// Route::get('/jugadores/getJugador', [HonorariosController::class, 'getJugador'])->name('jugadores/getJugador');
// Route::post('/jugadores/createJugador', [HonorariosController::class, 'createJugador'])->name('jugadores/createJugador');
// Route::post('/jugadores/updateJugador', [HonorariosController::class, 'updateJugador'])->name('jugadores/updateJugador');
// Route::post('/jugadores/createTutor', [HonorariosController::class, 'createTutor'])->name('jugadores/createTutor');
// Route::post('/jugadores/cambioEstatus', [HonorariosController::class, 'cambioEstatus'])->name('jugadores/cambioEstatus');
// Route::post('/jugadores/deleteJugador', [HonorariosController::class, 'deleteJugador'])->name('jugadores/deleteJugador');
// Route::post('/jugadores/deleteArchivo/{id}',  [HonorariosController::class, 'deleteArchivo'])->name('jugadores/deleteArchivo/{id}');
// Route::post('/jugadores/verificaDorsal', [HonorariosController::class, 'verificaDorsal'])->name('jugadores/verificaDorsal');