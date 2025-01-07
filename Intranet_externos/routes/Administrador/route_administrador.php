<?php

use App\Http\Controllers\AdministradorController;

Route::get('admin', [AdministradorController::class, 'index'])->name('/admin');