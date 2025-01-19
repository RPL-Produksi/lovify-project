<?php

namespace App\Http\Controllers\View\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::user()->role !== 'client') {
            return view('pages.client.home.index');
        } else if (Auth::user()->role === 'mitra') {
            return redirect()->route('mitra.home');
        } else if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.home');
        } else if (Auth::user()->role === 'superadmin') {
            return redirect()->route('superadmin.home');
        }
    }
}
