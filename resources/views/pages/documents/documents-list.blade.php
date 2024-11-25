@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-document">

        
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Documents</h4>


                  <div class="export-btn">
                     @can('addSideBarDocuments', App\Models\User::class)
                    <button class="btn btn-primary btn-md" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddDocument" >
                        <i class="ti ti-plus me-1"></i> Add Document
                    </button>
                    @endcan

                </div>
               
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customDocumentTable" class="table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Title</th> 
                                <th>Is Required</th>
                                <th>Require Expiry</th>
                                <th>Allowed Types</th>
                                <th>Added By</th>
                                <th>Date Added</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($documents as $document)
                            <tr>
                                <td></td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $document->title }}</td>
                                <td>{{ $document->is_required ? 'Yes' : 'No' }}</td> <!-- Display if the document is required -->
                                <td>{{ $document->require_expiry ? 'Yes' : 'No' }}</td>
                                <td>{{ $document->allowed_types }}</td>
                                <td>{{ $document->addedBy->name ?? 'N/A' }}</td> <!-- Assuming relationship to added_by is defined -->
                                <td>{{ $document->created_at->format('Y-m-d') }}</td>
                                <td class="text-lg-center">
                                    <div class="d-flex justify-content-center align-items-center">

                                        @can('changeSideBarDocuments', App\Models\User::class)
                                        <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-document-btn"
                                        data-bs-toggle="offcanvas" 
                                        data-bs-target="#offcanvasEditDocument" 
                                        data-id="{{ $document->id }}"
                                        data-title="{{ $document->title }}"
                                        data-is_required="{{ $document->is_required }}"
                                        data-require_expiry="{{ $document->require_expiry }}"
                                        data-allowed_types="{{ $document->allowed_types }}"> <!-- This should be a comma-separated string -->
                                        <i class="ti ti-edit"></i>
                                      </button>
                                    @endcan

                                    @can('deleteSideBarDocuments', App\Models\User::class)
                                    @if($document->title !== 'QID')
                                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                @endcan
                                    <script>
                                        function confirmDelete() {
                                            return confirm('Are you sure you want to delete this document?');
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

            {{-- Create Document Modal --}}
            @include('pages.documents.document-create-modal')

            {{-- Edit Document Modal --}}
            @include('pages.documents.document-edit-modal')
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

{{-- <script>
    // Function to filter table rows based on the search input
    function filterTable() {
        let input = document.getElementById('customDocumentSearch');
        let filter = input.value.toLowerCase();
        let table = document.getElementById('customDocumentTable');
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
        var table = $('#customDocumentTable').DataTable({
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
