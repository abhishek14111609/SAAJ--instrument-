@extends('layouts.app')
@section('title','Checkout – SAAJ (instrument)')

@section('content')
<div class="min-h-screen bg-linear-to-br from-purple-50/40 via-white to-white py-16">
<div class="container mx-auto px-6 max-w-6xl">

    <div class="mb-10">
        <span class="text-[10px] uppercase tracking-widest text-purple-500 font-bold">Almost there</span>
        <h1 class="text-4xl font-heading font-bold text-midnight-900 mt-1">Checkout</h1>
    </div>

    {{-- Progress steps --}}
    <div class="flex items-center gap-0 mb-12 max-w-md">
        @foreach([['1','Cart'],['2','Details'],['3','Confirm']] as $i => [$n,$l])
        <div class="flex items-center {{ $i < 2 ? 'flex-1' : '' }}">
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold
                    {{ $n <= '2' ? 'bg-purple-600 text-white' : 'bg-purple-100 text-purple-500' }}">{{ $n }}</div>
                <span class="text-[10px] mt-1 font-medium {{ $n <= '2' ? 'text-purple-600' : 'text-midnight-900/30' }}">{{ $l }}</span>
            </div>
            @if($i < 2)
            <div class="flex-1 h-0.5 bg-purple-{{ $n < '2' ? '600' : '100' }} mx-2 mb-4"></div>
            @endif
        </div>
        @endforeach
    </div>

    <div id="checkout-empty" class="hidden text-center py-20">
        <p class="text-midnight-900/40 mb-6">Your cart is empty.</p>
        <a href="{{ route('shop') }}" class="px-8 py-4 bg-purple-600 text-white rounded-2xl font-bold hover:bg-purple-700 transition-all">Shop Now</a>
    </div>

    <div id="checkout-content" class="flex flex-col lg:flex-row gap-10">
        {{-- Form --}}
        <div class="flex-1">
            <form id="checkout-form" onsubmit="submitOrder(event)" class="space-y-6" novalidate>
                {{-- Contact --}}
                <div class="bg-white rounded-3xl border border-purple-50 p-7">
                    <h2 class="font-heading font-bold text-lg text-midnight-900 mb-5 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-600 text-white rounded-full text-xs flex items-center justify-center font-bold shrink-0">1</span>
                        Contact Information
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-midnight-900/50 mb-1.5">Full Name *</label>
                            <input type="text" id="f-name" required placeholder="Rahul Sharma"
                                class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-midnight-900/50 mb-1.5">Phone *</label>
                            <input type="tel" id="f-phone" required placeholder="+91 98765 43210"
                                class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wide text-midnight-900/50 mb-1.5">Email *</label>
                            <input type="email" id="f-email" required placeholder="you@email.com"
                                class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
                        </div>
                    </div>
                </div>

                {{-- Shipping Address --}}
                <div class="bg-white rounded-3xl border border-purple-50 p-7">
                    <h2 class="font-heading font-bold text-lg text-midnight-900 mb-5 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-600 text-white rounded-full text-xs flex items-center justify-center font-bold shrink-0">2</span>
                        Shipping Address
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wide text-midnight-900/50 mb-1.5">Street Address *</label>
                            <textarea id="f-address" required rows="2" placeholder="House no., street, area…"
                                class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-midnight-900/50 mb-1.5">City *</label>
                            <input type="text" id="f-city" required placeholder="Bengaluru"
                                class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-midnight-900/50 mb-1.5">State *</label>
                            <select id="f-state" required class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 text-sm text-midnight-900 outline-none transition-all bg-white">
                                <option value="">Select state…</option>
                                @foreach(['Karnataka','Kerala','Tamil Nadu','Maharashtra','Goa','Andhra Pradesh','Telangana','Delhi','Other'] as $s)
                                <option>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-midnight-900/50 mb-1.5">Pincode *</label>
                            <input type="text" id="f-pincode" required maxlength="6" placeholder="560001"
                                class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
                        </div>
                    </div>
                </div>

                {{-- Payment --}}
                <div class="bg-white rounded-3xl border border-purple-50 p-7">
                    <h2 class="font-heading font-bold text-lg text-midnight-900 mb-5 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-600 text-white rounded-full text-xs flex items-center justify-center font-bold shrink-0">3</span>
                        Payment Method
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center gap-4 p-4 border-2 border-purple-600 rounded-2xl cursor-pointer bg-purple-50/30" id="lbl-cod">
                            <input type="radio" name="payment" value="cod" checked onchange="selectPayment(this)" class="w-4 h-4 accent-purple-600">
                            <div>
                                <p class="font-bold text-sm text-midnight-900">Cash on Delivery</p>
                                <p class="text-xs text-midnight-900/40">Pay when you receive</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-4 p-4 border-2 border-purple-100 rounded-2xl cursor-pointer hover:border-purple-300 transition-all" id="lbl-online">
                            <input type="radio" name="payment" value="online" onchange="selectPayment(this)" class="w-4 h-4 accent-purple-600">
                            <div>
                                <p class="font-bold text-sm text-midnight-900">UPI / Online</p>
                                <p class="text-xs text-midnight-900/40">Pay securely online</p>
                            </div>
                        </label>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-midnight-900/50 mb-1.5 mt-4">Order Notes (optional)</label>
                        <textarea id="f-notes" rows="2" placeholder="Any special instructions…"
                            class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 text-sm text-midnight-900 outline-none transition-all resize-none"></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full py-5 bg-purple-600 text-white font-bold text-sm rounded-2xl hover:bg-purple-700 btn-purple-glow transition-all active:scale-95 flex items-center justify-center gap-2" id="place-order-btn">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    Place Order
                </button>
            </form>
        </div>

        {{-- Summary --}}
        <div class="w-full lg:w-80 shrink-0">
            <div class="bg-white rounded-3xl border border-purple-100 p-7 sticky top-24">
                <h2 class="font-heading font-bold text-lg text-midnight-900 mb-5">Your Order</h2>
                <div id="checkout-cart-items" class="space-y-3 mb-5 max-h-64 overflow-y-auto"></div>
                <div class="border-t border-purple-50 pt-4 space-y-2 text-sm">
                    <div class="flex justify-between text-midnight-900/55"><span>Subtotal</span><span id="co-subtotal">₹0</span></div>
                    <div class="flex justify-between text-midnight-900/55"><span>Shipping</span><span id="co-shipping" class="text-green-600 font-medium">FREE</span></div>
                    <div class="flex justify-between font-bold text-base text-midnight-900 pt-2 border-t border-purple-50"><span>Total</span><span id="co-total">₹0</span></div>
                </div>
                <div class="mt-5 flex items-center justify-center gap-1.5 text-[11px] text-midnight-900/30">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
                    100% secure checkout
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
const FREE_SHIP = 500, SHIP = 60;

