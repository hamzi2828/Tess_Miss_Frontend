@extends('master.master')

@section('title', 'index')

@push('css')
@endpush

@section('content')


<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row g-6">

        <div class="col-xl-4">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-7">
                <div class="card-body text-nowrap">
                  @if($merchant_details)
                   <h5 class="card-title mb-5" style="">Basic information has been submitted.</h5>
                  @endif
                    <h5 class="card-title mb-5" style="">Step 1: Completed</h5>
                  @if($merchant_details)
                    <a href="{{ route('create.merchants.kfc') }}" class="btn btn-primary disabled" 
                    style="background: rgba(0, 128, 0, 0.78); pointer-events: none; opacity: 0.65;" 
                    aria-disabled="true">Basic Information</a>
                  @endif
                  @if(!$merchant_details)
                    <a href="{{ route('create.merchants.kfc') }}" class="btn btn-primary" 
                        style="background: rgba(0, 128, 0, 0.78);" disabled>Basic Information</a>
                   @endif
                </div> 
                

                
              </div>
              <div class="col-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="../../assets/img/illustrations/card-advance-sale.png"
                    height="140"
                    alt="view sales" />
                </div>
              </div>
            </div>
          </div>
        </div>


       
        <div class="col-xl-4">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-7">
                <div class="card-body text-nowrap">
                  <h5 class="card-title mb-5" style="">Step 2: Completed</h5>
                  <a href="#" class="btn btn-primary" style="background: rgba(255, 87, 34, 0.84);">Upload Documents</a>
                </div>  
              </div>
              <div class="col-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="../../assets/img/illustrations/card-advance-sale.png"
                    height="140"
                    alt="view sales" />
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-4">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-7">
                <div class="card-body text-nowrap">
                  <h5 class="card-title mb-5" style="">Step 3: Completed</h5>
                  <a href="#" class="btn btn-primary" style="background: #666;">Account Verified</a>
                </div>  
              </div>
              <div class="col-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="../../assets/img/illustrations/card-advance-sale.png"
                    height="140"
                    alt="view sales" />
                </div>
              </div>
            </div>
          </div>
        </div>
      
        <!-- View sales -->
        
        <!-- Statistics -->
        {{-- <div class="col-xl-8 col-md-12">
          <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
              <h5 class="card-title mb-0">Statistics</h5>
              <small class="text-muted">Updated 1 month ago</small>
            </div>
            <div class="card-body d-flex align-items-end">
              <div class="w-100">
                <div class="row gy-3">
                  <div class="col-md-4 col-6">
                    <div class="d-flex align-items-center">
                      <div class="badge rounded bg-label-primary me-4 p-2">
                        <i class="ti ti-chart-pie-2 ti-lg"></i>
                      </div>
                      <div class="card-info">
                        <h5 class="mb-0">230k</h5>
                        <small>Total Merchants</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-6">
                    <div class="d-flex align-items-center">
                      <div class="badge rounded bg-label-info me-4 p-2"><i class="ti ti-users ti-lg"></i></div>
                      <div class="card-info">
                        <h5 class="mb-0">8.549k</h5>
                        <small>Pending KYC</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-6">
                    <div class="d-flex align-items-center">
                      <div class="badge rounded bg-label-danger me-4 p-2">
                        <i class="ti ti-shopping-cart ti-lg"></i>
                      </div>
                      <div class="card-info">
                        <h5 class="mb-0">1.423k</h5>
                        <small>Approved KYC</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-6">
                    <div class="d-flex align-items-center">
                      <div class="badge rounded bg-label-success me-4 p-2">
                        <i class="ti ti-currency-dollar ti-lg"></i>
                      </div>
                      <div class="card-info">
                        <h5 class="mb-0"> 9745</h5>
                        <small>Sales</small>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 col-6">
                    <div class="d-flex align-items-center">
                      <div class="badge rounded bg-label-success me-4 p-2">
                        <i class="ti ti-currency-dollar ti-lg"></i>
                      </div>
                      <div class="card-info">
                        <h5 class="mb-0"> 9745</h5>
                        <small>Services</small>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 col-6">
                    <div class="d-flex align-items-center">
                      <div class="badge rounded bg-label-success me-4 p-2">
                        <i class="ti ti-currency-dollar ti-lg"></i>
                      </div>
                      <div class="card-info">
                        <h5 class="mb-0"> 9745</h5>
                        <small>Pending Documents</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
        <!--/ Statistics -->

    
   
   
      </div>
    </div>
    <!-- / Content -->
</div>

 @endsection

@push('script')

@endpush