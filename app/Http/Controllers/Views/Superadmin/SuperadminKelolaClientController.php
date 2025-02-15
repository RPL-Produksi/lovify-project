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
        $client = User::where('role', 'client')->get();
        return view('pages.superadmin.client.index', compact('user','client'));
    }
}
