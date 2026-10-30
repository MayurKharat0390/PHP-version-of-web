<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="glass-strong rounded-3xl p-12 shadow-2xl text-center">
        <!-- Success Icon -->
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-gradient-to-br from-teal-400 to-teal-600 mb-8 shadow-lg">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <h1 class="text-4xl font-serif font-bold mb-6">
            <span class="gradient-text">Already Completed! ✨</span>
        </h1>

        <p class="text-2xl text-gray-700 mb-4 font-medium">
            You've already completed your daily reflection today!
        </p>

        <p class="text-lg text-gray-600 mb-8">
            Great job staying consistent! 🎉 Come back tomorrow for a new reflection scenario.
        </p>

        <!-- Stats Box -->
        <div class="glass p-6 rounded-2xl mb-8 max-w-md mx-auto">
            <div class="flex items-center justify-center gap-4">
                <div class="text-center">
                    <div class="text-3xl font-serif font-bold text-teal-600 mb-1">1</div>
                    <div class="text-sm text-gray-600">Reflection Today</div>
                </div>
                <div class="w-px h-12 bg-gray-300"></div>
                <div class="text-center">
                    <div class="text-3xl font-serif font-bold text-purple-600 mb-1">✓</div>
                    <div class="text-sm text-gray-600">Daily Goal Met</div>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="glass p-6 rounded-2xl border-2 border-teal-200 mb-8">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center text-white flex-shrink-0 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="text-left flex-1">
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Why One Per Day?</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Daily reflections are designed to be thoughtful and meaningful. Taking time to reflect deeply once a day is more valuable than rushing through multiple scenarios.
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?= url('') ?>"
                class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-full text-lg font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Back to Home
            </a>

            <a href="<?= url('resources') ?>"
                class="inline-flex items-center justify-center gap-2 px-8 py-4 glass-strong text-gray-700 rounded-full text-lg font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Explore Resources
            </a>
        </div>
    </div>
</div>
