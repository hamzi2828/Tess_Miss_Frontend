<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

use App\Services\DocumentsService;



class DocumentsController extends Controller
{
    public function __construct(DocumentsService $documentsService)
    {
        $this->documentsService = $documentsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all documents from the database
        $documents = Document::all();
    
        // Pass the documents to the view
        return view('pages.documents.documents-list', compact('documents'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'documentTitle' => 'required|string|max:255',
            'is_required' => 'required|boolean',
            'require_expiry' => 'required|boolean',
            // 'allowed_types' is optional, but if present, it must be an array
            'allowed_types' => 'nullable|array',
            'allowed_types.*' => 'in:document,image', 
        ]);
        
       
             
            $this->documentsService->createDocument($validatedData);


        // Redirect to the documents index page with a success message
        return redirect()->route('documents.index')->with('success', 'Document created successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        // dd($request->all());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'documentTitle' => 'required|string|max:255',
            'is_required' => 'required|boolean',
            'require_expiry' => 'required|boolean',
            'allowed_types' => 'nullable|array',
            'allowed_types.*' => 'in:document,image', 
        ]);
    
        $this->documentsService->updateDocument($document, $validatedData);
    
        // Redirect to the documents index page with a success message
        return redirect()->route('documents.index')->with('success', 'Document updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        // Delete the document
        $document->delete();
    
        // Redirect back with a success message
        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
    
}
