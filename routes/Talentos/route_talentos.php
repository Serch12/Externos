<?php

use App\Http\Controllers\TalentosControllers;

Route::get('/talentos', [TalentosControllers::class, 'index'])->name('talentos');
Route::get('/talentos/getTalentos', [TalentosControllers::class, 'getTalentos'])->name('talentos/getTalentos');
Route::post('talentos/activacion', [TalentosControllers::class, 'activacion'])->name('talentos/activacion');
Route::get('/talentos/galeriaTalento/{id}',  [TalentosControllers::class, 'galeriaTalento'])->name('talentos/galeriaTalento/{id}');
Route::post('/talentos/eliminarImagen/{id}', [TalentosControllers::class, 'eliminarImagen'])->name('talentos/eliminarImagen/{id}');
Route::post('/talentos/updateTalento',  [TalentosControllers::class, 'updateTalento'])->name('talentos/updateTalento');
Route::post('/talentos/Talentodelete', [TalentosControllers::class, 'Talentodelete'])->name('talentos/Talentodelete');

Route::get('/talentos/getBanner', [TalentosControllers::class, 'getBanner'])->name('talentos/getBanner');
Route::post('/talentos/createBanner', [TalentosControllers::class, 'createBanner'])->name('talentos/createBanner');
Route::get('/talentos/Bannergaleria/{id}', [TalentosControllers::class, 'Bannergaleria'])->name('talentos/Bannergaleria/{id}');