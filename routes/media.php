<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;


Route::post('media',[MediaController::class,'store'])
->middleware('auth')->name('media.store');