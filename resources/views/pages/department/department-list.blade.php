@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-department">
            <div class="d-flex mb-6 align-items-center">
                <h4 class="fw-bold">Departments</h4>
            
                <div class="d-flex col-lg-3 col-md-3 ms-auto" style="justify-content: end">
                    @can('adddepartments', App\Models\User::class)
                    <button class="btn btn-primary btn-md" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddDepartment">
                        <i class="ti ti-plus me-1"></i> Add Department
                    </button>
                    @endcan
                </div>
            </div>
            
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customDepartmentTable" class="table border-top display">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Department Title</th> 
                                <th>Supervisor Name</th>
                                <th>Stage</th>
                                <th>Added By</th>
                                <th>Date Added</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($departments as $department)
                                @if($department->users->isEmpty())
                                    <tr>
                                        <td></td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $department->title }}</td>
                                        <td>No Supervisor</td> <!-- If no supervisor exists -->
                                        <td>
                                            @switch($department->stage)
                                                @case(1)
                                                    Stage 1 - KYC
                                                    @break
                                                @case(2)
                                                    Stage 2 - Document
                                                    @break
                                                @case(3)
                                                    Stage 3 - Sales
                                                    @break
                                                @case(4)
                                                    Stage 4 - Services
                                                    @break
                                                @default
                                                    Not Assigned
                                            @endswitch
                                        </td>
                                        <td>{{ $department->addedBy->name }}</td>
                                        <td>{{ $department->date_added }}</td>
                        
                                        <td class="text-lg-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                @can('changedepartments', App\Models\User::class)
                                                <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-department-btn"
                                                data-bs-toggle="offcanvas" 
                                                data-bs-target="#offcanvasEditDepartment" 
                                                data-id="{{ $department->id }}"
                                                data-title="{{ $department->title }}"
                                                data-stage="{{ $department->stage }}">
                                                <i class="ti ti-edit"></i>
                                                </button>
                                                @endcan
                        
                                                @can('deletedepartments', App\Models\User::class)
                                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($department->users as $user) <!-- Loop through each user for the department -->
                                        <tr>
                                            <td></td>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $department->title }}</td>
                                            <td>{{ $user->name }}</td> 
                                            <td>
                                                @switch($department->stage)
                                                    @case(1)
                                                        Stage 1 - KYC
                                                        @break
                                                    @case(2)
                                                        Stage 2 - Document
                                                        @break
                                                    @case(3)
                                                        Stage 3 - Sales
                                                        @break
                                                    @case(4)
                                                        Stage 4 - Services
                                                        @break
                                                    @default
                                                        Not Assigned
                                                @endswitch
                                            </td>
                                            <td>{{ $department->addedBy->name }}</td>
                                            <td>{{ $department->date_added }}</td>
                        
                                            <td class="text-lg-center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @can('changedepartments', App\Models\User::class)
                                                    <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-department-btn"
                                                    data-bs-toggle="offcanvas" 
                                                    data-bs-target="#offcanvasEditDepartment" 
                                                    data-id="{{ $department->id }}"
                                                    data-title="{{ $department->title }}"
                                                    data-stage="{{ $department->stage }}">
                                                    <i class="ti ti-edit"></i>
                                                    </button>
                                                    @endcan
                        
                                                    @can('deletedepartments', App\Models\User::class)
                                                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>

            {{-- Create Department Modal --}}
            @include('pages.department.department-create-modal')

            {{-- Edit Department Modal --}}
            @include('pages.department.department-edit-modal')
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

@endsection

@push('script')
<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#customDepartmentTable').DataTable({
            "paging": true,      // Enable pagination
            "ordering": true,    // Enable sorting
            "info": true,        // Display table information
            "searching": true,   // Enable search functionality
            "order": [[ 2, 'asc' ]] // Default sorting by Department Title (column index 2), ascending
        });
    });
</script>
@endpush
