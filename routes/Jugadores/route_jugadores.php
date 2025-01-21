<?php

use App\Http\Controllers\JugadoresController;

Route::get('/jugadores', [JugadoresController::class, 'index'])->name('jugadores');