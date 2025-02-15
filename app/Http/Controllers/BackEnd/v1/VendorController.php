<?php

namespace App\Http\Controllers\BackEnd\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function getVendors(Request $request, $id = null)
    {
        $category = $request->input('category');
    }
}
