<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart  = session('cart', []);
        if (empty($cart)) return redirect()->route('cart')->with('error', 'Your cart is empty.');
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = $subtotal >= 500 ? 0 : 60;
        $total    = $subtotal + $shipping;
        return view('checkout.index', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('cart');

        $data = $request->validate([
            'name'           => 'required|string|max:100',
            'email'          => 'required|email',
            'phone'          => 'required|string|max:15',
            'address'        => 'required|string',
            'city'           => 'required|string',
            'state'          => 'required|string',
            'pincode'        => 'required|string|max:10',
            'payment_method' => 'required|in:cod,online',
            'notes'          => 'nullable|string',
        ]);

        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = $subtotal >= 500 ? 0 : 60;
        $total    = $subtotal + $shipping;

        $order = Order::create([
            ...$data,
            'order_number'   => Order::generateOrderNumber(),
            'subtotal'       => $subtotal,
            'shipping'       => $shipping,
            'total'          => $total,
            'payment_status' => $data['payment_method'] === 'cod' ? 'unpaid' : 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_name' => $item['product_name'],
                'variant_name' => $item['variant_name'],
                'quantity'     => $item['qty'],
                'price'        => $item['price'],
                'subtotal'     => $item['price'] * $item['qty'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('order.confirmation', $order->order_number);
    }
}
