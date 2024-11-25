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

            {{-- Approval Section --}}
            <div class="form-section box-container">
                <h5 class="basic-details-header">Approval</h5>
                <div class="mt-4 box-container">
                    {{-- Section Ownership Details --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p><strong>KYC Added By:</strong> {{ $merchant[0]['added_by']['name'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>KYC Approved By:</strong> {{ $merchant[0]['approved_by']['name'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>KYC Declined By:</strong> {{ $merchant[0]['declined_by']['name'] ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p><strong>Documents Added By:</strong> {{ $merchant[0]['documents'][0]['added_by']['name'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Documents Approved By:</strong> {{ $merchant[0]['documents'][0]['approved_by']['name'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Documents Declined By:</strong> {{ $merchant[0]['documents'][0]['declined_by']['name'] ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p><strong>Sales Added By:</strong> {{ $merchant[0]['sales'][0]['added_by']['name'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Sales Approved By:</strong> {{ $merchant[0]['sales'][0]['approved_by']['name'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Sales Declined By:</strong> {{ $merchant[0]['sales'][0]['declined_by']['name'] ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p><strong>Services Added By:</strong> {{ $merchant[0]['services'][0]['added_by']['name'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Services Approved By:</strong> {{ $merchant[0]['services'][0]['approved_by']['name'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Services Declined By:</strong> {{ $merchant[0]['services'][0]['declined_by']['name'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
  @include('pages.merchants.components.approveOrDecline')
</div>
@endsection
