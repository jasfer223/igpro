<!-- resources/views/admin/users.blade.php -->

@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="container">
    <h1>Manage Users</h1>
     <!-- DataTales Example -->
                    <div class="card shadow mb-4">
 {{--                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users Table</h6>
                        </div> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    
                                
                                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add New
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create a user account</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Role</label>
  </div>
  <select class="custom-select" id="inputGroupSelect01">
    @foreach ($roles as $role)
        <option value="{{ $role->id }}">{{ $role->role_name}}</option>
     
    @endforeach
    
  </select>
</div>

    <div class="mb-3"><label for="exampleFormControlInput1">Email address</label><input class="form-control" id="exampleFormControlInput1" type="email" placeholder="Enter email Ex.[name@nemsu.edu.ph]"></div>

    <div class="mb-3"><label for="exampleFormControlInput1">Password</label><input class="form-control" id="exampleFormControlInput1" type="password" placeholder="Enter password"></div>

    <div class="mb-3"><label for="exampleFormControlInput1">Repeat Password</label><input class="form-control" id="exampleFormControlInput1" type="password" placeholder="Enter password again"></div>

    {{-- <button class="btn btn-primary" type="button">Create Account</button> --}}
    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div></div>
                               
                                <div class="col-sm-12 col-md-3"><div class="dataTables_length" id="dataTable_length"><label>Show entries <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div></div>

                                <div class="col-sm-12 col-md-3"><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div></div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Campus</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Campus</th>
                                            <th>Role</th>
                                            <th>Action</th>
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
                                                <td>
                                                    <button class="btn btn-primary" type="button">Edit</button>
                                                    <button class="btn btn-warning" type="button">Delete</button>
                                                </td>
                                          </tr>
                                        @endforeach

                                        
                                    
                                    </tbody>
                                </table>
                                <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 51 to 57 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next disabled" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div>
                            </div>
                        </div>
                    </div>

</div>
@endsection