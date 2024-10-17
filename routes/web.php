<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserController;

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
Route::get('/landing-page', [LandingPageController::class, 'index'])->name('landing_page');
Route::get('/', function () {
    return view('home');
});
Route::resource('events', EventController::class);

Route::prefix('/kelola_akun')->name('kelola_akun.')->group(function (){
    Route::get('/data',[UserController::class, 'index'])->name('data');
    Route::get('/tambah', [UserController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [UserController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}', [UserController::class, 'edit'])->name('ubah');
    Route::patch('/ubah/{id}/proses', [UserController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('hapus');
    Route::get('/kelola-akun/tambah', [UserController::class, 'tambah'])->name('kelola_akun.tambah');
    Route::post('/kelola-akun/simpan', [UserController::class, 'simpan'])->name('kelola_akun.simpan');
});




