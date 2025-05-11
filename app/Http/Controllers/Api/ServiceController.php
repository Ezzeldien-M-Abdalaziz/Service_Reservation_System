<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function services()
    {

        $services = Service::select('id', 'name', 'description', 'price', 'available', 'rating')->paginate();
        return response()->json($services , 200);
    }

    public function service($id)
    {
        // Fetch a specific service by ID from the database
        $service = Service::findOrFail($id);
        return response()->json($service , 200);
    }

    public function storeService(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:services|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'available' => 'nullable|integer',
        ],[
            'name.required' => 'Service name is required',
            'name.unique' => 'Service name must be unique',
            'description.required' => 'Service description is required',
            'price.required' => 'Service price is required',
        ]);

        $service = Service::create($validatedData);

        return response()->json($service, 201);
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'available' => 'nullable|integer',
        ],[
            'name.required' => 'Service name is required',
            'description.required' => 'Service description is required',
            'price.required' => 'Service price is required',
        ]);

        $service = Service::findOrFail($id);

        $service->update($validatedData);

        return response()->json($service , 200);
    }

    public function deleteService($id)
    {

        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json(['message' => 'Service deleted successfully'] , 200);
    }
}
