<div class="form-section box-container">
    <h4 class="mb-3 basic-details-header ">Sales Data</h4>

@foreach($merchant_details['sales'] as $index => $sale)
<div class="form-section box-container mb-4">
    {{-- <h5 class="mb-3">Sale Details #{{ $index + 1 }}</h5> --}}

    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Min Transaction Amount:</strong> {{ number_format($sale['min_transaction_amount'] ?? 0, 2) }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Monthly Limit Amount:</strong> {{ number_format($sale['monthly_limit_amount'] ?? 0, 2) }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Max Transaction Amount:</strong> {{ number_format($sale['max_transaction_amount'] ?? 0, 2) }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Max Transaction Count/Day:</strong> {{ $sale['max_transaction_count'] ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Daily Limit Amount:</strong> {{ number_format($sale['daily_limit_amount'] ?? 0, 2) }}</p>
        </div>
    </div>
</div>
@endforeach

    </div>