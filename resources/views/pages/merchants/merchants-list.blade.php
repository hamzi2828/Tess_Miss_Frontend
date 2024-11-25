@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-merchant">

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
         
            @if(session('info'))
            <br>
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
            @endif
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">All Merchants</h4>

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

                    @can('addKYC', App\Models\User::class)
             
                    <a href="{{ route('create.merchants.kfc') }}" class="btn btn-primary btn-md">
                        <i class="ti ti-plus me-1"></i>Add Merchant 
                    </a>
                    @endcan

                </div>
               
            </div>


            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customMerchantTablecomplete" class="table border-top display">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Merchant </th>
                                <th>KYC </th>
                                <th>Documents </th>
                                <th>Sales </th>
                                <th>Services </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($merchants as $merchant)
                            <tr>
                                <!-- S.No -->
                                <td>{{ $i++ }}</td>

                                <!-- Merchant Details -->
                                <td>
                                    <strong>{{ $merchant['merchant_name'] }}</strong><br>
                                    <small>{{ $merchant['merchant_email'] }}</small><br>
                                    <small>Registration Date: {{ \Carbon\Carbon::parse($merchant['created_at'])->format('Y-m-d') }}</small>
                                </td>

                                <!-- KYC Details -->
                                <td>
                                    @if (!empty($merchant['added_by']) || !empty($merchant['approved_by']))
                                        <strong>Added:</strong> {{ $merchant['added_by']['name'] ?? 'Pending' }}<br>
                                        <strong>Approved:</strong> {{ $merchant['approved_by']['name'] ?? 'Pending' }}
                                        
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>
                                <!-- Documents Details -->
                                <td>
                                    @if (!empty($merchant['documents']))
                                        <strong>Added:</strong> {{ $merchant['documents'][0]['added_by']['name'] ?? 'Pending' }}<br>
                                        <strong>Approved:</strong> {{ $merchant['documents'][0]['approved_by']['name'] ?? 'Pending' }}
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>
                                <!-- Sales Details -->
                                <td>
                                    @if (!empty($merchant['sales']))
                                        <strong>Added:</strong> {{ $merchant['sales'][0]['added_by']['name'] ?? 'Pending' }}<br>
                                        <strong>Approved:</strong> {{ $merchant['sales'][0]['approved_by']['name'] ?? 'Pending' }}
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>

                            

                                <!-- Services Details -->
                                <td>
                                    @if (!empty($merchant['services']))
                                        <strong>Added:</strong> {{ $merchant['services'][0]['added_by']['name'] ?? 'Pending' }}<br>
                                        <strong>Approved:</strong> {{ $merchant['services'][0]['approved_by']['name'] ?? 'Pending' }}
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">

                                   
                                     @canany(['viewKYC', 'viewDocuments','viewSales','viewServices'], App\Models\User::class)
                                        <!-- Preview Button -->
                                    <form action="{{ route('merchants.preview') }}" method="GET" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="merchant_id" value="{{ $merchant['id'] }}">
                                        <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </form>
                                    @endcanany


                                    @canany(['changeKYC', 'changeDocuments','changeSales','changeServices'], App\Models\User::class)

                                        <!-- Edit Button -->
                                        @php
                                        $userStage = auth()->user()->getDepartmentStage(auth()->user()->department);
                                        $routeName = $userStage == 1 
                                            ? 'edit.merchants.kyc' 
                                            : ($userStage == 2 
                                                ? 'edit.merchants.documents' 
                                                : ($userStage == 3 
                                                    ? 'edit.merchants.sales' 
                                                    : 'edit.merchants.services'));
                                    @endphp
                                    
                                    <form action="{{ route($routeName) }}" method="GET">
                                        <input type="hidden" name="merchant_id" value="{{ $merchant['id'] }}">
                                        <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                    </form>
                                    
                                    
                                    
                                     
                                        <!-- Delete Button -->
                                        {{-- <form action="{{ route('merchants.destroy', $merchant['id']) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form> --}}
                                        @endcanany
                                        <!-- Delete Confirmation -->
                                        <script>
                                            function confirmDelete() {
                                                return confirm('Are you sure you want to delete this merchant?');
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
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

@endsection

@push('script')


<script>
    $(document).ready(function() {
        var table = $('#customMerchantTablecomplete').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true,
            "order": [[ 1, 'asc' ]], // Default sorting by Merchant Details
            // dom: '<"d-flex justify-content-between"<"search-box"f><"export-btn"B>>t<"d-flex justify-content-between"ip>',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'Merchants Data',
                    text: 'Export CSV',
                    className: 'btn btn-secondary mt'
                }
            ]
        });

        // Attach CSV export event to the dropdown item
        $('#exportCsv').on('click', function() {
            table.button('.buttons-csv').trigger();
        });
    });


</script>

@endpush
