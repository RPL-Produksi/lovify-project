<?php

namespace App\Http\Controllers\Views\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminKelolaLokasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $location = Location::all();
        return view('pages.admin.lokasi.index', compact('location', 'user'));
    }

    public function getData(Request $request)
    {
        $length = intval($request->input('length', 10));
        $start = intval($request->input('start', 0));
        $search = $request->input('search')['value'] ?? '';
        $order = $request->input('order')[0] ?? null;

        $data = Location::query();

        if (!empty($search)) {
            $data->where('name', 'LIKE', "%$search%");
        }

        if ($order) {
            $columns = ['id', 'name'];
            $orderBy = $columns[$order['column']] ?? 'name';
            $orderDir = $order['dir'] ?? 'asc';

            $data->orderBy($orderBy, $orderDir);
        } else {
            $data->orderBy('name', 'asc');
        }

        $count = Location::count();
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
