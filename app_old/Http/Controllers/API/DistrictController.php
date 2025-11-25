<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::with('division')->get();
        return response()->json([
            'error' => false,
            'msg' => 'Districts retrieved successfully',
            'data' => $districts
        ]);
    }

    public function show($id)
    {
        $district = District::with('division')->find($id);
        
        if (!$district) {
            return response()->json([
                'error' => true,
                'msg' => 'District not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'District retrieved successfully',
            'data' => $district
        ]);
    }
    
    public function upazilas($id)
    {
        $district = District::with('upazilas')->find($id);
        
        if (!$district) {
            return response()->json([
                'error' => true,
                'msg' => 'District not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'Upazilas retrieved successfully',
            'data' => $district->upazilas
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string',
            'bn_name' => 'nullable|string',
            'lat' => 'nullable|string',
            'lon' => 'nullable|string',
            'url' => 'nullable|string'
        ]);
        
        $district = District::create($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'District created successfully',
            'data' => $district
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $district = District::find($id);
        
        if (!$district) {
            return response()->json([
                'error' => true,
                'msg' => 'District not found'
            ], 404);
        }
        
        $validated = $request->validate([
            'division_id' => 'sometimes|required|exists:divisions,id',
            'name' => 'sometimes|required|string',
            'bn_name' => 'nullable|string',
            'lat' => 'nullable|string',
            'lon' => 'nullable|string',
            'url' => 'nullable|string'
        ]);
        
        $district->update($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'District updated successfully',
            'data' => $district
        ]);
    }

    public function destroy($id)
    {
        $district = District::find($id);
        
        if (!$district) {
            return response()->json([
                'error' => true,
                'msg' => 'District not found'
            ], 404);
        }
        
        $district->delete();
        
        return response()->json([
            'error' => false,
            'msg' => 'District deleted successfully'
        ]);
    }
}
