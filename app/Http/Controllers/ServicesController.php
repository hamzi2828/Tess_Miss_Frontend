<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\ServicesService;

class ServicesController extends Controller
{
    protected $serviceService;

    public function __construct(ServicesService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all services using service layer
        $services = $this->serviceService->getAllServices();

        // Pass the services to the view
        return view('pages.services.services-list', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'serviceName' => 'required|string|max:255',
            'serviceFields' => 'nullable|array',
            'serviceFields.*' => 'nullable|string|max:255',
        ]);

        // Store the service using service layer
        $this->serviceService->createService($validatedData);

        // Redirect to the services index page with a success message
        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'serviceName' => 'required|string|max:255',
            'serviceFields' => 'nullable|array',
            'serviceFields.*' => 'string|max:255',
        ]);

        // Update the service using service layer
        $this->serviceService->updateService($service, $validatedData);

        // Redirect back to the service list page with a success message
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            // Delete the service using service layer
            $this->serviceService->deleteService($service);

            // Redirect with success message
            return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            // Handle errors and return with an error message
            return redirect()->route('services.index')->with('error', 'An error occurred while trying to delete the service.');
        }
    }
}
