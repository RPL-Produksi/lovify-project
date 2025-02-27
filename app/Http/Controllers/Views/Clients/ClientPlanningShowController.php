<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Planning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPlanningShowController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->query('filter');

        $planningQuery = Planning::where("client_id", $user->id);

        if ($filter === 'ordered') {
            $planningQuery->whereHas('order');
        }

        $planning = $planningQuery->get();

        return view('pages.client.planning.index', compact('user', 'planning'));
    }


    public function detail($id)
    {
        $user = Auth::user();
        $planning = Planning::with('products.vendor.category')->findOrFail($id);
        return view('pages.client.planning.detail', compact('user', 'planning'));
    }

    public function store($id = null)
    {
        $user = Auth::user();
        $planning = Planning::find($id);
        return view('pages.client.planning.store', compact('user', 'planning'));
    }

    public function category()
    {
        $user = Auth::user();
        $category = Category::all();
        return view('pages.client.planning.category', compact('user', 'category'));
    }
}
