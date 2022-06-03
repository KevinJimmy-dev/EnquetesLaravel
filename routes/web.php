<?php

use App\Http\Controllers\{
    PollController,
    OptionController
};
use Illuminate\Support\Facades\Route;

Route::get('/', [PollController::class, 'index'])->name('index.poll');

Route::get('/enquete/create', [PollController::class, 'create'])->name('create.poll');
Route::post('/enquete/store', [PollController::class, 'store'])->name('store.poll');
Route::get('/enquete/{id}/editar', [PollController::class, 'edit'])->name('edit.poll');
Route::put('/enquete/{id}/update', [PollController::class, 'update'])->name('update.poll');
Route::delete('/enquete/{id}/excluir', [PollController::class, 'delete'])->name('delete.poll');

Route::get('/enquete/{id}/opcoes/create', [OptionController::class, 'create'])->name('create.option');
Route::post('/enquete/{id}/opcoes/store', [OptionController::class, 'store'])->name('store.option');
Route::get('/enquete/{id}/opcoes/editar', [OptionController::class, 'edit'])->name('edit.option');
Route::put('/enquete/{id}/opcoes/update', [OptionController::class, 'update'])->name('update.option');
Route::delete('/enquete/opcoes/{id}/excluir', [OptionController::class, 'delete'])->name('delete.option');
Route::put('/enquete/{id}/votar', [OptionController::class, 'vote'])->name('vote.option');