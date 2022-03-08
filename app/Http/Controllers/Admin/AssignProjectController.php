<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\AssignProject;
use Auth;

class AssignProjectController extends Controller
{
    public function assign_project() {
        $project = Project::all();
        $user = User::whereNotIn('role_id',[1])->get();
        $assignUserData = User::with('project')->get();
        return view('project.assign_project',compact('project','user','assignUserData'));
    }

    public function store(Request $request) {
        $project = $request->input('project');
        $user = $request->input('user');
        foreach($user as $val) {
            foreach($project as $pr) {
                AssignProject::create(['user_id'=>$val,'project_id'=>$pr]);
            }
        }
        return redirect()->route('assign_project')->with('success','Assign User  Successfully');
    }
}
