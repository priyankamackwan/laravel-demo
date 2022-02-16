<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
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
                                    <a class="nav-link" href="{{route('admin-dashboard')}}">Dashboard</a>
                                </li>
                                <li class="nav-item has-submenu active">
                                    <a class="nav-link" href="{{route('user-management')}}">User Management</a>
                                    <ul class="submenu">
                                        <li style="padding-left:15px;"><a class="nav-link" href="{{route('user.create')}}">Add</a></li>
                                        <li style="padding-left:15px;"><a class="nav-link" href="{{route('user-management')}}">User List</a></li>
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
                        <h2>User Management</h2>
                        <table class="table table-bordered table-responsive-lg">
                            <tr>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach($user as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->company_name}}</td>
                                <td>{{$row->email}}</td>
                                <td><input data-id="{{$row->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Deactive" {{ $row->status ? 'checked' : '' }}></td>
                                <td><a href="{{route('user.edit',$row->id)}}" class="btn btn-primary">Edit</a>&nbsp;<form action="{{ route('user.destroy',$row->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
        $.ajax({
            type: "post",
            url: '{{route("changeStatus")}}',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            data: {'status': status, 'user_id': user_id},
            success: function(data){
               toastr.success(data, 'status', { timeOut: 2000 });
                return false;
            }
        });
    })
  })
</script>