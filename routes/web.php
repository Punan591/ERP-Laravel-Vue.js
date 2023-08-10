<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\AppointmentStatusController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ClientStatusController;
use App\Http\Controllers\Admin\DashboardStatController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

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
    return view('/auth/login');
});

// Route::get('/admin/dashboard', function () {
//    return view('dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/api/stats/appointments', [DashboardStatController::class, 'appointments']);
    Route::get('/api/stats/users', [DashboardStatController::class, 'users']);

    Route::get('/api/users', [UserController::class, 'index']);
    Route::post('/api/users', [UserController::class, 'store']);
    Route::patch('/api/users/{user}/change-role', [UserController::class, 'changeRole']);
    Route::put('/api/users/{user}', [UserController::class, 'update']);
    Route::delete('/api/users/{user}', [UserController::class, 'destory']);
    Route::delete('/api/users', [UserController::class, 'bulkDelete']);

    Route::get('/api/clients', [ClientController::class, 'index']);
    Route::post('/api/clients/create', [ClientController::class, 'store']);
    Route::get('/api/clients/{client}/edit', [ClientController::class, 'edit']);
    Route::put('/api/clients/{client}/edit', [ClientController::class, 'update']);
    Route::get('/api/client-status', [ClientStatusController::class, 'getStatusWithCount']);

    Route::get('/api/appointment-status', [AppointmentStatusController::class, 'getStatusWithCount']);
    Route::get('/api/appointments', [AppointmentController::class, 'index']);
    Route::post('/api/appointments/create', [AppointmentController::class, 'store']);
    Route::get('/api/appointments/{appointment}/edit', [AppointmentController::class, 'edit']);
    Route::put('/api/appointments/{appointment}/edit', [AppointmentController::class, 'update']);
    Route::delete('/api/appointments/{appointment}', [AppointmentController::class, 'destroy']);

    Route::get('/api/settings', [SettingController::class, 'index']);
    Route::post('/api/settings', [SettingController::class, 'update']);

    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages', [MessageController::class, 'index']);
});

//Route::get('{view}', ApplicationController::class)->where('view', '(.*)');
Route::get('{view}', ApplicationController::class)->where('view', '(.*)')->middleware('auth');
