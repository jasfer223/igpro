<!-- resources/views/admin/users.blade.php -->
@extends('layouts.admin')

@section('title', 'NEMSU | IGPro')

@include('admin.includes.edit-user-modal')
@include('admin.includes.delete-user-modal')
@include('admin.includes.add-user-modal')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
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
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">
                            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i>
                            Add New
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-gray-100">
                            <tr>

                                <th>Username</th>
                                <th>Email</th>
                                <th>Campus</th>
                                <th>Role</th>
                                <th style="width:  60px;">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Campus</th>
                                <th>Role</th>
                                <th style="width:  60px;">Action</th>
                            </tr>
                        </tfoot>
                        <tbody class="text-gray-800">

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
                                    <td style="width: 60px;">
                                        <!-- Edit button to open the edit modal -->
                                        <button type="button" class="btn btn-circle btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal" data-user-id="{{ $user->id }}" data-user-username="{{ $user->username }}" data-user-email="{{ $user->email }}" data-user-campus-id="{{ $user->campus_id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Delete button to open the delete modal -->
                                        <button type="button" class="btn btn-circle btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-id="{{ $user->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@section('script')
<script>
    // Handle the click event for the edit button
    $('.btn-secondary').on('click', function () {
        const userId = $(this).data('user-id');
        const userUsername = $(this).data('user-username');
        const userEmail = $(this).data('user-email');
        const userCampusId = $(this).data('user-campus-id');

        $('#editUserId').val(userId);
        $('#editUserUsername').val(userUsername);
        $('#editUserEmail').val(userEmail);
        $('#editUserCampusId').val(userCampusId);
    });

    // Handle the click event for the delete button
    $('.btn-danger').on('click', function () {
        const userId = $(this).data('user-id');

        $('#deleteUserId').val(userId);
    });
</script>
@endsection
@endsection
