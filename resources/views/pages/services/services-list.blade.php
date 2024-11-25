@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-service">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Services</h4>
                <div class="col-md-4 col-lg-2">
                    {{-- <input type="text" id="customServiceSearch" class="form-control me-2" placeholder="Search services" onkeyup="filterTable()"> --}}
                  
                    @can('addSideBarServices', App\Models\User::class)
                      <button class="btn btn-primary btn-md" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddService">
                        <i class="ti ti-plus me-1"></i> Add Service
                    </button>
                    @endcan
                </div>
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customServiceTable" class="table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Services Name</th> 
                                <th>Services Fields</th>
                                <th>Added By</th>
                                <th>Date Added</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($services as $service)
                            <tr>
                                <td></td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $service->name }}</td>
                                <td>
                                    <ul>
                                        @foreach(json_decode($service->fields) as $field)
                                            <li>{{ $field }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                 <!-- Display JSON fields -->
                                <td>{{ $service->user->name ?? 'N/A' }}</td> <!-- Assuming relationship to added_by is defined -->
                                <td>{{ $service->date_added->format('Y-m-d') }}</td>
                                <td class="text-lg-center">
                                    <div class="d-flex justify-content-center align-items-center">

                                        @can('changeSideBarServices', App\Models\User::class)
                                            <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-service-btn"
                                            data-bs-toggle="offcanvas" 
                                            data-bs-target="#offcanvasEditService" 
                                            data-id="{{ $service->id }}"
                                            data-name="{{ $service->name }}"
                                            data-fields="{{ htmlspecialchars(json_encode($service->fields), ENT_QUOTES, 'UTF-8') }}">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                      @endcan
                                      @can('deleteSideBarServices', App\Models\User::class)
                                      <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                    <script>
                                        function confirmDelete() {
                                            return confirm('Are you sure you want to delete this service?');
                                        }
                                    </script>
                                    

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Create Service Modal --}}
            @include('pages.services.service-create-modal')

            {{-- Edit Service Modal --}}
            @include('pages.services.service-edit-modal')
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

{{-- <script>
    // Function to filter table rows based on the search input
    function filterTable() {
        let input = document.getElementById('customServiceSearch');
        let filter = input.value.toLowerCase();
        let table = document.getElementById('customServiceTable');
        let rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                let cellValue = cells[j].textContent || cells[j].innerText;
                if (cellValue.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script> --}}

@endsection
@push('script')
<!-- Initialize DataTables with export options -->
<script>
    $(document).ready(function() {
        var table = $('#customServiceTable').DataTable({
            "paging": true,      // Enable pagination
            "ordering": true,    // Enable sorting
            "info": true,        // Display table information
            "searching": true,   // Enable search functionality
            "order": [[ 1, 'asc' ]], // Default sorting by Title (column index 3), ascending

            // Add export buttons before the search box
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'excelHtml5',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'print',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                }
            ]
        });

        // Trigger the export actions from the dropdown
        $('#exportCsv').on('click', function() {
            table.button('.buttons-csv').trigger();
        });

        $('#exportExcel').on('click', function() {
            table.button('.buttons-excel').trigger();
        });

        $('#exportPdf').on('click', function() {
            table.button('.buttons-pdf').trigger();
        });

        $('#exportPrint').on('click', function() {
            table.button('.buttons-print').trigger();
        });
    });
</script>
@endpush
