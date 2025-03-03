<?php

namespace App\Http\Controllers\BackEnd\v1\Admins;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminVendorController extends Controller
{
    public function verifyVendor(Request $request, $id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vendor not found'
                ], 404);
            }

            return redirect()->back()->with('error', 'Vendor not found');
        }

        if ($vendor->is_verified) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vendor already verified'
                ], 400);
            }

            return redirect()->back()->with('error', 'Vendor already verified');
        }

        $vendor->update([
            'is_verified' => 1
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Vendor verified successfully'
            ]);
        }

        return redirect()->back()->with('success', 'Vendor verified successfully');
    }
}
