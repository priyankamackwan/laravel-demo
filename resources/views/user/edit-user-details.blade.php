<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .bcontent {
            margin-top: 10px;
        }
        .table-borderless > tbody > tr > td,
        .table-borderless > tbody > tr > th,
        .table-borderless > tfoot > tr > td,
        .table-borderless > tfoot > tr > th,
        .table-borderless > thead > tr > td,
        .table-borderless > thead > tr > th {
            border: none;
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
                                    <a class="nav-link" href="{{route('myAccount')}}">My Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('editAccount')}}">Edit Account</a>
                                </li>
                                <li class="nav-item">
                                   <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                    </form>
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
                        <h2>User Details</h2>
                        <form action="{{route('updateUser',Auth::user()->id)}}" method="post">
                          @csrf
                          <table class="table table-borderless">
                            <tr>
                                <td width="20%"><strong>Full Name</strong></td>
                                <td><input type='text' name='name' value='{{Auth::user()->name}}' class="form-control"></td>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </tr>
                            <tr>
                                <td><strong>Company Name</strong></td>
                                <td><input type='text' name='company_name' value='{{Auth::user()->company_name}}' class="form-control"></td>
                                @if ($errors->has('company_name'))
                                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                @endif
                            </tr>
                             <tr>
                                <td><strong>Email</strong></td>
                                <td><input type='email' name='email' value='{{Auth::user()->email}}' class="form-control"></td>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </tr>
                            <tr>
                                <td><strong>Password</strong></td>
                                <td><input type='password' name='password' class="form-control" placeholder="Password"><input type="hidden" name="opwd" value="{{Auth::user()->password}}"></td>
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