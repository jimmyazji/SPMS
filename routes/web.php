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
    Route::get('requests/{group:id}', [GroupRequestController::class, 'store'])->name('requests.store');
    Route::delete('requests/{group:id}', [GroupRequestController::class, 'destroy'])->name('requests.destroy');
    Route::get('request/{id}/accept', [GroupRequestController::class, 'acceptRequest'])->name('requests.accept');
    Route::get('request/{id}/reject', [GroupRequestController::class, 'rejectRequest'])->name('requests.reject');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('groups', GroupController::class);
    Route::get('groups/{group:id}/leave', [GroupController::class, 'leaveGroup'])->name('groups.leave');
    Route::resource('projects', ProjectController::class);
    Route::get('export.projects', [ProjectController::class, 'export'])->name('projects.export');
    Route::get('projects/{project:id}/assign', [ProjectController::class, 'assign'])->name('projects.assign');
    Route::get('projects/{project:id}/unassign', [ProjectController::class, 'unassign'])->name('projects.unassign');
    Route::get('projects/{project:id}/supervise', [ProjectController::class, 'supervise'])->name('projects.supervise');
    Route::get('projects/{project:id}/abandon', [ProjectController::class, 'abandon'])->name('projects.abandon');
    Route::get('projects/{project:id}/approve', [ProjectController::class, 'approve'])->name('projects.approve');
    Route::get('projects/{project:id}/disapprove', [ProjectController::class, 'disapprove'])->name('projects.disapprove');
    Route::get('projects/{project:id}/complete', [ProjectController::class, 'complete'])->name('projects.complete');
    Route::get('projects/{project}/sync', [ProjectController::class, 'sync'])->name('projects.sync');
});

require __DIR__ . '/auth.php';
