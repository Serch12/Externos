<?php

use App\Http\Controllers\Auth\ResetPasswordController;


Route::get('/reset', [ResetPasswordController::class, 'index'])->name('reset');
Route::get('/reset/Muestra', [ResetPasswordController::class, 'Muestra'])->name('reset/Muestra');
Route::post('/reset/createRole', [ResetPasswordController::class, 'createRole'])->name('reset/createRole');
Route::post('/reset/updateRole', [ResetPasswordController::class, 'updateRole'])->name('reset/updateRole');
Route::post('/reset/deleteRole', [ResetPasswordController::class, 'deleteRole'])->name('reset/deleteRole');

Route::get('/reset-password/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');