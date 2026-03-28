@extends('layouts.app')
@section('title','Shop – SAAJ (instrument)')

@section('content')
{{-- ── Hero Banner ── --}}
<section class="bg-linear-to-br from-purple-50 via-white to-purple-100 py-14">
    <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <span class="inline-block px-3 py-1 rounded-full bg-purple-100 text-purple-600 text-[10px] font-bold uppercase tracking-widest mb-4">All Products</span>
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-midnight-900 leading-tight">Our <span class="gradient-text italic">Collection</span></h1>
            <p class="text-midnight-900/50 mt-3 text-sm max-w-md">Explore our full range of ethically sourced honey and artisanal spices.</p>
        </div>
        <div class="flex items-center gap-3 text-sm">
            <span class="text-midnight-900/40">Sort by:</span>
            <select id="sort-select" onchange="sortProducts(this.value)" class="px-3 py-2 border border-purple-100 rounded-xl text-sm text-midnight-900 bg-white focus:outline-none focus:border-purple-400">
                <option value="">Latest</option>
                <option value="price_asc">Price: Low → High</option>
                <option value="price_desc">Price: High → Low</option>
                <option value="name_asc">Name A–Z</option>
            </select>
        </div>
    </div>
</section>

{{-- ── Filter + Grid ── --}}
<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Sidebar Filters --}}
            <aside class="w-full lg:w-56 shrink-0">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-purple-50/60 rounded-2xl p-5 border border-purple-100">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-midnight-900 mb-4">Category</h3>
                        <div class="space-y-2.5">
                            @foreach(['all'=>'All Products','wellness'=>'Wellness Honey','spices'=>'Spices','powders'=>'Powders & Blends'] as $k=>$v)
                            <label class="flex items-center gap-2.5 cursor-pointer group">
                                <input type="radio" name="cat-filter" value="{{ $k }}" {{ $k==='all'?'checked':'' }}
                                    onchange="filterCategory('{{ $k }}')"
                                    class="w-3.5 h-3.5 accent-purple-600 cursor-pointer">
                                <span class="text-sm text-midnight-900/65 group-hover:text-purple-600 transition-colors">{{ $v }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-purple-50/60 rounded-2xl p-5 border border-purple-100">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-midnight-900 mb-4">Price Range</h3>
                        <input type="range" min="0" max="2000" value="2000" id="price-range"
                            onchange="document.getElementById('price-val').textContent='₹'+this.value"
                            class="w-full accent-purple-600">
                        <p class="text-xs text-midnight-900/50 mt-2">Up to <span id="price-val">₹2000</span></p>
                    </div>

                    <a href="{{ route('home') }}#wellness" class="block text-center py-2.5 border-2 border-purple-200 text-purple-600 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-purple-600 hover:text-white hover:border-purple-600 transition-all">
                        Reset Filters
                    </a>
                </div>
            </aside>

            {{-- Product Grid --}}
            <div class="flex-1">
                {{-- Search bar --}}
                <div class="mb-8 relative">
                    <input type="text" id="search-input" placeholder="Search products…"
                        onkeyup="searchProducts(this.value)"
                        class="w-full pl-11 pr-4 py-3 border border-purple-100 rounded-2xl text-sm text-midnight-900 focus:outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 bg-purple-50/30 transition-all">
                    <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                </div>

                <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
                    @php
                        $minPrice = $product->variants->where('price','>',0)->min('price');
                        $firstVariant = $product->variants->where('price','>',0)->first();
                    @endphp
                    <div class="product-card group bg-white rounded-3xl border border-purple-50 hover:border-purple-200 hover:shadow-xl hover:shadow-purple-100/60 transition-all duration-500 overflow-hidden flex flex-col"
                         data-name="{{ strtolower($product->name) }}"
                         data-category="{{ $product->category->slug }}"
                         data-price="{{ $minPrice ?? 0 }}">
                        <a href="{{ route('product.show', $product->slug) }}">
                            <div class="relative h-48 bg-linear-to-br from-purple-50 to-purple-100/40 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('images/' . ($product->category->slug === 'wellness' ? 'honey.png' : 'spices.png')) }}"
                                     alt="{{ $product->name }}"
                                     class="h-36 object-contain transform group-hover:scale-110 transition-transform duration-700">
                                @if($product->category->slug === 'wellness')
                                <span class="absolute top-3 left-3 px-2.5 py-1 bg-purple-600 text-white text-[9px] font-bold uppercase tracking-wider rounded-full">Wellness</span>
                                @else
                                <span class="absolute top-3 left-3 px-2.5 py-1 bg-violet-600 text-white text-[9px] font-bold uppercase tracking-wider rounded-full">Spice</span>
                                @endif
                            </div>
                        </a>
                        <div class="p-5 flex flex-col flex-1">
                            <span class="text-[10px] text-purple-500 font-bold uppercase tracking-widest mb-1">{{ $product->category->name }}</span>
                            <a href="{{ route('product.show', $product->slug) }}">
                                <h3 class="font-heading font-bold text-midnight-900 text-lg mb-2 group-hover:text-purple-600 transition-colors leading-snug">{{ $product->name }}</h3>
                            </a>
                            <p class="text-midnight-900/45 text-xs leading-relaxed mb-4 flex-1">{{ Str::limit($product->description, 70) }}</p>

                            @if($minPrice)
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs text-midnight-900/40">From</span>
                                <span class="text-xl font-bold font-heading text-midnight-900">₹{{ number_format($minPrice, 0) }}</span>
                            </div>
                            {{-- Quick Add --}}
                            @if($firstVariant)
                            <button onclick="addToCart({
                                    variant_id:{{ $firstVariant->id }},
                                    product:'{{ addslashes($product->name) }}',
                                    variant:'{{ addslashes($firstVariant->name) }}',
                                    price:{{ $firstVariant->price }},
                                    qty:1,
                                    slug:'{{ $product->slug }}'
                                })"
                                class="w-full py-3 bg-purple-50 text-purple-700 font-bold text-xs uppercase tracking-widest rounded-2xl border border-purple-100 hover:bg-purple-600 hover:text-white hover:border-purple-600 transition-all duration-300 active:scale-95">
                                Add to Cart
                            </button>
                            @endif
                            @else
                            <a href="{{ route('product.show', $product->slug) }}"
                               class="w-full py-3 text-center border-2 border-dashed border-purple-200 text-purple-500 font-bold text-xs uppercase tracking-widest rounded-2xl hover:bg-purple-50 transition-all">
                                View Details
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <p id="no-results" class="hidden text-center text-midnight-900/40 py-16 text-sm">No products found. <a href="{{ route('shop') }}" class="text-purple-500 underline">Reset search</a></p>
            </div>
        </div>
    </div>
</section>

<script>
function searchProducts(q) {
    q = q.toLowerCase().trim();
    let count = 0;
    document.querySelectorAll('.product-card').forEach(card => {
        const match = card.dataset.name.includes(q);
        card.style.display = match ? '' : 'none';
        if (match) count++;
    });
    document.getElementById('no-results').classList.toggle('hidden', count > 0);
}
function filterCategory(cat) {
    document.querySelectorAll('.product-card').forEach(card => {
        card.style.display = (cat === 'all' || card.dataset.category === cat) ? '' : 'none';
    });
}
function sortProducts(val) {
    const grid  = document.getElementById('product-grid');
    const cards = Array.from(document.querySelectorAll('.product-card'));
    cards.sort((a, b) => {
        if (val === 'price_asc')  return +a.dataset.price - +b.dataset.price;
        if (val === 'price_desc') return +b.dataset.price - +a.dataset.price;
        if (val === 'name_asc')   return a.dataset.name.localeCompare(b.dataset.name);
        return 0;
    });
    cards.forEach(c => grid.appendChild(c));
}
</script>
@endsection
