@extends('layouts.app')
@section('title','My Cart – SAAJ (instrument)')

@section('content')
<div class="min-h-screen bg-linear-to-br from-purple-50/40 via-white to-white py-16">
<div class="container mx-auto px-6 max-w-6xl">

    <div class="mb-10">
        <span class="text-[10px] uppercase tracking-widest text-purple-500 font-bold">Your Selection</span>
        <h1 class="text-4xl font-heading font-bold text-midnight-900 mt-1">Shopping Cart</h1>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">
        {{-- Cart Items --}}
        <div class="flex-1">
            {{-- Empty state --}}
            <div id="empty-cart" class="hidden text-center py-24">
                <div class="w-24 h-24 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-dashed border-purple-200">
                    <svg class="w-10 h-10 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-heading font-bold text-midnight-900 mb-3">Your cart is empty</h2>
                <p class="text-midnight-900/40 text-sm mb-8">Looks like you haven't added anything yet.</p>
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-purple-600 text-white font-bold text-sm rounded-2xl hover:bg-purple-700 transition-all btn-purple-glow active:scale-95">
                    Browse Products →
                </a>
            </div>

            {{-- Cart list --}}
            <div id="cart-list" class="space-y-4"></div>

            {{-- Actions --}}
            <div id="cart-actions" class="hidden flex-wrap items-center gap-3 mt-6">
                <button onclick="clearCart()" class="px-5 py-2.5 border border-red-200 text-red-500 text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-red-50 transition-all">
                    Clear Cart
                </button>
                <a href="{{ route('shop') }}" class="px-5 py-2.5 border border-purple-200 text-purple-600 text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-purple-50 transition-all">
                    ← Continue Shopping
                </a>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="w-full lg:w-80 shrink-0">
            <div class="bg-white rounded-3xl border border-purple-100 p-7 sticky top-24">
                <h2 class="font-heading font-bold text-xl text-midnight-900 mb-6">Order Summary</h2>

                <div class="space-y-3 text-sm mb-6" id="summary-lines">
                    <div class="flex justify-between text-midnight-900/60">
                        <span>Subtotal</span>
                        <span id="summary-subtotal">₹0</span>
                    </div>
                    <div class="flex justify-between text-midnight-900/60">
                        <span>Shipping</span>
                        <span id="summary-shipping" class="text-green-600 font-medium">FREE</span>
                    </div>
                    <div class="border-t border-purple-50 pt-3 flex justify-between font-bold text-midnight-900 text-base">
                        <span>Total</span>
                        <span id="summary-total">₹0</span>
                    </div>
                </div>

                <div id="free-shipping-bar" class="mb-6 hidden">
                    <p class="text-[11px] text-purple-600 font-medium mb-1.5" id="shipping-msg"></p>
                    <div class="h-1.5 bg-purple-50 rounded-full overflow-hidden">
                        <div id="shipping-progress" class="h-full bg-linear-to-r from-purple-400 to-violet-600 rounded-full transition-all duration-500"></div>
                    </div>
                </div>

                <a id="checkout-btn" href="{{ route('checkout') }}"
                   class="block text-center py-4 bg-purple-600 text-white font-bold text-sm rounded-2xl hover:bg-purple-700 btn-purple-glow transition-all active:scale-95 mb-4">
                    Proceed to Checkout →
                </a>

                <div class="flex items-center justify-center gap-2 text-[11px] text-midnight-900/35">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    Secure &amp; Encrypted Checkout
                </div>

                {{-- Trust badges --}}
                <div class="mt-6 pt-5 border-t border-purple-50 grid grid-cols-3 gap-3 text-center">
                    @foreach(['100%\nPure','Free Returns','Lab\nTested'] as $badge)
                    <div class="text-[10px] text-midnight-900/40 font-medium leading-tight">{!! nl2br($badge) !!}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
const FREE_SHIP_THRESHOLD = 500;
const SHIP_COST = 60;

function renderCart() {
    const cart      = getCart();
    const list      = document.getElementById('cart-list');
    const empty     = document.getElementById('empty-cart');
    const actions   = document.getElementById('cart-actions');
    const checkoutBtn = document.getElementById('checkout-btn');

    if (!cart.length) {
        list.innerHTML = '';
        empty.classList.remove('hidden');
        actions.style.display = 'none';
        updateSummary(0);
        return;
    }

    empty.classList.add('hidden');
    actions.style.display = 'flex';

    list.innerHTML = cart.map((item, idx) => `
        <div class="flex items-center gap-5 bg-white rounded-2xl p-5 border border-purple-50 hover:border-purple-200 transition-all group">
            <div class="w-16 h-16 bg-purple-50 rounded-xl flex items-center justify-center shrink-0 border border-purple-100">
                <span class="text-purple-300 font-black text-lg font-heading">S</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-heading font-bold text-midnight-900 leading-snug">${item.product}</p>
                <p class="text-xs text-purple-500 font-medium mt-0.5">${item.variant}</p>
                <p class="text-sm font-bold text-midnight-900 mt-1">₹${(item.price * item.qty).toLocaleString('en-IN')}</p>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <button onclick="changeQty(${idx}, -1)" class="w-8 h-8 rounded-lg bg-purple-50 hover:bg-purple-100 text-midnight-900 font-bold flex items-center justify-center transition-all">−</button>
                <span class="w-8 text-center font-bold text-sm text-midnight-900">${item.qty}</span>
                <button onclick="changeQty(${idx}, 1)"  class="w-8 h-8 rounded-lg bg-purple-50 hover:bg-purple-100 text-midnight-900 font-bold flex items-center justify-center transition-all">+</button>
            </div>
            <button onclick="removeItem(${idx})" class="ml-2 w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-400 flex items-center justify-center transition-all shrink-0" title="Remove">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
        </div>
    `).join('');

    const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
    updateSummary(subtotal);
}

function updateSummary(subtotal) {
    const shipping = subtotal > 0 && subtotal < FREE_SHIP_THRESHOLD ? SHIP_COST : 0;
    const total    = subtotal + shipping;

    document.getElementById('summary-subtotal').textContent = '₹' + subtotal.toLocaleString('en-IN');
    document.getElementById('summary-shipping').textContent = shipping === 0 ? (subtotal > 0 ? 'FREE' : '₹0') : '₹' + shipping;
    document.getElementById('summary-shipping').className   = shipping === 0 && subtotal > 0 ? 'text-green-600 font-medium' : 'text-midnight-900/60';
    document.getElementById('summary-total').textContent   = '₹' + total.toLocaleString('en-IN');

    const bar  = document.getElementById('free-shipping-bar');
    const msg  = document.getElementById('shipping-msg');
    const prog = document.getElementById('shipping-progress');
    if (subtotal > 0 && subtotal < FREE_SHIP_THRESHOLD) {
        bar.classList.remove('hidden');
        const rem = FREE_SHIP_THRESHOLD - subtotal;
        msg.textContent  = `Add ₹${rem} more for FREE shipping!`;
        prog.style.width = (subtotal / FREE_SHIP_THRESHOLD * 100) + '%';
    } else {
        bar.classList.add('hidden');
    }
}

function changeQty(idx, delta) {
    const cart = getCart();
    cart[idx].qty = Math.max(1, cart[idx].qty + delta);
    saveCart(cart);
    updateBadge();
    renderCart();
}

function removeItem(idx) {
    const cart = getCart();
    cart.splice(idx, 1);
    saveCart(cart);
    updateBadge();
    renderCart();
}

function clearCart() {
    if (confirm('Clear your entire cart?')) {
        saveCart([]);
        updateBadge();
        renderCart();
    }
}

renderCart();
</script>
@endsection
