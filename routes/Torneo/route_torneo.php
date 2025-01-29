<?php

use App\Http\Controllers\TorneoController;

Route::get('/torneo', [TorneoController::class, 'index'])->name('torneo');
Route::get('/torneo/getTorneo', [TorneoController::class, 'getTorneo'])->name('torneo/getTorneo');
Route::post('/torneo/createTorneo', [TorneoController::class, 'createTorneo'])->name('torneo/createTorneo');