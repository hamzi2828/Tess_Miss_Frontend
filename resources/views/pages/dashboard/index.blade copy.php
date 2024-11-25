@extends('master.master')

@section('title', 'index')

@push('css')
@endpush

@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row g-6">

      <!-- Sales last year -->
        <div class="col-xxl-2 col-md-4 col-6">
          <div class="card h-100">
              <div class="card-body">
                  <div class="badge p-2 bg-label-success mb-3 rounded">
                      <i class="ti ti-shopping-cart ti-28px"></i>
                  </div>
                  <h5 class="card-title mb-1">Total Orders</h5>
                  <p class="card-subtitle">Last week</p>
                  <p class="text-heading mb-3 mt-1">1.28k</p>
                  <div>
                      <span class="badge bg-label-success">+12.2%</span>
                  </div>
              </div>
          </div>
      </div>
    


      <!-- Total Profit -->
      <div class="col-xxl-2 col-md-4 col-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="badge p-2 bg-label-danger mb-3 rounded">
              <i class="ti ti-credit-card ti-28px"></i>
            </div>
            <h5 class="card-title mb-1">Total Profit</h5>
            <p class="card-subtitle">Last week</p>
            <p class="text-heading mb-3 mt-1">1.28k</p>
            <div>
              <span class="badge bg-label-danger">-12.2%</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Sales -->
      <div class="col-xxl-2 col-md-5 col-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="badge p-2 bg-label-success mb-3 rounded">
              <i class="ti ti-credit-card ti-28px"></i>
            </div>
            <h5 class="card-title mb-1">Total Sales</h5>
            <p class="card-subtitle">Last week</p>
            <p class="text-heading mb-3 mt-1">24.67k</p>
            <div>
              <span class="badge bg-label-success">+24.5%</span>
            </div>
          </div>
        </div>
      </div>

      {{-- total session --}}
        <div class="col-xxl-2 col-md-5 col-6">
          <div class="card h-100">
              <div class="card-body">
                  <div class="badge p-2 bg-label-primary mb-3 rounded">
                      <i class="ti ti-users ti-28px"></i> <!-- Changed icon to represent sessions -->
                  </div>
                  <h5 class="card-title mb-1">Total Sessions</h5> <!-- Changed title -->
                  <p class="card-subtitle">Last week</p>
                  <p class="text-heading mb-3 mt-1">24.67k</p>
                  <div>
                      <span class="badge bg-label-primary">+24.5%</span> <!-- Changed badge color for consistency -->
                  </div>
              </div>
          </div>
      </div>
    

      @include('pages.dashboard.charts.reveneueGrowth')
      
      @include('pages.dashboard.charts.lineAreaChart')
      @include('pages.dashboard.charts.lineChart')

      @include('pages.dashboard.charts.salesOverview')

      @include('pages.dashboard.charts.popularProducts')


        <!-- Sales By Stores -->
        <div class="col-xxl-4 col-md-6">
          <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
              <div class="card-title mb-0">
                <h5 class="mb-1">Sales by Stores</h5>
                <p class="card-subtitle">Monthly Sales Overview</p>
              </div>
              <div class="dropdown">
                <button
                  class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                  type="button"
                  id="salesByCountry"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">
                  <i class="ti ti-dots-vertical ti-md text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountry">
                  <a class="dropdown-item" href="javascript:void(0);">Download</a>
                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  <a class="dropdown-item" href="javascript:void(0);">Share</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="p-0 m-0">
                <li class="d-flex align-items-center mb-4">
                  <div class="avatar flex-shrink-0 me-4">
                    <i class="fis fi fi-us rounded-circle fs-2"></i>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <div class="d-flex align-items-center">
                        <h6 class="mb-0 me-1">$8,567k</h6>
                      </div>
                      <small class="text-body">United states</small>
                    </div>
                    <div class="user-progress">
                      <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                        <i class="ti ti-chevron-up"></i>
                        25.8%
                      </p>
                    </div>
                  </div>
                </li>
                <li class="d-flex align-items-center mb-4">
                  <div class="avatar flex-shrink-0 me-4">
                    <i class="fis fi fi-br rounded-circle fs-2"></i>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <div class="d-flex align-items-center">
                        <h6 class="mb-0 me-1">$2,415k</h6>
                      </div>
                      <small class="text-body">Brazil</small>
                    </div>
                    <div class="user-progress">
                      <p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                        <i class="ti ti-chevron-down"></i>
                        6.2%
                      </p>
                    </div>
                  </div>
                </li>
                <li class="d-flex align-items-center mb-4">
                  <div class="avatar flex-shrink-0 me-4">
                    <i class="fis fi fi-in rounded-circle fs-2"></i>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <div class="d-flex align-items-center">
                        <h6 class="mb-0 me-1">$865k</h6>
                      </div>
                      <small class="text-body">India</small>
                    </div>
                    <div class="user-progress">
                      <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                        <i class="ti ti-chevron-up"></i>
                        12.4%
                      </p>
                    </div>
                  </div>
                </li>
                <li class="d-flex align-items-center mb-4">
                  <div class="avatar flex-shrink-0 me-4">
                    <i class="fis fi fi-au rounded-circle fs-2"></i>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <div class="d-flex align-items-center">
                        <h6 class="mb-0 me-1">$745k</h6>
                      </div>
                      <small class="text-body">Australia</small>
                    </div>
                    <div class="user-progress">
                      <p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                        <i class="ti ti-chevron-down"></i>
                        11.9%
                      </p>
                    </div>
                  </div>
                </li>
                <li class="d-flex align-items-center mb-4">
                  <div class="avatar flex-shrink-0 me-4">
                    <i class="fis fi fi-fr rounded-circle fs-2"></i>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <div class="d-flex align-items-center">
                        <h6 class="mb-0 me-1">$45</h6>
                      </div>
                      <small class="text-body">France</small>
                    </div>
                    <div class="user-progress">
                      <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                        <i class="ti ti-chevron-up"></i>
                        16.2%
                      </p>
                    </div>
                  </div>
                </li>
                <li class="d-flex align-items-center">
                  <div class="avatar flex-shrink-0 me-4">
                    <i class="fis fi fi-cn rounded-circle fs-2"></i>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <div class="d-flex align-items-center">
                        <h6 class="mb-0 me-1">$12k</h6>
                      </div>
                      <small class="text-body">China</small>
                    </div>
                    <div class="user-progress">
                      <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                        <i class="ti ti-chevron-up"></i>
                        14.8%
                      </p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
       
        @include('pages.dashboard.charts.popularProducts')

        @include('pages.dashboard.charts.sourceTraffic')

        @include('pages.dashboard.charts.dounatChart')


        <!-- Total Earning -->
        {{-- <div class="col-xxl-4 col-md-6">
          <div class="card h-100">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title">Total Earning</h5>
                <div class="dropdown">
                  <button
                    class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                    type="button"
                    id="totalEarning"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-md text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarning">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <h2 class="mb-0 me-2">87%</h2>
                <i class="ti ti-chevron-up text-success me-1"></i>
                <h6 class="text-success mb-0">25.8%</h6>
              </div>
            </div>
            <div class="card-body">
              <div id="totalEarningChart"></div>
              <div class="d-flex align-items-start my-4">
                <div class="badge rounded bg-label-primary p-2 me-4 rounded">
                  <i class="ti ti-brand-paypal ti-md"></i>
                </div>
                <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                  <div class="me-2">
                    <h6 class="mb-0">Total Revenue</h6>
                    <small class="text-body">Client Payment</small>
                  </div>
                  <h6 class="mb-0 text-success">+$126</h6>
                </div>
              </div>
              <div class="d-flex align-items-start">
                <div class="badge rounded bg-label-secondary p-2 me-4 rounded">
                  <i class="ti ti-currency-dollar ti-md"></i>
                </div>
                <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                  <div class="me-2">
                    <h6 class="mb-0">Total Sales</h6>
                    <small class="text-body">Refund</small>
                  </div>
                  <h6 class="mb-0 text-success">+$98</h6>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
        <!--/ Total Earning -->

        <!-- Monthly Campaign State -->
        {{-- <div class="col-xxl-4 col-md-6">
          <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
              <div class="card-title mb-0">
                <h5 class="mb-1">Monthly Campaign State</h5>
                <p class="card-subtitle">8.52k Social Visiters</p>
              </div>
              <div class="dropdown">
                <button
                  class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                  type="button"
                  id="MonthlyCampaign"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">
                  <i class="ti ti-dots-vertical ti-md text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="MonthlyCampaign">
                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  <a class="dropdown-item" href="javascript:void(0);">Download</a>
                  <a class="dropdown-item" href="javascript:void(0);">View All</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="p-0 m-0">
                <li class="mb-6 d-flex justify-content-between align-items-center">
                  <div class="badge bg-label-success rounded p-1_5"><i class="ti ti-mail ti-md"></i></div>
                  <div class="d-flex justify-content-between w-100 flex-wrap">
                    <h6 class="mb-0 ms-4">Emails</h6>
                    <div class="d-flex">
                      <p class="mb-0">12,346</p>
                      <p class="ms-4 text-success mb-0">0.3%</p>
                    </div>
                  </div>
                </li>
                <li class="mb-6 d-flex justify-content-between align-items-center">
                  <div class="badge bg-label-info rounded p-1_5"><i class="ti ti-link ti-md"></i></div>
                  <div class="d-flex justify-content-between w-100 flex-wrap">
                    <h6 class="mb-0 ms-4">Opened</h6>
                    <div class="d-flex">
                      <p class="mb-0">8,734</p>
                      <p class="ms-4 text-success mb-0">2.1%</p>
                    </div>
                  </div>
                </li>
                <li class="mb-6 d-flex justify-content-between align-items-center">
                  <div class="badge bg-label-warning rounded p-1_5"><i class="ti ti-mouse ti-md"></i></div>
                  <div class="d-flex justify-content-between w-100 flex-wrap">
                    <h6 class="mb-0 ms-4">Clicked</h6>
                    <div class="d-flex">
                      <p class="mb-0">967</p>
                      <p class="ms-4 text-danger mb-0">1.4%</p>
                    </div>
                  </div>
                </li>
                <li class="mb-6 d-flex justify-content-between align-items-center">
                  <div class="badge bg-label-primary rounded p-1_5"><i class="ti ti-users ti-md"></i></div>
                  <div class="d-flex justify-content-between w-100 flex-wrap">
                    <h6 class="mb-0 ms-4">Subscribe</h6>
                    <div class="d-flex">
                      <p class="mb-0">345</p>
                      <p class="ms-4 text-success mb-0">8.5%</p>
                    </div>
                  </div>
                </li>
                <li class="mb-6 d-flex justify-content-between align-items-center">
                  <div class="badge bg-label-secondary rounded p-1_5">
                    <i class="ti ti-alert-triangle ti-md"></i>
                  </div>
                  <div class="d-flex justify-content-between w-100 flex-wrap">
                    <h6 class="mb-0 ms-4">Complaints</h6>
                    <div class="d-flex">
                      <p class="mb-0">10</p>
                      <p class="ms-4 text-danger mb-0">1.5%</p>
                    </div>
                  </div>
                </li>
                <li class="d-flex justify-content-between align-items-center">
                  <div class="badge bg-label-danger rounded p-1_5"><i class="ti ti-ban ti-md"></i></div>
                  <div class="d-flex justify-content-between w-100 flex-wrap">
                    <h6 class="mb-0 ms-4">Unsubscribe</h6>
                    <div class="d-flex">
                      <p class="mb-0">86</p>
                      <p class="ms-4 text-success mb-0">0.8%</p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div> --}}
        <!--/ Monthly Campaign State -->

  


        {{-- @include('pages.dashboard.charts.barCharts') --}}


      </div>
    </div>
    <!-- / Content -->



    <div class="content-backdrop fade"></div>
  </div>
  <!-- Content wrapper -->

  
@endsection

@push('script')

@endpush