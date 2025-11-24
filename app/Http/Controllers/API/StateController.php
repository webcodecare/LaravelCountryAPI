<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states = State::with('country')->get();
        return response()->json([
            'error' => false,
            'msg' => 'States retrieved successfully',
            'data' => $states
        ]);
    }

    public function show($id)
    {
        $state = State::with('country')->find($id);
        
        if (!$state) {
            return response()->json([
                'error' => true,
                'msg' => 'State not found'
            ], 404);
        }
        
        return response()->json([
            'error' => false,
            'msg' => 'State retrieved successfully',
            'data' => $state
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string',
            'state_code' => 'nullable|string'
        ]);
        
        $state = State::create($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'State created successfully',
            'data' => $state
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $state = State::find($id);
        
        if (!$state) {
            return response()->json([
                'error' => true,
                'msg' => 'State not found'
            ], 404);
        }
        
        $validated = $request->validate([
            'country_id' => 'sometimes|required|exists:countries,id',
            'name' => 'sometimes|required|string',
            'state_code' => 'nullable|string'
        ]);
        
        $state->update($validated);
        
        return response()->json([
            'error' => false,
            'msg' => 'State updated successfully',
            'data' => $state
        ]);
    }

    public function destroy($id)
    {
        $state = State::find($id);
        
        if (!$state) {
            return response()->json([
                'error' => true,
                'msg' => 'State not found'
            ], 404);
        }
        
        $state->delete();
        
        return response()->json([
            'error' => false,
            'msg' => 'State deleted successfully'
        ]);
    }
}
