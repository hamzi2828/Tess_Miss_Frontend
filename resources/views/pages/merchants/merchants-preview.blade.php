{{-- merchant-preview --}}
@extends('master.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Alert Messages --}}
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

    {{-- Merchant Approval Status --}}
    @php
        $allApproved = $merchant_details->approved_by !== null &&
                    $merchant_details->documents->isNotEmpty() &&
                    $merchant_details->documents->every(fn($document) => $document->approved_by !== null) &&
                    $merchant_details->sales->isNotEmpty() &&
                    $merchant_details->sales->every(fn($sale) => $sale->approved_by !== null) &&
                    $merchant_details->services->isNotEmpty() &&
                    $merchant_details->services->every(fn($service) => $service->approved_by !== null);
    @endphp

    @if($allApproved)
        <div class="alert alert-success d-flex align-items-center justify-content-center w-100" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>All stages has been successfully approved!</strong>
        </div>
    @endif


    {{-- Merchant Details --}}
    <div class="row">
        <div class="col-md-3">
            @include('pages.merchants.preview.leftHalf')
        </div>

        <div class="col-md-9">
            {{-- Basic Details Section --}}
            @if(!is_null($merchant_details))
                @include('pages.merchants.preview.basicDetailsSection')
            @endif

            {{-- Sales Data Section --}}
            @if($merchant_details->sales->isNotEmpty())
                @include('pages.merchants.preview.salesDetailsSection')
            @endif

            {{-- Services Section --}}
            @if($merchant_details->services->isNotEmpty())
                @include('pages.merchants.preview.servicesDeatilsSection')
            @endif



        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

</div>
@endsection
