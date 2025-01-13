<?php

namespace App\Http\Controllers\API\v1\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MitraProductController extends Controller
{
    public function store(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'required|image',
            'status' => 'required|in:draft,active,inactive',
            'attachments.*' => 'nullable|image|file',
        ]);

        if ($validator->fails()) {
            if ($request->isJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $input = $request->all();
        $input['slug'] = $this->makeSlug($request->name);
        $input['mitra_id'] = Auth::id();

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $storedFile = $file->storeAs($input['slug'] . '/' . Auth::user()->username . '/' . 'cover', $file->hashName());
            $filePath = Storage::url($storedFile);
            $input['cover'] = $filePath;
        }

        $product = Product::updateOrCreate(['id' => $id], $input);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $storedFile = $attachment->storeAs(
                    $product->slug . '/' . Auth::user()->username . '/' . 'attachments',
                    $attachment->hashName()
                );

                $filePath = Storage::url($storedFile);

                $productAttachment = new ProductAttachment();
                $productAttachment->product_id = $product->id;
                $productAttachment->path = $filePath;
                $productAttachment->save();
            }
        }

        if ($request->isJson()) {
            $response = [
                'status' => 'success',
                'message' => 'Product saved successfully',
            ];

            return response()->json($response, 201);
        }

        return true;
    }
}
