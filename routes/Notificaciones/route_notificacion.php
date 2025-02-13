<?php

use App\Http\Controllers\NotificacionController;

Route::get('/notificacion/getNotificacion',  [NotificacionController::class, 'getNotificacion'])->name('notificacion/getNotificacion');
Route::post('/notificacion/eliminaNotificacion/{id}', [NotificacionController::class, 'eliminaNotificacion'])->name('notificacion/eliminaNotificacion/{id}');
Route::post('/notificacion/limpiaNotificacion', [NotificacionController::class, 'limpiaNotificacion'])->name('notificacion/limpiaNotificacion');