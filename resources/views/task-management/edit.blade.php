<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- selec2 cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
    <style>
    .bcontent {
        margin-top: 10px;
    }
    </style>
    <div class="py-12">
        <div class="row">
            <div class="col-md-3 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <nav class="navbar navbar-light bg-light">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="">Dashboard</a>
                                </li>
                                <li class="nav-item has-submenu">
                                    <a class="nav-link" href="{{route('users.index')}}">User Management</a>
                                    <ul class="submenu">
                                        <li style="padding-left:15px;"><a class="nav-link active" href="{{route('users.create')}}">Add</a></li>
                                        <li style="padding-left:15px;"><a class="nav-link" href="{{route('users.index')}}">User List</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('project.index')}}">Manange Project</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('assign_project')}}">Assign Project</a>
                                </li>
                                <li class="nav-item has-submenu active">
                                    <a class="nav-link" href="{{route('task.index')}}">Task Management</a>
                                    <ul class="submenu">
                                        <li style="padding-left:15px;"><a class="nav-link" href="{{route('task.create')}}">Add</a></li>
                                        <li style="padding-left:15px;"><a class="nav-link" href="{{route('task.index')}}">Task Management</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-9 mx-auto sm:px-6 lg:px-8">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>Add Task</h2>
                        <form action="{{route('task.store')}}" method="post">
                            @csrf
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Project Name</strong></td>
                                    <td>
                                        <select class="form-control" id="project" name="project">
                                            @foreach($project as $val)
                                                <option value="{{$val->id}}" {{$val->id == $taskmanagement->project_id  ? 'selected' : ''}}>{{$val->project_name}}</option>
                                            @endforeach        
                                        </select>
                                    </td>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </tr>
                                <tr>
                                    <td width="20%"><strong>Title</strong></td>
                                    <td><input type='text' name='title' id='title' placeholder="Title"class="form-control" autocomplete="off" value="{{$taskmanagement->title}}"></td>
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </tr>
                                <tr>
                                    <td><strong>Description</strong></td>
                                    <td><input type='text' name='description' id='description' placeholder="Description" class="form-control" value="{{$taskmanagement->description}}"></td>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </tr>
                                <tr>
                                    <td><strong>Start Date</strong></td>
                                    <td><input type='date' name='start_date' class="form-control" value="{{$taskmanagement->start_date}}"></td>
                                    @if ($errors->has('start_date'))
                                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                    @endif
                                </tr>
                                <tr>
                                    <td><strong>End Date</strong></td>
                                    <td><input type='date' name='end_date' class="form-control" value="{{$taskmanagement->end_date}}"></td>
                                    @if ($errors->has('end_date'))
                                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                    @endif
                                </tr>
                                <tr>
                                    <td><strong>Estimate Hours</strong></td>
                                    <td><input type="text" name='estimate_hours' class="form-control bs-timepicker" value="{{$taskmanagement->estimate_hours}}"></td>
                                    @if ($errors->has('estimate_hours'))
                                        <span class="text-danger">{{ $errors->first('estimate_hours') }}</span>
                                    @endif
                                </tr>
                                <tr>
                                    <td><strong>Assign Name</strong></td>
                                    <td>
                                        <select class="select2-multiple form-control" name="user[]" multiple="multiple" id="select2Multiple">
                                            @foreach($user as $pval)
                                                <option value="{{$pval->id}}" {{$pval->id == $taskmanagement->assign_id  ? 'selected' : ''}}>{{$pval->name}}</option>
                                            @endforeach        
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        <select class="form-control" id="status" name="status">
                                            @foreach($status as $value)
                                                <option value="{{$value}}" {{$pval->id == $taskmanagement->assign_id  ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach        
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type='submit' name='submit' class="btn btn-success" value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>   
<script>
$(document).ready(function() {
    // Select2 Multiple
    $('.select2-multiple').select2({
        placeholder: "Select",
        allowClear: true
    });
});
$(function () {
  $('.bs-timepicker').timepicker();
});
</script>
