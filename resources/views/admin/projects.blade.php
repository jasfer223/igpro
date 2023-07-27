<!-- resources/views/admin/projects.blade.php -->

@extends('layouts.admin')

@section('title', 'NEMSU | IGPro')

@section('content')
<div class="container-fluid">
    <h4>Manage Projects</h4>

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

    {{-- DataTable Start --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6">

                    {{-- Add new button toggle modal --}}
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                        Add New
                    </button>

                    {{-- Add project form --}}
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

                                    {{-- Project form modal BODY --}}
                                    <div class="modal-body">  

                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input class="form-control" id="title" type="text" placeholder="Enter project title" name="title">
                                        </div>

                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <input class="form-control" id="description" type="text" placeholder="Enter project description" name="description">
                                        </div>   

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Create project">
                                        </div>

                                    </div>   {{-- Modal body END--}}
                                </div>
                            </div>
                        </div>
                    </form> {{-- FORM END --}}
                </div>        
            </div> {{-- Row END --}}

            {{-- Table responsive START  --}}
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
                                <td>{{ $project->description }}</td>

                                
                                <td>
                                @foreach ($project->campuses as $campus)
                                @php
                                    // Define a mapping array to associate statuses with Bootstrap badge classes
                                    $statusBadgeClasses = [
                                        'Functional' => 'success',
                                        'Phased Out' => 'danger',
                                    ];
                                    // Look up the badge class based on the status using the mapping array
                                    $badgeClass = $statusBadgeClasses[$campus->pivot->status] ?? 'danger';
                                @endphp
                                    <span class="badge badge-{{ $badgeClass }}">{{ $campus->pivot->status }} ({{ $campus->location }})</span>
                                @endforeach
                                </td>
                                
                                <td>
                            
                                @php
                                    // Define a mapping array to associate locations with Bootstrap badge classes
                                    $locationBadgeClasses = [
                                        'Tandag' => 'primary',
                                        'Bislig' => 'secondary',
                                        'Cantilan' => 'success',
                                        'San Miguel' => 'danger',
                                        'Tagbina' => 'warning',
                                        'Lianga' => 'info',
                                        'Cagwait' => 'dark',
                                    ];
                                @endphp

                                @foreach ($project->campuses as $campus)
                                    @php
                                        // Look up the badge class based on the location using the mapping array
                                        $badgeClass = $locationBadgeClasses[$campus->location] ?? 'primary';
                                    @endphp
                                    <span class="badge badge-{{ $badgeClass }}">{{ $campus->location }}</span>
                                @endforeach
                            
                                </td>
                                <td class="col-2">
                                    <button class="btn btn-primary btn-sm" type="button">View</button>
                                    <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                    <button class="btn btn-warning btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div> {{-- Table responsive END --}}
        </div>
    </div>
</div>
@endsection
