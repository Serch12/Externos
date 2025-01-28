<?php

use App\Http\Controllers\TorneoController;

Route::get('/torneo', [TorneoController::class, 'index'])->name('torneo');