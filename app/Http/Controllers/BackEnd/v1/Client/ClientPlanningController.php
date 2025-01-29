<?php

namespace App\Http\Controllers\Backend\v1\Client;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientPlanningController extends Controller
{
    public function storePlanning(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'product_ids' => ['required', 'array'],
            'product_ids.*' => ['required', 'integer', 'exists:products,id'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 400);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $planning = Planning::updateOrCreate(
            ['id' => $id],
            [
                'title' => $request->title,
                'description' => $request->description,
            ]
        );

        $planning->products()->sync($request->product_ids);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Planning created successfully',
                'data' => $planning
            ], 201);
        }

        // return redirect()->back()->with('success', 'Planning created successfully');
        return true;
    }
}
