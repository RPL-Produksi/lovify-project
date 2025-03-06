<?php

namespace App\Http\Controllers\Views\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminKelolaVendorController extends Controller
{
    public function index() {
        $user = Auth::user();
        $vendor = Vendor::all();
        return view('pages.admin.vendor.index', compact('vendor', 'user'));
    }

    public function getData(Request $request)
    {
        $length = intval($request->input('length', 10));
        $start = intval($request->input('start', 0));
        $search = $request->input('search')['value'] ?? '';
        $order = $request->input('order')[0] ?? null;

        $data = Vendor::query();

        if (!empty($search)) {
            $data->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('phone_number', 'LIKE', "%$search%");
        }

        if ($order) {
            $columns = ['id', 'name', 'email', 'phone_number', 'is_verified'];
            $orderBy = $columns[$order['column']] ?? 'name';
            $orderDir = $order['dir'] ?? 'asc';

            $data->orderBy($orderBy, $orderDir);
        } else {
            $data->orderBy('name', 'asc');
        }

        $count = Vendor::count();
        $countFiltered = $data->count();

        $data = $data->skip($start)->take($length)->get();

        return response()->json([
            "draw" => intval($request->input('draw', 1)),
            "recordsTotal" => $count,
            "recordsFiltered" => $countFiltered,
            "data" => $data
        ]);
    }

    public function delete($id) {
        $vendor = Vendor::find($id);

        $vendor->delete();
        return redirect()->back()->with('success', 'Vendor berhasil dihapus');
    }
}
