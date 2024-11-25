<div class="form-section box-container">
    <h4 class="mb-3 basic-details-header ">Services</h4>

    <!-- Services Section -->
    @foreach($services as $service)
    <h4 class="mb-3 ">{{ ucfirst($service['name']) }}</h4>
    <div class="form-section box-container">
     
        <!-- Display the fields for each service -->
        @php
        $fields = json_decode($service['fields'], true);
        $merchantServiceData = $merchant_details['services']->where('service_id', $service['id'])->keyBy('field_name');
        @endphp

        @if($fields)
        @foreach($fields as $index => $field)
            <div class="row mb-3">
                <div class="col-md-12">
                    <p><strong>{{ ucfirst($field) }}:</strong> 
                    {{ $merchantServiceData['Field ' . $index]['field_value'] ?? 'N/A' }}</p>
                </div>
            </div>
        @endforeach
        @else
        <p class="text-muted">No fields available for this service.</p>
        @endif

    </div>
    @endforeach
</div>


