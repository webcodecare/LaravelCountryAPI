<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::all();
        return response()->json([
            'error' => false,
            'msg' => 'Divisions retrieved successfully',
            'data' => $divisions
        ]);
    }

    public function show($id)
    {
        $division = Division::find($id);
        
        if (!$division) {
            return response()->json([
                'error' => true,
                'msg' => 'Division not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'Division retrieved successfully',
            'data' => $division
        ]);
    }
    
    public function districts($id)
    {
        $division = Division::with('districts')->find($id);
        
        if (!$division) {
            return response()->json([
                'error' => true,
                'msg' => 'Division not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'Districts retrieved successfully',
            'data' => $division->districts
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'bn_name' => 'nullable|string',
            'url' => 'nullable|string'
        ]);
        
        $division = Division::create($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'Division created successfully',
            'data' => $division
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $division = Division::find($id);
        
        if (!$division) {
            return response()->json([
                'error' => true,
                'msg' => 'Division not found'
            ], 404);
        }
        
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'bn_name' => 'nullable|string',
            'url' => 'nullable|string'
        ]);
        
        $division->update($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'Division updated successfully',
            'data' => $division
        ]);
    }

    public function destroy($id)
    {
        $division = Division::find($id);
        
        if (!$division) {
            return response()->json([
                'error' => true,
                'msg' => 'Division not found'
            ], 404);
        }
        
        $division->delete();
        
        return response()->json([
            'error' => false,
            'msg' => 'Division deleted successfully'
        ]);
    }
}
