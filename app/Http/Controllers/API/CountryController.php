<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return response()->json([
            'error' => false,
            'msg' => 'Countries retrieved successfully',
            'data' => $countries
        ]);
    }

    public function show($id)
    {
        $country = Country::find($id);
        
        if (!$country) {
            return response()->json([
                'error' => true,
                'msg' => 'Country not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'Country retrieved successfully',
            'data' => $country
        ]);
    }
    
    public function states($id)
    {
        $country = Country::with('states')->find($id);
        
        if (!$country) {
            return response()->json([
                'error' => true,
                'msg' => 'Country not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'States retrieved successfully',
            'data' => $country->states
        ]);
    }
    
    public function cities($id)
    {
        $country = Country::with('cities')->find($id);
        
        if (!$country) {
            return response()->json([
                'error' => true,
                'msg' => 'Country not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'Cities retrieved successfully',
            'data' => $country->cities
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'nullable|string',
            'iso3' => 'nullable|string',
            'dial_code' => 'nullable|string'
        ]);
        
        $country = Country::create($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'Country created successfully',
            'data' => $country
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        
        if (!$country) {
            return response()->json([
                'error' => true,
                'msg' => 'Country not found'
            ], 404);
        }
        
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'code' => 'nullable|string',
            'iso3' => 'nullable|string',
            'dial_code' => 'nullable|string'
        ]);
        
        $country->update($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'Country updated successfully',
            'data' => $country
        ]);
    }

    public function destroy($id)
    {
        $country = Country::find($id);
        
        if (!$country) {
            return response()->json([
                'error' => true,
                'msg' => 'Country not found'
            ], 404);
        }
        
        $country->delete();
        
        return response()->json([
            'error' => false,
            'msg' => 'Country deleted successfully'
        ]);
    }
}
