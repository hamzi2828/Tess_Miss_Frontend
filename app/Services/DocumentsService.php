<?php
namespace App\Services;

use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentsService
{
    /**
     * Create a new document.
     *
     * @param array $data
     * @return Document
     */
    public function createDocument(array $data)
    {
        // Convert allowed_types array to a comma-separated string
        $allowedTypesString = isset($data['allowed_types']) ? implode(',', $data['allowed_types']) : 'None';

        // Create the document
        return Document::create([
            'title' => $data['documentTitle'],
            'is_required' => $data['is_required'],
            'require_expiry' => $data['require_expiry'],
            'allowed_types' => $allowedTypesString,
            'added_by' => auth()->user()->id, 
            'status' => 'active',
        ]);
    }

    /**
     * Update an existing document.
     *
     * @param Document $document
     * @param array $data
     * @return bool
     */
    public function updateDocument(Document $document, array $data)
    {
        // dd($data);
        // Convert allowed_types array to a comma-separated string
        $allowedTypesString = isset($data['allowed_types']) ? implode(',', $data['allowed_types']) : 'None';

        // Update the document
        return $document->update([
            'title' => $data['documentTitle'],
            'is_required' => $data['is_required'],
            'require_expiry' => $data['require_expiry'],
            'allowed_types' => $allowedTypesString,
        ]);
    }

    /**
     * Delete a document.
     *
     * @param Document $document
     * @return bool|null
     * @throws \Exception
     */
    public function deleteDocument(Document $document)
    {
        // You could add additional logic here, like deleting files related to the document if needed.
        return $document->delete();
    }

    /**
     * Retrieve a document by ID.
     *
     * @param int $id
     * @return Document|null
     */
    public function getDocumentById($id)
    {
        return Document::find($id);
    }
}
