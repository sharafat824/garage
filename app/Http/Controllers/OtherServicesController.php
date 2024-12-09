<?php

namespace App\Http\Controllers;

use App\Setting;
use App\OtherServices;
use Illuminate\Http\Request;

class OtherServicesController extends Controller
{
    public function servicelist()
    {
        $services  = OtherServices::get();

        return view('other_services.list', compact('services'));
    }


    public function add()
    {
        return view('other_services.add');
    }

    public function view(Request $request)
    {
        // Retrieve service details based on the service ID
        $service = OtherServices::find($request->id);

        $logo = Setting::first();

        // Return the service details view, passing the service data
        return view('other_services.modal_view', compact('service', 'logo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'cylinder' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        OtherServices::create($validated);

        return redirect('other/service/list')->with('message', 'Service added successfully!');
    }


    public function destory($id)
    {
        // Find the service by its ID
        $service = OtherServices::findOrFail($id);
    
        // Delete the service
        $service->delete();
    
        // Redirect back with a success message
        return redirect('other/service/list')->with('message', 'Service deleted successfully.');
    }
    public function destroyMultiple() {}
    public function serviceedit($id)
    {
        $service = OtherServices::find($id);

        return view('other_services.edit', compact('service'));
    }
    public function serviceupdate(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'cylinder' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Find the service by its ID
        $service = OtherServices::findOrFail($id);

        // Update the service's attributes with the validated data
        $service->name = $validated['name'];
        $service->short_description = $validated['short_description'];
        $service->cylinder = $validated['cylinder'];
        $service->price = $validated['price'];

        // Save the changes to the database
        $service->save();

        // Redirect back with a success message
        return redirect('other/service/list')->with('message', 'Service updated successfully.');
    }

    public function getPrice(Request $request)
    {
        // Get the product ID from the request
        $productId = $request->input('id');
        
        // Find the product based on the ID
        $product = OtherServices::find($productId);
    
        // Check if the product exists
        if ($product) {
            // Return the price as a response
            return response()->json([
                'success' => true,
                'price' => $product->price,
                'short_description' => $product->short_description,
                'cylinder' => $product->cylinder
            ]);
        } else {
            // Return an error response if the product is not found
            return response()->json([
                'success' => false,
                'message' => 'Product not found.',
            ]);
        }
    }
    
}
