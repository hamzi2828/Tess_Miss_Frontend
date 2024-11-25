<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddDocument" aria-labelledby="offcanvasAddDocumentLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddDocumentLabel" class="offcanvas-title">Add Document</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="addNewDocumentForm" method="POST" action="{{ route('documents.store') }}">
            @csrf

            <!-- Document Title Field -->
            <div class="mb-6">
                <label class="form-label" for="add-document-title">Document Title</label>
                <input type="text" class="form-control" id="add-document-title" placeholder="Enter document title" name="documentTitle" aria-label="Document Title" required />
            </div>

            <!-- Is Required Field -->
            <div class="mb-6">
                <label class="form-label" for="add-document-required">Is Required?</label>
                <select id="add-document-required" class="form-select" name="is_required" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <!-- Required Expiry Date Field -->
            <div class="mb-6">
                <label class="form-label" for="add-document-expiry">Require Expiry Date?</label>
                <select id="add-document-expiry" class="form-select" name="require_expiry" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <!-- Allowed Types Field with Checkboxes -->
            <div class="mb-6">
                <label class="form-label" for="add-document-types">Allowed Types</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="document" id="allowed-type-document" name="allowed_types[]">
                    <label class="form-check-label" for="allowed-type-document">
                        Document
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="image" id="allowed-type-image" name="allowed_types[]">
                    <label class="form-check-label" for="allowed-type-image">
                        Image
                    </label>
                </div>
            </div>


            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>
