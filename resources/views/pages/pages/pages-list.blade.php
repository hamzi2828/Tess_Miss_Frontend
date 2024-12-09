@extends('master.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-ecommerce-user">

        <div class="d-flex mb-6 align-items-center">
            <h4 class="fw-bold">Merchant Pages</h4>

            <div class="d-flex col-lg-3 col-md-3 ms-auto" style="justify-content: end">

                <a href="{{ route('pages.create') }}" class="btn btn-primary btn-md">
                    <i class="ti ti-plus me-1"></i> Add Page
                </a>

            </div>

        </div>


        <div class="card">
            <div class="card-datatable table-responsive">
                <table id="customPageTable" class="table border-top">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th class="text-lg-center">Page Title</th>
                            <th>Page URL</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th class="text-lg-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php $i = 1; @endphp
                        @foreach($pages as $page)
                        <tr>
                            <td></td>
                            <td>{{ $page->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <span class="text-heading text-wrap fw-medium">{{ $page->title }}</span><br>
                                        <small>{{ $page->url }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $page->url }}</td>

                            <td>{{ $page->created_at }}</td>

                            <td>
                                @if($page->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td class="text-lg-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <!-- Edit Button -->

                                    <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-page-btn"
                                    onclick="editPage({{ $page->id }})">
                                <i class="ti ti-edit"></i>
                            </button>


                                  <!-- Delete Form -->
                            <form action="{{ route('pages.destroy', $page->id) }}" method="POST" class="delete-page-form" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 delete-page-btn">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>

                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>

<!-- Hidden Form for Edit Page -->
<form id="editPageForm" action="{{ route('pages.edit') }}" method="GET" style="display:none;">
    @csrf
    <input type="hidden" id="pageId" name="page_id">
</form>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-page-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission
            const confirmation = confirm("Are you sure you want to delete this user?");
            if (confirmation) {
                // Find the closest form and submit it
                this.closest('form').submit();
            }
        });
    });
});


    // Function to handle edit user button click
    function editPage(pageId) {
    let form = document.getElementById('editPageForm');
    document.getElementById('pageId').value = pageId; // Pass userId in the hidden input
    form.submit();
}

</script>

@endsection



@push('script')
<!-- Initialize DataTables with export options -->
<script>
    $(document).ready(function() {
        var table = $('#customUserTable').DataTable({
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
