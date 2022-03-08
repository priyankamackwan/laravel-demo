<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
                                    <a class="nav-link active" href="{{route('admin-dashboard')}}">Dashboard</a>
                                </li>
                                <li class="nav-item has-submenu">
                                    <a class="nav-link" href="{{route('users.index')}}">User management</a>
                                    <ul class="submenu">
                                        <li style="padding-left:15px;"><a class="nav-link" href="{{route('users.create')}}">Add</a></li>
                                        <li style="padding-left:15px;"><a class="nav-link" href="{{route('users.index')}}">User List</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('project.index')}}">Manange Project</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('assign_project')}}">Assign Project</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-9 mx-auto sm:px-6 lg:px-8">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>Edit Project</h2>
                        <form action="{{route('project.update',$project->id)}}" method="post">
                          @csrf
                          @method('PUT')
                          <table class="table table-borderless">
                            <tr>
                                <td width="20%"><strong>Project Name</strong></td>
                                <td><input type='text' name='project_name' id='project_name' placeholder="Project Name"class="form-control" value="{{$project->project_name}}" autocomplete="off"></td>
                                @if ($errors->has('project_name'))
                                    <span class="text-danger">{{ $errors->first('project_name') }}</span>
                                @endif
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type='submit' name='submit' class="btn btn-success" value="Update"></td>
                            </tr>
                          </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
