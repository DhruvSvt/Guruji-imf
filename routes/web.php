<?php

use App\Http\Controllers\GuardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\SocietyController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Auth;

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
    return redirect(route('admin.index'));
})->middleware('auth');

Auth::routes();


// ***************************** Admin Routes *****************************
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        // return view('welcome');
        return view('admin.index');
    })->name('admin.index');

    // -------------------------Members Routes-------------------------
    Route::resource('members', UsersController::class);
    Route::post('members/status', [UsersController::class, 'status'])->name('members.status');

    // -------------------------Society Routes-------------------------
    Route::resource('society', SocietyController::class);
    Route::post('society/status', [SocietyController::class, 'status'])->name('society.status');
});


// ***************************** Secretary Routes *****************************
Route::middleware(['auth', 'secretary'])->prefix('secretary')->group(function () {
    Route::get('/', function () {
        // return view('welcome');
        return view('admin.index');
    })->name('admin.index');

    // -------------------------Guard Routes-------------------------
    Route::resource('guard', GuardController::class);
    Route::post('guard/status', [GuardController::class, 'status'])->name('guard.status');

    // -------------------------Resident Routes-------------------------
    Route::resource('resident', ResidentController::class);
    Route::post('resident/status', [ResidentController::class, 'status'])->name('resident.status');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
