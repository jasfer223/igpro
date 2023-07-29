<!-- resources/views/admin/users.blade.php -->
@extends('layouts.admin')

@section('title', 'NEMSU | IGPro')

@section('content')
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> 
                Generate Report
            </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                           <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> 
                           Add New
                        </button>
{{-- ADD A USER FORM --}}
<form method="POST" action="{{ route('create-user') }}" id="createUserForm">
      @csrf
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create a user account</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

  
    <div class="input-group mb-3">
        <label for="username">Role</label>
        <select class="users-role-select-multiple" name="role[]" multiple="multiple" style="width: 100%">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
            @endforeach
        </select>        
    </div>

    <div class="input-group mb-3">
        <label for="username">Campus</label>

        <select class="custom-select" name="campus" style="width: 100%">
            @foreach ($campuses as $campus)
                <option value="{{ $campus->id }}">{{ $campus->location }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="username">Username</label>
        <input class="form-control" id="username" type="text" placeholder="Enter username" name="username">
    </div>

    <div class="mb-3">
        <label for="email">Email address</label>
        <input class="form-control" id="email" type="email" placeholder="Enter email Ex. [name@nemsu.edu.ph]" name="email">
    </div>

    <div class="mb-3">
        <label for="password">Password</label>
        <input class="form-control" id="password" type="password" placeholder="Enter password" name="password">
        <span class="text-xs text-danger">
            @error('password')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="mb-3">
        <label for="password_confirmation">Repeat Password</label>
        <input class="form-control" id="password_confirmation" type="password" placeholder="Enter password again"
            name="password_confirmation">
        <span class="text-danger" id="password-error"></span>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Create account">
        {{-- <button type="submit" class="btn btn-primary">Save changes</button> --}}
    </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>        
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>Username</th>
                                <th>Email</th>
                                <th>Campus</th>
                                <th>Role</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Campus</th>
                                <th>Role</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($usersWithRoles as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->campus->location }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->role_name }},
                                        @endforeach
                                    </td>
                                    <td class="col-2">
                                        <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                        <button class="btn btn-warning btn-sm" type="button">Delete</button>
                                    </td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
