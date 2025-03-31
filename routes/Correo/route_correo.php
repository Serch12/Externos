<?php

use App\Http\Controllers\CorreoController;

Route::get('/correo', [CorreoController::class, 'index'])->name('correo');
Route::post('/home/cambioPassword', [CorreoController::class, 'cambioPassword'])->name('home/cambioPassword');