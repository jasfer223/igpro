<!-- resources/views/admin/projects.blade.php -->

@extends('layouts.admin')

@section('title', 'NEMSU | IGPro')

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

        {{-- .card START --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                    Generate Report
                </a>
            </div>
            {{-- .card-body START --}}
            <div class="card-body">
                {{-- .row START --}}
                <div class="row">
                    <div class="col-sm-12 col-md-6">

                        {{-- Add New button toggle modal --}}
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i>
                            Add New
                        </button>

                        {{-- form START --}}
                        <form method="POST" action="{{ route('create-project') }}" id="createProjectForm">
                            @csrf

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Create a Project</h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        {{-- .modal-body START --}}
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input class="form-control" id="title" type="text"
                                                    placeholder="Enter project title" name="title">
                                            </div>

                                            {{-- CKEDITOR --}}
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="editor" type="text" placeholder="Enter project description" name="description"> </textarea>
                                            </div>

                                            {{-- <label for="status">Status</label>
                                            <div class="input-group mb-3">

                                                <select class="custom-select" id="status" name="status">
                                                    @foreach ($allStatus as $status)
                                                        <option value="{{ $status->id }}">{{ $status->status_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div> --}}

                                            <label for="status">Campus Location and Status</label>
                                            <div class="mb-3">
                                                <select name="" id="">
                                                    <option value="">Select Status</option>
                                                    @foreach ($campuses as $campus)
                                                        <option value="{{ $campus->id }}">{{ $status->name }} -
                                                            {{ $campus->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary" value="Create project">
                                            </div>

                                        </div> {{-- .modal-body END --}}
                                    </div>
                                </div>
                            </div>
                        </form> {{-- form END --}}
                    </div>
                </div> {{-- .row END --}}

                {{-- .table-responsive START  --}}
                <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Location</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Location</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->title }}</td>
                                    <td>
                                        {{ $project->description }}
                                    </td>
                                    <td>
                                        <div>

                                            @php
                                                $statusBadgeClasses = [
                                                    'Functional' => 'success',
                                                    'Phased Out' => 'danger',
                                                ];
                                                
                                                $badgeClass = $statusBadgeClasses[$project->status->status_name] ?? 'primary';
                                            @endphp

                                            <span class="badge badge-{{ $badgeClass }}">
                                                {{ $project->status->status_name }}
                                            </span>



                                        </div>

                                    </td>

                                    <td>
                                        @foreach ($project->campuses as $campus)
                                            <div>
                                                @php
                                                    // Define a mapping array to associate status names with Bootstrap badge classes
                                                    $locationBadgeClasses = [
                                                        'Tandag' => 'primary',
                                                        'Cantilan' => 'success',
                                                        'Cagwait' => 'dark',
                                                        'Tagbina' => 'warning',
                                                        'San Miguel' => 'danger',
                                                        'Lianga' => 'info',
                                                        'Bislig' => 'secondary',
                                                        // Add more status names and their corresponding badge classes here if needed
                                                    ];
                                                    // Look up the badge class based on the status name using the mapping array
                                                    $badgeClass = $locationBadgeClasses[$campus->location] ?? 'primary';
                                                @endphp
                                                <span
                                                    class="badge badge-{{ $badgeClass }}">{{ $campus->location }}</span>
                                            </div>
                                        @endforeach
                                    </td>

                                    <td class="col-2">
                                        <button class="btn btn-success btn-sm" type="button">View</button>
                                        <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                        <button class="btn btn-warning btn-sm" type="button">Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div> {{-- Table responsive END --}}
            </div> {{-- .card-body END --}}
        </div> {{-- .card END --}}
    </div> {{-- .container-fluid END --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
