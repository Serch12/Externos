<?php

use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home/cambioPassword', [HomeController::class, 'cambioPassword'])->name('home/cambioPassword');
Route::get('/home/Calendario', [HomeController::class,'Calendario'])->name('home/Calendario');
Route::post('/home/RecordatorioCreate', [HomeController::class,'RecordatorioCreate'])->name('home/RecordatorioCreate');
Route::post('/home/RecordatorioUpdate', [HomeController::class,'RecordatorioUpdate'])->name('home/RecordatorioUpdate');
Route::post('/home/RecordatorioDelete', [HomeController::class,'RecordatorioDelete'])->name('home/RecordatorioDelete');