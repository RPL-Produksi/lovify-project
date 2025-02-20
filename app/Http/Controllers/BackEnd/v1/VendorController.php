<?php

namespace App\Http\Controllers\BackEnd\v1;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    public function getVendors(Request $request, $id = null)
    {
        $user = $request->user();
        if ($id) {
            $vendor = Vendor::find($id);
            if ($user->role == 'client' && !$vendor->is_verified) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vendor Not Found',
                ]);
            } else if ($user->role == 'mitra' && $vendor->mitra_id != $user->id) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vendor Not Found',
                ]);
            }
            
            if ($vendor) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Get Vendor Success',
                    'data' => [
                        'id' => $vendor->id,
                        'name' => $vendor->name,
                        'email' => $vendor->email,
                        'category' => $vendor->category->name,
                        'location' => $vendor->location->name,
                        'phone_number' => $vendor->phone_number,
                        'profile' => $vendor->profile,
                        'is_verified' => $vendor->is_verified,
                        'email_verified' => $vendor->email_verified,
                        'phone_verified' => $vendor->phone_verified,
                        'mitra' => [
                            'name' => $vendor->mitra->name,
                            'email' => $vendor->mitra->email,
                            'phone_number' => $vendor->mitra->phone_number,
                            'profile' => $vendor->mitra->profile,
                        ],
                    ],
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Vendor Not Found',
            ]);
        }

        $category = $request->input('category');
        $location = Str::slug($request->input('location'));
        $vendors = Vendor::query();
        $location = Location::where('slug', $location)->first();

        if ($user->role == 'client') {
            $vendors->where('is_verified', true);
        } else if ($user->role == 'mitra') {
            $vendors->where('mitra_id', $user->id);
        }

        if ($category) {
            $vendors->where('category_id', $category);
        }

        if ($location) {
            $vendors->where('location_id', $location->id);
        }

        if ($request->wantsJson()) {
            $vendors->get();
            $response = $vendors->map(function ($vendor) {
                return [
                    'id' => $vendor->id,
                    'name' => $vendor->name,
                    'email' => $vendor->email,
                    'category' => $vendor->category->name,
                    'location' => $vendor->location->name,
                    'phone_number' => $vendor->phone_number,
                    'profile' => $vendor->profile,
                    'is_verified' => $vendor->is_verified,
                    'email_verified' => $vendor->email_verified,
                    'phone_verified' => $vendor->phone_verified,
                    'mitra' => [
                        'name' => $vendor->mitra->name,
                        'email' => $vendor->mitra->email,
                        'phone_number' => $vendor->mitra->phone_number,
                        'profile' => $vendor->mitra->profile,
                    ],
                ];
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Get Vendors Success',
                'data' => $response,
            ]);
        }

        // return redirect()->route('home');
        return true;
    }
}
