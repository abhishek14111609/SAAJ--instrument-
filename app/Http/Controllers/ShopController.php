<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('products.variants')->get();
        $query      = Product::with('variants', 'category');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('sort')) {
            match($request->sort) {
                'price_asc'  => $query->join('product_variants','products.id','=','product_variants.product_id')
                                      ->orderBy('product_variants.price','asc')->select('products.*'),
                'price_desc' => $query->join('product_variants','products.id','=','product_variants.product_id')
                                      ->orderBy('product_variants.price','desc')->select('products.*'),
                default      => $query->latest(),
            };
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        return view('shop.index', compact('products', 'categories', 'request'));
    }
}
