<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with('items')
            ->firstOrFail();

        return view('order-success', compact('order'));
    }

    public function track(Request $request)
    {
        if ($request->has('order_number')) {
            $order = Order::where('order_number', $request->order_number)
                ->with('items')
                ->first();

            if (!$order) {
                return view('track-order')->with('error', 'Order not found!');
            }

            return view('track-order', compact('order'));
        }

        return view('track-order');
    }
}