<?php

namespace App\Http\Controllers\Backend\v1\Mitras;

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
            'email' => ['required', 'email', 'unique:vendors,email'],
            'phone_number' => ['required', 'string', 'unique:vendors,phone_number'],
            'profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
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
        $message = null;
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
            $message = 'Vendor updated successfully';
        }

        $message = $message == null ? 'Vendor created successfully' : $message;
        $vendor = Vendor::create($data);

        $response = $vendor;
        dd($response);
    }
}
