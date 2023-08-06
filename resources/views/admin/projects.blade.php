<!-- resources/views/admin/projects.blade.php -->

@extends('layouts.admin')

@section('title', 'NEMSU | IGPro')

@include('admin.includes.edit-project-modal')
@include('admin.includes.delete-project-modal')
@include('admin.includes.add-project-modal')

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
                        <button type="button" 
                            class="btn btn-primary mb-3" 
                            data-toggle="modal" 
                            data-target="#addNewProjectModal">
                            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i>
                            Add New
                        </button>
                    </div>
                </div> {{-- .row END --}}

                {{-- .table-responsive START  --}}
                <div class="table-responsive">
                    <table class="table table-bordered" id="projectsTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-gray-100">
                            <tr>
                                <th>#</th>
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
                                        <td>{{ $project->id }}</td>
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
                                            {{-- <span class="badge badge-{{ $badgeClass }}">{{ $statusName }}</span> --}}
                                            <span>{{ $statusName }}</span>
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
                                            <button class="btn-circle btn btn-info btn-sm" type="button">
                                                <i class="fas fa-info"> </i>
                                            </button>
                                            <!-- Edit button to open the edit modal -->
                                            <button type="button" class="btn btn-circle btn-secondary btn-sm" data-toggle="modal" data-target="#editProjectModal" data-project-id="{{ $project->id }}" data-project-title="{{ $project->title }}" data-project-description="{{ $project->description }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <!-- Delete button to open the delete modal -->
                                            <button type="button" class="btn btn-circle btn-danger btn-sm" data-toggle="modal" data-target="#deleteProjectModalCenter" data-project-id="{{ $project->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div> {{-- Table responsive END --}}


            </div> {{-- .card-body END --}}
        </div> {{-- .card END --}}
</div> {{-- .container-fluid END --}}

@section('script')
<script>
    // Handle the click event for the edit button
    $('.btn-secondary').on('click', function () {
        const projectId = $(this).data('project-id');
        const projectTitle = $(this).data('project-title');
        const projectDescription = $(this).data('project-description');

        $('#editProjectId').val(projectId);
        $('#editProjectTitle').val(projectTitle);
        
        // Set the content of CKEditor
        desc_editor.setData(projectDescription);

    });

    // Handle the click event for the delete button
    $('.btn-danger').on('click', function () {
        const projectId = $(this).data('project-id');

        $('#deleteProjectId').val(projectId);
    });
</script>
<script src="{{ asset('js/admin/ckeditor.js') }}"> </script>
@endsection
@endsection
