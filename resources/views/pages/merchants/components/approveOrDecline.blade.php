  {{-- Decline Modal --}}
  <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('merchants.decline', $merchant_details->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="declineModalLabel">Decline Merchant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="declineNotes" class="form-label"><strong>Reason for Declining:</strong></label>
                        <textarea id="declineNotes" name="decline_notes" class="form-control" rows="4" placeholder="Enter the reason for declining..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Back and Approve Buttons --}}
<div class="d-flex justify-content-end mt-4">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>

   

    @if(auth()->user()->role === 'supervisor' && !$allApproved)
    
        {{-- Approve Button --}}
        @if(auth()->user()->getDepartmentStage(auth()->user()->department) === 1 && !$merchant_details->approved_by)
            <form action="{{ route('merchants.approve', $merchant_details->id) }}" method="POST" class="ms-2">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check me-1"></i> Approve
                </button>
            </form>
        @endif
       
        @php
            $documents = $merchant_details->documents ?? collect(); 
            $documentsApproved = $documents->filter(fn($document) => $document->approved_by !== null); 
            $documentsDeclined = $documents->filter(fn($document) => $document->declined_by !== null); 

          // Sales Logic
            $sales = $merchant_details->sales ?? collect(); 
            $salesApproved = $sales->filter(fn($sale) => $sale->approved_by !== null); 
            $salesDeclined = $sales->filter(fn($sale) => $sale->declined_by !== null);
         // Services Logic
            $services = $merchant_details->services ?? collect(); 
            $servicesApproved = $services->filter(fn($service) => $service->approved_by !== null); 
            $servicesDeclined = $services->filter(fn($service) => $service->declined_by !== null);
        @endphp
    
     @if(auth()->user()->getDepartmentStage(auth()->user()->department) === 2 && 
        $documents->isNotEmpty() && 
        $documentsApproved->count() !== $documents->count()) 
        <form action="{{ route('merchants.approve', $merchant_details->id) }}" method="POST" class="ms-2">
            @csrf
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check me-1"></i> Approve
            </button>
        </form>
      @endif

      {{-- Approve Button for Sales --}}
    @if(auth()->user()->getDepartmentStage(auth()->user()->department) === 3 && 
    $sales->isNotEmpty() && 
    $salesApproved->count() !== $sales->count()) {{-- Check if NOT all sales are approved --}}
    <form action="{{ route('merchants.approve', $merchant_details->id) }}" method="POST" class="ms-2">
        @csrf
        <button type="submit" class="btn btn-success">
            <i class="fas fa-check me-1"></i> Approve 
        </button>
    </form>
    @endif

    {{-- Approve Button for Services --}}
    @if(auth()->user()->getDepartmentStage(auth()->user()->department) === 4 && 
    $services->isNotEmpty() && 
    $servicesApproved->count() !== $services->count()) {{-- Check if NOT all services are approved --}}
    <form action="{{ route('merchants.approve', $merchant_details->id) }}" method="POST" class="ms-2">
        @csrf
        <button type="submit" class="btn btn-success">
            <i class="fas fa-check me-1"></i> Approve 
        </button>
    </form>
    @endif
 


    {{-- Decline Button --}}
    @if(auth()->user()->getDepartmentStage(auth()->user()->department) === 1 && !$merchant_details->declined_by)
        <form class="ms-2">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#declineModal">
                <i class="fas fa-times me-1"></i> Decline
            </button>
        </form>
    @endif


    {{-- Decline Button for Documents (Stage 2) --}}
    @if(auth()->user()->getDepartmentStage(auth()->user()->department) === 2 && 
        $documents->isNotEmpty() && 
        $documents->contains(fn($document) => $document->declined_by === null))
        <form class="ms-2">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#declineModal">
                <i class="fas fa-times me-1"></i> Decline 
            </button>
        </form>
    @endif

    {{-- decline button for sales (stage 3) --}}
    @if(auth()->user()->getDepartmentStage(auth()->user()->department) === 3 && 
        $sales->isNotEmpty() && 
        $sales->contains(fn($sale) => $sale->declined_by === null))
        <form class="ms-2">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#declineModal">
                <i class="fas fa-times me-1"></i> Decline 
            </button>
        </form>
    @endif

    {{-- Decline Button for Services (Stage 4) --}}
    @if(auth()->user()->getDepartmentStage(auth()->user()->department) === 4 && 
        $services->isNotEmpty() && 
        $services->contains(fn($service) => $service->declined_by === null))
        <form class="ms-2">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#declineModal">
                <i class="fas fa-times me-1"></i> Decline 
            </button>
        </form>
    @endif


     @endif


</div>
