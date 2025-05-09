<?php

use App\Http\Controllers\HonorariosController;

Route::get('/honorario', [HonorariosController::class, 'index'])->name('honorario');
Route::get('/honorario/DetalleHonorario/{id}', [HonorariosController::class, 'DetalleHonorario'])->name('honorario/DetalleHonorario/{id}');
Route::post('/honorario/lectorPDF', [HonorariosController::class, 'lectorPDF'])->name('honorario/lectorPDF');
Route::post('/honorario/AgregarHonorario', [HonorariosController::class, 'AgregarHonorario'])->name('honorario/AgregarHonorario');
Route::post('/honorario/UpdateHonorario', [HonorariosController::class, 'UpdateHonorario'])->name('honorario/UpdateHonorario');


/* Rutas Honorario Historial */

Route::get('/honorario/HistorialHonorario/{id}', [HonorariosController::class, 'HistorialHonorario'])->name('honorario/HistorialHonorario/{id}');
Route::get('/honorario/HistorialAdmin', [HonorariosController::class, 'HistorialAdmin'])->name('honorario/HistorialAdmin');