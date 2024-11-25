@extends('master.master')

@section('content')


@if(session('error'))
<br>
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
<br>
    <div class="alert alert-success"> 
        {{ session('success') }}
    </div>
@endif

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-merchant-category">
      


            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Merchant Categories</h4>

                  <div class="export-btn">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-download"></i> Export
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                        <li>
                            <a class="dropdown-item" id="exportCsv" href="#">
                                <i class="ti ti-file"></i> CSV
                            </a>
                        </li>
                    </ul>

                    @can('addMerchantCategories', App\Models\User::class)
                    <button class="btn btn-primary btn-md" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddCategory" style="width: 194px;">
                        <i class="ti ti-plus me-1"></i> Add Category
                    </button>
                    @endcan
                </div>
               
            </div>



            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customCategoryTable" class="table border-top display">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Parent Category</th>
                        
                                <th>Added By</th>
                                <th>Date Added</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($categories as $parentCategory)
                                @if(is_null($parentCategory->parent_id))
                                    <!-- Display the parent category as a bold heading -->
                                    <tr>
                                        <td></td>
                                        <td>{{ $i++ }}</td>
                                        <td><strong>{{ $parentCategory->title }}</strong></td>
                                        <td>{{ $parentCategory->addedBy->name ?? 'N/A' }}</td>
                                        <td>{{ $parentCategory->created_at->format('Y-m-d') }}</td>
                                        <td class="text-lg-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                @can('changeMerchantCategories', App\Models\User::class)
                                                <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-category-btn"
                                                    data-bs-toggle="offcanvas" 
                                                    data-bs-target="#offcanvasEditCategory" 
                                                    data-id="{{ $parentCategory->id }}"
                                                    data-title="{{ $parentCategory->title }}"
                                                    data-parent="{{ $parentCategory->parent_id }}"
                                                    data-added_by="{{ $parentCategory->added_by }}">
                                                    <i class="ti ti-edit"></i>
                                                </button>
                                                @endcan
                                                
                                                @can('deleteMerchantCategories', App\Models\User::class)
                                                <form action="{{ route('merchant-categories.destroy', $parentCategory->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
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
            
                                    <!-- Display child categories under the parent category -->
                                    @foreach($categories as $childCategory)
                                        @if($childCategory->parent_id == $parentCategory->id)
                                            <tr>
                                                <td></td>
                                                <td>{{ $i++ }}</td>
                                              
                                                <td>-- {{ $childCategory->title }}</td>
                                                <td>{{ $childCategory->addedBy->name ?? 'N/A' }}</td>
                                                <td>{{ $childCategory->created_at->format('Y-m-d') }}</td>
                                                <td class="text-lg-center">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        @can('changeMerchantCategories', App\Models\User::class)
                                                        <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-category-btn"
                                                            data-bs-toggle="offcanvas" 
                                                            data-bs-target="#offcanvasEditCategory" 
                                                            data-id="{{ $childCategory->id }}"
                                                            data-title="{{ $childCategory->title }}"
                                                            data-parent="{{ $childCategory->parent_id }}"
                                                            data-added_by="{{ $childCategory->added_by }}">
                                                            <i class="ti ti-edit"></i>
                                                        </button>
                                                        @endcan
                                                        
                                                        @can('deleteMerchantCategories', App\Models\User::class)
                                                        <form action="{{ route('merchant-categories.destroy', $childCategory->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
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
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <script>
                function confirmDelete() {
                    return confirm('Are you sure you want to delete this category?');
                }
            </script>
            

            {{-- Create Category Modal --}}
            @include('pages.merchantCategories.merchantCategory-create-modal')

            {{-- Edit Category Modal --}}
            @include('pages.merchantCategories.merchantCategory-edit-modal')
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

@endsection

@push('script')
<!-- Initialize DataTables with export options -->
<script>
    $(document).ready(function() {
        var table = $('#customCategoryTable').DataTable({
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
