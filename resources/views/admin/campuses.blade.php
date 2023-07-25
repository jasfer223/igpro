<!-- resources/views/admin/campuses.blade.php -->

@extends('layouts.admin')

@section('title', 'NEMSU | IGPro')

@section('content')
<div class="container-fluid">
    <h4>Manage Campuses</h4>

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

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                            Add New
                        </button>
{{-- ADD A USER FORM --}}
<form method="POST" action="{{ route('create-campus') }}">
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
        <label for="location">Location</label>
        <input class="form-control" id="location" type="text" placeholder="Enter campus location" name="location">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Create campus">
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
                    <table class="table table-bordered" id="campusTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Location</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Location</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($campuses as $campus)
                                <tr>
                                    <td>{{ $campus->id }}</td>
                                    <td>{{ $campus->location }}</td>
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