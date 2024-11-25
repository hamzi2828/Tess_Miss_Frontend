<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditDocument" aria-labelledby="offcanvasEditDocumentLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasEditDocumentLabel" class="offcanvas-title">Edit Document</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="editDocumentForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Document Title -->
            <div class="mb-6">
                <label class="form-label" for="edit-document-title">Document Title</label>
                <input type="text" class="form-control" id="edit-document-title" name="documentTitle" required />
            </div>

            <!-- Is Required Field -->
            <div class="mb-6">
                <label class="form-label" for="edit-document-required">Is Required?</label>
                <select id="edit-document-required" class="form-select" name="is_required" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <!-- Require Expiry Date Field -->
            <div class="mb-6">
                <label class="form-label" for="edit-document-expiry">Require Expiry Date?</label>
                <select id="edit-document-expiry" class="form-select" name="require_expiry" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <!-- Allowed Types Checkbox -->
            <div class="mb-6">
                <label class="form-label" for="edit-document-types">Allowed Types</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="document" id="edit-allowed-type-document" name="allowed_types[]">
                    <label class="form-check-label" for="edit-allowed-type-document">
                        Document
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="image" id="edit-allowed-type-image" name="allowed_types[]">
                    <label class="form-check-label" for="edit-allowed-type-image">
                        Image
                    </label>
                </div>
            </div>

            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3">Update</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Handle Edit Button Click
      document.querySelectorAll('.edit-document-btn').forEach(function(button) {
          button.addEventListener('click', function() {
              const documentID = this.getAttribute('data-id');
              const documentTitle = this.getAttribute('data-title');
              const isRequired = this.getAttribute('data-is_required');
              const requireExpiry = this.getAttribute('data-require_expiry');
              const allowedTypes = this.getAttribute('data-allowed_types').split(',');

              // Set form action for updating the document
              document.getElementById('editDocumentForm').action = '/documents/' + documentID;

              // Populate fields in the modal with document data
              document.getElementById('edit-document-title').value = documentTitle;
              document.getElementById('edit-document-required').value = isRequired;
              document.getElementById('edit-document-expiry').value = requireExpiry;

              // Populate allowed types checkboxes
              document.getElementById('edit-allowed-type-document').checked = allowedTypes.includes('document');
              document.getElementById('edit-allowed-type-image').checked = allowedTypes.includes('image');
          });
      });
    });
</script>
