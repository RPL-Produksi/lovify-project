<?php

namespace App\Http\Controllers\Backend\v1\Mitras;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MitraProductController extends Controller
{
    public function store(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'cover' => 'required|image',
            'status' => 'required|in:draft,active,inactive',
            'category_id' => 'required|exists:categories,id',
            'attachemnts.*' => 'nullable|image',
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

        $input = $request->all();
        $input['mitra_id'] = $request->user()->id;
        $input['slug'] = $this->makeSlug($request->name);

        if ($request->has('cover')) {
            $file = $request->cover;

            $folderPath = $request->user()->id . '-' . 'mitra' . '/' . 'product' . '/' . $input['slug'] . '/' . 'cover';
            $storedFile = $file->storeAs($folderPath, $file->hashName());

            $filePath = Storage::url($storedFile);
            $input['cover'] = $filePath;
        }

        $product = Product::updateOrCreate(['id' => @$id], $input);

        if ($request->has('attachments')) {
            $attachments = $request->attachments;
            $attachmentPaths = [];

            $folderPath = $request->user()->id . '-' . 'mitra' . '/' . 'product' . '/' . $input['slug'] . '/' . 'attachments';
            foreach ($attachments as $attachment) {
                $storedFile = $attachment->storeAs($folderPath, $attachment->hashName());
                $filePath = Storage::url($storedFile);
                $attachmentPaths[] = $filePath;
            }

            $product->attachments()->createMany($attachmentPaths);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $product,
            ], 200);
        }

        return redirect()->route('mitra.product.index')->with('success', 'Product has been saved');
    }
}
