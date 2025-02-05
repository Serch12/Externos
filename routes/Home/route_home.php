<?php

use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home/cambioPassword', [HomeController::class, 'cambioPassword'])->name('home/cambioPassword');