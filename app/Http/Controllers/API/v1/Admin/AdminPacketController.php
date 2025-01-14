<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminPacketController extends Controller
{
    public function storePacket(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'product_ids' => ['required', 'array', 'min:1'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            return redirect()->back()->withErrors($validator->errors());
        }

        $packet = Packet::updateOrCreate(
            ['id' => $id],
            [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]
        );
        $packet->products()->sync($request->product_ids);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Packet has been saved',
                'data' => [
                    'id' => $packet->id,
                    'name' => $packet->name,
                    'price' => $packet->price,
                    'description' => $packet->description,
                    'products' => $packet->products,
                ],
            ], 200);
        }

        return true;
    }

    public function getPackets(Request $request, $id)
    {

        if ($id != null) {
            $packet = Packet::with('products')->find($id);

            if (!$packet) {
                if ($request->wantsJson()) {
                    return response()->json(['error' => 'Packet not found'], 404);
                }

                return redirect()->back()->withErrors('Packet not found');
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Packet fetched successfully',
                    'data' => $packet,
                ], 200);
            }

            return true;
        }
        
        $validator = Validator::make($request->all(), [
            'page' => ['integer', 'min:1'],
            'size' => ['integer', 'min:10', 'max:100']
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            return redirect()->back()->withErrors($validator->errors());
        }

        $page = $request->page ?? 1;
        $size = $request->size ?? 10;

        $packets = Packet::with('products')->orderBy('name', 'ASC')->paginate($size, ['*'], 'page', $page);

        if ($request->wantsJson()) {
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

        return True;
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
            return response()->json(['status' => 'success', 'message' => 'Packet has been deleted'], 200);
        }

        return true;
    }
}
