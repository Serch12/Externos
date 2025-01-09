<?php

use App\Http\Controllers\PermisosRolesController;

Route::get('/access', [PermisosRolesController::class, 'index'])->name('access');
Route::get('/access/Muestra', [PermisosRolesController::class, 'Muestra'])->name('access/Muestra');
Route::post('/access/createRole', [PermisosRolesController::class, 'createRole'])->name('access/createRole');
Route::post('/access/updateRole', [PermisosRolesController::class, 'updateRole'])->name('access/updateRole');
Route::post('/access/deleteRole', [PermisosRolesController::class, 'deleteRole'])->name('access/deleteRole');