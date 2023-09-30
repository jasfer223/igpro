<!-- resources/views/admin/campuses.blade.php -->

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

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Campuses</h6>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                    Generate Report
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewCampusModal">
                            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i>
                            Add New
                        </button>
                        
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="campusTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-gray-100">
                            <tr>
                                <th style="width:  20px;">#</th>
                                <th>Location</th>
                                <th style="width:  60px;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">

                            @foreach ($campuses as $campus)
                                <tr>
                                    <td>{{ $campus->id }}</td>
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
                                                // Add more status names and their corresponding badge classes here if needed
                                            ];
                                            // Look up the badge class based on the status name using the mapping array
                                            $badgeClass = $locationBadgeClasses[$campus->location] ?? 'primary';
                                        @endphp
                                        <span class="badge badge-{{ $badgeClass }}">{{ $campus->location }}</span> --}}

                                        <span>{{ $campus->location }}</span>


                                    </td>
                                    <td style="width: 60px;">
                                        <!-- Edit button to open the edit modal -->
                                        <button type="button" class="btn btn-circle btn-secondary btn-sm" data-toggle="modal" data-target="#editCampusModal" data-campus-id="{{ $campus->id }}" data-campus-location="{{ $campus->location }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Delete button to open the delete modal -->
                                        <button type="button" class="btn btn-circle btn-danger btn-sm" data-toggle="modal" data-target="#deleteCampusModalCenter" data-role-id="{{ $campus->id }}">
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

@include('admin.includes.edit-campus-modal')
@include('admin.includes.delete-campus-modal')
@include('admin.includes.add-campus-modal')
    
@section('script')
<script>
    // Handle the click event for the edit button
    $('.btn-secondary').on('click', function () {
        const campusId = $(this).data('campus-id');
        const campusLocation = $(this).data('campus-location');

        $('#editCampusId').val(campusId);
        $('#editCampusLocation').val(campusLocation);
    });

    // Handle the click event for the delete button
    $('.btn-danger').on('click', function () {
        const campusId = $(this).data('campus-id');

        $('#deleteRoleId').val(campusId);
    });
</script>
@endsection
@endsection
