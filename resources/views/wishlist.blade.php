@extends('layouts.app')
@section('title','Wishlist – SAAJ (instrument)')

@section('content')
<div class="min-h-screen bg-linear-to-br from-purple-50/40 via-white to-white py-16">
<div class="container mx-auto px-6 max-w-5xl">

    <div class="mb-10">
        <span class="text-[10px] uppercase tracking-widest text-purple-500 font-bold">Saved Items</span>
        <h1 class="text-4xl font-heading font-bold text-midnight-900 mt-1">My Wishlist</h1>
    </div>

    <div id="wishlist-empty" class="hidden text-center py-24">
        <div class="w-24 h-24 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-dashed border-purple-200">
            <svg class="w-10 h-10 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
            </svg>
        </div>
        <h2 class="text-2xl font-heading font-bold text-midnight-900 mb-3">Your wishlist is empty</h2>
        <p class="text-midnight-900/40 text-sm mb-8">Save your favourite products to revisit them later.</p>
        <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-purple-600 text-white font-bold text-sm rounded-2xl hover:bg-purple-700 transition-all btn-purple-glow">
            Explore Products →
        </a>
    </div>

    <div id="wishlist-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>

    <div id="wishlist-actions" class="hidden flex-wrap items-center justify-between mt-10 pt-6 border-t border-purple-50">
        <button onclick="clearWishlist()" class="px-5 py-2.5 border border-red-200 text-red-500 text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-red-50 transition-all">
            Clear All
        </button>
        <button onclick="moveAllToCart()" class="px-5 py-2.5 bg-purple-600 text-white text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-purple-700 transition-all">
            Add All to Cart
        </button>
    </div>
</div>
</div>

<script>
const WL_KEY = 'saaj_wishlist';
function getWL()   { try { return JSON.parse(localStorage.getItem(WL_KEY)) || []; } catch { return []; } }
function saveWL(w) { localStorage.setItem(WL_KEY, JSON.stringify(w)); }

function renderWishlist() {
    const wl = getWL();
    const grid   = document.getElementById('wishlist-grid');
    const empty  = document.getElementById('wishlist-empty');
    const acts   = document.getElementById('wishlist-actions');
    if (!wl.length) { empty.classList.remove('hidden'); grid.innerHTML = ''; acts.classList.add('hidden'); return; }
    empty.classList.add('hidden');
    acts.classList.remove('hidden');
    grid.innerHTML = wl.map((item, i) => `
        <div class="bg-white rounded-3xl border border-purple-50 hover:border-purple-200 hover:shadow-xl hover:shadow-purple-100/40 transition-all duration-500 overflow-hidden">
            <div class="h-44 bg-gradient-to-br from-purple-50 to-purple-100/40 flex items-center justify-center">
                <span class="text-purple-200 text-5xl font-black font-heading">S</span>
            </div>
            <div class="p-5">
                <p class="text-[10px] text-purple-500 font-bold uppercase tracking-widest mb-1">${item.category || 'Product'}</p>
                <h3 class="font-heading font-bold text-midnight-900 mb-1">${item.name}</h3>
                <p class="text-sm font-bold text-midnight-900 mb-4">₹${item.price?.toLocaleString('en-IN') || '—'}</p>
                <div class="flex gap-2">
                    <button onclick="wlToCart(${i})" class="flex-1 py-2.5 bg-purple-600 text-white text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-purple-700 transition-all">Add to Cart</button>
                    <button onclick="removeWL(${i})" class="w-10 h-10 bg-red-50 hover:bg-red-100 text-red-400 rounded-xl flex items-center justify-center transition-all shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

function removeWL(i) { const wl = getWL(); wl.splice(i,1); saveWL(wl); renderWishlist(); }
function wlToCart(i) {
    const item = getWL()[i];
    addToCart({ variant_id: item.variant_id || Date.now(), product: item.name, variant: item.variant || '250g', price: item.price || 0, qty: 1, slug: item.slug || '' });
}
function clearWishlist() { if (confirm('Clear wishlist?')) { saveWL([]); renderWishlist(); } }
function moveAllToCart() { getWL().forEach((_,i) => wlToCart(i)); showToast('✓ All items added to cart!'); }

renderWishlist();
</script>
@endsection
