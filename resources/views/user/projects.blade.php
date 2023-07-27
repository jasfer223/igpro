<!-- resources/views/user/projects.blade.php -->

@extends('layouts.user')

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
                    <form method="POST" action="{{ route('create-user') }}" id="createUserForm">
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
                            @foreach ($project->campuses as $campus)
                                @if ($campus->id === auth()->user()->campus_id)
                                    <tr>
                                        <td>{{ $project->title }}</td>
                                        <td>{{ $project->description }}</td>

                                        @php
                                            // Define a mapping array to associate statuses with Bootstrap badge classes
                                            $statusBadgeClasses = [
                                                'Functional' => 'success',
                                                'Phased Out' => 'warning',
                                            ];
                                            // Look up the badge class based on the status using the mapping array
                                            $badgeClass = $statusBadgeClasses[$campus->pivot->status] ?? 'warning';
                                        @endphp
                                        <td>
                                            <span class="badge badge-{{ $badgeClass }}">{{ $campus->pivot->status }}</span>
                                        </td>

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
                                            // Look up the badge class based on the location using the mapping array
                                            $badgeClass = $locationBadgeClasses[$campus->location] ?? 'primary';
                                        @endphp
                                        <td>
                                            <span class="badge badge-{{ $badgeClass }}">{{ $campus->location }}</span>
                                        </td>

                                        <td class="col-2">
                                            <button class="btn btn-primary btn-sm" type="button">View</button>
                                            <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                            <button class="btn btn-warning btn-sm" type="button">Delete</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach

                    </tbody>
                </table>
            </div> {{-- Table responsive END --}}
        </div>
    </div>
</div>
@endsection
