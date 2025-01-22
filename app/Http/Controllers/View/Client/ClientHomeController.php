<?php

namespace App\Http\Controllers\View\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientHomeController extends Controller
{
    public function home()
    {
        if (Auth::user()->role == 'client') {
            return view('pages.client.home.index');
        // } else if (Auth::user()->role == 'mitra') {
        //     return view('pages.mitra.home.index');
        } else if (Auth::user()->role == 'admin') {
            return view('pages.admin.home.index');
        } else if (Auth::user()->role == 'superadmin') {
            return view('pages.superadmin.home.index');
        }
    }
}
