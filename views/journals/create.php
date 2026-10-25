<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center mb-16">
        <a href="<?= url('journals') ?>"
            class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 font-semibold mb-6 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Journal
        </a>
        <h1 class="text-5xl font-serif font-bold mb-6">
            <span class="gradient-text">New Entry</span>
        </h1>
        <p class="text-xl text-gray-600 font-light">Take a moment to reflect on your week.</p>
    </div>

    <div class="glass-strong rounded-3xl p-10 md:p-12 shadow-2xl border-2 border-purple-200">
        <?php if (!empty($error)): ?>
            <div class="p-4 mb-6 rounded-2xl bg-red-50 border border-red-200 text-red-700 font-medium text-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span><?= e($error) ?></span>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= url('journals/create') ?>" class="space-y-8">
            <?= csrf_field() ?>

            <!-- Mood Selection -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">How are you feeling?</label>
                <select name="mood" class="w-full px-5 py-4 rounded-2xl border-2 border-purple-200 bg-white text-base focus:border-purple-500 focus:outline-none">
                    <option value="">Select your mood (optional)...</option>
                    <option value="happy" <?= ($mood ?? '') === 'happy' ? 'selected' : '' ?>>😊 Happy</option>
                    <option value="calm" <?= ($mood ?? '') === 'calm' ? 'selected' : '' ?>>😌 Calm</option>
                    <option value="thoughtful" <?= ($mood ?? '') === 'thoughtful' ? 'selected' : '' ?>>🤔 Thoughtful</option>
                    <option value="grateful" <?= ($mood ?? '') === 'grateful' ? 'selected' : '' ?>>🙏 Grateful</option>
                    <option value="challenged" <?= ($mood ?? '') === 'challenged' ? 'selected' : '' ?>>💪 Challenged</option>
                    <option value="confused" <?= ($mood ?? '') === 'confused' ? 'selected' : '' ?>>😕 Confused</option>
                </select>
            </div>

            <!-- Content Area -->
            <div>
                <label for="journal_content" class="block text-lg font-bold text-gray-800 mb-4">Your Reflection</label>
                <div class="relative">
                    <textarea id="journal_content" name="content" required rows="12"
                        placeholder="Reflect on your week... What did you learn? How did you grow? (Minimum 150 words)"
                        class="w-full p-6 rounded-3xl border-2 border-purple-200 bg-white/90 font-sans text-lg leading-relaxed focus:border-purple-600 focus:outline-none focus:ring-4 focus:ring-purple-500/10 transition-all resize-y"><?= e($content ?? '') ?></textarea>
                    <div class="absolute bottom-4 right-4 text-sm text-gray-400 font-medium">
                        <span id="word-count">0</span> words (min 150)
                    </div>
                </div>
                <p class="mt-3 text-sm text-gray-500 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    Reflect on your experiences, learnings, and growth this week
                </p>
            </div>

            <!-- Tags -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Tags</label>
                <input type="text" name="tags" value="<?= e($tags ?? '') ?>"
                    placeholder="e.g. growth, challenges, gratitude (comma-separated)"
                    class="w-full px-5 py-4 rounded-2xl border-2 border-purple-200 bg-white text-base focus:border-purple-500 focus:outline-none">
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="<?= url('journals') ?>" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-semibold transition-colors">
                    Cancel
                </a>
                <button type="submit"
                    class="px-8 py-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-full text-lg font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Save Entry
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const textarea = document.getElementById('journal_content');
    const wordCount = document.getElementById('word-count');

    function updateWordCount() {
        const text = textarea.value.trim();
        const words = text ? text.split(/\s+/).length : 0;
        wordCount.textContent = words;
        if (words >= 150) {
            wordCount.classList.remove('text-red-500');
            wordCount.classList.add('text-emerald-600');
        } else {
            wordCount.classList.remove('text-emerald-600');
            wordCount.classList.add('text-gray-400');
        }
    }

    textarea.addEventListener('input', updateWordCount);
    updateWordCount();
</script>
