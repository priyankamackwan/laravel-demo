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
                                    <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('myAccount')}}">My Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('editAccount')}}">Edit Account</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-9 mx-auto sm:px-6 lg:px-8">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>User Details</h2>
                          <table class="table table-borderless">
                            <tr>
                                <td width="20%"><strong>Full Name</strong></td><td>{{Auth::user()->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Company Name</strong></td><td>{{Auth::user()->company_name}}</td>
                            </tr>
                             <tr>
                                <td><strong>Email</strong></td><td>{{Auth::user()->email}}</td>
                            </tr>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>