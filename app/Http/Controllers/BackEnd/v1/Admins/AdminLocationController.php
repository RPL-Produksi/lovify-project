<?php

namespace App\Http\Controllers\BackEnd\v1\Admins;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AdminLocationController extends Controller
{
    public function storeLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 400);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only('name');
        $data['slug'] = Str::slug($data['name']);
        $location = Location::create($data);
        
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Location has been created',
                'data' => $location,
            ]);
        }

        // return redirect()->back()->with('success', 'Location has been created');
        return true;
    }

    public function deleteLocation(Request $request, $id)
    {
        $location = Location::find($id);

        if ($location == null) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Location not found',
                ], 404);
            }

            // return redirect()->back()->with('error', 'Location not found');
            return false;
        }

        $location->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Location has been deleted',
            ]);
        }

        // return redirect()->back()->with('success', 'Location has been deleted');
        return true;
    }
}
