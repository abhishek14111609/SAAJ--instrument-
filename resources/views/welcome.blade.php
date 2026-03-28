@extends('layouts.app')

@section('content')

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║ HERO with animated headline + hero image ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <section class="relative min-h-[92vh] flex items-center overflow-hidden bg-linear-to-br from-white via-purple-50/40 to-purple-100/60">
        {{-- Decorative blobs --}}
        <div class="absolute -top-32 -right-32 w-[700px] h-[700px] bg-purple-300/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 left-0 w-96 h-96 bg-violet-300/10 rounded-full blur-3xl pointer-events-none"></div>

        {{-- Hero image (right) --}}
        <div class="absolute right-0 inset-y-0 w-1/2 pointer-events-none">
            <img src="{{ asset('images/hero.png') }}" alt="Artisanal honey & spices"
                 class="w-full h-full object-cover opacity-30 scale-105 animate-subtle-zoom">
            <div class="absolute inset-0 bg-linear-to-r from-white via-purple-50/80 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 py-20">
            <div class="max-w-2xl" id="hero-content">
                {{-- Badge --}}
                <div class="flex items-center gap-2 mb-8">
                    <span class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-purple-100 border border-purple-200 text-purple-700 text-[10px] font-bold uppercase tracking-widest animate-fade-in-up">
                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500 animate-pulse"></span>
                        Artisanal · Ethical · Pure
                    </span>
                    <span class="px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-[10px] font-bold tracking-wider animate-fade-in-up">
                        ✓ Lab Certified
                    </span>
                </div>

                {{-- Headline --}}
                <h1 class="text-5xl sm:text-6xl md:text-8xl font-heading font-bold text-midnight-900 leading-[1.02] mb-8 animate-fade-in-up delay-100">
                    Nature's finest<br>
                    <span class="gradient-text italic">Instruments</span>
                </h1>

                <p class="text-lg text-midnight-950 font-medium mb-10 max-w-lg leading-relaxed animate-fade-in-up delay-200">
                    Ethically sourced honey and spices from Kerala & Karnataka — processed with traditional techniques to preserve every drop of nature's goodness.
                </p>

                {{-- CTAs --}}
                <div class="flex flex-wrap gap-4 mb-12 animate-fade-in-up delay-300">
                    <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-purple-600 text-white rounded-2xl font-semibold hover:bg-purple-700 btn-purple-glow transition-all active:scale-95 text-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/></svg>
                        Shop Now
                    </a>
                    <a href="{{ route('about') }}" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-midnight-900/20 text-midnight-900 rounded-2xl font-semibold hover:border-purple-400 hover:text-purple-600 transition-all active:scale-95 text-sm">
                        Our Story
                    </a>
                </div>

                {{-- Social proof --}}
                <div class="flex flex-wrap items-center gap-6 animate-fade-in-up delay-300">
                    <div class="flex -space-x-2">
                        @for($i = 0; $i < 5; $i++)
                            <div class="w-8 h-8 rounded-full bg-purple-500 border-2 border-white flex items-center justify-center text-white text-[10px] font-black">{{ chr(65 + $i) }}</div>
                        @endfor
                    </div>
                    <div>
                        <div class="flex gap-0.5 mb-0.5">
                            @for($i = 0; $i < 5; $i++)<span class="text-yellow-400 text-sm">★</span>@endfor
                        </div>
                        <p class="text-[11px] text-midnight-900/45"><strong class="text-midnight-900">5,000+</strong> happy customers</p>
                    </div>
                    <div class="hidden sm:block w-px h-8 bg-midnight-900/20"></div>
                    @foreach(['100%\nPure', 'Free\nShipping', 'Lab\nTested'] as $b)
                        <div class="text-[10px] text-midnight-900/60 font-bold leading-tight hidden sm:block">{!! nl2br($b) !!}</div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Scroll cue --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce text-midnight-900/25">
            <span class="text-[9px] uppercase tracking-widest">Scroll</span>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/></svg>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  ANNOUNCEMENT STRIP  (like Eros category strip)         ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <section class="py-10 bg-white border-y border-purple-50 overflow-hidden">
        <div class="flex gap-12 animate-marquee whitespace-nowrap">
            @foreach(['🍯 Raw Honey', '🌿 Moringa Honey', '🌺 Litchi Honey', '🫙 Drumstick Honey', '🌶 Black Pepper', '🌱 Cardamom', '🍂 Turmeric', '🧄 Kashmiri Chilli', '🫚 Coriander', '🌿 Ajwain'] as $item)
                <span class="inline-flex items-center gap-2 text-sm font-medium text-midnight-900/55 hover:text-purple-600 transition-colors cursor-default">
                    {{ $item }}
                </span>
                <span class="text-purple-200 font-bold">✦</span>
            @endforeach
            {{-- Duplicate for infinite loop --}}
            @foreach(['🍯 Raw Honey', '🌿 Moringa Honey', '🌺 Litchi Honey', '🫙 Drumstick Honey', '🌶 Black Pepper', '🌱 Cardamom', '🍂 Turmeric', '🧄 Kashmiri Chilli', '🫚 Coriander', '🌿 Ajwain'] as $item)
                <span class="inline-flex items-center gap-2 text-sm font-medium text-midnight-900/55 hover:text-purple-600 transition-colors cursor-default">
                    {{ $item }}
                </span>
                <span class="text-purple-200 font-bold">✦</span>
            @endforeach
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  FEATURE HIGHLIGHTS  (3 pillars)                        ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <section class="py-20 bg-purple-50/30">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                        ['🔬', 'Lab-Certified Purity', 'Every batch is independently tested for heavy metals, adulteration, and nutritional content.'],
                        ['🌍', 'Direct Trade', 'We source directly from farmers and beekeepers — no middlemen, full traceability.'],
                        ['🏺', 'Traditional Craft', 'Cold extraction, slow sun-drying, and hand-grinding preserve maximum nutrients & flavour.'],
                    ] as [$icon, $title, $desc])
                    <div class="group flex gap-5 p-7 bg-white rounded-3xl border border-purple-50 hover:border-purple-200 hover:shadow-xl hover:shadow-purple-100/40 transition-all duration-500">
                        <div class="text-3xl shrink-0 group-hover:scale-110 transition-transform duration-300">{{ $icon }}</div>
                        <div>
                            <h3 class="font-heading font-bold text-lg text-midnight-900 mb-2">{{ $title }}</h3>
                            <p class="text-midnight-900/50 text-sm leading-relaxed">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  CATEGORY SHOWCASE  (Bento-style cards like Eros)       ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-14">
                <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">Explore</span>
                <h2 class="text-4xl md:text-5xl font-heading font-bold text-midnight-900">Shop by Category</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Category card 1 --}}
                <a href="{{ route('shop') }}?category=wellness"
                   class="group relative rounded-4xl overflow-hidden bg-midnight-900 p-10 flex flex-col justify-end min-h-96 hover:shadow-2xl hover:shadow-purple-500/30 transition-all duration-500">
                    {{-- Background Image --}}
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/honey.png') }}" class="w-full h-full object-cover scale-110 group-hover:scale-125 transition-transform duration-1000 opacity-50">
                        {{-- Dark Overlay --}}
                        <div class="absolute inset-0 bg-linear-to-t from-midnight-900 via-midnight-900/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                    </div>
                    {{-- Content --}}
                    <div class="relative z-10">
                        <span class="inline-block px-3 py-1 bg-purple-500/30 text-purple-200 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4 border border-purple-400/30 backdrop-blur-md">Collection I</span>
                        <h3 class="text-4xl font-heading font-bold text-white mb-3 tracking-tight">Wellness Honey</h3>
                        <p class="text-purple-100/60 text-sm mb-6 max-w-xs leading-relaxed font-light">Raw, medicinal & seasonal varieties from the deep forests of Kerala.</p>
                        <span class="inline-flex items-center gap-3 text-white text-xs font-bold uppercase tracking-widest group-hover:gap-5 transition-all outline-hidden">
                            Explore Collection <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </a>

                {{-- Category card 2 + 2 small --}}
                <div class="grid grid-rows-2 gap-6">
                    <a href="{{ route('shop') }}?category=spices"
                       class="group relative rounded-4xl overflow-hidden bg-midnight-900 p-8 flex flex-col justify-end hover:shadow-2xl hover:shadow-violet-500/30 transition-all duration-500 min-h-48">
                        <div class="absolute inset-0">
                            <img src="{{ asset('images/spices.png') }}" class="w-full h-full object-cover scale-110 group-hover:scale-125 transition-transform duration-1000 opacity-40">
                            <div class="absolute inset-0 bg-linear-to-t from-midnight-900 via-midnight-900/20 to-transparent opacity-70 group-hover:opacity-80 transition-opacity"></div>
                        </div>
                        <div class="relative z-10">
                            <span class="inline-block px-3 py-1 bg-violet-500/30 text-violet-200 text-[10px] font-bold uppercase tracking-widest rounded-full mb-3 border border-violet-400/30 backdrop-blur-md">Collection II</span>
                            <h3 class="text-2xl font-heading font-bold text-white mb-2 tracking-tight">Earthy Spices</h3>
                            <p class="text-violet-100/50 text-xs mb-4 font-light max-w-[200px]">Authentic whole & powdered spices from the Western Ghats.</p>
                            <span class="inline-flex items-center gap-2 text-white text-[10px] font-bold uppercase tracking-widest group-hover:gap-3 transition-all">Shop <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                        </div>
                    </a>
                    <div class="grid grid-cols-2 gap-6">
                        @foreach([
                                ['🎁', 'Gift Sets', 'Curated bundles', 'from-purple-500/5 to-violet-500/5', 'border-purple-100'],
                                ['🌿', 'Seasonal', 'Limited drops', 'from-violet-500/5 to-purple-500/5', 'border-violet-100']
                            ] as [$icon, $t, $d, $grad, $bor])
                            <a href="{{ route('shop') }}" class="group rounded-4xl bg-linear-to-br {{ $grad }} border {{ $bor }} hover:border-purple-300 hover:bg-white hover:shadow-2xl hover:shadow-purple-100/60 p-6 flex flex-col justify-between transition-all duration-500">
                                <span class="text-4xl transform group-hover:rotate-12 transition-transform">{{ $icon }}</span>
                                <div>
                                    <h4 class="font-heading font-bold text-midnight-900 group-hover:text-purple-600 transition-colors text-lg mb-1">{{ $t }}</h4>
                                    <p class="text-xs text-midnight-900/40 font-light">{{ $d }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  WELLNESS PRODUCTS  (dynamic from DB)                   ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <section id="wellness" class="py-24 bg-purple-50/40 relative overflow-hidden">
        <div class="absolute -top-20 right-0 w-72 h-72 bg-purple-200/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">Featured</span>
                    <h2 class="text-4xl md:text-5xl font-heading font-bold text-midnight-900">Wellness Honey</h2>
                    <p class="text-midnight-900/60 mt-3 max-w-md font-medium">Raw, medicinal, and seasonal honeys reflecting the flora of their origin.</p>
                </div>
                <a href="{{ route('shop') }}" class="shrink-0 inline-flex items-center gap-2 px-6 py-3 border-2 border-purple-200 text-purple-600 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-purple-600 hover:text-white hover:border-purple-600 transition-all">
                    View All <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($categories->where('slug', 'wellness')->first()?->products ?? [] as $product)
                    <div class="group bg-white rounded-3xl p-8 border border-purple-100/60 hover:border-purple-300/40 hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden relative flex flex-col">
                        <div class="absolute -top-8 -right-8 w-32 h-32 bg-purple-100 rounded-full blur-3xl opacity-0 group-hover:opacity-50 transition-opacity duration-700 pointer-events-none"></div>
                        <div class="h-32 bg-purple-50 rounded-2xl flex items-center justify-center mb-6 border border-purple-50 group-hover:border-purple-100 transition-all overflow-hidden">
                            <img src="{{ asset('images/honey.png') }}" alt="{{ $product->name }}" class="h-24 object-contain group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <a href="{{ route('product.show', $product->slug) }}">
                            <h3 class="text-xl font-heading font-bold mb-3 text-midnight-900 group-hover:text-purple-600 transition-colors leading-snug">{{ $product->name }}</h3>
                        </a>
                        <p class="text-midnight-900/40 text-xs mb-6 leading-relaxed flex-1">{{ Str::limit($product->description, 80) }}</p>
                        <div class="space-y-2 mb-6">
                            @foreach($product->variants as $variant)
                                <div class="flex justify-between items-center text-sm border-b border-purple-50 pb-2 last:border-0">
                                    <span class="text-midnight-900/55">{{ $variant->name }}</span>
                                    <span class="font-bold text-midnight-900">₹{{ number_format($variant->price, 0) }}</span>
                                </div>
                            @endforeach
                        </div>
                        @php $v = $product->variants->where('price', '>', 0)->first(); @endphp
                        @if($v)
                            <button onclick="addToCart({variant_id:{{ $v->id }},product:'{{ addslashes($product->name) }}',variant:'{{ addslashes($v->name) }}',price:{{ $v->price }},qty:1,slug:'{{ $product->slug }}'})"
                                class="w-full py-3.5 bg-purple-50 text-purple-600 font-bold text-xs uppercase tracking-widest rounded-2xl border border-purple-100 group-hover:bg-purple-600 group-hover:text-white group-hover:border-purple-600 transition-all duration-300 active:scale-95">
                                Add to Cart
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  SPICES SECTION  (dynamic)                              ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <section id="spices" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-purple-100/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16 max-w-xl mx-auto">
                <span class="inline-block px-3 py-1 bg-violet-100 text-violet-600 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">Spice Garden</span>
                <h2 class="text-4xl md:text-5xl font-heading font-bold text-midnight-900 mb-4">Earthy Spices</h2>
                <p class="text-midnight-900/45 font-light">Authentic whole and powdered spices from the verdant Western Ghats.</p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($categories->where('slug', 'spices')->first()?->products ?? [] as $product)
                    <div class="group relative bg-purple-50/50 rounded-2xl p-6 border border-transparent hover:border-purple-100 hover:bg-white hover:shadow-xl hover:shadow-purple-100/40 transition-all duration-500 overflow-hidden">
                        <a href="{{ route('product.show', $product->slug) }}">
                            <div class="w-full aspect-square bg-white rounded-xl mb-5 flex items-center justify-center border border-purple-50 group-hover:border-purple-100 transition-all overflow-hidden">
                                <img src="{{ asset('images/spices.png') }}" alt="{{ $product->name }}" class="h-20 object-contain group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <h4 class="font-heading font-bold text-midnight-900 mb-1 group-hover:text-purple-600 transition-colors leading-snug">{{ $product->name }}</h4>
                        </a>
                        <p class="text-midnight-900/30 text-[10px] uppercase tracking-widest mb-3">Coming Soon</p>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-between border-t border-purple-50 pt-3">
                            <span class="text-[10px] font-bold text-purple-500 uppercase tracking-widest">Pricing Soon</span>
                            <svg class="w-4 h-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  TESTIMONIALS                                           ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <section class="py-24 bg-purple-50/40">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">Testimonials</span>
                <h2 class="text-4xl font-heading font-bold text-midnight-900">What Our Customers Say</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                        ['Priya M.', 'Bengaluru', 'The Litchi honey is unlike anything I\'ve tasted! Floral, delicate, and 100% real. No crystallization tricks — just pure honey.', '5'],
                        ['Ankit R.', 'Mumbai', 'Bought the spice combo for my mum. She loved it. The Kashmiri chilli is so fragrant! Will definitely reorder.', '5'],
                        ['Dr. Sneha K.', 'Kochi', 'As a nutritionist I\'m very picky. SAAJ\'s raw Moringa honey passed my lab test with flying colours. Highly recommended.', '5'],
                    ] as [$name, $city, $review, $stars])
                    <div class="group bg-white p-7 rounded-3xl border border-purple-50 hover:border-purple-200 hover:shadow-xl hover:shadow-purple-100/40 transition-all duration-500">
                        <div class="flex gap-0.5 mb-4">
                            @for($i = 0; $i < 5; $i++)<span class="text-yellow-400">★</span>@endfor
                        </div>
                        <p class="text-midnight-900/65 text-sm leading-relaxed mb-6 italic">"{{ $review }}"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-linear-to-br from-purple-400 to-violet-600 flex items-center justify-center text-white font-black text-sm">{{ substr($name, 0, 1) }}</div>
                            <div>
                                <p class="font-bold text-sm text-midnight-900">{{ $name }}</p>
                                <p class="text-xs text-midnight-900/55">{{ $city }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  PHILOSOPHY  dark section                               ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <section class="py-32 bg-midnight-900 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-purple-600/12 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-violet-500/8 rounded-full blur-3xl pointer-events-none"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <h2 class="text-4xl md:text-6xl font-heading font-bold mb-10 leading-tight">
                    Purity as an<br><span class="gradient-text italic">Instrument</span> of Life.
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                    <p class="text-white/70 font-medium leading-relaxed">Why "instrument"? Because we believe that what you consume is a tool — a medium through which your body maintains harmony. Just as a perfectly tuned instrument produces pure music, pure nutrients produce vibrant health.</p>
                    <p class="text-white/70 font-medium leading-relaxed">From the dense forests where our honey is harvested to the small-batch organic farms in the Western Ghats, SAAJ ensures that the path from soil to soul is short, ethical, and transparent.</p>
                </div>
                <div class="flex flex-wrap gap-10">
                    @foreach([['100%', 'Pure Raw Honey'], ['24+', 'Farm Partners'], ['5000+', 'Happy Customers'], ['Heritage', 'Traditional Craft']] as [$n, $l])
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-heading font-bold gradient-text mb-1">{{ $n }}</div>
                            <div class="text-[10px] uppercase tracking-widest text-white/50 font-bold">{{ $l }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  NEWSLETTER CTA                                         ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <section class="py-20 bg-linear-to-br from-purple-600 to-violet-700 relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            @for($i = 0; $i < 6; $i++)
                <div class="absolute rounded-full bg-white/5" style="width:{{ rand(100, 350) }}px;height:{{ rand(100, 350) }}px;top:{{ rand(0, 100) }}%;left:{{ rand(0, 100) }}%;transform:translate(-50%,-50%);filter:blur(60px)"></div>
            @endfor
        </div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-white mb-3">Stay in the Loop</h2>
            <p class="text-purple-100/65 text-sm mb-8 max-w-md mx-auto">New harvests, seasonal drops, and exclusive subscriber offers delivered to your inbox.</p>
            <form class="flex max-w-md mx-auto gap-3" onsubmit="subscribeNewsletter(event)">
                <input type="email" id="nl-email" placeholder="your@email.com" required
                    class="flex-1 px-5 py-3.5 rounded-xl bg-white/15 border border-white/25 text-white placeholder-white/40 text-sm focus:outline-none focus:border-white/60 transition-all">
                <button type="submit" class="px-6 py-3.5 bg-white text-purple-700 font-bold text-sm rounded-xl hover:bg-purple-50 transition-all active:scale-95">
                    Subscribe
                </button>
            </form>
            <p class="text-purple-200/40 text-[11px] mt-4">No spam. Unsubscribe anytime.</p>
        </div>
    </section>

    <style>
      @keyframes subtle-zoom { 0%{transform:scale(1)}100%{transform:scale(1.08)} }
      .animate-subtle-zoom { animation: subtle-zoom 18s linear infinite alternate; }
      @keyframes fade-in-up { from{opacity:0;transform:translateY(28px)}to{opacity:1;transform:translateY(0)} }
      .animate-fade-in-up { opacity:0; animation: fade-in-up .9s ease-out forwards; }
      .delay-100 { animation-delay:.2s } .delay-200 { animation-delay:.4s } .delay-300 { animation-delay:.65s }
      #hero-content { opacity:0; animation: fade-in-up .9s ease-out forwards; }

      @keyframes marquee { 0%{transform:translateX(0)}100%{transform:translateX(-50%)} }
      .animate-marquee { display:flex; width:max-content; animation: marquee 30s linear infinite; }
      .animate-marquee:hover { animation-play-state:paused; }
    </style>

    <script>
    function subscribeNewsletter(e) {
        e.preventDefault();
        showToast('🎉 Thank you for subscribing!');
        document.getElementById('nl-email').value = '';
    }
    </script>
@endsection