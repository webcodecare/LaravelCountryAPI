<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('country')->get();
        return response()->json([
            'error' => false,
            'msg' => 'Cities retrieved successfully',
            'data' => $cities
        ]);
    }

    public function show($id)
    {
        $city = City::with('country')->find($id);
        
        if (!$city) {
            return response()->json([
                'error' => true,
                'msg' => 'City not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'City retrieved successfully',
            'data' => $city
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string'
        ]);
        
        $city = City::create($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'City created successfully',
            'data' => $city
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $city = City::find($id);
        
        if (!$city) {
            return response()->json([
                'error' => true,
                'msg' => 'City not found'
            ], 404);
        }
        
        $validated = $request->validate([
            'country_id' => 'sometimes|required|exists:countries,id',
            'name' => 'sometimes|required|string'
        ]);
        
        $city->update($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'City updated successfully',
            'data' => $city
        ]);
    }

    public function destroy($id)
    {
        $city = City::find($id);
        
        if (!$city) {
            return response()->json([
                'error' => true,
                'msg' => 'City not found'
            ], 404);
        }
        
        $city->delete();
        
        return response()->json([
            'error' => false,
            'msg' => 'City deleted successfully'
        ]);
    }
}