function loadCheckoutCart() {
    const cart = getCart();
    if (!cart.length) {
        document.getElementById('checkout-empty').classList.remove('hidden');
        document.getElementById('checkout-content').classList.add('hidden');
        return;
    }
    const items = document.getElementById('checkout-cart-items');
    items.innerHTML = cart.map(i => `
        <div class="flex items-center justify-between gap-3">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-midnight-900 truncate">${i.product}</p>
                <p class="text-[11px] text-purple-500">${i.variant} × ${i.qty}</p>
            </div>
            <span class="text-sm font-bold text-midnight-900 shrink-0">₹${(i.price * i.qty).toLocaleString('en-IN')}</span>
        </div>
    `).join('');
    const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
    const shipping = subtotal < FREE_SHIP ? SHIP : 0;
    document.getElementById('co-subtotal').textContent = '₹' + subtotal.toLocaleString('en-IN');
    document.getElementById('co-shipping').textContent = shipping ? '₹' + shipping : 'FREE';
    document.getElementById('co-total').textContent    = '₹' + (subtotal + shipping).toLocaleString('en-IN');
}

function selectPayment(radio) {
    document.getElementById('lbl-cod').className    = 'flex items-center gap-4 p-4 border-2 border-purple-100 rounded-2xl cursor-pointer hover:border-purple-300 transition-all';
    document.getElementById('lbl-online').className = 'flex items-center gap-4 p-4 border-2 border-purple-100 rounded-2xl cursor-pointer hover:border-purple-300 transition-all';
    document.getElementById('lbl-' + radio.value).className = 'flex items-center gap-4 p-4 border-2 border-purple-600 rounded-2xl cursor-pointer bg-purple-50/30';
}

function submitOrder(e) {
    e.preventDefault();
    const required = ['f-name','f-phone','f-email','f-address','f-city','f-state','f-pincode'];
    let valid = true;
    required.forEach(id => {
        const el = document.getElementById(id);
        if (!el.value.trim()) { el.classList.add('border-red-400'); valid = false; }
        else el.classList.remove('border-red-400');
    });
    if (!valid) { showToast('⚠ Please fill all required fields.'); return; }

    const btn = document.getElementById('place-order-btn');
    btn.disabled = true;
    btn.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Placing Order…';

    // Store order info in session storage for confirmation page
    const cart     = getCart();
    const subtotal = cart.reduce((s,i) => s + i.price * i.qty, 0);
    const shipping = subtotal < FREE_SHIP ? SHIP : 0;
    const order = {
        number    : 'SAAJ-' + Math.random().toString(36).substr(2,6).toUpperCase() + '-' + new Date().toLocaleDateString('en-GB').replace(/\//g,''),
        name      : document.getElementById('f-name').value,
        email     : document.getElementById('f-email').value,
        phone     : document.getElementById('f-phone').value,
        address   : document.getElementById('f-address').value + ', ' + document.getElementById('f-city').value + ', ' + document.getElementById('f-state').value + ' ' + document.getElementById('f-pincode').value,
        payment   : document.querySelector('input[name=payment]:checked').value,
        items     : cart, subtotal, shipping, total: subtotal + shipping,
        date      : new Date().toLocaleDateString('en-IN', {day:'numeric',month:'long',year:'numeric'}),
    };
    sessionStorage.setItem('saaj_order', JSON.stringify(order));
    saveCart([]);
    updateBadge();
    window.location.href = '{{ route('order.confirmation') }}';
}

loadCheckoutCart();
</script>
@endsection
