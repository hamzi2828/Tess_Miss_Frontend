<div class="form-section box-container">
    <!-- Document Fields -->
    <h4 class="mb-3">Documents</h4>

    <!-- Section for Valid Documents -->
    @foreach($merchant_details['documents'] as $document)
        @php
            $documentExpired = false;

            if (isset($document['date_expiry'])) {
                $expiryDate = \Carbon\Carbon::parse($document['date_expiry']);
                $documentExpired = $expiryDate->isPast();
            }
        @endphp

        @if(!$documentExpired) <!-- Only display non-expired documents here -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="document_{{ $document['id'] }}" class="form-label">
                        @php
                            $titleParts = explode('_', $document['title']); 
                            $documentId = $titleParts[0]; 
                            $secondWord = $titleParts[1] ?? null; 
                            $matchingDocument = $all_documents->firstWhere('id', (int)$documentId);
                            $inputName = "document_" . $documentId;

                            if ($matchingDocument && $matchingDocument->title === 'QID' && $secondWord) {
                                $inputName .= "_{$secondWord}_{$document['id']}";
                            } else {
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
                            disabled
                        >
                        @if(!empty($document['document']))
                            <input type="hidden" name="existing_document_{{ $document['id'] }}" value="{{ $document['document'] }}">
                        @endif

                        @if(Str::contains($document['document_type'], 'image'))
                            {{-- <a href="{{ asset('storage/' . $document['document']) }}" target="_blank" class="input-group-text"> --}}
                                <a href="{{ asset($document['document']) }}" target="_blank" class="input-group-text">
                                <i class="tf-icons ti ti-photo"></i> 
                            </a>
                        @endif
                    </div>
                </div>

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
                                disabled
                                
                            >
                        </div>
                    </div>
                @endif
            </div>
        @endif
    @endforeach

    <!-- Section for Expired Documents -->
    <h4 class="mt-4 mb-3">Expired Documents</h4>
    @foreach($merchant_details['documents'] as $document)
        @php
            $documentExpired = false;

            if (isset($document['date_expiry'])) {
                $expiryDate = \Carbon\Carbon::parse($document['date_expiry']);
                $documentExpired = $expiryDate->isPast();
            }
        @endphp

        @if($documentExpired) <!-- Only display expired documents here -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="document_{{ $document['id'] }}" class="form-label">
                        @php
                            $titleParts = explode('_', $document['title']); 
                            $documentId = $titleParts[0]; 
                            $secondWord = $titleParts[1] ?? null; 
                            $matchingDocument = $all_documents->firstWhere('id', (int)$documentId);
                            $inputName = "document_" . $documentId;

                            if ($matchingDocument && $matchingDocument->title === 'QID' && $secondWord) {
                                $inputName .= "_{$secondWord}_{$document['id']}";
                            } else {
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
                            disabled
                        >
                        @if(!empty($document['document']))
                            <input type="hidden" name="existing_document_{{ $document['id'] }}" value="{{ $document['document'] }}">
                        @endif

                        @if(Str::contains($document['document_type'], 'image'))
                            {{-- <a href="{{ asset('storage/' . $document['document']) }}" target="_blank" class="input-group-text"> --}}
                        <a href="{{ asset($document['document']) }}" target="_blank" class="input-group-text">
                            <i class="tf-icons ti ti-photo"></i> 
                        </a>
                        @endif
                    </div>
                </div>

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
                                disabled
                            >
                        </div>
                    </div>
                @endif
            </div>
        @endif
    @endforeach
</div>
