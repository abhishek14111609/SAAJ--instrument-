<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function confirmation($orderNumber)
    {
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();
        return view('orders.confirmation', compact('order'));
    }

    public function track(Request $request)
    {
        $order = null;
        if ($request->filled('order_number')) {
            $order = Order::with('items')
                ->where('order_number', $request->order_number)
                ->when($request->filled('email'), fn($q) => $q->where('email', $request->email))
                ->first();
        }
        return view('orders.track', compact('order'));
    }
}
