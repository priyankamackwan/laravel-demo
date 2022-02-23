<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Userdetails;
use App\Http\Controllers\Admin\Auth\AdminloginController;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
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
Auth::user();
Route::get('/', function () {
    if (Auth::guest()) {   //but here it will work
        return view('welcome');
    } else {
        if(Auth::user()->role_id==1) {
            return redirect('admin/dashboard');
        }else if(Auth::user()->role_id==2) {
            return redirect('dashboard');
        } 
    }
});

Route::get('/admin',[AdminloginController::class,'index'])->name('admin');
Route::post('/admin',[AdminloginController::class,'store']);

Route::middleware(['user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->middleware(['auth'])->name('user.dashboard'); 
    Route::get('/myAccount',[Userdetails::class,'myAccount'])->middleware(['auth'])->name('myAccount');
    Route::get('/editAccount',[Userdetails::class,'editAccount'])->middleware(['auth'])->name('editAccount');
    Route::post('updateUser/{id}',[Userdetails::class,'updateUser'])->middleware(['auth'])->name('updateUser');
});

Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.admin-dashboard');
        })->name('admin-dashboard'); 
        Route::resource('/users',BaseController::class);
        Route::post('changeStatus',[BaseController::class,'changeStatus'])->name('changeStatus');
    });
});

require __DIR__.'/auth.php';



