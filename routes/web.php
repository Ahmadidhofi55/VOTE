<?php

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


Route::get('/calon', [UsersController::class, 'index'])->name('calon.index');


Route::resource('/kelas', KelasController::class);
