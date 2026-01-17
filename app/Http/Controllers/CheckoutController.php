<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CheckoutController extends Controller
{
   public function index()
{
    $cart = session('cart', []);
    
    // Calculate total
    $total = 0;
    foreach($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    
    // Generate UPI QR Code
    $upiId = 'pratikpunjabi3@ybl';
    $merchantName = 'Seemas Boutique';
    $upiUrl = "upi://pay?pa={$upiId}&pn=" . urlencode($merchantName) . "&am={$total}&cu=INR";
    
    $qrCode = QrCode::size(250)->generate($upiUrl);
    
    return view('checkout', compact('cart', 'qrCode', 'total'));
}
    
    
    
    
     
    

    
    

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon || !$coupon->isValid()) {
            return back()->with('error', 'Invalid or expired coupon code!');
        }

        $subtotal = $this->calculateSubtotal();

        if ($coupon->minimum_order && $subtotal < $coupon->minimum_order) {
            return back()->with('error', 'Minimum order amount of ₹' . $coupon->minimum_order . ' required!');
        }

        $discount = $coupon->calculateDiscount($subtotal);

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $discount
        ]);

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
        return back()->with('success', 'Coupon removed!');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'required|string|max:15',
            'customer_address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'payment_method' => 'required|in:cod,upi',
            'upi_utr' => 'required_if:payment_method,upi|nullable|string'
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty!');
        }

        $subtotal = $this->calculateSubtotal();
        $coupon = session()->get('coupon');
        $discount = $coupon['discount'] ?? 0;
        $total = $subtotal - $discount;

        // Create Order
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'coupon_code' => $coupon['code'] ?? null,
            'total' => $total,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method === 'cod' ? 'paid' : 'pending',
            'upi_utr' => $request->upi_utr,
            'order_status' => $request->payment_method === 'cod' ? 'confirmed' : 'pending',
            'notes' => $request->notes
        ]);

        // Create Order Items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'size' => $item['size'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        // Update coupon usage
        if ($coupon) {
            $couponModel = Coupon::where('code', $coupon['code'])->first();
            if ($couponModel) {
                $couponModel->increment('used_count');
            }
        }

        // Clear cart and coupon
        session()->forget(['cart', 'coupon']);

        return redirect()->route('order.success', $order->order_number);
    }

    private function calculateSubtotal()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return $subtotal;
    }
}