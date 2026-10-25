<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <!-- Header Section -->
    <div class="text-center mb-20">
        <div class="inline-flex items-center gap-2 px-4 py-2 glass rounded-full text-xs font-bold uppercase tracking-wider text-purple-600 mb-6">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
            </svg>
            Personal Growth
        </div>
        <h1 class="text-5xl md:text-6xl font-serif font-bold mb-6">
            <span class="gradient-text">My UHV Journal</span>
        </h1>
        <p class="text-xl text-gray-600 font-light max-w-2xl mx-auto">
            A private space for weekly reflections and personal growth tracking.
        </p>
    </div>

    <!-- Privacy Notice -->
    <div class="max-w-3xl mx-auto mb-12">
        <div class="glass-strong p-6 rounded-2xl border-2 border-purple-200 flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center flex-shrink-0 shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-gray-800 text-lg mb-1">Private & Confidential</h3>
                <p class="text-gray-600 text-base">This journal is for self-reflection, not evaluation. Your entries are visible only to you.</p>
            </div>
        </div>
    </div>

    <!-- Create New Entry Button -->
    <div class="max-w-3xl mx-auto mb-16 text-center">
        <a href="<?= url('journals/create') ?>"
            class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-full text-lg font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            New Journal Entry
        </a>
    </div>

    <!-- Journal Entries List -->
    <div class="max-w-4xl mx-auto">
        <?php if (!empty($entries)): ?>
        <div class="space-y-6">
            <?php foreach ($entries as $entry): ?>
            <a href="<?= url('journals/' . $entry['id']) ?>"
                class="group card-3d glass-strong rounded-3xl p-8 shadow-lg hover:shadow-2xl border-2 border-transparent hover:border-purple-200 transition-all block">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            <?= format_date($entry['created_at'], 'd') ?>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Week <?= format_date($entry['created_at'], 'W') ?> Reflection</h3>
                            <p class="text-sm text-gray-500"><?= format_date($entry['created_at'], 'F j, Y • g:i A') ?></p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-xs font-bold uppercase tracking-wider">
                            <?= word_count($entry['content']) ?> words
                        </span>
                        <?php if (!empty($entry['mood'])): ?>
                            <span class="text-2xl"><?= \App\Models\Journal::getMoodDisplay($entry['mood']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="prose prose-lg max-w-none mb-4">
                    <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line line-clamp-3">
                        <?= e(substr($entry['content'], 0, 200)) ?>...
                    </p>
                </div>

                <?php if (!empty($entry['tags'])): ?>
                <div class="flex flex-wrap gap-2 mb-4">
                    <?php foreach (explode(',', $entry['tags']) as $tag): if(trim($tag) !== ''): ?>
                        <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-xs font-semibold">#<?= e(trim($tag)) ?></span>
                    <?php endif; endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="text-purple-600 font-semibold group-hover:text-purple-700 transition-colors flex items-center gap-2">
                    <span>Read Entry</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-20 glass-strong rounded-3xl shadow-glass">
            <p class="text-xl text-gray-600 font-serif">No journal entries yet.</p>
            <p class="text-gray-500 mt-2">Start your reflection journey by adding your first entry above.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
