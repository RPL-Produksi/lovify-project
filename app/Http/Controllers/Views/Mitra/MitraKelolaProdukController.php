<?php

namespace App\Http\Controllers\Views\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class MitraKelolaProdukController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $kategori = Category::all();
        if ($user->vendor) {
            $produk = $user->vendor->products;
        } else {
            $produk = [];
        }
        return view('pages.mitra.produk.index', compact('produk', 'user', 'kategori'));
    }

    public function getData(Request $request)
    {
        $user = $request->user();
        $vendor = $user->load('vendor.products')->vendor;

        if (!$vendor) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak memiliki vendor',
            ], 404);
        }

        $length = intval($request->input('length', 10));
        $start = intval($request->input('start', 0));
        $search = $request->input('search')['value'] ?? '';
        $order = $request->input('order')[0] ?? null;
        $statusFilter = $request->input('status') ?? '';

        $data = $vendor->products();

        if (!empty($statusFilter)) {
            $data->where('status', $statusFilter);
        }

        if (!empty($search)) {
            $data->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%")
                    ->orWhere('price', 'LIKE', "%$search%");
            });
        }

        if ($order) {
            $columns = ['id', 'cover', 'name', 'description', 'price', 'status'];
            $orderBy = $columns[$order['column']] ?? 'name';
            $orderDir = $order['dir'] ?? 'asc';

            $data->orderBy($orderBy, $orderDir);
        } else {
            $data->orderBy('name', 'asc');
        }

        $count = $vendor->products()->count();
        $countFiltered = $data->count();

        $data = $data->skip($start)->take($length)->get();

        return response()->json([
            "draw" => intval($request->input('draw', 1)),
            "recordsTotal" => $count,
            "recordsFiltered" => $countFiltered,
            "data" => $data
        ]);
    }
}
