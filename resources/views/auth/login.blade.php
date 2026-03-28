@extends('layouts.app')
@section('title','Login – SAAJ (instrument)')

@section('content')
<div class="min-h-screen bg-linear-to-br from-purple-50 via-white to-purple-100 flex items-center justify-center py-20 px-4">
<div class="w-full max-w-md">

    {{-- Logo --}}
    <div class="text-center mb-10">
        <div class="w-16 h-16 bg-linear-to-br from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl shadow-purple-500/25">
            <span class="text-white font-black text-2xl font-heading">S</span>
        </div>
        <h1 class="text-3xl font-heading font-bold text-midnight-900">Welcome back</h1>
        <p class="text-midnight-900/45 text-sm mt-2">Sign in to your SAAJ account</p>
    </div>

    <div class="bg-white rounded-3xl shadow-2xl shadow-purple-100/50 border border-purple-50 p-8">
        <form onsubmit="handleLogin(event)" class="space-y-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Email Address</label>
                <input type="email" id="l-email" required placeholder="you@email.com"
                    class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Password</label>
                <div class="relative">
                    <input type="password" id="l-pass" required placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all pr-12">
                    <button type="button" onclick="togglePwd('l-pass')" class="absolute right-3 top-1/2 -translate-y-1/2 text-midnight-900/30 hover:text-purple-500 transition-colors">
                        <svg id="l-pass-eye" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                <div class="text-right mt-1.5">
                    <a href="#" class="text-xs text-purple-500 hover:text-purple-700 transition-colors">Forgot password?</a>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="remember" class="w-4 h-4 accent-purple-600 rounded cursor-pointer">
                <label for="remember" class="text-sm text-midnight-900/55 cursor-pointer">Remember me</label>
            </div>

            <button type="submit" class="w-full py-4 bg-purple-600 text-white font-bold text-sm rounded-2xl hover:bg-purple-700 btn-purple-glow transition-all active:scale-95">
                Sign In →
            </button>

            {{-- Divider --}}
            <div class="flex items-center gap-3 text-xs text-midnight-900/25">
                <div class="flex-1 h-px bg-purple-50"></div>or continue with<div class="flex-1 h-px bg-purple-50"></div>
            </div>

            {{-- Social login --}}
            <div class="grid grid-cols-2 gap-3">
                @foreach(['Google','WhatsApp'] as $s)
                <button type="button" class="flex items-center justify-center gap-2 py-3 border border-purple-100 rounded-xl text-sm font-medium text-midnight-900/70 hover:bg-purple-50 hover:border-purple-200 transition-all">
                    {{ $s }}
                </button>
                @endforeach
            </div>
        </form>
    </div>

    <p class="text-center text-sm text-midnight-900/45 mt-6">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-purple-600 font-bold hover:text-purple-700 transition-colors">Create one →</a>
    </p>
    <p class="text-center text-xs text-midnight-900/25 mt-4">
        <a href="{{ route('home') }}" class="hover:text-purple-500 transition-colors">← Continue browsing without login</a>
    </p>
</div>
</div>

<script>
function handleLogin(e) {
    e.preventDefault();
    showToast('👋 Login feature coming soon! Continue shopping as guest.');
    setTimeout(() => window.location.href = '{{ route('home') }}', 1500);
}
function togglePwd(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endsection
