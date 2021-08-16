<?php

use App\Http\Controllers\DirectoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;

Route::group(['middleware' => ['auth']], function () {
    Route::post('media/{directory:id}', [MediaController::class, 'store'])
        ->name('media.store');
    Route::post('directory/{directory:id}', [DirectoryController::class, 'store'])
        ->name('directory.store');
    Route::get('directory/{id}', [DirectoryController::class, 'download'])
        ->name('directory.download');
    Route::delete('directory/{id}', [DirectoryController::class, 'destroy'])
        ->name('directory.destroy');
    Route::get('media/{id}', [MediaController::class, 'download'])
        ->name('media.download');
    Route::delete('media/{id}', [MediaController::class, 'destroy'])
        ->name('media.destroy');
    Route::post('directory/{id}',[DirectoryController::class,'rename'])
    ->name('directory.rename');
    Route::post('media/{id}',[MediaController::class,'rename'])
    ->name('media.rename');
});
