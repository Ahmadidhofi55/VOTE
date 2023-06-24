<?php

use App\Http\Controllers\CalonController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\UsersController;
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

//user login
Route::get('/', function () {
    return view('login');
});

//user view


//admin login
Route::get('/login', function () {
    return view('admin.login');
})->name('login');

//admin dashboard
Route::get('/dashboard', function() {
    return view('admin.admin');
})->name('dashboard');


//user
Route::get('/user',[UsersController::class,'index'])->name('user.index');

Route::get('/calon', [CalonController::class, 'index'])->name('calon.index');



//kelas
Route::get('/kelas',[KelasController::class,'index'])->name('kelas.index');
Route::get('/kelas/read',[KelasController::class,'read'])->name('kelas.read');
Route::get('/kelas/show/{id}',[KelasController::class,'show'])->name('kelas.show');
Route::post('/kelas/store',[KelasController::class,'store'])->name('kelas.store');
Route::put('/kelas/update/{id}',[KelasController::class,'update'])->name('kelas.update');
Route::delete('/kelas/delete/{id}',[KelasController::class,'destroy'])->name('kelas.destroy');

//jurusan
Route::get('/jurusan',[JurusanController::class,'index'])->name('jurusan.index');
Route::get('/jurusan/read',[JurusanController::class,'read'])->name('jurusan.read');
Route::get('/jurusan/show/{id}',[JurusanController::class,'show'])->name('jurusan.show');
Route::post('/jurusan/store',[JurusanController::class,'store'])->name('jurusan.store');
Route::put('/jurusan/update/{id}',[JurusanController::class,'update'])->name('jurusan.update');
Route::delete('/jurusan/delete/{id}',[JurusanController::class,'destroy'])->name('jurusan.destroy');

//users
Route::get('/user',[UsersController::class,'index'])->name('user.index');
Route::get('/user/read',[UsersController::class,'read'])->name('user.read');
Route::get('/user/show/{id}',[UsersController::class,'show'])->name('user.show');
Route::post('/user/store',[UsersController::class,'store'])->name('user.store');
Route::put('/user/update/{id}',[UsersController::class,'update'])->name('user.update');
Route::delete('/user/delete/{id}',[UsersController::class,'destroy'])->name('user.destroy');
