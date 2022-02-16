<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Userdetails extends Controller {

    public function myAccount() {
        
        return view('user-details');
    }

    public function editAccount() {
        
        return view('edit-user-details');
    }

    public function updateUser(Request $request,$id) {
        
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
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

    public function userManagement() {

        $user = User::orderBy('id', 'DESC')->get();
        return view('user.show',compact('user'));
    }  

    public function update(Request $request,$id) {
        
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $name = $request->input('name');
        $company_name = $request->input('company_name');
        $email = $request->input('email');
        if(!empty($request->input('password'))){
           $password = Hash::make($request->input('password'));
        }else{
           $password = $request->input('opwd'); 
        }
        User::where("id",$id)->update(['name' => $name,'company_name' => $company_name,'email' => $email,'password' => $password]);
        return redirect()->route('user-management')->with('success','Profile Update Successfully');
    } 

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('user.edit',compact('user'));
    }

    public function destroy($id) {

        $user = User::find($id);
        $user->delete();
        return redirect()->route('user-management')->with('success','User deleted successfully');
    }

    public function create() {

        return view('user.create');
    }

    public function store(Request $request) {
        
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $name = $request->input('name');
        $company_name = $request->input('company_name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $role_id = $request->input('role_id');
        User::create(['name' => $name,'company_name' => $company_name,'email' => $email,'password' => $password,'role_id' => $role_id]);
        return redirect()->route('user-management')->with('success','User Create Successfully');
    } 

    public function changeStatus(Request $request) {

        $status = $request->input('status');
        $id = $request->input('user_id');
        User::where("id",$id)->update(['status' => $status]);
        echo json_encode('Status updated successfully');
    }  
   
}
