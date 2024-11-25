@extends('master.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <form class="kyc-form" action="{{ route('update.merchants.services',['merchant_id' => request()->merchant_id]) }}" method="POST">
        @csrf
        <!-- Sales Data Section -->
        <div class="form-section box-container">

            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.edit-progressBar')


            @foreach($services as $service)
            @php
                // Filter services for the current service_id and key by normalized field_name
                $merchantServiceData = $merchant_details['services']
                    ->where('service_id', $service['id'])
                    ->keyBy(fn($item) => strtolower(trim($item->field_name)));
        
                // Decode the fields for the current service
                $fields = json_decode($service['fields'], true);
        
                // Create a mapping of fields to merchantServiceData keys
                $fieldMapping = [];
                $fieldCounter = 0;
                foreach ($fields as $field) {
                    $normalizedField = strtolower(trim($field));
                    $fieldMapping[$normalizedField] = "field {$fieldCounter}";
                    $fieldCounter++;
                }
            @endphp
        
            @if(!empty($fields) && $merchantServiceData->isNotEmpty()) {{-- Matching service_id found --}}
                <div class="form-section box-container">
                    <h4 class="mb-3">{{ ucfirst($service['name']) }}</h4>
        
                    @foreach($fields as $index => $field)
                        @php
                            // Normalize the field name for matching
                            $normalizedField = strtolower(trim($field));
                            // Map the normalized field to the corresponding key in merchantServiceData
                            $mappedKey = $fieldMapping[$normalizedField] ?? null;
                            // Retrieve field value or leave blank if not found
                            $fieldValue = isset($merchantServiceData[$mappedKey])
                                ? $merchantServiceData[$mappedKey]->field_value
                                : '';
                        @endphp
        
                        <div class="mb-3">
                            <label for="service_{{ $service['id'] }}_field_{{ $index }}" class="form-label">
                                {{ ucfirst($field) }}
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="service_{{ $service['id'] }}_field_{{ $index }}" 
                                   name="services[{{ $service['id'] }}][fields][{{ $index }}]"
                                   value="{{ $fieldValue }}"
                                   placeholder="{{ ucfirst($field) }}">
                        </div>
                    @endforeach
                </div>
            @else {{-- No matching service_id found --}}
                <div class="form-section box-container">
                    <h4 class="mb-3">{{ ucfirst($service['name']) }}</h4>
        
                    @foreach($fields as $index => $field)
                        <div class="mb-3">
                            <label for="service_{{ $service['id'] }}_field_{{ $index }}" class="form-label">
                                {{ ucfirst($field) }}
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="service_{{ $service['id'] }}_field_{{ $index }}" 
                                   name="services[{{ $service['id'] }}][fields][{{ $index }}]"
                                   value=""
                                   placeholder="{{ ucfirst($field) }}">
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save Services Data</button>
            </div>
        </div>
    </form>
</div>

@endsection
