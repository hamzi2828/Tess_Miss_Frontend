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
                    
                    @php
                    if ($document['previous_doc_id']) {
                            continue;
                        }
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
                        // Check if the document is expired
                        $isExpired = $document['date_expiry'] && now()->greaterThan($document['date_expiry']);
                        $replacedDocument = \App\Models\MerchantDocument::where('previous_doc_id', $document['id'])->first();
                    @endphp
    

                    <div class="col-md-6">
                        <label for="document_{{ $document['id'] }}" class="form-label">

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
                                @if($isExpired) disabled  @endif
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
                    @if($matchingDocument && $matchingDocument->require_expiry )
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
                                    @if($isExpired) readonly @endif
                                >
                            </div>
                        </div>
                    @endif

                    @if($isExpired && $replacedDocument)
                        {{-- Replacement Document Inputs --}}
                        <div class="col-md-6">
                            <div class="input-group">
                                {{-- File Input for Replacement --}}
                                <input 
                                    type="file" 
                                    class="form-control" 
                                    id="update_replace_document_{{ $replacedDocument->id }}_of_{{ $document['id'] }}" 
                                    name="update_replace_document_{{ $replacedDocument->id }}_of_{{ $document['id'] }}" 
                                    @if(Str::contains($replacedDocument->document_type, 'image'))
                                        accept="image/jpeg,image/png,image/jpg,image/gif,image/svg"
                                    @else
                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.txt"
                                    @endif
                                >
                                {{-- Hidden Input for Existing Replacement Document --}}
                                @if(!empty($replacedDocument->document))
                                    <input type="hidden" name="existing_replace_document_{{ $replacedDocument->id }}" value="{{ $replacedDocument->document }}">
                                @endif
                    
                                {{-- Link to View Replacement Document --}}
                                <a href="{{ asset($replacedDocument->document) }}" target="_blank" class="input-group-text">
                                    <i class="tf-icons ti ti-file"></i> 
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- Date Input for Replacement Expiry --}}
                            <div class="input-group mt-1">
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="replace_expiry_{{ $replacedDocument->id }}" 
                                    name="replace_expiry_{{ $replacedDocument->id }}" 
                                    value="{{ $replacedDocument->date_expiry }}"
                                >
                            </div>
                        </div>
                  @endif
                

                    {{--  Add a new input field for replacing expired documents --}}
                    @if($isExpired && !$replacedDocument)
                        <div class="col-md-6">
                            <label for="replace_document_{{ $document['id'] }}" class="form-label">
                                Replace Expired Document<span class="required-asterisk">*</span>
                            </label>
                            <div class="input-group">
                                <input 
                                    type="file" 
                                    class="form-control" 
                                    id="replace_document_{{ $document['id'] }}" 
                                    name="replace_document_{{ $document['id'] }}" 
                                    accept=".pdf,.doc,.docx,.jpeg,.jpg,.png"
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="replace_expiry_{{ $document['id'] }}" class="form-label">
                                Expiry Date for Replacement<span class="required-asterisk">*</span>
                            </label>
                            <div class="input-group">
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="replace_expiry_{{ $document['id'] }}" 
                                    name="replace_expiry_{{ $document['id'] }}"
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