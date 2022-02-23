<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Userdetails extends Controller {

    public function myAccount() {
        return view('user.user-details');
    }

    public function editAccount() {
        return view('user.edit-user-details');
    }

    public function updateUser(Request $request,$id) {
        
         $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);
        if($validator->fails()) {
            return redirect()->route('editAccount')->withErrors($validator);
        }else {
            $name = $request->input('name');
            $company_name = $request->input('company_name');
            $email = $request->input('email');
            if(!empty($request->input('password'))){
               $password = Hash::make($request->input('password'));
            }else{
               $password = $request->input('opwd'); 
            }
            User::where("id",$id)->update(['name' => $name,'company_name' => $company_name,'email' => $email,'password' => $password]);
            return redirect()->route('editAccount')->with('success','Profile Update Successfully');  
        }  
    }     
}
