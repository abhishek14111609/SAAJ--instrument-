@extends('layouts.app')
@section('title','Order Confirmed – SAAJ (instrument)')

@section('content')
<div class="min-h-screen bg-linear-to-br from-purple-50/40 via-white to-white py-20">
<div class="container mx-auto px-6 max-w-3xl">

    {{-- Success Banner --}}
    <div class="text-center mb-12">
        <div class="w-24 h-24 bg-linear-to-br from-purple-500 to-violet-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-purple-500/30 animate-bounce-once">
            <svg class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <span class="inline-block px-4 py-1 bg-green-100 text-green-600 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">Order Placed!</span>
        <h1 class="text-4xl md:text-5xl font-heading font-bold text-midnight-900 mb-3">Thank You! 🎉</h1>
        <p class="text-midnight-900/50 text-lg">Your order has been received and is being prepared with care.</p>
    </div>

    {{-- Order Card --}}
    <div class="bg-white rounded-3xl border border-purple-100 shadow-xl shadow-purple-100/40 overflow-hidden mb-8" id="order-card">
        <div class="bg-linear-to-r from-purple-600 to-violet-600 px-8 py-5 flex items-center justify-between">
            <div>
                <p class="text-purple-200 text-[11px] font-bold uppercase tracking-widest">Order Number</p>
                <p class="text-white font-heading font-bold text-xl mt-0.5" id="conf-order-num">—</p>
            </div>
            <div class="text-right">
                <p class="text-purple-200 text-[11px] font-bold uppercase tracking-widest">Date</p>
                <p class="text-white text-sm font-medium mt-0.5" id="conf-date">—</p>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-purple-500 mb-3">Shipping To</p>
                    <p class="font-bold text-midnight-900" id="conf-name">—</p>
                    <p class="text-sm text-midnight-900/50 mt-1" id="conf-address">—</p>
                    <p class="text-sm text-midnight-900/50" id="conf-phone">—</p>
                    <p class="text-sm text-midnight-900/50" id="conf-email">—</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-purple-500 mb-3">Payment</p>
                    <span id="conf-payment-badge" class="inline-block px-3 py-1 rounded-full text-xs font-bold">—</span>
                    <div class="mt-4 space-y-1">
                        <div class="flex justify-between text-sm text-midnight-900/55">
                            <span>Subtotal</span><span id="conf-subtotal">—</span>
                        </div>
                        <div class="flex justify-between text-sm text-midnight-900/55">
                            <span>Shipping</span><span id="conf-shipping">—</span>
                        </div>
                        <div class="flex justify-between font-bold text-midnight-900 border-t border-purple-50 pt-2 mt-2">
                            <span>Total</span><span id="conf-total">—</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Items --}}
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-purple-500 mb-4">Items Ordered</p>
                <div id="conf-items" class="space-y-3"></div>
            </div>
        </div>
    </div>

    {{-- Status Timeline --}}
    <div class="bg-white rounded-3xl border border-purple-100 p-8 mb-8">
        <h2 class="font-heading font-bold text-lg text-midnight-900 mb-6">Order Status</h2>
        <div class="relative">
            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-purple-100"></div>
            @foreach([
                ['Order Placed', 'Your order has been confirmed.', true],
                ['Processing',   'We\'re preparing your items.', false],
                ['Shipped',      'Your order is on the way.', false],
                ['Delivered',    'Successfully delivered.', false],
            ] as [$title,$desc,$done])
            <div class="relative flex items-start gap-5 mb-6 last:mb-0">
                <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center shrink-0 z-10 {{ $done ? 'bg-purple-600 border-purple-600' : 'bg-white border-purple-200' }}">
                    @if($done)
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M5 13l4 4L19 7"/></svg>
                    @else
                    <div class="w-2 h-2 rounded-full bg-purple-200"></div>
                    @endif
                </div>
                <div class="pt-0.5">
                    <p class="font-bold text-sm {{ $done ? 'text-purple-600' : 'text-midnight-900/40' }}">{{ $title }}</p>
                    <p class="text-xs text-midnight-900/35 mt-0.5">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- CTA Buttons --}}
    <div class="flex flex-wrap justify-center gap-4">
        <a href="{{ route('shop') }}" class="px-8 py-4 bg-purple-600 text-white font-bold text-sm rounded-2xl hover:bg-purple-700 btn-purple-glow transition-all active:scale-95">
            Continue Shopping
        </a>
        <a href="{{ route('order.track') }}" class="px-8 py-4 border-2 border-purple-200 text-purple-600 font-bold text-sm rounded-2xl hover:bg-purple-50 transition-all">
            Track Order
        </a>
        <button onclick="window.print()" class="px-8 py-4 border-2 border-midnight-900/10 text-midnight-900/50 font-bold text-sm rounded-2xl hover:bg-gray-50 transition-all">
            🖨 Print Receipt
        </button>
    </div>

</div>
</div>

<style>
@keyframes bounce-once { 0%,100%{transform:scale(1)} 30%{transform:scale(1.15)} }
.animate-bounce-once { animation: bounce-once .8s ease; }
@media print { header,footer,#checkout-btn,button { display:none!important; } }
</style>

<script>
const order = JSON.parse(sessionStorage.getItem('saaj_order') || 'null');
if (order) {
    document.getElementById('conf-order-num').textContent = order.number;
    document.getElementById('conf-date').textContent      = order.date;
    document.getElementById('conf-name').textContent      = order.name;
    document.getElementById('conf-address').textContent   = order.address;
    document.getElementById('conf-phone').textContent     = order.phone;
    document.getElementById('conf-email').textContent     = order.email;
    document.getElementById('conf-subtotal').textContent  = '₹' + order.subtotal.toLocaleString('en-IN');
    document.getElementById('conf-shipping').textContent  = order.shipping ? '₹' + order.shipping : 'FREE';
    document.getElementById('conf-total').textContent     = '₹' + order.total.toLocaleString('en-IN');

    const badge = document.getElementById('conf-payment-badge');
    badge.textContent = order.payment === 'cod' ? 'Cash on Delivery' : 'Online Payment';
    badge.className   = 'inline-block px-3 py-1 rounded-full text-xs font-bold ' + (order.payment === 'cod' ? 'bg-yellow-100 text-yellow-700' : 'bg-purple-100 text-purple-700');

    document.getElementById('conf-items').innerHTML = (order.items || []).map(i => `
        <div class="flex items-center justify-between py-3 border-b border-purple-50 last:border-0">
            <div>
                <p class="font-medium text-sm text-midnight-900">${i.product}</p>
                <p class="text-xs text-purple-400">${i.variant} × ${i.qty}</p>
            </div>
            <span class="font-bold text-sm text-midnight-900">₹${(i.price * i.qty).toLocaleString('en-IN')}</span>
        </div>
    `).join('');
}
</script>
@endsection
