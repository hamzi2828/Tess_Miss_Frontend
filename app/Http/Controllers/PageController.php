<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();

        return view('pages.pages.pages-list', compact('pages'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pages.create-page');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the incoming request
        $validated = $request->validate([
            'pageName' => 'required|string|max:255|unique:pages,name',
            'pageSlug' => 'nullable|string|max:255|unique:pages,slug',
            'pageDescription' => 'required|string',
            'pageStatus' => 'required|in:active,inactive',
        ]);



        // Generate slug if not provided
        $slug = $validated['pageSlug'] ?? \Str::slug($validated['pageName'], '-');

        // Create the page
        $page = Page::create([
            'name' => $validated['pageName'],
            'slug' => $slug,
            'description' => $validated['pageDescription'],
            'status' => $validated['pageStatus'],
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('pages.index')->with('success', 'Page created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Fetch the page by slug
        $page = Page::where('slug', $slug)->firstOrFail();

        // Return the page details (you can pass this to a view later)
        return view('pages.pages.show-page', compact('page'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $page = Page::find($request->page_id);
        return view('pages.pages.edit-page', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        // Validate the input
        $validated = $request->validate([
            'pageName' => 'required|string|max:255|unique:pages,name,' . $page->id,
            'pageSlug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'pageDescription' => 'required|string',
            'pageStatus' => 'required|in:active,inactive',
        ]);

        // Update the page with validated data
        $page->update([
            'name' => $validated['pageName'],
            'slug' => $validated['pageSlug'],
            'description' => $validated['pageDescription'],
            'status' => $validated['pageStatus'],
        ]);

        // Redirect with success message
        return redirect()->route('pages.index')->with('success', 'Page updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        try {
            // Delete the page
            $page->delete();

            // Redirect with success message
            return redirect()->route('pages.index')->with('success', 'Page deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Failed to delete the page. Please try again.');
        }
    }

}
