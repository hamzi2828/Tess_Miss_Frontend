@extends('master.master')

@section('content')

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container-xxl flex-grow-1 container-p-y">
    <form class="kyc-form" action="{{ route('update.merchants.documents',['merchant_id' => request()->merchant_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Details Section -->
        <div class="form-section box-container">

            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.edit-progressBar')

            <!-- Document Fields -->
            <h4 class="mb-3">Documents</h4>
           
            @foreach($merchant_details['documents'] as $document)
            <div class="row mb-3">


                <div class="col-md-6">
                    <label for="document_{{ $document['id'] }}" class="form-label">
                
                        @php
                            $titleParts = explode('_', $document['title']); 
                            $documentId = $titleParts[0]; 
                            $secondWord = $titleParts[1] ?? null; 
                            $matchingDocument = $all_documents->firstWhere('id', (int)$documentId);
                            // $inputName = $documentId . ($matchingDocument && $matchingDocument->title === 'QID' && $secondWord ? "_{$secondWord}" : "") . "_document_{$document['id']}";
                            $inputName = "document_" . $documentId;

                            if ($matchingDocument && $matchingDocument->title === 'QID' && $secondWord) {
                                // Append secondWord and document ID for QID
                                $inputName .= "_{$secondWord}_{$document['id']}";
                            } 
                            else {
                                $inputName .= "_{$document['id']}";
                            }

                        @endphp
                
                        @if($matchingDocument)
                            <strong>{{ $matchingDocument->title }}</strong>
                
                            @if($matchingDocument->title === 'QID' && $secondWord)
                                <strong> for <span>{{ $secondWord }}</span> </strong>
                            @endif
                
                            @if($document['status'])
                                <label for="expiry_{{ $document['id'] }}" class="form-label">
                                    (Required)<span class="required-asterisk">*</span> 
                                </label>
                            @endif
                        @endif
                    </label>
                
                    {{-- Display icon next to file input --}}
                    <div class="input-group">
                        <input 
                            type="file" 
                            class="form-control" 
                            id="{{ $inputName }}" 
                            name="{{ $inputName }}" 
                            @if(Str::contains($document['document_type'], 'image'))
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/svg"
                            @else
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.txt"
                            @endif
                        >
                        
                        {{-- Include a hidden field with the existing document path or ID --}}
                        @if(!empty($document['document']))
                            <input type="hidden" name="existing_document_{{ $document['id'] }}" value="{{ $document['document'] }}">
                        @endif
                    
                        {{-- Icon for viewing the document (image) --}}
                        @if(Str::contains($document['document_type'], 'image'))
                            {{-- <a href="{{ asset('storage/' . $document['document']) }}" target="_blank" class="input-group-text"> --}}
                                <a href="{{ asset($document['document']) }}" target="_blank" class="input-group-text">

                                <i class="tf-icons ti ti-photo"></i> 
                            </a>
                        @endif
                    </div>
                
                </div>
                

                
                    {{-- Check for individual document expiry requirement --}}
                    @if($matchingDocument && $matchingDocument->require_expiry)
                    <div class="col-md-6">
                        <label for="expiry_{{ $document['id'] }}" class="form-label">
                            Expiry Date (Required)<span class="required-asterisk">*</span> 
                        </label>
                        <div class="input-group">
                            <input 
                                type="date" 
                                class="form-control" 
                                id="expiry_{{ $document['id'] }}" 
                                name="expiry_{{ $document['id'] }}" 
                                value="{{ $document['date_expiry'] }}" 
                                required
                            >
                        </div>
                    </div>
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