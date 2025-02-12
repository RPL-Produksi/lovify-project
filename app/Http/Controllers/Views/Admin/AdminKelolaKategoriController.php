<?php

namespace App\Http\Controllers\Views\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminKelolaKategoriController extends Controller
{
    public function index() {
        $user = Auth::user();
        $kategori = Category::all();
        return view('pages.admin.kategori.index', compact('kategori', 'user'));
    }
}
