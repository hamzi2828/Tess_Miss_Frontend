@extends('master.master')

@section('content')

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container-xxl flex-grow-1 container-p-y">
    <form class="kyc-form" action="{{ route('store.merchants.documents',['merchant_id' => request()->merchant_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Details Section -->
        <div class="form-section box-container">
            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.edit-progressBar')
        
            <!-- Document Fields -->
            <h4 class="mb-3">Documents</h4>
        
            @foreach($merchant_documents as $document)
                <div class="row mb-3">
                    @if($document->title === 'QID')
                        <!-- Iterate through each shareholder if document is QID -->
                        @foreach($merchant_shareholders as $shareholder)
                            <div class="col-md-6">
                                <label for="document_{{ $document->id }}_{{ $shareholder->id }}" class="form-label">
                                    <strong> {{ $document->title }} for {{ $shareholder->title }}</strong>
                                    @if($document->is_required)
                                        (Required)<span class="required-asterisk">*</span> 
                                    @endif
                                </label>
                                <div class="input-group">
                                    <input 
                                        type="file" 
                                        class="form-control" 
                                        id="document_{{ $document->id }}_{{ $shareholder->id }}" 
                                        name="document_{{ $document->id }}_{{ $shareholder->id }}_{{ $shareholder->title }}" 
                                        @if($document->allowed_types === 'documents')
                                            accept=".pdf,.doc,.docx,.xls,.xlsx,.txt" 
                                        @elseif($document->allowed_types === 'image')
                                            accept="image/jpeg,image/png,image/jpg,image/gif,image/svg"
                                        @endif
                                        @if($document->is_required)
                                            required
                                        @endif
                                    >
                                </div>
                            </div>
        
                            @if($document->require_expiry)
                            <div class="col-md-6">
                                <label for="expiry_{{ $document->id }}_{{ $shareholder->id }}" class="form-label">
                                    <strong>  Expiry for {{ $shareholder->title }}   </strong>
                                    <span class="required-asterisk">*</span></label>
                                <div class="input-group">
                                    <input 
                                        type="date" 
                                        class="form-control" 
                                        id="expiry_{{ $document->id }}_{{ $shareholder->id }}" 
                                        name="expiry_{{ $document->id }}_{{ $shareholder->id }}_{{ $shareholder->title }}" 
                                        required
                                    >
                               
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @else
                        <!-- Normal Document Fields -->
                        <div class="col-md-6">
                            <label for="document_{{ $document->id }}" class="form-label">
                                <strong> {{ $document->title }}</strong>
                                @if($document->is_required)
                                    (Required)<span class="required-asterisk">*</span> 
                                @endif
                            </label>
                            <div class="input-group">
                                <input 
                                    type="file" 
                                    class="form-control" 
                                    id="document_{{ $document->id }}" 
                                    name="document_{{ $document->id }}" 
                                    @if($document->allowed_types === 'documents')
                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.txt" 
                                    @elseif($document->allowed_types === 'image')
                                        accept="image/jpeg,image/png,image/jpg,image/gif,image/svg"
                                    @endif
                                    @if($document->is_required)
                                        required
                                    @endif
                                >
                             
                            </div>
                        </div>
        
                        @if($document->require_expiry)
                        <div class="col-md-6">
                            <label for="expiry_{{ $document->id }}" class="form-label">Expiry <span class="required-asterisk">*</span></label>
                            <div class="input-group">
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="expiry_{{ $document->id }}" 
                                    name="expiry_{{ $document->id }}" 
                                    required
                                >
                           
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
            @endforeach
        
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save Documents Data</button>
            </div>
        </div>
        
        
    </form>
</div>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set the minimum date to today
        let today = new Date().toISOString().split('T')[0]; // Get today's date in 'YYYY-MM-DD' format
        document.querySelectorAll('input[type="date"]').forEach(function(dateInput) {
            dateInput.setAttribute('min', today); // Set the min attribute dynamically to today's date
        });
    });
</script>