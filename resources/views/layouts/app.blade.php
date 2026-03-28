<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SAAJ (instrument) – Ethically sourced artisanal honey & spices from Kerala and Karnataka. 100% pure, lab-certified, traditionally crafted.">
    <title>@yield('title', 'SAAJ (instrument) – Artisanal Honey & Spices')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── Announcement bar shimmer ── */
        .announcement-bar {
            background: linear-gradient(90deg, #6d28d9, #a855f7, #7c3aed, #6d28d9);
            background-size: 300% auto;
            animation: bar-shimmer 5s linear infinite;
        }
        @keyframes bar-shimmer { to { background-position: 300% center; } }

        /* ── Nav hover underline ── */
        .nav-link { position: relative; }
        .nav-link::after {
            content: ''; position: absolute; bottom: -2px; left: 0;
            width: 0; height: 2px; background: #a855f7; border-radius: 2px;
            transition: width .3s ease;
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link.active { color: #7c3aed; }

        /* ── Mobile menu ── */
        #mobile-menu { transform: translateX(-100%); transition: transform .35s ease; }
        #mobile-menu.open { transform: translateX(0); }

        /* ── Toast notification ── */
        #toast {
            position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 9999;
            background: #1a0a2e; color: #fff; padding: .85rem 1.4rem;
            border-radius: 1rem; font-size: .82rem; font-weight: 500;
            border-left: 4px solid #a855f7; opacity: 0;
            transform: translateY(12px); transition: all .35s ease;
            pointer-events: none; max-width: 320px;
        }
        #toast.show { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="antialiased bg-white font-sans text-midnight-900">

<!-- ── Announcement Bar ────────────────────────────────────── -->
<div class="announcement-bar text-white text-center text-[11px] py-2.5 font-medium tracking-widest">
    ✦ FREE shipping on orders above ₹500 &nbsp;·&nbsp; Ethically sourced &nbsp;·&nbsp; 100% Pure ✦
</div>

<!-- ── Header ─────────────────────────────────────────────── -->
<header id="site-header" class="sticky top-0 z-50 glass border-b border-purple-100 transition-all duration-300">
    <nav class="container mx-auto px-4 lg:px-6 py-3.5 flex items-center justify-between gap-4">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0 group">
            <div class="w-9 h-9 rounded-xl bg-linear-to-br from-purple-500 to-violet-600 flex items-center justify-center shadow group-hover:shadow-purple-400/40 transition-all">
                <span class="text-white text-xs font-black">S</span>
            </div>
            <span class="text-lg font-heading font-bold text-midnight-900 leading-none">
                SAAJ <span class="text-[10px] font-sans font-light tracking-widest text-purple-500 uppercase">(instrument)</span>
            </span>
        </a>

        <!-- Desktop Nav -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-midnight-900/70">
            <a href="{{ route('home') }}"    class="nav-link hover:text-purple-600 transition-colors {{ request()->routeIs('home')    ? 'active' : '' }}">Home</a>
            <a href="{{ route('shop') }}"    class="nav-link hover:text-purple-600 transition-colors {{ request()->routeIs('shop')    ? 'active' : '' }}">Shop</a>
            <a href="{{ route('about') }}"   class="nav-link hover:text-purple-600 transition-colors {{ request()->routeIs('about')   ? 'active' : '' }}">About</a>
            <a href="{{ route('contact') }}" class="nav-link hover:text-purple-600 transition-colors {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </div>

        <!-- Right actions -->
        <div class="flex items-center gap-2">
            <!-- Search -->
            <a href="{{ route('shop') }}" class="hidden md:flex w-9 h-9 rounded-xl hover:bg-purple-50 items-center justify-center text-midnight-900/60 hover:text-purple-600 transition-all" title="Search">
                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
            </a>

            <!-- Wishlist -->
            <a href="{{ route('wishlist') }}" class="hidden md:flex w-9 h-9 rounded-xl hover:bg-purple-50 items-center justify-center text-midnight-900/60 hover:text-purple-600 transition-all" title="Wishlist">
                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            </a>

            <!-- Cart -->
            <a href="{{ route('cart') }}" class="relative w-9 h-9 rounded-xl hover:bg-purple-50 flex items-center justify-center text-midnight-900/60 hover:text-purple-600 transition-all" title="Cart">
                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/></svg>
                <span id="cart-count-badge" class="absolute -top-1 -right-1 bg-violet-600 text-white text-[9px] w-4.5 h-4.5 rounded-full items-center justify-center font-black leading-none hidden" style="display:none">0</span>
            </a>

            <!-- Account -->
            <a href="{{ route('login') }}" class="hidden md:flex w-9 h-9 rounded-xl hover:bg-purple-50 items-center justify-center text-midnight-900/60 hover:text-purple-600 transition-all" title="Account">
                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </a>

            <!-- Order Now CTA -->
            <a href="{{ route('shop') }}" class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 bg-purple-600 text-white text-xs font-bold rounded-xl hover:bg-purple-700 transition-all btn-purple-glow active:scale-95">
                Shop Now
            </a>

            <!-- Mobile hamburger -->
            <button id="menu-btn" class="md:hidden w-9 h-9 rounded-xl hover:bg-purple-50 flex items-center justify-center transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </nav>
</header>

<!-- ── Mobile Slide-in Menu ───────────────────────────────── -->
<div id="mobile-menu" class="fixed inset-y-0 left-0 z-60 w-72 bg-white shadow-2xl flex flex-col">
    <div class="flex items-center justify-between px-6 py-5 border-b border-purple-50">
        <span class="font-heading font-bold text-lg">Menu</span>
        <button id="menu-close" class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center hover:bg-purple-100 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
    </div>
    <nav class="flex flex-col gap-1 p-4 flex-1">
        @foreach([['home','Home'],['shop','Shop'],['about','About'],['contact','Contact'],['cart','Cart'],['wishlist','Wishlist'],['login','Login / Register']] as [$r,$l])
        <a href="{{ route($r) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-purple-50 text-midnight-900/70 hover:text-purple-600 font-medium transition-all text-sm">{{ $l }}</a>
        @endforeach
    </nav>
    <div class="p-4 border-t border-purple-50">
        <a href="{{ route('shop') }}" class="block text-center py-3 bg-purple-600 text-white rounded-xl font-bold text-sm hover:bg-purple-700 transition-all">Shop Now</a>
    </div>
</div>
<div id="menu-overlay" class="fixed inset-0 z-55 bg-black/30 hidden backdrop-blur-sm"></div>

<!-- ── Flash message ──────────────────────────────────────── -->
@if(session('success'))
<div class="bg-purple-50 border-b border-purple-100 text-purple-700 text-sm text-center py-2.5 font-medium">
    {{ session('success') }}
</div>
@endif

<main>
    @yield('content')
</main>

<!-- ── Footer ─────────────────────────────────────────────── -->
<footer class="bg-midnight-900 text-white pt-20 pb-10 relative overflow-hidden">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-violet-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-10 mb-16 border-b border-white/10 pb-16">
            <!-- Brand col -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-xl bg-linear-to-br from-purple-500 to-violet-600 flex items-center justify-center">
                        <span class="text-white font-black text-sm">S</span>
                    </div>
                    <span class="font-heading text-xl font-bold">SAAJ <span class="text-[10px] font-sans font-light tracking-widest uppercase text-purple-400">(instrument)</span></span>
                </div>
                <p class="text-white/45 text-sm font-light leading-relaxed max-w-xs">
                    Ethically sourced and traditionally crafted honey and spices from Kerala and Karnataka. Purity is our promise.
                </p>
                <div class="flex gap-3 mt-7">
                    @foreach(['instagram','whatsapp'] as $s)
                    <a href="#" class="w-9 h-9 rounded-xl bg-white/5 hover:bg-purple-500/25 flex items-center justify-center transition-all border border-white/10 hover:border-purple-500/40 text-white/50 hover:text-white">
                        @if($s=='instagram')
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        @else
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        @endif
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Links -->
            @foreach([
                'Quick Links' => [['home','Home'],['shop','Shop'],['about','About Us'],['contact','Contact']],
                'Categories'  => [['shop','Wellness Honey'],['shop','Spices'],['shop','Powders & Blends'],['shop','Gift Sets']],
                'Support'     => [['cart','My Cart'],['order.track','Track Order'],['contact','FAQ'],['contact','Returns']],
            ] as $title => $links)
            <div>
                <h3 class="text-xs font-bold uppercase tracking-widest text-purple-400 mb-5">{{ $title }}</h3>
                <ul class="space-y-3">
                    @foreach($links as [$r,$l])
                    <li><a href="{{ route($r) }}" class="text-sm text-white/45 hover:text-purple-300 transition-colors">{{ $l }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>

        <!-- Newsletter mini -->
        <div class="bg-white/5 rounded-2xl p-6 mb-12 flex flex-col md:flex-row items-center justify-between gap-4 border border-white/10">
            <div>
                <p class="font-heading font-bold text-lg mb-1">Stay in the loop</p>
                <p class="text-sm text-white/40">New arrivals, seasonal drops & exclusive offers.</p>
            </div>
            <form class="flex gap-2 w-full md:w-auto" onsubmit="return false;">
                <input type="email" placeholder="your@email.com"
                    class="flex-1 md:w-56 px-4 py-2.5 rounded-xl bg-white/10 border border-white/15 text-sm text-white placeholder-white/30 focus:outline-none focus:border-purple-400 transition-all">
                <button class="px-5 py-2.5 bg-purple-600 text-white text-sm font-bold rounded-xl hover:bg-purple-500 transition-all">Subscribe</button>
            </form>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-3 text-xs text-white/20 tracking-widest">
            <span>&copy; {{ \Carbon\Carbon::now()->year }} SAAJ (instrument). Handcrafted with care.</span>
            <span class="flex gap-4">
                <a href="#" class="hover:text-white/50 transition-colors">Privacy</a>
                <a href="#" class="hover:text-white/50 transition-colors">Terms</a>
            </span>
        </div>
    </div>
</footer>

<!-- ── Toast ──────────────────────────────────────────────── -->
<div id="toast"></div>

<script>
// ── Cart (localStorage) ─────────────────────────────────────────────
const CART_KEY = 'saaj_cart';

function getCart()  { try { return JSON.parse(localStorage.getItem(CART_KEY)) || []; } catch { return []; } }
function saveCart(c){ localStorage.setItem(CART_KEY, JSON.stringify(c)); }

function updateBadge() {
    const count = getCart().reduce((s, i) => s + i.qty, 0);
    const badge = document.getElementById('cart-count-badge');
    if (!badge) return;
    badge.textContent = count;
    badge.classList.toggle('hidden', count === 0);
}

function showToast(msg) {
    const t = document.getElementById('toast');
    t.textContent = msg; t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3000);
}

function addToCart(item) {
    const cart = getCart();
    const idx  = cart.findIndex(i => i.variant_id === item.variant_id);
    if (idx > -1) { cart[idx].qty += item.qty; }
    else { cart.push(item); }
    saveCart(cart);
    updateBadge();
    showToast('✓ ' + item.product + ' added to cart!');
}

window.addToCart = addToCart;
updateBadge();

// ── Mobile menu ─────────────────────────────────────────────────────
const menuBtn     = document.getElementById('menu-btn');
const menuClose   = document.getElementById('menu-close');
const mobileMenu  = document.getElementById('mobile-menu');
const menuOverlay = document.getElementById('menu-overlay');

function openMenu()  { mobileMenu.classList.add('open'); menuOverlay.classList.remove('hidden'); }
function closeMenu() { mobileMenu.classList.remove('open'); menuOverlay.classList.add('hidden'); }

menuBtn?.addEventListener('click', openMenu);
menuClose?.addEventListener('click', closeMenu);
menuOverlay?.addEventListener('click', closeMenu);

// ── Sticky header shrink ─────────────────────────────────────────────
window.addEventListener('scroll', () => {
    document.getElementById('site-header')?.style.setProperty(
        'box-shadow', window.scrollY > 60 ? '0 4px 30px rgba(147,51,234,.08)' : 'none'
    );
});
</script>
</body>
</html>
