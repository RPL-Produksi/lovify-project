<?php

namespace App\Http\Controllers\BackEnd\v1\Mitras;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MitraVendorController extends Controller
{
    public function storeVendor(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:vendors,email,' . $id],
            'phone_number' => ['required', 'string', 'unique:vendors,phone_number,' . $id],
            'profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
            'location_id' => ['required', 'exists:locations,id'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['mitra_id'] = $request->user()->id;
        
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $path = $file->storeAs('vendors/' . $data['name'], $file->hashName());
            $filePath = Storage::url($path);
            $data['profile'] = $filePath;
        } else {
            $data['profile'] = null;
        }
        
        if ($id != null) {
            $vendor = Vendor::find($id);
            if ($vendor != null && $vendor->mitra_id != $request->user()->id) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'You are not authorized to update this vendor',
                    ], 400);
                }
                
                return redirect()->back()->with('error', 'You are not authorized to update this vendor');
            }
            
            $vendor->update($data);
            
            $vendor->mitra->makeHidden(['id', 'role', 'is_verified', 'created_at', 'updated_at', 'phone_verified']);
            $response = $vendor;
            $response['profile'] = $vendor->profile == null ? asset('vendors/default.png') : $vendor->profile;
            $response['mitra']['avatar'] = $response->mitra->avatar == null ? asset('avatars/default.png') : $response->mitra->avatar;
            return response()->json([
                'status' => 'success',
                'message' => 'Vendor updated successfully',
                'data' => $response,
            ], 200);
        }
        
        $vendor = Vendor::create($data);
        
        // $vendor->mitra->makeHidden(['id', 'role', 'is_verified', 'created_at', 'updated_at', 'phone_verified']);
        // $response = $vendor;
        // $response['profile'] = $vendor->profile == null ? asset('vendors/default.png') : $vendor->profile;
        // $response['mitra']['avatar'] = $response->mitra->avatar == null ? asset('avatars/default.png') : $response->mitra->avatar;

        // if ($request->wantsJson()) {
        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Vendor created successfully',
        //         'data' => $response,
        //     ], 200);
        // }

        return redirect()->route('mitra.home')->with('success', 'Vendor created successfully');
    }
}
