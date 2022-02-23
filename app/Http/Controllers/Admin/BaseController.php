<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller {

    public function __construct()
    {
       $this->middleware('auth')->except('index');
    }

    public function index() {

        $user = User::whereNotIn('role_id',[1])->orderBy('id', 'DESC')->get();
        return view('admin.user.dashboard',compact('user'));
    }  

    public function update(Request $request,$id) {
        
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            // return redirect()->route('user.create')->withErrors($validator);
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
            return redirect()->route('users.index')->with('success','Profile Update Successfully');
        }
    } 

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('user'));
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }

    public function create() {
        return view('admin.user.create');
    }

    public function store(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users|email',
            'role_id' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('users.create')->withErrors($validator);
        }else {
            $name = $request->input('name');
            $company_name = $request->input('company_name');
            $email = $request->input('email');
            $password = Hash::make($request->input('password'));
            $role_id = $request->input('role_id');
            User::create(['name' => $name,'company_name' => $company_name,'email' => $email,'password' => $password,'role_id' => $role_id]);
            return redirect()->route('users.index')->with('success','User Create Successfully');    
        }
    } 

    public function changeStatus(Request $request) {

        $status = $request->input('status');
        $id = $request->input('user_id');
        User::where("id",$id)->update(['status' => $status]);
        echo json_encode('Status updated successfully');
    }  
}
