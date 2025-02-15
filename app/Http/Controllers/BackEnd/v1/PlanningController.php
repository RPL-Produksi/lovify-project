<?php

namespace App\Http\Controllers\BackEnd\v1;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function getPlanning(Request $request, $id = null)
    {
        $plannings = Planning::query();

        if ($id != null) {
            $planning = Planning::find($id);
            if ($planning == null) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Planning not found',
                    ], 404);
                }

                // return redirect()->back()->with('error', 'Planning not found');
                return true;
            }

            if ($request->user()->id != $planning->client_id) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'You are not authorized to view this planning',
                    ], 403);
                }

                // return redirect()->back()->with('error', 'You are not authorized to view this planning');
                return true;
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $planning,
                ], 200);
            }

            // return view('planning.show', compact('planning'));
            return true;
        }

        if ($request->user()->role == 'client') {
            $plannings->where('client_id', $request->user()->id);
        } else if ($request->user()->role == 'mitra') {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to view this planning',
            ], 403);
        }

        $plannings->get();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $plannings,
            ], 200);
        }

        // return view('planning.index', compact('plannings'));
        return true;
    }
}
