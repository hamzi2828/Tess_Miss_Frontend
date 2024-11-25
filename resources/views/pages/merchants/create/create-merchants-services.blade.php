@extends('master.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <form class="kyc-form" action="{{ route('store.merchants.services' ,['merchant_id' => request()->merchant_id]) }}" method="POST">
        @csrf
        <!-- Sales Data Section -->
        <div class="form-section box-container">

            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.edit-progressBar')

            <!-- Services Section -->
            @foreach($services as $service)
            <div class="form-section box-container">
                <h4 class="mb-3">{{ ucfirst($service->name) }}</h4>

                <!-- Display the fields for each service -->
                @php
                    $fields = json_decode($service->fields, true);
                @endphp

                @if($fields)
                    @foreach($fields as $index => $field)
                    <div class="mb-3">
                        <label for="service_{{ $service->id }}_field_{{ $index }}" class="form-label">{{ ucfirst($field) }}</label>
                        <input type="text" 
                               class="form-control" 
                               id="service_{{ $service->id }}_field_{{ $index }}" 
                               name="services[{{ $service->id }}][fields][{{ $index }}]"
                               placeholder="{{ ucfirst($field) }}">
                    </div>
                    @endforeach
                @endif

            </div>
            @endforeach

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save Services Data</button>
            </div>
        </div>
    </form>
</div>

@endsection
