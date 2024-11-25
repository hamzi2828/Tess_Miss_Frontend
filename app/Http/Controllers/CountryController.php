<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all countries from the database
        $countries = Country::all();

        // Pass the countries to the view
        return view('pages.countries.countries-list', compact('countries'));
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
            'countryCode' => 'required|string|max:5|unique:countries,country_code',
            'countryName' => 'required|string|max:255',
            'countryStatus' => 'required|string|max:255',
        ]);
    
        // Create a new country record in the database
        $country = Country::create([
            'country_code' => $validatedData['countryCode'],
            'country_name' => $validatedData['countryName'],
            'country_status' => $validatedData['countryStatus'],
        ]);
    
        // Redirect back to the countries list with a success message
        return redirect()->route('countries.index')->with('success', 'Country added successfully.');
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
    public function update(Request $request, Country $country)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'countryCode' => 'required|string|max:255', // Country Code is required and must be a string
            'countryName' => 'required|string|max:255', // Country Name is required and must be a string
            'countryStatus' => 'required|string|max:255', // Country Status is required and must be a string
        ]);
    
        try {
            // Update the country record with the validated data
            $country->update([
                'country_code' => $validatedData['countryCode'],
                'country_name' => $validatedData['countryName'],
                'country_status' => $validatedData['countryStatus'],
            ]);
    
            // Redirect back to the country list with a success message
            return redirect()->route('countries.index')->with('success', 'Country updated successfully.');
    
        } catch (\Exception $e) {
            // Handle any errors, such as database issues, and return an error message
            return redirect()->route('countries.index')->with('error', 'An error occurred while updating the country.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        try {
            // Attempt to delete the country record
            $country->delete();

            // Redirect back to the country list with a success message
            return redirect()->route('countries.index')->with('success', 'Country deleted successfully.');

        } catch (\Exception $e) {
            // Handle any potential errors, such as foreign key constraints, and return an error message
            return redirect()->route('countries.index')->with('error', 'An error occurred while trying to delete the country.');
        }
    }

}
