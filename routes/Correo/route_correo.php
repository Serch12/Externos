<?php

use App\Http\Controllers\CorreoController;

Route::get('/correo', [CorreoController::class, 'index'])->name('correo');
Route::post('/correo/createCorreo', [CorreoController::class, 'createCorreo'])->name('correo/createCorreo');
Route::get('/correo/getCorreo', [CorreoController::class,'getCorreo'])->name('correo/getCorreo');
Route::post('/correo/activacionCorreo', [CorreoController::class,'activacionCorreo'])->name('correo/activacionCorreo');
Route::get('/correo/galeCorreo/{id}', [CorreoController::class,'galeCorreo'])->name('correo/galeCorreo/{id}');
Route::post('/correo/deleteCorreo/{id}', [CorreoController::class,'deleteCorreo'])->name('correo/deleteCorreo/{id}');
Route::post('/correo/editarCorreo', [CorreoController::class,'editarCorreo'])->name('correo/editarCorreo');