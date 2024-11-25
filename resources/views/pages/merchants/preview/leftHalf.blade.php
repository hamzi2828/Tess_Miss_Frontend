   {{-- lefthalh --}}
    <div class="card text-left">
        <div class="card-header">
            <h5 class="mb-0 basic-details-header">Merchant Information</h5>
        
            @if($merchant_details->documents->isNotEmpty())
                <div class="form-section box-container">
                    <!-- Loop through valid documents -->
                    @foreach($merchant_details['documents'] as $document)
                        @php
                            $documentExpired = false;
        
                            // Check if the document is expired
                            if (!empty($document['date_expiry'])) {
                                $expiryDate = \Carbon\Carbon::parse($document['date_expiry']);
                                $documentExpired = $expiryDate->isPast();
                            }
        
                            // Extract and format the document title
                            $titleParts = explode('_', $document['title']);
                            $documentId = $titleParts[0];
                            $secondWord = $titleParts[1] ?? null;
                            $matchingDocument = $all_documents->firstWhere('id', (int)$documentId);
                            $title = $matchingDocument ? $matchingDocument->title : 'Document';
        
                            if ($matchingDocument && $matchingDocument->title === 'QID' && $secondWord) {
                                $title .= " for " . $secondWord;
                            }
                        @endphp
        
                        <!-- Display non-expired documents with the title "Logo" -->
                        @if(!$documentExpired && $title === 'Logo')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    @if(!empty($document['document']))
                                        <!-- Display the document as an image -->
                                        <img 
                                            src="{{ asset($document['document']) }}" 
                                            alt="Logo Document" 
                                            class="img-fluid rounded"
                                        />
                                    @else
                                        <p class="text-muted">No file available</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        
        
            <div class="card-body">
                <h5 class="card-title">{{ $merchant_details->merchant_name ?? 'N/A' }}</h5>
                <p class="text-muted">{{ $merchant_details->merchant_name_ar ?? 'N/A' }}</p>
                <hr>
                <p><strong>Merchant ID:</strong> {{ $merchant_details->merchant_id ?? 'N/A' }}</p>
                <p><strong>Terminal ID:</strong> {{ $merchant_details->terminal_id ?? 'N/A' }}</p>
                <p><strong>Commercial Registration #:</strong> {{ $merchant_details->comm_reg_no ?? 'N/A' }}</p>
                <p><strong>Parent Category:</strong> {{ $merchant_details->parent_category ?? 'No Category Found' }}</p>
                <p>
                    <strong>Service Category:</strong>
                    @php
                        $activity = $MerchantCategory->where('id', $merchant_details['merchant_category'])->first();
                    @endphp
                    {{ $activity ? $activity->title : 'N/A' }}
                </p>
                </div>
                <div class="card-footer">
                    <h5 class="w-100 mb-3 basic-details-header">Merchant Documents</h5>

                    
                @if($merchant_details->documents->isNotEmpty())
                    <div class="form-section box-container">
                        <!-- Section for Valid Documents -->
                        @foreach($merchant_details['documents'] as $document)
                            @php
                                $documentExpired = false;

                                if (isset($document['date_expiry'])) {
                                    $expiryDate = \Carbon\Carbon::parse($document['date_expiry']);
                                    $documentExpired = $expiryDate->isPast();
                                }
                            @endphp

                            @if(!$documentExpired) <!-- Only display non-expired documents -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            @php
                                                $titleParts = explode('_', $document['title']); 
                                                $documentId = $titleParts[0]; 
                                                $secondWord = $titleParts[1] ?? null; 
                                                $matchingDocument = $all_documents->firstWhere('id', (int)$documentId);
                                                $title = $matchingDocument ? $matchingDocument->title : 'Document';

                                                if ($matchingDocument && $matchingDocument->title === 'QID' && $secondWord) {
                                                    $title .= " for " . $secondWord;
                                                }
                                            @endphp
                                            <strong>{{ $title }}</strong>
                                        </label>
                                        <div class="input-group">
                                            @if(!empty($document['document']))
                                                <!-- Display a clickable button with an icon -->
                                                <a href="{{ asset($document['document']) }}" target="_blank" class="btn btn-outline-secondary">
                                                    <i class="tf-icons ti ti-file"></i> View 
                                                </a>
                                            @else
                                                <p class="text-muted">No file available</p>
                                            @endif
                                        </div>
                                    </div>

                                    @if($matchingDocument && $matchingDocument->require_expiry)
                                    <div class="col-md-6 mt-5">

                                    <p><strong>Expiry Date:</strong> 
                                    {{ $document['date_expiry'] ? \Carbon\Carbon::parse($document['date_expiry'])->format('Y-m-d') : 'N/A' }}
                                    </p> 
                                    </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                        <!-- Section for Expired Documents -->
                        <h4 class="mt-4 mb-3 ">Expired Documents</h4>
                        @foreach($merchant_details['documents'] as $document)
                            @php
                                $documentExpired = isset($document['date_expiry']) && \Carbon\Carbon::parse($document['date_expiry'])->isPast();
                            @endphp

                            @if($documentExpired) 
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <strong>{{ $matchingDocument->title ?? 'Document' }}</strong>
                                    </label>
                                    <div class="input-group">
                                        @if(!empty($document['document']))
                                            <a href="{{ asset($document['document']) }}" target="_blank" class="btn btn-outline-secondary">
                                                <i class="tf-icons ti ti-file"></i> View
                                            </a>
                                        @else
                                            <p class="text-muted">No file available</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 mt-5">

                                    <p><strong>Expiry Date:</strong> 
                                    {{ $document['date_expiry'] ? \Carbon\Carbon::parse($document['date_expiry'])->format('Y-m-d') : 'N/A' }}
                                    </p> 
                                    </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                @endif
                {{-- <button class="btn btn-secondary w-100">Merchant Previous Documents</button> --}}

                 {{-- <div class="mt-4">
                    <h5 class="w-100 mb-3 basic-details-header">Additional Notes:</h5>

                    <textarea id="additionalNotes" class="form-control" rows="4" placeholder="Enter any additional notes here..."></textarea>
                </div> --}}
            </div>
        

    </div>