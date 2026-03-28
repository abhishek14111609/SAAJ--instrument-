@extends('layouts.app')
@section('title','About Us – SAAJ (instrument)')

@section('content')
{{-- Hero --}}
<section class="relative py-32 bg-linear-to-br from-purple-50 via-white to-purple-100 overflow-hidden">
    <div class="absolute -top-32 -right-32 w-[600px] h-[600px] bg-purple-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-3xl">
            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 text-[10px] font-bold uppercase tracking-widest rounded-full mb-6">Our Story</span>
            <h1 class="text-5xl md:text-7xl font-heading font-bold text-midnight-900 leading-tight mb-8">
                Purity as an<br><span class="gradient-text italic">Instrument</span> of Life.
            </h1>
            <p class="text-lg text-midnight-900/55 leading-relaxed max-w-xl font-light">
                We believe what you consume is more than food — it's a tool for harmony, health, and connection to nature.
            </p>
        </div>
    </div>
</section>

{{-- Brand Values --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['🌿','Ethically Sourced','Every product is traced back to its origin — small farms, ethical beekeepers, and sustainable forests across Kerala and Karnataka.'],
                ['🔬','Lab Tested','Each batch undergoes rigorous quality testing to confirm purity, authenticity, and nutritional integrity before it reaches you.'],
                ['🏺','Traditionally Crafted','We honour age-old methods of honey extraction and spice preparation that have been passed down through generations.'],
            ] as [$icon,$title,$desc])
            <div class="group p-8 rounded-3xl border border-purple-50 hover:border-purple-200 hover:shadow-xl hover:shadow-purple-100/40 transition-all duration-500">
                <div class="text-4xl mb-5">{{ $icon }}</div>
                <h3 class="font-heading font-bold text-xl text-midnight-900 mb-3">{{ $title }}</h3>
                <p class="text-midnight-900/50 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Story --}}
<section class="py-24 bg-purple-50/40">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-purple-500 mb-4 block">Our Philosophy</span>
                <h2 class="text-4xl font-heading font-bold text-midnight-900 mb-6">Why "Instrument"?</h2>
                <p class="text-midnight-900/55 leading-relaxed mb-5 font-light">
                    Just as a perfectly tuned instrument produces pure music, pure nutrients produce vibrant health. We named ourselves SAAJ — the Hindi/Sanskrit word for "instrument" — to remind ourselves and our customers that what you consume is a sacred tool.
                </p>
                <p class="text-midnight-900/55 leading-relaxed font-light">
                    From the dense Nilgiri forests where our rare honeys are harvested, to the small-batch organic spice farms in the Western Ghats, every step is short, traceable, and transparent.
                </p>
                <div class="flex flex-wrap gap-4 mt-8">
                    @foreach(['100% Natural','No Additives','Ethically Traded','Lab Certified'] as $tag)
                    <span class="px-4 py-2 bg-white border border-purple-100 text-purple-600 text-xs font-bold rounded-full">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-purple-200/20 rounded-[3rem] blur-2xl pointer-events-none"></div>
                <img src="{{ asset('images/honey.png') }}" alt="SAAJ Honey"
                     class="relative rounded-3xl w-full aspect-square object-contain bg-purple-50 border border-purple-100 p-8">
            </div>
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="py-24 bg-midnight-900 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 text-center">
            @foreach([['100%','Pure Honey'],['24+','Farm Partners'],['12+','Honey Varieties'],['5000+','Happy Customers']] as [$n,$l])
            <div>
                <div class="text-4xl md:text-5xl font-heading font-bold gradient-text mb-2">{{ $n }}</div>
                <div class="text-xs uppercase tracking-widest text-white/35 font-medium">{{ $l }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Team --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 text-center">
        <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">The People</span>
        <h2 class="text-4xl font-heading font-bold text-midnight-900 mb-4">Rooted in Values</h2>
        <p class="text-midnight-900/45 max-w-xl mx-auto text-sm mb-16">We are a small, passionate team that believes in the power of nature's pure ingredients.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-3xl mx-auto">
            @foreach([
                ['Founder','Kerala, India',"A beekeeper's son turned entrepreneur, committed to bringing honest honey to every home."],
                ['Head of Sourcing','Karnataka, India',"Spends months each year visiting farms to personally verify quality and ethical practices."],
                ['Quality Lead','Tamil Nadu, India',"Oversees lab testing and batch certification for every product line."],
            ] as [$role,$loc,$bio])
            <div class="group p-7 rounded-3xl border border-purple-50 hover:border-purple-200 hover:shadow-xl hover:shadow-purple-100/40 transition-all duration-500 text-left">
                <div class="w-16 h-16 bg-linear-to-br from-purple-400 to-violet-600 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <p class="font-bold text-purple-600 text-[10px] uppercase tracking-widest mb-1">{{ $role }}</p>
                <p class="text-xs text-midnight-900/35 mb-3">{{ $loc }}</p>
                <p class="text-sm text-midnight-900/55 leading-relaxed">{{ $bio }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-24 bg-linear-to-br from-purple-600 to-violet-700 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,...')] opacity-5 pointer-events-none"></div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="text-4xl font-heading font-bold mb-4">Ready to Experience Purity?</h2>
        <p class="text-purple-100/70 text-lg mb-10 max-w-md mx-auto">Explore our full collection of artisanal honey and spices, crafted with care.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('shop') }}" class="px-10 py-4 bg-white text-purple-700 font-bold rounded-2xl hover:bg-purple-50 transition-all active:scale-95">
                Shop Now →
            </a>
            <a href="{{ route('contact') }}" class="px-10 py-4 border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/10 transition-all">
                Get in Touch
            </a>
        </div>
    </div>
</section>
@endsection
