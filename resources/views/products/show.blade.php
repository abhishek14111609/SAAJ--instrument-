@extends('layouts.app')

@section('title', $product->name . ' - SAAJ (instrument)')

@section('content')
<!-- ─── Product Detail ───────────────────────────────────────────── -->
<section class="py-24 bg-white min-h-screen">
    <div class="container mx-auto px-6">

        <!-- Breadcrumb -->
        <nav class="flex mb-16 text-xs font-semibold uppercase tracking-widest text-midnight-900/30">
            <a href="/" class="hover:text-purple-600 transition-colors">Home</a>
            <span class="mx-4">/</span>
            <span class="text-midnight-900/50">{{ $product->category->name }}</span>
            <span class="mx-4">/</span>
            <span class="text-midnight-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-20">

            <!-- Product Image -->
            <div class="relative group">
                <div class="absolute -inset-4 bg-purple-200/20 rounded-[3rem] blur-2xl group-hover:bg-purple-300/25 transition-all duration-700 pointer-events-none"></div>
                <div class="relative bg-purple-50/50 rounded-[2.5rem] overflow-hidden border border-purple-100 flex items-center justify-center p-12 aspect-square">
                    <img src="{{ asset('images/' . ($product->category->slug == 'wellness' ? 'honey.png' : 'spices.png')) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-1000">
                </div>
            </div>

            <!-- Product Details -->
            <div class="flex flex-col">
                <!-- Category label -->
                <span class="inline-block px-3 py-1 rounded-full bg-purple-100 text-purple-600 font-bold uppercase tracking-[0.2em] text-[10px] mb-6 w-fit">
                    {{ $product->category->name }} Collection
                </span>

                <h1 class="text-5xl md:text-6xl font-heading font-bold text-midnight-900 mb-8 leading-tight">
                    {{ $product->name }}
                </h1>

                <div class="prose prose-sm text-midnight-900/55 mb-12 leading-relaxed font-light max-w-md">
                    <p>{{ $product->description }}</p>
                    <p class="mt-4 italic text-purple-500 font-medium">Pure. Ethical. Artisanal.</p>
                </div>

                @if($product->variants->where('price', '>', 0)->count() > 0)
                <!-- Size Selector -->
                <div class="mb-10">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-midnight-900 mb-6">Select Size</h3>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($product->variants as $variant)
                        <button class="relative group/btn border-2 border-purple-100 rounded-2xl p-4 text-center hover:border-purple-400 hover:bg-purple-50/40 transition-all duration-300 cursor-pointer">
                            <span class="block text-[10px] font-bold text-midnight-900/40 uppercase mb-1">{{ $variant->name }}</span>
                            <span class="block text-xl font-bold text-midnight-900 font-heading">₹{{ number_format($variant->price, 0) }}</span>
                            <input type="radio" name="variant" value="{{ $variant->id }}" class="absolute inset-0 opacity-0 cursor-pointer">
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Add to Cart -->
                <div class="flex items-center gap-4">
                    <!-- Quantity -->
                    <div class="flex items-center border-2 border-purple-100 rounded-2xl overflow-hidden">
                        <button class="px-5 py-4 hover:bg-purple-50 transition-colors text-lg font-bold text-midnight-900">−</button>
                        <span class="px-4 font-bold text-midnight-900">1</span>
                        <button class="px-5 py-4 hover:bg-purple-50 transition-colors text-lg font-bold text-midnight-900">+</button>
                    </div>
                    <!-- CTA -->
                    <button class="flex-1 py-5 bg-midnight-900 text-white rounded-2xl font-bold uppercase tracking-widest text-xs hover:bg-purple-600 transition-all duration-300 shadow-xl hover:shadow-purple-500/30 active:scale-95">
                        Add to Collection
                    </button>
                </div>

                @else
                <!-- Pending pricing -->
                <div class="bg-purple-50/60 border border-purple-100 rounded-4xl p-10 text-center">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-100 text-purple-600 font-bold uppercase tracking-widest text-[10px] mb-5">
                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500 animate-pulse"></span>
                        Pricing Decision Pending
                    </span>
                    <p class="text-midnight-900/40 text-sm font-light leading-relaxed mt-2">
                        This item is currently undergoing final quality checks and packaging design. We'll be announcing the pricing soon.
                    </p>
                    <button class="mt-8 px-10 py-4 bg-purple-600 text-white rounded-2xl font-bold uppercase tracking-widest text-[10px] hover:bg-purple-700 btn-purple-glow transition-all active:scale-95">
                        Notify Me
                    </button>
                </div>
                @endif

                <!-- Meta Info -->
                <div class="mt-16 grid grid-cols-2 gap-8 pt-10 border-t border-purple-50">
                    <div>
                        <span class="block text-[10px] uppercase tracking-widest text-midnight-900/25 mb-2">Category</span>
                        <span class="text-xs font-bold text-midnight-900 underline decoration-purple-400 decoration-2 underline-offset-4">{{ $product->category->name }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] uppercase tracking-widest text-midnight-900/25 mb-2">Origin</span>
                        <span class="text-xs font-bold text-midnight-900">Kerala, Karnataka</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── More from SAAJ ────────────────────────────────────────────── -->
<section class="py-24 bg-purple-50/30 border-t border-purple-100">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-3xl font-heading font-bold text-midnight-900">More from SAAJ</h2>
            <a href="/" class="text-xs font-bold uppercase tracking-widest text-purple-500 hover:text-purple-700 transition-colors flex items-center gap-1">
                View All
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 opacity-40 grayscale pointer-events-none">
            @for($i = 0; $i < 4; $i++)
            <div class="bg-purple-50 rounded-2xl h-80 animate-pulse border border-purple-100"></div>
            @endfor
        </div>
    </div>
</section>
@endsection
