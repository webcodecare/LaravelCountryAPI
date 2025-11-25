<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Union;
use Illuminate\Http\Request;

class UnionController extends Controller
{
    public function index()
    {
        $unions = Union::with('upazila')->get();
        return response()->json([
            'error' => false,
            'msg' => 'Unions retrieved successfully',
            'data' => $unions
        ]);
    }

    public function show($id)
    {
        $union = Union::with('upazila')->find($id);
        
        if (!$union) {
            return response()->json([
                'error' => true,
                'msg' => 'Union not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'Union retrieved successfully',
            'data' => $union
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'upazilla_id' => 'required|exists:upazilas,id',
            'name' => 'required|string',
            'bn_name' => 'nullable|string',
            'url' => 'nullable|string'
        ]);
        
        $union = Union::create($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'Union created successfully',
            'data' => $union
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $union = Union::find($id);
        
        if (!$union) {
            return response()->json([
                'error' => true,
                'msg' => 'Union not found'
            ], 404);
        }
        
        $validated = $request->validate([
            'upazilla_id' => 'sometimes|required|exists:upazilas,id',
            'name' => 'sometimes|required|string',
            'bn_name' => 'nullable|string',
            'url' => 'nullable|string'
        ]);
        
        $union->update($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'Union updated successfully',
            'data' => $union
        ]);
    }

    public function destroy($id)
    {
        $union = Union::find($id);
        
        if (!$union) {
            return response()->json([
                'error' => true,
                'msg' => 'Union not found'
            ], 404);
        }
        
        $union->delete();
        
        return response()->json([
            'error' => false,
            'msg' => 'Union deleted successfully'
        ]);
    }
}
