<?php

namespace App\Http\Controllers\Backend\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PacketController extends Controller
{
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
}
