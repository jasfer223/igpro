<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.admin')

@section('title', 'NEMSU | IGPro')

@section('content')
    <div class="container-fluid">
        {{-- <h4>Admin Dashboard</h4> --}}
        <!-- Page Heading -->

        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $usersCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Admins</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $adminsCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret  fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Campuses</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $campusesCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-school fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-info
                            text-uppercase mb-1">
                                    Roles</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $rolesCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cogs fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <div class="row mb-4">
    <!-- Doughnut Chart -->
    <div class="col-lg-6 d-flex flex-column h-100">
        <div class="card shadow h-100">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Project Statuses per Campus</h6>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-bar pt-4 pb-2">
                    <canvas id="campusStatusBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- {{ dd($campusData) }} --}}
    <!-- Doughnut Chart -->
    <div class="col-lg-6 d-flex flex-column h-100">
        <div class="card shadow h-100">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-doughnut pt-4 pb-3">
                    <canvas id="campusDoughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
    @section('script')
        <script> 
            var campusData = @json($campusData);
            var campusStatusData = @json($campusStatusData);   
        </script> 
        <script src="{{ asset('js/admin/doughnut-charts.js') }}"></script>  
    @endsection

@endsection
