<!-- resources/views/admin/roles.blade.php -->

@extends('layouts.admin')

@section('title', 'NEMSU | IGPro')

@include('admin.includes.edit-role-modal')
@include('admin.includes.delete-role-modal')

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

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
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
                        <form method="POST" action="{{ route('create-role') }}">
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

                                            <div class="mb-3">
                                                <label for="role_name">Location</label>
                                                <input class="form-control" id="role_name" type="text"
                                                    placeholder="Enter role name" name="role_name">
                                            </div>

                                            <div class="modal-footer">                                                
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary" value="Create role">
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
                    <table class="table table-bordered" id="rolesTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-gray-100">
                            <tr>

                                <th>ID</th>
                                <th>Role Name</th>
                                <th style="width:  60px;">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th style="width:  60px;">Action</th>
                            </tr>
                        </tfoot>
                        <tbody class="text-gray-800">

                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td style="width: 60px;">
                                        <!-- Edit button to open the edit modal -->
                                        <button type="button" class="btn btn-circle btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editRoleModal" data-role-id="{{ $role->id }}" data-role-name="{{ $role->role_name }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Delete button to open the delete modal -->
                                        <button type="button" class="btn btn-circle btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteRoleModal" data-role-id="{{ $role->id }}">
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
        const roleId = $(this).data('role-id');
        const roleName = $(this).data('role-name');

        $('#editRoleId').val(roleId);
        $('#editRoleName').val(roleName);
    });

    // Handle the click event for the delete button
    $('.btn-danger').on('click', function () {
        const roleId = $(this).data('role-id');

        $('#deleteRoleId').val(roleId);
    });
</script>
@endsection
@endsection
