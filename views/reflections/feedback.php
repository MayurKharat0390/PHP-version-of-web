<div class="max-w-4xl mx-auto px-4 py-20">
    <div class="text-center mb-16">
        <span class="inline-block px-4 py-2 glass rounded-full text-xs font-bold tracking-widest uppercase text-purple-600 mb-4 shadow-glass">Daily Practice</span>
        <h1 class="text-5xl md:text-6xl font-serif font-bold mb-6">
            <span class="gradient-text">Reflection Captured</span>
        </h1>
        <p class="text-xl text-gray-600 font-light">Thank you for pausing to reflect today.</p>
    </div>

    <div class="relative group">
        <div class="absolute -inset-1 bg-gradient-to-r from-primary-400 via-indigo-500 to-accent-400 rounded-[3rem] blur-xl opacity-40 group-hover:opacity-60 transition duration-1000"></div>

        <div class="relative glass-strong rounded-[2.5rem] shadow-3d overflow-hidden p-10 md:p-16">

            <!-- Chosen Option -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-gradient-to-br from-teal-400 to-primary-600 text-white mb-8 shadow-lg">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-serif font-bold mb-4 text-gray-800">You chose:</h3>
                <p class="text-xl text-gray-600 italic font-medium bg-white/60 rounded-2xl px-6 py-4 inline-block">
                    "<?= e($selected_option['option_text'] ?? '') ?>"
                </p>
            </div>

            <!-- Reflective Insight -->
            <div class="glass-strong rounded-3xl p-10 md:p-12 shadow-lg relative overflow-hidden mb-12 border-2 border-accent-200">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-accent-400 via-accent-500 to-accent-600"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-accent-400 to-accent-600 flex items-center justify-center text-white shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-accent-600 uppercase tracking-wider">Reflective Insight</h4>
                    </div>

                    <p class="text-2xl font-serif text-gray-800 leading-relaxed">
                        <?= e($scenario['explanation'] ?? '') ?>
                    </p>
                </div>
            </div>

            <!-- Connected Value + Actions -->
            <div class="flex flex-col items-center justify-center space-y-6">
                <div class="text-center glass-strong px-10 py-8 rounded-3xl shadow-lg border-2 border-primary-200">
                    <span class="text-gray-500 text-sm font-bold uppercase tracking-wider block mb-3">Connected Value</span>
                    <p class="text-4xl font-serif font-bold bg-gradient-to-r from-primary-600 to-teal-600 bg-clip-text text-transparent">
                        <?= e($scenario['related_value'] ?? '') ?>
                    </p>
                </div>

                <a href="<?= url('') ?>"
                    class="mt-4 px-8 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-full font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all text-base">
                    ← Back to Home
                </a>
            </div>

        </div>
    </div>
</div>
