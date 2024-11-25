<!-- Create Merchant Category Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddCategory" aria-labelledby="offcanvasAddCategoryLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddCategoryLabel" class="offcanvas-title">Add Merchant Category</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="addNewCategoryForm" method="POST" action="{{ route('merchant-categories.store') }}">
            @csrf
            <!-- Category Name Field -->
            <div class="mb-6">
                <label class="form-label" for="add-category-name">Category Name</label>
                <input type="text" class="form-control" id="add-category-name" name="categoryName" required />
            </div>

            <!-- Parent Category Dropdown -->
            <div class="mb-6">
                <label class="form-label" for="add-parent-category">Parent Category</label>
                <select id="add-parent-category" class="form-select select2" name="parentCategory">
                    <option value="">Select Parent Category (optional)</option>
                    @foreach($categories as $category) <!-- Assuming categories are passed from controller -->
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>



            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>


