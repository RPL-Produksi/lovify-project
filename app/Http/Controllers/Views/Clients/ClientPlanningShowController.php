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
}
