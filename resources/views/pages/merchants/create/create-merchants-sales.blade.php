@extends('master.master')

@section('content')

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    
<div class="container-xxl flex-grow-1 container-p-y">
    <form class="kyc-form" action="{{ route('store.merchants.sales',['merchant_id' => request()->merchant_id]) }}" method="POST" >
        @csrf
        <!-- Sales Data Section -->
        <div class="form-section box-container">
           
            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.edit-progressBar')

            <!-- Sales Fields -->
            <h4 class="mb-3">Sales Data</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="minTransactionAmount" class="form-label">Min Transaction Amount <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="minTransactionAmount" name="minTransactionAmount" required>
                </div>
                <div class="col-md-6">
                    <label for="monthlyLimitAmount" class="form-label">Monthly Limit Amount <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="monthlyLimitAmount" name="monthlyLimitAmount" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="maxTransactionAmount" class="form-label">Max Transaction Amount <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="maxTransactionAmount" name="maxTransactionAmount" required>
                </div>
                <div class="col-md-6">
                    <label for="maxTransactionCount" class="form-label">Max Transaction Count/Day <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="maxTransactionCount" name="maxTransactionCount" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dailyLimitAmount" class="form-label">Daily Limit Amount <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="dailyLimitAmount" name="dailyLimitAmount" required>
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save Sales Data</button>
            </div>
        </div>
    </form>
</div>

@endsection
