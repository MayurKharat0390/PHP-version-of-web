<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <a href="<?= url('resources') ?>"
        class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-semibold mb-8 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Resources
    </a>

    <div class="glass-strong rounded-3xl p-10 md:p-12 shadow-2xl">
        <?php
        $categories = \App\Models\Resource::getCategories();
        $catLabel = $categories[$resource['category']] ?? ucfirst($resource['category'] ?? '');
        $typeLabel = \App\Models\Resource::getTypeDisplay($resource['resource_type'] ?? 'link');
        ?>
        <div class="flex items-center gap-3 mb-6">
            <span class="px-4 py-2 bg-emerald-50 text-emerald-700 text-sm font-bold uppercase tracking-wider rounded-full">
                <?= e($catLabel) ?>
            </span>
            <span class="px-4 py-2 glass text-gray-600 text-sm font-bold rounded-full">
                <?= e($typeLabel) ?>
            </span>
        </div>

        <h1 class="text-5xl font-serif font-bold mb-6">
            <span class="gradient-text"><?= e($resource['title']) ?></span>
        </h1>

        <div class="flex items-center gap-4 text-gray-500 text-sm mb-8">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <?= (int)($resource['views_count'] ?? 0) ?> views
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <?= format_date($resource['created_at'], 'M j, Y') ?>
            </div>
        </div>

        <div class="prose prose-lg max-w-none mb-8 leading-relaxed">
            <p class="text-xl text-gray-700"><?= nl2br(e($resource['description'] ?? '')) ?></p>
        </div>

        <div class="flex flex-wrap gap-4 mt-8">
            <?php if (!empty($resource['url'])): ?>
                <a href="<?= e($resource['url']) ?>" target="_blank"
                    class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-full text-lg font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span>Open Resource</span>
                </a>
            <?php endif; ?>

            <?php if (!empty($resource['file'])): ?>
                <a href="<?= media($resource['file']) ?>" download
                    class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-primary-500 to-teal-600 text-white rounded-full text-lg font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Download File</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
