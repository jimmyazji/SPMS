<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserNotificationController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('markAllRead', [UserNotificationController::class, 'markAllRead'])->name('markAllRead');
    Route::get('notifications/{id}', [UserNotificationController::class, 'show'])->name('notifications.show');
    Route::get('groupRequests/{group:id}',[GroupRequestController::class,'store'])->name('groupRequests.store');
    Route::delete('groupRequests/{group:id}',[GroupRequestController::class,'destroy'])->name('groupRequests.destroy');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('projects', ProjectController::class);
});

require __DIR__ . '/auth.php';
