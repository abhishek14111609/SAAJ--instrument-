@extends('layouts.app')
@section('title','Track Order – SAAJ (instrument)')

@section('content')
<div class="min-h-screen bg-linear-to-br from-purple-50/40 via-white to-white py-20">
<div class="container mx-auto px-6 max-w-2xl">

    <div class="text-center mb-12">
        <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">Track Your Order</span>
        <h1 class="text-4xl font-heading font-bold text-midnight-900">Where's My Order?</h1>
        <p class="text-midnight-900/45 mt-3 text-sm">Enter your order number to see the latest status.</p>
    </div>

    {{-- Track Form --}}
    <div class="bg-white rounded-3xl border border-purple-100 p-8 mb-8 shadow-xl shadow-purple-100/30">
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Order Number *</label>
                <input type="text" id="track-num" placeholder="e.g. SAAJ-ABC123-28032026"
                    class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Email Address</label>
                <input type="email" id="track-email" placeholder="you@email.com"
                    class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
            </div>
            <button onclick="trackOrder()" class="w-full py-4 bg-purple-600 text-white font-bold text-sm rounded-2xl hover:bg-purple-700 btn-purple-glow transition-all active:scale-95">
                Track Order →
            </button>
        </div>
    </div>

    {{-- Result --}}
    <div id="track-result" class="hidden bg-white rounded-3xl border border-purple-100 p-8 shadow-xl shadow-purple-100/30">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-purple-500">Order</p>
                <p class="font-heading font-bold text-xl text-midnight-900 mt-0.5" id="tr-num">—</p>
            </div>
            <span id="tr-status-badge" class="px-4 py-1.5 rounded-full text-xs font-bold">—</span>
        </div>

        {{-- Timeline --}}
        <div class="relative mb-6" id="tr-timeline"></div>

        <div class="border-t border-purple-50 pt-5 grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-[10px] uppercase tracking-widest text-purple-400 font-bold mb-1">Customer</p>
                <p class="font-medium text-midnight-900" id="tr-name">—</p>
            </div>
            <div>
                <p class="text-[10px] uppercase tracking-widest text-purple-400 font-bold mb-1">Total</p>
                <p class="font-bold text-midnight-900" id="tr-total">—</p>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <a href="{{ route('contact') }}" class="flex-1 text-center py-3 border border-purple-200 text-purple-600 rounded-2xl text-xs font-bold uppercase tracking-widest hover:bg-purple-50 transition-all">
                Contact Support
            </a>
            <a href="{{ route('shop') }}" class="flex-1 text-center py-3 bg-purple-600 text-white rounded-2xl text-xs font-bold uppercase tracking-widest hover:bg-purple-700 transition-all">
                Shop More
            </a>
        </div>
    </div>

    {{-- Not found --}}
    <div id="track-not-found" class="hidden text-center py-8 bg-red-50 rounded-3xl border border-red-100">
        <p class="text-red-500 font-bold mb-2">Order not found</p>
        <p class="text-sm text-midnight-900/40">Please check your order number and try again.</p>
    </div>

    {{-- Help --}}
    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach([
            ['🚚','Delivery Time','3–7 business days across India'],
            ['📦','Free Shipping','On orders above ₹500'],
            ['🔄','Easy Returns','Within 7 days of delivery'],
        ] as [$icon,$title,$desc])
        <div class="bg-white rounded-2xl border border-purple-50 p-5 text-center hover:border-purple-200 transition-all">
            <div class="text-2xl mb-2">{{ $icon }}</div>
            <p class="font-bold text-sm text-midnight-900">{{ $title }}</p>
            <p class="text-xs text-midnight-900/40 mt-1">{{ $desc }}</p>
        </div>
        @endforeach
    </div>

</div>
</div>

<script>
const STATUS_STEPS = {
    pending:    0, processing: 1, shipped: 2, delivered: 3, cancelled: -1
};
const STATUS_LABELS = ['Order Placed','Processing','Shipped','Delivered'];

function trackOrder() {
    const num   = document.getElementById('track-num').value.trim();
    const email = document.getElementById('track-email').value.trim();
    if (!num) { showToast('⚠ Please enter an order number.'); return; }

    // Try to match last placed order from sessionStorage
    const last = JSON.parse(sessionStorage.getItem('saaj_order') || 'null');
    if (last && last.number.toUpperCase() === num.toUpperCase()) {
        showTrackResult({
            number: last.number, name: last.name, total: '₹' + last.total.toLocaleString('en-IN'),
            status: 'pending',
        });
    } else {
        document.getElementById('track-result').classList.add('hidden');
        document.getElementById('track-not-found').classList.remove('hidden');
    }
}

function showTrackResult(order) {
    document.getElementById('track-not-found').classList.add('hidden');
    document.getElementById('track-result').classList.remove('hidden');
    document.getElementById('tr-num').textContent   = order.number;
    document.getElementById('tr-name').textContent  = order.name;
    document.getElementById('tr-total').textContent = order.total;

    const statusMap = {pending:'bg-yellow-100 text-yellow-700', processing:'bg-purple-100 text-purple-700', shipped:'bg-blue-100 text-blue-700', delivered:'bg-green-100 text-green-700'};
    const badge = document.getElementById('tr-status-badge');
    badge.textContent = order.status.charAt(0).toUpperCase() + order.status.slice(1);
    badge.className   = 'px-4 py-1.5 rounded-full text-xs font-bold ' + (statusMap[order.status] || 'bg-gray-100 text-gray-600');

    const step = STATUS_STEPS[order.status];
    const tl   = document.getElementById('tr-timeline');
    tl.innerHTML = `<div class="absolute left-4 top-0 bottom-0 w-0.5 bg-purple-50"></div>` +
        STATUS_LABELS.map((l, i) => `
        <div class="relative flex items-center gap-4 mb-5 last:mb-0">
            <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center shrink-0 z-10 ${i <= step ? 'bg-purple-600 border-purple-600' : 'bg-white border-purple-100'}">
                ${i <= step ? '<svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M5 13l4 4L19 7"/></svg>' : `<div class="w-2 h-2 rounded-full bg-purple-100"></div>`}
            </div>
            <span class="text-sm font-medium ${i <= step ? 'text-purple-700' : 'text-midnight-900/30'}">${l}</span>
        </div>
    `).join('');
}
</script>
@endsection
