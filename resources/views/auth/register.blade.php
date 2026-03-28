@extends('layouts.app')
@section('title','Register – SAAJ (instrument)')

@section('content')
<div class="min-h-screen bg-linear-to-br from-purple-50 via-white to-purple-100 flex items-center justify-center py-20 px-4">
<div class="w-full max-w-md">

    <div class="text-center mb-10">
        <div class="w-16 h-16 bg-linear-to-br from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl shadow-purple-500/25">
            <span class="text-white font-black text-2xl font-heading">S</span>
        </div>
        <h1 class="text-3xl font-heading font-bold text-midnight-900">Create Account</h1>
        <p class="text-midnight-900/45 text-sm mt-2">Join the SAAJ community</p>
    </div>

    <div class="bg-white rounded-3xl shadow-2xl shadow-purple-100/50 border border-purple-50 p-8">
        <form onsubmit="handleRegister(event)" class="space-y-5">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">First Name</label>
                    <input type="text" required placeholder="Rahul"
                        class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Last Name</label>
                    <input type="text" required placeholder="Sharma"
                        class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Email Address</label>
                <input type="email" id="r-email" required placeholder="you@email.com"
                    class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Phone Number</label>
                <input type="tel" placeholder="+91 98765 43210"
                    class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Password</label>
                <div class="relative">
                    <input type="password" id="r-pass" required placeholder="Min. 8 characters"
                        class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all pr-12">
                    <button type="button" onclick="togglePwd('r-pass')" class="absolute right-3 top-1/2 -translate-y-1/2 text-midnight-900/30 hover:text-purple-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                {{-- Strength bar --}}
                <div class="h-1 bg-purple-50 rounded-full mt-2 overflow-hidden">
                    <div id="pwd-strength-bar" class="h-full rounded-full transition-all duration-500 w-0"></div>
                </div>
                <p class="text-[10px] text-midnight-900/30 mt-1" id="pwd-strength-label"></p>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Confirm Password</label>
                <input type="password" id="r-pass2" required placeholder="Repeat password"
                    class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
            </div>

            <div class="flex items-start gap-2">
                <input type="checkbox" id="terms" required class="mt-0.5 w-4 h-4 accent-purple-600 cursor-pointer shrink-0">
                <label for="terms" class="text-xs text-midnight-900/55 cursor-pointer leading-relaxed">
                    I agree to SAAJ's <a href="#" class="text-purple-500 underline">Terms of Service</a> and <a href="#" class="text-purple-500 underline">Privacy Policy</a>
                </label>
            </div>

            <button type="submit" class="w-full py-4 bg-purple-600 text-white font-bold text-sm rounded-2xl hover:bg-purple-700 btn-purple-glow transition-all active:scale-95">
                Create Account →
            </button>
        </form>
    </div>

    <p class="text-center text-sm text-midnight-900/45 mt-6">
        Already have an account?
        <a href="{{ route('login') }}" class="text-purple-600 font-bold hover:text-purple-700 transition-colors">Sign in →</a>
    </p>
</div>
</div>

<script>
document.getElementById('r-pass').addEventListener('input', function() {
    const p = this.value, bar = document.getElementById('pwd-strength-bar'), lbl = document.getElementById('pwd-strength-label');
    let score = 0;
    if (p.length >= 8) score++;
    if (/[A-Z]/.test(p)) score++;
    if (/[0-9]/.test(p)) score++;
    if (/[^A-Za-z0-9]/.test(p)) score++;
    const levels = [['', ''], ['w-1/4 bg-red-400', 'Weak'], ['w-2/4 bg-yellow-400', 'Fair'], ['w-3/4 bg-purple-400', 'Good'], ['w-full bg-green-500', 'Strong']];
    const [cls, label] = levels[score];
    bar.className = 'h-full rounded-full transition-all duration-500 ' + cls;
    lbl.textContent = label;
});
function handleRegister(e) {
    e.preventDefault();
    const p1 = document.getElementById('r-pass').value, p2 = document.getElementById('r-pass2').value;
    if (p1 !== p2) { showToast('⚠ Passwords do not match.'); return; }
    showToast('🎉 Account registration coming soon!');
    setTimeout(() => window.location.href = '{{ route('home') }}', 1500);
}
function togglePwd(id) { const i = document.getElementById(id); i.type = i.type === 'password' ? 'text' : 'password'; }
</script>
@endsection
