<?php

namespace App\Http\Controllers\Views\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminKelolaAdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.superadmin.admin.index', compact('user'));
    }

    public function getData(Request $request)
    {
        $length = intval($request->input('length', 15));
        $start = intval($request->input('start', 0));
        $search = $request->input('search');
        $columns = $request->input('columns');
        $order = $request->input('order');

        $data = User::where('role', 'admin'); // Tetap filter role admin dari awal

        if (!empty($search['value'])) {
            $searchValue = $search['value'];
            $data->where(function ($query) use ($searchValue) {
                $query->where('fullname', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('username', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('phone_number', 'LIKE', '%' . $searchValue . '%');
            });
        }

        $count = User::where('role', 'admin')->count(); // Hitung total admin sebelum filter
        $countFiltered = $data->count(); // Hitung jumlah setelah filter search

        if (!empty($order)) {
            $order = $order[0];
            $orderBy = $order['column'];
            $orderDir = $order['dir'];

            if (isset($columns[$orderBy]['data'])) {
                $data->orderBy($columns[$orderBy]['data'], $orderDir);
            } else {
                $data->orderBy('fullname', 'asc');
            }
        } else {
            $data->orderBy('fullname', 'asc');
        }

        $data = $data->skip($start)->take($length)->get();

        $response = [
            "draw" => intval($request->input('draw', 1)),
            "recordsTotal" => $count,
            "recordsFiltered" => $countFiltered,
            "limit" => $length,
            "data" => $data
        ];

        return response()->json($response);
    }
}
