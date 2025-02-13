<?php

namespace App\Http\Controllers\BackEnd\v1\Clients;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientOrderController extends Controller
{
    public function storeOrder(Request $request, $id)
    {
        // $table->uuid('id')->primary();
        // $table->integer('total_price');
        // $table->integer('down_payment');
        // $table->integer('remaining_payment');
        // $table->date('dp_deadline');
        // $table->date('payment_deadline');
        // $table->date('marry_date');
        // $table->enum('status', ['pending', 'in_progress', 'completed', 'canceled']);
        // $table->foreignUuid('planning_id')->constrained('plannings')->cascadeOnDelete();
        // $table->timestamps();

        $validator = Validator::make($request->all(), [
            'marry_date' => ['required', 'date', 'after:' . Carbon::now()->addMonths(6)],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $planning = Planning::find($id);

        if (!$planning) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Planning not found',
                ], 404);
            }

            return redirect()->back()->with('error', 'Planning not found');
        }

        $data = [];
        $data['total_price'] = $planning->products->toArray();
    }
}
