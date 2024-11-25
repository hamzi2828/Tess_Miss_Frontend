@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-country">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Countries</h4>

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

                    @can('addCountries', App\Models\User::class)
                    <button class="btn btn-primary btn-md" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddCountry" style="width: 194px;">
                        <i class="ti ti-plus me-1"></i> Add Country
                    </button>
                    @endcan
                </div>
               
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customCountryTable" class="table border-top display">
                        <thead>
                            <tr>
                               
                                <th>ID</th>
                                <th>Country Code</th> 
                                <th>Country Name</th>
                                <th>Country Status</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($countries as $country)
                            @php
                                // Define initials from the country name (e.g., 'AF' for Afghanistan)
                                $initials = strtoupper(substr($country->country_name, 0, 2));
                                
                                // Define the background color class based on country status
                                $state = '';
                                if ($country->country_status == 'No Risk') {
                                    $state = 'success'; // Green for 'No Risk'
                                } elseif ($country->country_status == 'Medium Risk') {
                                    $state = 'warning'; // Yellow for 'Medium Risk'
                                } elseif ($country->country_status == 'High Risk') {
                                    $state = 'danger'; // Red for 'High Risk'
                                } elseif ($country->country_status == 'Low Risk') {
                                    $state = 'primary'; // Blue for 'Low Risk'
                                }
                            @endphp
                            <tr>
                               
                                <td>{{ $country->id }}</td>
                                <td>{{ $country->country_code }}</td>
                                <td>{{ $country->country_name }}</td>
                                <td>
                                    <span class="badge bg-{{ $state }}"> {{ $country->country_status }}</span>
                                </td>
                                <td class="text-lg-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        
                                        @can('changeCountries', App\Models\User::class)
                                        <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-country-btn"
                                        data-bs-toggle="offcanvas" 
                                        data-bs-target="#offcanvasEditCountry" 
                                        data-id="{{ $country->id }}"
                                        data-code="{{ $country->country_code }}"
                                        data-name="{{ $country->country_name }}"
                                        data-status="{{ $country->country_status }}">
                                        <i class="ti ti-edit"></i>
                                      </button>
                                      @endcan

                                      @can('deleteCountries', App\Models\User::class)
                                      <form action="{{ route('countries.destroy', $country->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                              <i class="ti ti-trash"></i>
                                          </button>
                                      </form>
                                  @endcan
                                  
                                  <script>
                                      function confirmDelete() {
                                          return confirm('Are you sure you want to delete this country?');
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
            
            {{-- Create Country Modal --}}
            @include('pages.countries.countries-create-modal')

            {{-- Edit Country Modal --}}
            @include('pages.countries.countries-edit-modal')
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

@endsection

@push('script')
<script>
    $(document).ready(function() {
        var table = $('#customCountryTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true,
            "order": [[ 3, 'asc' ]], // Default sorting by Country Name
            
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'Countries Data',
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
