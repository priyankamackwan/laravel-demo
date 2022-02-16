<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Userdetails;
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



// User login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/myAccount',[Userdetails::class,'myAccount'])->middleware(['auth'])->name('myAccount');
Route::get('/editAccount',[Userdetails::class,'editAccount'])->middleware(['auth'])->name('editAccount');
Route::post('/updateUser/{id}',[Userdetails::class,'updateUser'])->middleware(['auth'])->name('updateUser');

// Admin login
Route::get('/admin-dashboard', function () {
    return view('admin-dashboard');
})->middleware(['auth'])->name('admin-dashboard');

Route::get('/user-management',[Userdetails::class,'userManagement'])->middleware(['auth'])->name('user-management');
Route::delete('/user-management/{id}',[Userdetails::class,'destroy'])->middleware(['auth'])->name('user.destroy');
Route::get('/user-management/{id}',[Userdetails::class,'edit'])->middleware(['auth'])->name('user.edit');
Route::post('/update/{id}',[Userdetails::class,'update'])->middleware(['auth'])->name('update');
Route::get('/user-managementa',[Userdetails::class,'create'])->middleware(['auth'])->name('user.create');
Route::post('/user-management',[Userdetails::class,'store'])->middleware(['auth'])->name('user.store');
Route::post('/user-management',[Userdetails::class,'changeStatus'])->middleware(['auth'])->name('changeStatus');
require __DIR__.'/auth.php';
