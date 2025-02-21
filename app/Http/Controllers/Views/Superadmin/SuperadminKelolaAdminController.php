<?php

namespace App\Http\Controllers\Views\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminKelolaAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->ajax()) {
            $admin = User::where('role', 'admin')->get();
            return response()->json($admin);
        }

        return view('pages.superadmin.admin.index', compact('user'));
    }
}
