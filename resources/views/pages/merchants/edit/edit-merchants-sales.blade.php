@extends('master.master')

@section('content')

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container-xxl flex-grow-1 container-p-y">
    <form class="kyc-form" action="{{ route('update.merchants.sales',['merchant_id' => request()->merchant_id]) }}" method="POST">
        @csrf

        <!-- Sales Data Section -->
        <div class="form-section box-container">
           
            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.edit-progressBar')

            <!-- Sales Fields -->
            <h4 class="mb-3">Sales Data</h4>
            
            @foreach($merchant_details['sales'] as $index => $sale)
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="minTransactionAmount_{{ $index }}" class="form-label">Min Transaction Amount <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="minTransactionAmount_{{ $index }}" name="sales[{{ $index }}][minTransactionAmount]" value="{{ $sale['min_transaction_amount'] }}" required>
                </div>
                <div class="col-md-6">
                    <label for="monthlyLimitAmount_{{ $index }}" class="form-label">Monthly Limit Amount <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="monthlyLimitAmount_{{ $index }}" name="sales[{{ $index }}][monthlyLimitAmount]" value="{{ $sale['monthly_limit_amount'] }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="maxTransactionAmount_{{ $index }}" class="form-label">Max Transaction Amount <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="maxTransactionAmount_{{ $index }}" name="sales[{{ $index }}][maxTransactionAmount]" value="{{ $sale['max_transaction_amount'] }}" required>
                </div>
                <div class="col-md-6">
                    <label for="maxTransactionCount_{{ $index }}" class="form-label">Max Transaction Count/Day <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="maxTransactionCount_{{ $index }}" name="sales[{{ $index }}][maxTransactionCount]" value="{{ $sale['max_transaction_count'] }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dailyLimitAmount_{{ $index }}" class="form-label">Daily Limit Amount <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="dailyLimitAmount_{{ $index }}" name="sales[{{ $index }}][dailyLimitAmount]" value="{{ $sale['daily_limit_amount'] }}" required>
                </div>
            </div>
            @endforeach

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save Sales Data</button>
            </div>
        </div>
    </form>
</div>

@endsection
