<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {
        $cart  = session('cart', []);
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'qty'        => 'integer|min:1|max:20',
        ]);

        $variant = ProductVariant::with('product')->findOrFail($request->variant_id);
        $cart    = session('cart', []);
        $key     = 'variant_' . $variant->id;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $request->qty ?? 1;
        } else {
            $cart[$key] = [
                'variant_id'   => $variant->id,
                'product_name' => $variant->product->name,
                'variant_name' => $variant->name,
                'price'        => $variant->price,
                'qty'          => $request->qty ?? 1,
                'slug'         => $variant->product->slug,
            ];
        }
        session(['cart' => $cart]);

        if ($request->expectsJson()) {
            return response()->json(['count' => count($cart), 'message' => 'Added to cart!']);
        }

        return back()->with('success', '✓ ' . $variant->product->name . ' added to cart!');
    }

    public function update(Request $request, $key)
    {
        $cart = session('cart', []);
        if (isset($cart[$key])) {
            if ($request->qty <= 0) {
                unset($cart[$key]);
            } else {
                $cart[$key]['qty'] = (int) $request->qty;
            }
            session(['cart' => $cart]);
        }
        return back()->with('success', 'Cart updated.');
    }

    public function remove($key)
    {
        $cart = session('cart', []);
        unset($cart[$key]);
        session(['cart' => $cart]);
        return back()->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart')->with('success', 'Cart cleared.');
    }
}
