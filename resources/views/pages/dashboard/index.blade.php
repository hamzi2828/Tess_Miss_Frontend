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

        <div class="card">
            <h5 class="card-header">Merchant Progress</h5>
            <div class="card-body">

                <div class="text-light small fw-medium mb-1">Completed {{ $total_percent }}%</div>
                <div class="progress">

                    <!-- Merchant Progress -->
                    <div class="progress-bar bg-info" role="progressbar"
                        style="width: {{ $merchant_percent }}%"
                        aria-valuenow="{{ $merchant_percent }}"
                        aria-valuemin="0"
                        aria-valuemax="100">
                    </div>

                    <!-- Document Progress -->
                    <div class="progress-bar bg-info" role="progressbar"
                        style="width: {{ $document_percent }}%"
                        aria-valuenow="{{ $document_percent }}"
                        aria-valuemin="0"
                        aria-valuemax="100">
                    </div>

                    <!-- Sales Progress -->
                    <div class="progress-bar bg-info" role="progressbar"
                        style="width: {{ $sales_percent }}%"
                        aria-valuenow="{{ $sales_percent }}"
                        aria-valuemin="0"
                        aria-valuemax="100">
                    </div>

                    <!-- Service Progress -->
                    <div class="progress-bar bg-info" role="progressbar"
                        style="width: {{ $service_percent }}%"
                        aria-valuenow="{{ $service_percent }}"
                        aria-valuemin="0"
                        aria-valuemax="100">
                    </div>

                </div>

            </div>
        </div>



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



      </div>
    </div>
    <!-- / Content -->
</div>

 @endsection

@push('script')

@endpush
