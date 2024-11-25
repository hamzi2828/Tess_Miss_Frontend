<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MerchantCategory;
use App\Services\MerchantCategoriesService;

class MerchantCategoriesController extends Controller
{
    protected $merchantCategoriesService;

    public function __construct(MerchantCategoriesService $merchantCategoriesService)
    {
        $this->merchantCategoriesService = $merchantCategoriesService;
    }

    /**
     * Display a listing of the merchant categories.
     */
    public function index()
    {
        // Retrieve all categories via the service
        $categories = $this->merchantCategoriesService->getAll();

        // Pass the categories data to the view
        return view('pages.merchantCategories.merchantCategories-list', compact('categories'));
    }

    /**
     * Store a newly created merchant category.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'categoryName' => 'required|string|max:255',
            'parentCategory' => 'nullable|exists:merchant_categories,id',
            'categoryFields' => 'nullable|array',
            'categoryFields.*' => 'string|max:255',
        ]);

        // Store the new category via the service
        $this->merchantCategoriesService->store($validatedData);

        // Redirect with a success message
        return redirect()->route('merchant-categories.index')->with('success', 'Merchant Category created successfully.');
    }

    /**
     * Update the specified merchant category.
     */
    public function update(Request $request, MerchantCategory $merchantCategory)
    {
        try {
            $validatedData = $request->validate([
                'categoryName' => 'required|string|max:255',
                'parentCategory' => 'nullable|exists:merchant_categories,id',
            ]);
    
            // Update the category via the service
            $this->merchantCategoriesService->update($merchantCategory, $validatedData);
    
            // Redirect with a success message
            return redirect()->route('merchant-categories.index')->with('success', 'Merchant Category updated successfully.');
    
        } catch (\Exception $e) {
            // Catch the exception and redirect back with an error message
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
    

    /**
     * Remove the specified merchant category.
     */
    public function destroy(MerchantCategory $merchantCategory)
    {
        try {
            // Delete the category via the service
            $this->merchantCategoriesService->destroy($merchantCategory);

            // Redirect back to the merchant categories list with a success message
            return redirect()->route('merchant-categories.index')->with('success', 'Merchant Category deleted successfully.');
        } catch (\Exception $e) {
            // Handle potential errors and return an error message
            return redirect()->route('merchant-categories.index')->with('error', 'An error occurred while trying to delete the Merchant Category.');
        }
    }
}
