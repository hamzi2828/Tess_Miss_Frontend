<?php

namespace App\Services;

use App\Models\MerchantCategory;

class MerchantCategoriesService
{
    /**
     * Retrieve all merchant categories with their parent category and added-by user.
     */
    public function getAll()
    {
        return MerchantCategory::with('parentCategory', 'addedBy')->get();
    }

    /**
     * Store a newly created merchant category.
     */
    public function store($data)
    {
        $categoryData = [
            'title' => $data['categoryName'],
            'parent_id' => $data['parentCategory'] ?? null, // Use null if no parent category is selected
            'fields' => json_encode($data['categoryFields'] ?? []), // Convert categoryFields to JSON
            'added_by' => Auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        return MerchantCategory::create($categoryData);
    }

    /**
     * Update the specified merchant category.
     */
    public function update(MerchantCategory $merchantCategory, $data)
    {
       
        $isAlreadyParent = MerchantCategory::where('parent_id', $merchantCategory->id)->exists();

        if ($merchantCategory->id == $data['parentCategory']) {
            throw new \Exception("A category cannot be assigned as its own parent.");
        }
        if ($isAlreadyParent && isset($data['parentCategory'])) {
          
            throw new \Exception("This category is already a parent of other categories and cannot have a parent.");
        }
    
       
        $merchantCategory->update([
            'title' => $data['categoryName'],
            'parent_id' => $data['parentCategory'] ?? null,
        ]);
    }
    
    /**
     * Delete the specified merchant category.
     */
    public function destroy(MerchantCategory $merchantCategory)
    {
        return $merchantCategory->delete();
    }
}
