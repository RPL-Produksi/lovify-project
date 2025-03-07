<?php

namespace App\Http\Controllers\Views\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderProgress;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MitraKelolaPesananController extends Controller
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
        return view('pages.mitra.pesanan.index', compact('produk', 'user', 'kategori'));
    }

    public function getData(Request $request)
    {
        $mitra = $request->user();
        $productIds = $mitra->vendor->products->pluck('id');

        $query = OrderProgress::whereIn('product_id', $productIds)
            ->with(['order.planning.client', 'product']);

        if (!empty($request->input('search')['value'])) {
            $search = $request->input('search')['value'];
            $query->whereHas('order.planning.client', function ($q) use ($search) {
                $q->where('fullname', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('phone_number', 'LIKE', "%$search%");
            })->orWhereHas('product', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            });
        }

        $orderColumn = $request->input('order')[0]['column'] ?? 0;
        $orderDir = $request->input('order')[0]['dir'] ?? 'asc';
        $columns = ['id', 'marry_date', 'user_fullname', 'user_email', 'user_phone_number', 'product_name', 'status'];
        $query->orderBy($columns[$orderColumn] ?? 'id', $orderDir);

        $length = intval($request->input('length', 10));
        $start = intval($request->input('start', 0));

        $total = OrderProgress::whereIn('product_id', $productIds)->count();
        $filtered = $query->count();

        $data = $query->skip($start)->take($length)->get()->map(function ($orderProgres) {
            return [
                'id' => $orderProgres->id,
                'marry_date' => Carbon::parse($orderProgres->order->marry_date)->format('d-m-Y'),
                'user_fullname' => $orderProgres->order->planning->client->fullname,
                'user_email' => $orderProgres->order->planning->client->email,
                'user_phone_number' => $orderProgres->order->planning->client->phone_number,
                'product_name' => $orderProgres->product->name,
                'status' => $orderProgres->status,
            ];
        });

        return response()->json([
            "draw" => intval($request->input('draw', 1)),
            "recordsTotal" => $total,
            "recordsFiltered" => $filtered,
            "data" => $data
        ]);
    }
}
