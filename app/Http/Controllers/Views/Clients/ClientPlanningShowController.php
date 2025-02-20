<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Planning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPlanningShowController extends Controller
{
    public function index() {
        $user = Auth::user();
        $planning = Planning::where("client_id", $user->id)->get();
        return view('pages.client.planning.index', compact('user', 'planning'));
    }

    public function detail($id) {
        $user = Auth::user();
        $planning = Planning::findOrFail( $id );
        return view('pages.client.planning.detail', compact('user', 'planning'));
    }

    public function store() {
        $user = Auth::user();
        return view('pages.client.planning.store', compact('user'));
    }

    public function category() {
        $user = Auth::user();
        $category = Category::all();
        return view('pages.client.planning.category', compact('user','category'));
    }
}
