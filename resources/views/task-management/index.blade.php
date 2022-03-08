<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
                                    <a class="nav-link" href="{{route('user.dashboard')}}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('project.index')}}">Manange Project</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('myAccount')}}">My Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('editAccount')}}">Edit Account</a>
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
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>Task Management</h2>
                        <table class="table table-bordered table-responsive-lg">
                            <tr>
                                <th>Project Name</th>
                                <th>Task</th>
                            </tr>
                            @foreach($task as $row)
                            <tr>
                                <td>{{$row->taskProject->project_name}}</td>
                                <td><a href="{{route('task.create',$row->taskProject->id)}}" class="btn btn-warning">View Task</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
