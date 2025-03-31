<?php

use App\Http\Controllers\CorreoController;

Route::get('/correo', [CorreoController::class, 'index'])->name('correo');
Route::post('/correo/createCorreo', [CorreoController::class, 'createCorreo'])->name('correo/createCorreo');