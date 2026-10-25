<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <a href="<?= url('journals') ?>"
        class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 font-semibold mb-8 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Journal
    </a>

    <div class="glass-strong rounded-3xl p-10 md:p-12 shadow-2xl">
        <!-- Header -->
        <div class="flex items-start justify-between mb-8 pb-6 border-b border-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                    <?= format_date($entry['created_at'], 'd') ?>
                </div>
                <div>
                    <h1 class="text-3xl font-serif font-bold text-gray-800 mb-2">
                        Week <?= format_date($entry['created_at'], 'W') ?> Reflection
                    </h1>
                    <p class="text-gray-500"><?= format_date($entry['created_at'], 'F j, Y \a\t g:i A') ?></p>
                </div>
            </div>
            <div class="flex flex-col items-end gap-2">
                <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-bold">
                    <?= word_count($entry['content']) ?> words
                </span>
                <?php if (!empty($entry['mood'])): ?>
                    <span class="text-3xl"><?= \App\Models\Journal::getMoodDisplay($entry['mood']) ?></span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tags -->
        <?php if (!empty($entry['tags'])): ?>
        <div class="flex flex-wrap gap-2 mb-8">
            <?php foreach (explode(',', $entry['tags']) as $tag): if(trim($tag) !== ''): ?>
                <span class="px-4 py-2 bg-purple-50 text-purple-600 rounded-full text-sm font-semibold">#<?= e(trim($tag)) ?></span>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="prose prose-lg max-w-none">
            <p class="text-xl text-gray-800 leading-relaxed whitespace-pre-line"><?= e($entry['content']) ?></p>
        </div>

        <!-- Footer -->
        <div class="mt-12 pt-6 border-t border-gray-200 flex items-center justify-between">
            <p class="text-sm text-gray-500">
                Created on <?= format_date($entry['created_at'], 'F j, Y') ?>
            </p>
            <a href="<?= url('journals') ?>"
                class="px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-full font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                View All Entries
            </a>
        </div>
    </div>
</div>
