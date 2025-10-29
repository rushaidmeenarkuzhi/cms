<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\master\ComplaintController;
use App\Http\Controllers\Master\TechnicianController;
use App\Http\Controllers\master\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/complaints', ComplaintController::class);
Route::resource('/user', UserController::class);
Route::resource('/technician_list', TechnicianController::class);

Route::get('/assign/assign/{ticket_id}', [ComplaintController::class, 'showassign'])->name('complaint.showassign');
Route::post('/assign/assign/{ticket_id}', [ComplaintController::class, 'assignTechnician'])->name('complaint.assign');
Route::post('/technician_list/update', [TechnicianController::class, 'update'])->name('technician_list.update');

