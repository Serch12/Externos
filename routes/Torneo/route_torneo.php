<?php

use App\Http\Controllers\TorneoController;

Route::get('/torneo', [TorneoController::class, 'index'])->name('torneo');
Route::get('/torneo/getTorneo', [TorneoController::class, 'getTorneo'])->name('torneo/getTorneo');
Route::post('/torneo/createTorneo', [TorneoController::class, 'createTorneo'])->name('torneo/createTorneo');
Route::post('/torneo/updateTorneo', [TorneoController::class, 'updateTorneo'])->name('torneo/updateTorneo');
Route::get('/torneo/plantillaJugador', [TorneoController::class, 'plantillaJugador'])->name('torneo/plantillaJugador');
Route::post('/torneo/seleccionadosJugador', [TorneoController::class, 'seleccionadosJugador'])->name('torneo/seleccionadosJugador');
Route::get('/torneo/detalleSeleccionado/{id}', [TorneoController::class, 'detalleSeleccionado'])->name('torneo/detalleSeleccionado/{id}');
Route::post('/torneo/deleteJugador', [TorneoController::class, 'deleteJugador'])->name('torneo/deleteJugador');
Route::get('/torneo/InfoExterna/{id}', [TorneoController::class, 'InfoExterna'])->name('torneo/InfoExterna/{id}'); 
Route::post('/torneo/createDatoBancario', [TorneoController::class, 'createDatoBancario'])->name('torneo/createDatoBancario');
Route::post('/torneo/updateDatoBancario', [TorneoController::class, 'updateDatoBancario'])->name('torneo/updateDatoBancario');
Route::post('/torneo/estatusTorneo', [TorneoController::class, 'estatusTorneo'])->name('/torneo/estatusTorneo');
Route::get('/torneo/NotasDetalle/{id}', [TorneoController::class, 'NotasDetalle'])->name('torneo/NotasDetalle/{id}');