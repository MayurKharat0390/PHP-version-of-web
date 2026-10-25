<section class="py-20 relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <a href="<?= url('innovations') ?>"
            class="inline-flex items-center text-primary-600 font-bold mb-10 hover:-translate-x-1 transition-transform">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Innovations
        </a>

        <div class="glass-strong rounded-[3rem] p-10 md:p-16 shadow-2xl overflow-hidden relative">
            <?php
            $type = $innovation['innovation_type'] ?? 'app';
            $typeLabels = ['app' => 'Mobile App', 'website' => 'Web Platform', 'other' => 'Digital Tool'];
            $typeLabel = $typeLabels[$type] ?? ucfirst($type);
            ?>

            <!-- Header -->
            <div class="relative z-10">
                <div class="flex flex-wrap items-center gap-4 mb-8">
                    <span class="px-5 py-2 glass rounded-full text-sm font-bold uppercase tracking-widest text-primary-600">
                        <?= $typeLabel ?>
                    </span>
                    <span class="text-gray-400 text-sm italic">
                        Created <?= format_date($innovation['created_at'], 'F Y') ?>
                    </span>
                </div>

                <h1 class="text-5xl md:text-6xl font-serif font-bold text-gray-800 mb-8 leading-tight">
                    <?= e($innovation['title']) ?>
                </h1>

                <!-- Featured Image -->
                <div class="mb-12 rounded-3xl overflow-hidden shadow-xl aspect-video bg-gray-100">
                    <?php if (!empty($innovation['thumbnail'])): ?>
                        <img src="<?= media($innovation['thumbnail']) ?>" alt="<?= e($innovation['title']) ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-primary-400 to-purple-600 flex items-center justify-center">
                            <span class="text-9xl">✨</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <div class="glass p-8 rounded-2xl border-l-4 border-primary-500">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Developed By</h3>
                        <p class="text-xl font-bold text-gray-800"><?= e($innovation['developed_by'] ?? 'UHV Team') ?></p>
                    </div>
                    <div class="glass p-8 rounded-2xl border-l-4 border-purple-500">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Project Vision</h3>
                        <p class="text-gray-800 leading-relaxed"><?= e($innovation['short_description'] ?? '') ?></p>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="prose prose-xl max-w-none text-gray-700 mb-16 leading-relaxed">
                    <?= nl2br(e($innovation['description'] ?? '')) ?>
                </div>

                <!-- Action -->
                <div class="text-center">
                    <a href="<?= e($innovation['link']) ?>" target="_blank"
                        class="inline-flex items-center px-12 py-6 bg-gradient-to-r from-primary-600 to-purple-600 text-white rounded-full text-2xl font-bold shadow-glow-primary hover:shadow-2xl hover:-translate-y-2 transition-all">
                        Launch Experience
                        <svg class="ml-4 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
