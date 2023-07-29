<!-- resources/views/user/projects.blade.php -->

@extends('layouts.user')

@section('title', 'NEMSU | IGPro')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Users</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

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

                       @foreach ($campusProjects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->description }}</td>
                                
                                @if ($project->campuses->contains('location', Auth::user()->campus->location))
                                    <td> 
                                        @foreach ($project->statuses as $status)
                                            
                                                <div>  
                                                    @php
                                                        $statusBadgeClasses = [
                                                            'Functional' => 'success',
                                                            'Phased Out' => 'danger',
                                                        ];
                                                        $badgeClass = $statusBadgeClasses[$status->status_name] ?? 'success';
                                                    @endphp
                                                    <span class="badge badge-{{ $badgeClass }}">{{ $status->status_name }}</span>
                                                </div>
                                        @break 
                                        @endforeach   
                                    </td>
                                @endif


                                <td>
                                    @foreach ($project->campuses as $campus)
                                        <div>
                                            @php
                                                $locationBadgeClasses = [
                                                    'Tandag' => 'primary',
                                                    'Cantilan' => 'success',
                                                    'Cagwait' => 'dark',
                                                    'Lianga' => 'info',
                                                    'Tagbina' => 'warning',
                                                    'San Miguel' => 'danger',
                                                    'Bislig' => 'secondary',
                                                    ];
                                                $badgeClass = $locationBadgeClasses[$campus->location] ?? 'primary';
                                            @endphp
                                            <span class="badge badge-{{ $badgeClass }}">{{ $campus->location }}</span>
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
        </div>
    </div>
</div>
@endsection
