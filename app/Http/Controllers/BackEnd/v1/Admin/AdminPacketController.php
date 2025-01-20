<?php

namespace App\Http\Controllers\BackEnd\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminPacketController extends Controller
{
    // Only API
    public function getPackets(Request $request, $id = null)
    {
        if ($id != null) {
            $packet = Packet::with('products')->find($id);

            if (!$packet) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Packet not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Packet fetched successfully',
                'data' => $packet,
            ], 200);
        }

        $validator = Validator::make($request->all(), [
            'page' => ['integer', 'min:1'],
            'size' => ['integer', 'min:10', 'max:100']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $page = $request->page ?? 1;
        $size = $request->size ?? 10;

        $packets = Packet::with('products')->orderBy('name', 'ASC')->paginate($size, ['*'], 'page', $page);

        $response = [
            'status' => 'success',
            'message' => 'Packets fetched successfully',
            'data' => $packets->items(),
            'meta' => [
                'current_page' => $packets->currentPage(),
                'total_pages' => $packets->lastPage(),
                'total_items' => $packets->total(),
                'items_per_page' => $packets->perPage(),
            ],
        ];

        return response()->json($response, 200);
    }

    // API and Web
    public function storePacket(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:draft,active,inactive'],
            'product_ids' => ['required', 'array', 'min:1'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->withErrors($validator->errors());
        }

        $packet = Packet::updateOrCreate(['id' => $id], $request->only(['name', 'price', 'description', 'status']));
        $packet->products()->sync($request->product_ids);

        if ($request->wantsJson()) {
            $response = [
                'status' => 'success',
                'message' => 'Packet has been saved',
                'data' => $packet,
            ];

            return response()->json($response, 200);
        }

        return true;
    }

    public function deletePacket(Request $request, $id)
    {
        $packet = Packet::find($id);

        if (!$packet) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Packet not found'], 404);
            }

            return redirect()->back()->withErrors('Packet not found');
        }

        $packet->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Packet has been deleted'
            ], 200);
        }

        return true;
    }
}
