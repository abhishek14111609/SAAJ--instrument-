@extends('layouts.app')
@section('title','Contact Us – SAAJ (instrument)')

@section('content')
{{-- Hero --}}
<section class="py-20 bg-linear-to-br from-purple-50 via-white to-purple-100">
    <div class="container mx-auto px-6 text-center">
        <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">Get in Touch</span>
        <h1 class="text-4xl md:text-5xl font-heading font-bold text-midnight-900 mb-4">We'd Love to Hear <span class="gradient-text italic">From You</span></h1>
        <p class="text-midnight-900/45 text-sm max-w-md mx-auto">Questions, bulk orders, or just want to say hello — we're here for you.</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- Contact Info --}}
            <div class="space-y-5">
                @foreach([
                    ['📍','Visit Us','SAAJ (instrument) HQ<br>Bengaluru, Karnataka 560001<br>India'],
                    ['📞','Call Us','+91 98765 43210<br>Mon–Sat, 9am–6pm IST'],
                    ['✉️','Email Us','hello@saajoils.com<br>For general enquiries'],
                    ['📦','Bulk Orders','orders@saajoils.com<br>For wholesale & corporate orders'],
                ] as [$icon,$title,$info])
                <div class="flex gap-4 p-5 bg-purple-50/50 rounded-2xl border border-purple-100 hover:border-purple-300 hover:bg-white transition-all">
                    <div class="text-2xl shrink-0">{{ $icon }}</div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-purple-500 mb-1">{{ $title }}</p>
                        <p class="text-sm text-midnight-900/65 leading-relaxed">{!! $info !!}</p>
                    </div>
                </div>
                @endforeach

                {{-- Social --}}
                <div class="p-5 bg-midnight-900 rounded-2xl">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-purple-400 mb-4">Follow Us</p>
                    <div class="flex gap-3">
                        @foreach(['Instagram','WhatsApp','LinkedIn'] as $s)
                        <a href="#" class="flex-1 text-center py-2.5 bg-white/10 hover:bg-purple-500/30 rounded-xl text-white text-xs font-medium transition-all">{{ $s }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-2 bg-white rounded-3xl border border-purple-100 shadow-xl shadow-purple-100/30 p-8">
                <h2 class="font-heading font-bold text-2xl text-midnight-900 mb-6">Send us a Message</h2>
                <form id="contact-form" onsubmit="submitContact(event)" class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Full Name *</label>
                            <input type="text" id="c-name" required placeholder="Your name"
                                class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Phone</label>
                            <input type="tel" placeholder="+91 XXXXX XXXXX"
                                class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Email Address *</label>
                        <input type="email" id="c-email" required placeholder="you@email.com"
                            class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Subject *</label>
                        <select id="c-subject" required class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 text-sm text-midnight-900 outline-none transition-all bg-white">
                            <option value="">Choose topic…</option>
                            @foreach(['General Enquiry','Product Question','Bulk / Wholesale Order','Shipping & Delivery','Returns & Refunds','Other'] as $s)
                            <option>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-midnight-900/50 mb-1.5">Message *</label>
                        <textarea id="c-msg" required rows="5" placeholder="Tell us how we can help…"
                            class="w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 text-sm text-midnight-900 outline-none transition-all resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full py-4 bg-purple-600 text-white font-bold text-sm rounded-2xl hover:bg-purple-700 btn-purple-glow transition-all active:scale-95">
                        Send Message →
                    </button>
                </form>
                <div id="contact-success" class="hidden text-center py-10">
                    <div class="text-5xl mb-4">✅</div>
                    <h3 class="font-heading font-bold text-xl text-midnight-900 mb-2">Message Sent!</h3>
                    <p class="text-midnight-900/45 text-sm">We'll get back to you within 24 hours.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Map placeholder --}}
<section class="py-12 bg-purple-50/30">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="rounded-3xl bg-linear-to-br from-purple-100 to-purple-50 border border-purple-100 h-64 flex items-center justify-center">
            <div class="text-center">
                <div class="text-4xl mb-2">🗺️</div>
                <p class="text-midnight-900/40 text-sm font-medium">Map — Bengaluru, Karnataka, India</p>
                <a href="https://maps.google.com" target="_blank" class="text-purple-500 text-xs font-bold underline mt-1 block">Open in Google Maps →</a>
            </div>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 max-w-3xl">
        <h2 class="text-3xl font-heading font-bold text-midnight-900 text-center mb-12">Frequently Asked Questions</h2>
        <div class="space-y-4" id="faq-list">
            @foreach([
                ['Is your honey raw and unprocessed?','Yes! All our honeys are cold-extracted and lightly filtered to remove wax, without heating. This preserves all enzymes and nutritional properties.'],
                ['Do you ship across India?','Absolutely. We ship to all pin codes in India. Delivery takes 3–7 business days depending on your location.'],
                ['What is the shelf life of your products?','Honey has an indefinite shelf life if stored properly. Spices typically last 12–24 months in a cool, dry place.'],
                ['Can I place a bulk or corporate order?','Yes! Email us at orders@saajoils.com for wholesale pricing and custom packaging options.'],
                ["What's your return policy?","We offer hassle-free returns within 7 days of delivery for damaged or incorrect items. Contact us and we'll sort it out."],
            ] as [$q,$a])
            <div class="faq-item border border-purple-50 rounded-2xl overflow-hidden">
                <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between p-5 text-left hover:bg-purple-50/40 transition-all">
                    <span class="font-medium text-sm text-midnight-900 pr-4">{{ $q }}</span>
                    <svg class="faq-icon w-4 h-4 text-purple-500 shrink-0 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="faq-answer hidden px-5 pb-5 text-sm text-midnight-900/50 leading-relaxed border-t border-purple-50 pt-4">{{ $a }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
function submitContact(e) {
    e.preventDefault();
    const required = ['c-name','c-email','c-subject','c-msg'];
    let valid = true;
    required.forEach(id => {
        const el = document.getElementById(id);
        if (!el || !el.value.trim()) { el?.classList.add('border-red-400'); valid = false; }
        else el?.classList.remove('border-red-400');
    });
    if (!valid) { showToast('⚠ Please fill all required fields.'); return; }
    document.getElementById('contact-form').classList.add('hidden');
    document.getElementById('contact-success').classList.remove('hidden');
}

function toggleFaq(btn) {
    const item   = btn.closest('.faq-item');
    const answer = item.querySelector('.faq-answer');
    const icon   = item.querySelector('.faq-icon');
    const open   = !answer.classList.contains('hidden');
    // Close all
    document.querySelectorAll('.faq-answer').forEach(a => a.classList.add('hidden'));
    document.querySelectorAll('.faq-icon').forEach(i => i.style.transform = '');
    if (!open) { answer.classList.remove('hidden'); icon.style.transform = 'rotate(180deg)'; }
}
</script>
@endsection
