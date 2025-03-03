<?php

namespace App\Http\Controllers\BackEnd\v1\Mitras;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MitraOrderController extends Controller
{
    public function orderList (Request $request) {
        $mitra = $request->user();
    }

    // public function updateProductProgress(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'status' => 'required|in:in_progress,completed',
    //     ]);

    //     $order
    // }
}
