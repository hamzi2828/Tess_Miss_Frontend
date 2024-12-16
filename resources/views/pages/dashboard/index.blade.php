@extends('master.master')

@section('title', ' Merchant Forms ')

@push('css')
@endpush

@section('content')


<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row g-6">
        <h3 class="fw-bold">Profile Status</h3>

        <div class="col-12 col-sm-6 col-xl-4">
          <div class="card h-100">
            <div class="d-flex align-items-end row">

              <div class="col-7">
                <div class="card-body text-nowrap">

                  <h5 class="card-title mb-5" style="font-weight: bold;">Basic Information </h5>

                  @if($merchant_details->approved_by)
                    <h5 class="card-title mb-5" style="">Step 1: Completed</h5>
                  @else
                    <h5 class="card-title mb-5" style="">Step 1: Pending Approval</h5>
                  @endif

                    <a href="{{ route('create.merchants.kfc') }}" class="btn btn-primary "
                  >Basic Information</a>

                </div>



              </div>
              <div class="col-5 text-center text-sm-left">
                <div class="card-body pb-5 px-0 px-md-4">
                  <img
                    src="../../assets/img/illustrations/basic_information.png"
                    height="100"
                    alt="view sales" />
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="col-12 col-sm-6 col-xl-4">
          <div class="card h-100">
            <div class="d-flex align-items-end row">
              <div class="col-7">
                <div class="card-body text-nowrap">

                  <h5 class="card-title mb-5" style="font-weight: bold;">Documents Upload</h5>

                  @if($merchant_details->documents->isEmpty())
                      <h6 class="card-title mb-5" style="">Documents required</h6>
                  @else
                      @php
                          $allDocumentsApproved = $merchant_details->documents->every(function ($document) {
                              return !is_null($document->approved_by);
                          });
                      @endphp

                      @if($allDocumentsApproved)
                          <h5 class="card-title mb-5" style="">Step 2: Completed</h5>
                      @else
                          <h5 class="card-title mb-5" style="">Step 2: Pending Approval</h5>
                      @endif
                  @endif

                  <a href="{{ route('edit.documents') }}" class="btn btn-primary"
                  >Upload Documents</a>


                </div>
              </div>
              <div class="col-5 text-center text-sm-left">
                <div class="card-body pb-5 px-0 px-md-4">
                  <img
                    src="../../assets/img/illustrations/upload_documents.png"
                    height="100"
                    alt="view sales" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
          <div class="card h-100">
            <div class="d-flex align-items-end row">
              <div class="col-7">
                <div class="card-body text-nowrap mb-5">
                  <h5 class="card-title mb-5" style="font-weight: bold;">Account Verification</h5>

                  @if($merchant_details->sales->isNotEmpty() && $merchant_details->services->isNotEmpty())

                  <h5 class="card-title mb-5" style="">Step 3: Completed</h5>
                  <a href="{{ route('merchants.preview') }}" class="btn btn-success">View Details <span style="margin: 0 2px;"></span><i class="ti ti-eye"></i></a>
                  @else
                  <h5 class="card-title mb-5" style="">Step 3: Approval  Pending </h5>
                  @endif

                </div>
              </div>

              <div class="col-5 text-center text-sm-left">
                <div class="card-body pb-5 px-0 px-md-4 d-flex justify-content-center">
                  <img
                    src="../../assets/img/illustrations/tick_image_new.jpeg"
                    class="img-fluid"
                    style="max-height: 100px;"
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
