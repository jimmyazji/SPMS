<?php

use App\Http\Controllers\DirectoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;

Route::group(['middleware' => ['auth']], function () {
    Route::post('media/{project:id}', [MediaController::class, 'store'])
        ->name('media.store');
    Route::post('directory/{project:id}', [DirectoryController::class, 'store'])
        ->name('directory.store');
    Route::delete('directory/{id}', [DirectoryController::class, 'destroy'])
        ->name('directory.destroy');
    Route::delete('media/{id}', [MediaController::class, 'destroy'])
        ->name('media.destroy');
    Route::get('media/{id}', [MediaController::class, 'download'])
        ->name('media.download');
    Route::get('directory/{id}',[DirectoryController::class,'download'])
    ->name('directory.download');
});
