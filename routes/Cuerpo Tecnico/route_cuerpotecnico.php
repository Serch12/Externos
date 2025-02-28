<?php

use App\Http\Controllers\CuerpoTecnicoController;

Route::get('/cuerpo_tecnico', [CuerpoTecnicoController::class, 'index'])->name('cuerpo_tecnico');
Route::get('/cuerpo_tecnico/getCuerpoTecnico', [CuerpoTecnicoController::class, 'getCuerpoTecnico'])->name('cuerpo_tecnico/getCuerpoTecnico');
Route::post('/cuerpo_tecnico/createRegistro',  [CuerpoTecnicoController::class, 'createRegistro'])->name('cuerpo_tecnico/createRegistro');
Route::post('/cuerpo_tecnico/updaterRegistro', [CuerpoTecnicoController::class, 'updateRegistro'])->name('cuerpo_tecnico/updateRegistro');
Route::delete('/cuerpo_tecnico/deleteTecnico/{id}', [CuerpoTecnicoController::class, 'deleteTecnico'])->name('cuerpo_tecnico/deleteTecnico/{id}');
Route::post('/cuerpo_tecnico/cambioEstatus', [CuerpoTecnicoController::class, 'cambioEstatus'])->name('cuerpo_tecnico/cambioEstatus');