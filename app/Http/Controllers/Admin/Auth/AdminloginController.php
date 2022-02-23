<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class AdminloginController extends Controller
{
    
    public function index() {
        if(Auth::check()){
            return redirect()->route('admin-dashboard');
        }else {
           return  view('admin.login'); 
        }
        
    }

    public function store(LoginRequest $request)
    {

        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::ADMIN);
       
    }
}
