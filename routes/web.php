<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\Auth\GitHubController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupRequestController;
use App\Http\Controllers\UserNotificationController;

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

Route::get('auth/github', [GitHubController::class, 'gitRedirect'])->name('auth.git');
Route::get('auth/github/callback', [GitHubController::class, 'handleProviderCallback']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('markAllRead', [UserNotificationController::class, 'markAllRead'])->name('markAllRead');
    Route::get('notifications/{id}', [UserNotificationController::class, 'show'])->name('notifications.show');
    Route::get('groupRequests/{group:id}', [GroupRequestController::class, 'store'])->name('groupRequests.store');
    Route::delete('groupRequests/{group:id}', [GroupRequestController::class, 'destroy'])->name('groupRequests.destroy');
    Route::get('acceptRequest/{id}', [GroupRequestController::class, 'acceptRequest'])->name('groupRequests.acceptRequest');
    Route::get('rejectRequest/{id}', [GroupRequestController::class, 'rejectRequest'])->name('groupRequests.rejectRequest');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('groups', GroupController::class);
    Route::get('leaveGroup/{group:id}', [GroupController::class, 'leaveGroup'])->name('groups.leaveGroup');
    Route::resource('projects', ProjectController::class);
    Route::get('project/{project:id}/assignProject', [ProjectController::class, 'assignProject'])->name('projects.assignProject');
    Route::get('project/{project:id}/unAssignProject', [ProjectController::class, 'unAssignProject'])->name('projects.unAssignProject');
    Route::get('project/{project:id}/supervise', [ProjectController::class, 'supervise'])->name('projects.supervise');
    Route::get('project/{project:id}/unsupervise', [ProjectController::class, 'unsupervise'])->name('projects.unsupervise');
    Route::get('project/{project:id}/approve', [ProjectController::class, 'approve'])->name('projects.approve');
    Route::get('project/{project:id}/disapprove', [ProjectController::class, 'disapprove'])->name('projects.disapprove');
    Route::get('project/{project:id}/complete', [ProjectController::class, 'approve'])->name('projects.complete');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/media.php';
