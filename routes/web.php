<?php

use App\Http\Controllers\CalonController;
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
