<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LoginController;


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

//ADMIN
Route::middleware(['auth'])->group(function () {
    Route::get('/Dashboard', [DashboardController::class,'index']);
    Route::get('/Dashboard', [DashboardController::class,'index']);
    Route::post('Logout', [LoginController::class, 'Logout'])->name('Logout');
    Route::get('MasterSiswa/{id_siswa}/hapus', [SiswaController::class,'hapus'])->name('MasterSiswa.hapus');
    Route::resource('/MasterSiswa', SiswaController::class);
    Route::resource('/MasterProject', ProjectController::class);
    Route::resource('/MasterKontak', KontakController::class);
    Route::get('/MasterProject/tambah/{id}', [ProjectController::class, 'tambah']);
});

//GUEST
Route::middleware(['guest'])->group(function () {
    Route::get('/Login', [LoginController::class, 'index'])->name('login');     
    Route::post('/Login', [LoginController:: class, 'authenticate'])->name('login.auth');
    Route::get('/', function () { return view('home');});
    Route::get('/about', function () {return view('about');});
    Route::get('/project', function () {return view('project');});
    Route::get('/contact', function () {return view('contact');});    
});