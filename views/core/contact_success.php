<div class="max-w-2xl mx-auto px-4 py-24 text-center">
    <div class="glass-strong rounded-[2.5rem] p-12 shadow-2xl border border-white/50">
        <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-6 shadow-inner">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h1 class="text-4xl font-serif font-bold text-gray-900 mb-4">Message Sent!</h1>
        <p class="text-xl text-gray-600 mb-8 font-light leading-relaxed">
            Thank you <?= !empty($name) ? '<strong>' . e($name) . '</strong>, ' : '' ?>for reaching out to the UHV Cell. We have received your inquiry and our team will get back to you shortly.
        </p>
        <a href="<?= url('') ?>"
            class="inline-flex items-center gap-2 px-8 py-4 bg-primary-600 text-white rounded-2xl font-bold hover:bg-primary-500 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
            Return to Home
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
    </div>
</div>
