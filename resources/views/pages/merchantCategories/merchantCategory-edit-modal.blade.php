<!-- Edit Merchant Category Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditCategory" aria-labelledby="offcanvasEditCategoryLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasEditCategoryLabel" class="offcanvas-title">Edit Merchant Category</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="editCategoryForm" method="POST" action="">
            @csrf
            @method('PUT') <!-- Specify that this is an update request -->

            <!-- Category Name Field -->
            <div class="mb-6">
                <label class="form-label" for="edit-category-name">Category Name</label>
                <input type="text" class="form-control" id="edit-category-name" name="categoryName" required />
            </div>

            <!-- Parent Category Dropdown -->
            <div class="mb-6">
                <label class="form-label" for="edit-parent-category">Parent Category</label>
                <select id="edit-parent-category" class="form-select select2" name="parentCategory">
                    <option value="">Select Parent Category (optional)</option>
                    @foreach($categories->where('parent_id', null) as $category) <!-- Filter categories with parent_id = null -->
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            

            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3 data-submit">Update</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.edit-category-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const categoryID = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-title');
                const parentCategory = this.getAttribute('data-parent');

                // Set form action for updating the category
                document.getElementById('editCategoryForm').action = `/merchant-categories/${categoryID}`;

                // Set the category name in the input
                document.getElementById('edit-category-name').value = categoryName;

                // Set the parent category dropdown value
                const parentSelect = document.getElementById('edit-parent-category');
                parentSelect.value = parentCategory ? parentCategory : '';

                // Open the modal
                new bootstrap.Offcanvas(document.getElementById('offcanvasEditCategory')).show();
            });
        });
    });
</script>
