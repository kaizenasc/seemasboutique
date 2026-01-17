<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items');

        if ($request->has('status') && $request->status != 'all') {
            $query->where('order_status', $request->status);
        }

        if ($request->has('payment_status') && $request->payment_status != 'all') {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->latest()->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $order->update([
            'order_status' => $request->order_status
        ]);

        return back()->with('success', 'Order status updated successfully!');
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed'
        ]);

        $data = ['payment_status' => $request->payment_status];

        // If payment confirmed, also confirm order
        if ($request->payment_status === 'paid' && $order->order_status === 'pending') {
            $data['order_status'] = 'confirmed';
        }

        $order->update($data);

        return back()->with('success', 'Payment status updated successfully!');
    }

    public function whatsapp(Order $order)
    {
        $phone = '917058666655'; // Store WhatsApp number
        $message = "Hello {$order->customer_name},%0A%0AYour order #{$order->order_number} has been received!%0A%0ATotal Amount: ₹{$order->total}%0AStatus: {$order->order_status}%0A%0AThank you for shopping with Seema's Boutique!";
        
        return redirect("https://wa.me/{$phone}?text={$message}");
    }

    public function customerWhatsapp(Order $order)
    {
        $phone = $order->customer_phone;
        $message = "Hello {$order->customer_name},%0A%0AYour order #{$order->order_number} update:%0A%0AStatus: {$order->order_status}%0ATotal: ₹{$order->total}%0A%0AThank you for shopping with Seema's Boutique!";
        
        return redirect("https://wa.me/91{$phone}?text={$message}");
    }
}