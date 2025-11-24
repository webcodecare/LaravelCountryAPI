<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Upazila;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    public function index()
    {
        $upazilas = Upazila::with('district')->get();
        return response()->json([
            'error' => false,
            'msg' => 'Upazilas retrieved successfully',
            'data' => $upazilas
        ]);
    }

    public function show($id)
    {
        $upazila = Upazila::with('district')->find($id);
        
        if (!$upazila) {
            return response()->json([
                'error' => true,
                'msg' => 'Upazila not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'Upazila retrieved successfully',
            'data' => $upazila
        ]);
    }
    
    public function unions($id)
    {
        $upazila = Upazila::with('unions')->find($id);
        
        if (!$upazila) {
            return response()->json([
                'error' => true,
                'msg' => 'Upazila not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'Unions retrieved successfully',
            'data' => $upazila->unions
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string',
            'bn_name' => 'nullable|string',
            'url' => 'nullable|string'
        ]);
        
        $upazila = Upazila::create($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'Upazila created successfully',
            'data' => $upazila
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $upazila = Upazila::find($id);
        
        if (!$upazila) {
            return response()->json([
                'error' => true,
                'msg' => 'Upazila not found'
            ], 404);
        }
        
        $validated = $request->validate([
            'district_id' => 'sometimes|required|exists:districts,id',
            'name' => 'sometimes|required|string',
            'bn_name' => 'nullable|string',
            'url' => 'nullable|string'
        ]);
        
        $upazila->update($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'Upazila updated successfully',
            'data' => $upazila
        ]);
    }

    public function destroy($id)
    {
        $upazila = Upazila::find($id);
        
        if (!$upazila) {
            return response()->json([
                'error' => true,
                'msg' => 'Upazila not found'
            ], 404);
        }
        
        $upazila->delete();
        
        return response()->json([
            'error' => false,
            'msg' => 'Upazila deleted successfully'
        ]);
    }
}
