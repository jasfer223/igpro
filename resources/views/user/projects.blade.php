<!-- resources/views/user/projects.blade.php -->

@extends('layouts.user')

@section('title', 'NEMSU | IGPro')

@include('user.includes.delete-project-modal')
@include('user.includes.edit-project-modal')
@include('user.includes.add-project-modal')

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

        {{-- DataTable Start --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                    Generate Report
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">

                        {{-- Add new button toggle modal --}}
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProjectModal">
                            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i>
                            Add New
                        </button>

                    </div>
                </div> {{-- Row END --}}
                {{-- .table-responsive START  --}}
                <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-gray-100">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">

                            @php
                                // Define an associative array to map status_id to status_name
                                $statusNames = [
                                    1 => 'Functional', // Assuming 1 is the status_id for 'Functional'
                                    2 => 'Phased Out', // Assuming 2 is the status_id for 'Phased Out'
                                    // Add more status_id to status_name mappings as needed
                                ];
                            @endphp
                            @foreach ($projects as $project)
                                @foreach ($project->campuses as $campus)
                                    <tr>
                                        <td>{{ $project->title }}</td>
                                        <td>{{ $project->description }}</td>
                                        <td>
                                            @php
                                                // Retrieve the status_id for the current campus using the pivot table
                                                $status_id = $campus->pivot->status_id;
                                                // Determine the status_name based on the status_id using the associative array
                                                $statusName = $statusNames[$status_id] ?? 'Unknown';
                                                // Determine the badge class based on the status_id
                                                $badgeClass = $status_id === 1 ? 'success' : 'danger'; // You can add more conditions as needed
                                            @endphp
                                            <span class="badge badge-{{ $badgeClass }}">{{ $statusName }}</span>
                                            {{-- <span>{{ $statusName }}</span> --}}
                                        </td>
                                        <td>
                                            {{-- @php
                                                // Define a mapping array to associate status names with Bootstrap badge classes
                                                $locationBadgeClasses = [
                                                    'Tandag' => 'primary',
                                                    'Cantilan' => 'success',
                                                    'Cagwait' => 'cagwait',
                                                    'Lianga' => 'danger',
                                                    'Tagbina' => 'info',
                                                    'San Miguel' => 'secondary',
                                                    'Bislig' => 'warning',
                                                    // Add more campuses and their corresponding badge classes here if needed
                                                ];
                                                $badgeClass = $locationBadgeClasses[$campus->location] ?? 'primary';
                                            @endphp
                                            <span class="badge badge-{{ $badgeClass }}">{{ $campus->location }}</span> --}}
                                            <span>{{ $campus->location }}</span>
                                        </td>
                                        <td style="width: 100px;">
                                            @if ($campus->location === Auth::user()->campus->location)
                                                <button class="btn-circle btn btn-info btn-sm" type="button">
                                                <i class="fas fa-info"> </i>
                                                </button>
                                            
                                                <button type="button" class="btn btn-circle btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editProjectModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                
                                                <!-- Delete button to open the delete modal -->
                                                <button type="button" class="btn btn-circle btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProjectModal" data-project-id="{{ $project->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @else
                                                <button class="btn-circle btn btn-info btn-sm" type="button">
                                                        <i class="fas fa-info"> </i>
                                                </button>
                                                <button class="btn-circle btn btn-primary btn-sm" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div> {{-- Table responsive END --}}
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#user-description'), {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'undo',
                    'redo'
                ]
            },
            removeButtons: 'Table,Image'
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#editProjectDescription'), {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'undo',
                    'redo'
                ]
            },
            removeButtons: 'Table,Image'
        })
        .catch(error => {
            console.error(error);
        });

        
</script>
@section('script')
<script>
</script>
@endsection
@endsection
