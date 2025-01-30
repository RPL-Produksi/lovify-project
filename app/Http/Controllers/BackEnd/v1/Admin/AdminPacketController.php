<?php

namespace App\Http\Controllers\BackEnd\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminPacketController extends Controller
{
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
