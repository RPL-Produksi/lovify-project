<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPlanningShowController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('pages.client.planning.index', compact('user'));
    }

    public function detail() {
        $user = Auth::user();
        return view('pages.client.planning.detail', compact('user'));
    }

    public function store() {
        $user = Auth::user();
        return view('pages.client.planning.store', compact('user'));
    }
}
