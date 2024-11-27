@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-document">

        
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Documents History</h4>

            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customDocumentTable" class="table border-top">
                        <thead class="table-light">
                            <tr>
                            
                              
                                <th scope="col">Document Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Reason</th>
                                <th scope="col">Approved By</th>
                                <th scope="col">Uploaded Date</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                    
                    <tr>
                        @php
                            $allApproved = true; // Assume all documents are approved initially
                        @endphp
                    
                        <td>
                            @foreach($documents as $document)
                                @php
                                    $titleParts = explode('_', $document->title);
                                    $documentId = $titleParts[0] ?? null;
                                    $shareholder = $titleParts[1] ?? ''; // Safely access the second part
                                    $documentModel = $documentId ? \App\Models\Document::find($documentId) : null; // Check if $documentId exists
                                @endphp
                                {{ $documentModel ? $documentModel->title : 'N/A' }}
                                @if ($documentModel && $documentModel->title === 'QID' && $shareholder)
                                    for {{ $shareholder }}
                                @endif
                                <br>
                                @if(!$document->approved_by)
                                    @php $allApproved = false; @endphp
                                @endif
                            @endforeach
                        </td>
                    
                        <td>
                            @if($allApproved)
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger"> Declined</span>
                            @endif
                        </td>
                    
                        <td>
                            @foreach($documents as $document)
                                @if(!$document->approved_by && $document->declined_by)
                                    {{ $document->decline_notes ?? 'N/A' }}<br>
                                @endif
                            @endforeach
                        </td>
                    
                        <td>
                            @php
                                $firstDocument = $documents->first();
                                $approvedByUser = \App\Models\User::find($firstDocument->approved_by);
                            @endphp
                            {{ $approvedByUser ? $approvedByUser->name : 'N/A' }}
                        </td>
                    
                        <td>
                            {{ $documents->sortByDesc('updated_at')->first()->updated_at->format('Y-m-d') }}
                        </td>
                    
                        <td class="text-center">
                            @foreach($documents as $document)
                                <a href="{{ asset($document->document) }}" class="btn btn-primary btn-sm" target="_blank">View</a>
                            @endforeach
                        </td>
                    </tr>
                    
                          
                        </tbody>
                    </table>
                    
                </div>
            </div>


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
