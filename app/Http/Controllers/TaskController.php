<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignProject;
use App\Models\User;
use App\Models\Project;
use App\Models\Taskmanagement;
use Auth;
use Illuminate\Support\Facades\Validator; 

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $task = AssignProject::with('taskProject')->where('user_id',Auth::user()->id)->get();
        return view('task-management.index',compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = Project::all();
        $user = User::all();
        $status = array('Open','In Progress','Testing','Completed');
        return view('task-management.create',compact('project','user','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'project' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else {
            $taskinsert = array(
                'project_id' => $request->input('project'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'estimate_hours' => $request->input('estimate_hours'),
                'assign_id' => implode(',',$request->input('user')),
            );
            Taskmanagement::create($taskinsert);  
            return redirect()->back();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
