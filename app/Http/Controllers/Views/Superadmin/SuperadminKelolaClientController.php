<?php

namespace App\Http\Controllers\Views\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminKelolaClientController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('pages.superadmin.client.index', compact('user'));
    }

    public function getData() {
        return response()->json(User::where('role', 'client')->get());
    }
}