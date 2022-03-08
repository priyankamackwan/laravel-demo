<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- selec2 cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-9 mx-auto sm:px-6 lg:px-8">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>Assign Project</h2>
                        <form action="{{route('assign_project.store')}}" method="post">
                            @csrf
                            <table class="table table-borderless">
                                <tr>
                                    <td width="20%"><strong>Project Name</strong></td>
                                    <td> 
                                        <select class="select2-multiple form-control" name="project[]" multiple="multiple" id="select2Multiple">
                                            @foreach($project as $pval)
                                                <option value="{{$pval->id}}">{{$pval->project_name}}</option>
                                            @endforeach        
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%"><strong>User Name</strong></td>
                                    <td> 
                                        <select class="select3-multiple form-control" name="user[]" multiple="multiple" id="select3Multiple">
                                            @foreach($user as $uval)
                                                <option value="{{$uval->id}}">{{$uval->name}}</option>
                                            @endforeach               
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type='submit' name='submit' class="btn btn-success" value="Assign Project"></td>
                                </tr>
                            </table>
                        </form>
                        <table class="table table-striped">
                            <tr>
                                <th>User Name</th>
                                <th>Project Name</th>
                            </tr> 
                            @foreach($assignUserData as $val)
                                <tr>
                                    <td> {{$val->name}} </td>
                                @foreach($val->project as $pval)
                                    <td>{{ $pval->project_name }}</td>
                                @endforeach
                                </tr>
                            @endforeach
                        </table>
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
    $('.select3-multiple').select2({
        placeholder: "Select",
        allowClear: true
    });
});
</script>
