<?php

use App\Http\Controllers\PostController;

Route::get('/post', [PostController::class, 'index'])->name('post');
Route::post('/post/nuevo', [PostController::class,'nuevoPost'])->name('post/nuevo');
Route::get('/post/busqueda', [PostController::class,'busquedaPost'])->name('post/busqueda');
Route::put('/post/cambio-estatus/{id}/{estatus}',[PostController::class,'estatus'])->name('post/cambio_estatus/{id}/{estatus}');
Route::post('/post/edita/{id}',[PostController::class,'edita'])->name('post/edita/{id}');
Route::post('/post/imagenes', [PostController::class,'cargaImagenes'])->name('post/imagenes');
Route::get('/post/buscaImagenes/{id}', [PostController::class,'muestraImagenes'])->name('post/buscaImagenes/{id}');
Route::delete('/post/eliminaImagen/{id}', [PostController::class,'eliminaImagen'])->name('post/eliminaImagen/{id}');
