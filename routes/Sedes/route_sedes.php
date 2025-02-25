<?php

use App\Http\Controllers\SedeController;

Route::get('/sede', [SedeController::class, 'index'])->name('sede');
Route::get('/sede/busqueda', [SedeController::class,'Busqueda'])->name('sede/busqueda');
Route::post('/sede/createSede',[SedeController::class,'createSede'])->name('sede/createSede');
Route::post('/sede/updateSede', [SedeController::class,'updateSede'])->name('sede/updateSede');
Route::post('/sede/deleteSede', [SedeController::class,'deleteSede'])->name('sede/deleteSede');
Route::get('/sede/infoSede/{id}', [SedeController::class,'infoSede'])->name('sede/infoSede/{id}');
