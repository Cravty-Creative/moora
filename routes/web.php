<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

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
	return redirect('sign-in');
})->middleware('guest');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/', function () {
	return redirect('karyawan');
})->middleware('auth');

Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');

	// Route master data Kriteria
	Route::get('kriteria', [KriteriaController::class, 'getAll']);
	Route::get('kriteriawithsubpoin', [KriteriaController::class, 'getAllWithSubPoin']);

	// Route manage data karyawan
	Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan');
	Route::get('karyawanall', [KaryawanController::class, 'getAll']);
	Route::get('karyawanDT', [KaryawanController::class, 'getList']);
	Route::get('karyawan/{id}', [KaryawanController::class, 'show']);
	Route::post('karyawan', [KaryawanController::class, 'create']);
	Route::post('karyawan/{id}', [KaryawanController::class, 'update']);
	Route::delete('karyawan/{id}', [KaryawanController::class, 'destroy']);

	// Route manage data penilaian
	Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian');

	// Route Ranking
	Route::get('ranking', [RankingController::class, 'index'])->name('ranking');
});
