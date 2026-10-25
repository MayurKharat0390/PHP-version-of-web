<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <a href="<?= url('activities') ?>"
        class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-semibold mb-8 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Activities
    </a>

    <div class="glass-strong rounded-3xl overflow-hidden shadow-2xl">
        <!-- Hero Image -->
        <?php if (!empty($activity['image'])): ?>
        <div class="relative h-[600px] overflow-hidden">
            <img src="<?= media($activity['image']) ?>" alt="<?= e($activity['title']) ?>" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

            <div class="absolute bottom-0 left-0 right-0 p-10">
                <div class="mb-4">
                    <span class="inline-block px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white text-sm font-bold uppercase tracking-wider rounded-full shadow-lg">
                        <?= e($activity['value_practiced']) ?>
                    </span>
                </div>
                <h1 class="text-5xl font-serif font-bold text-white mb-3"><?= e($activity['title']) ?></h1>
                <div class="flex items-center gap-6 text-white/90">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <?= format_date($activity['date'], 'F j, Y') ?>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <?= $activity['student_count'] ?> students participated
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="relative h-[600px] bg-gradient-to-br from-emerald-200 via-emerald-300 to-emerald-400 flex items-center justify-center">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/20 to-emerald-600/20 animate-gradient bg-300%"></div>
            <div class="absolute bottom-0 left-0 right-0 p-10 bg-gradient-to-t from-black/60 to-transparent">
                <div class="mb-4">
                    <span class="inline-block px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white text-sm font-bold uppercase tracking-wider rounded-full shadow-lg">
                        <?= e($activity['value_practiced']) ?>
                    </span>
                </div>
                <h1 class="text-5xl font-serif font-bold text-white mb-3"><?= e($activity['title']) ?></h1>
                <div class="flex items-center gap-6 text-white/90">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <?= format_date($activity['date'], 'F j, Y') ?>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <?= $activity['student_count'] ?> students participated
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="p-10 md:p-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="glass p-6 rounded-2xl text-center">
                    <div class="text-4xl font-serif font-bold text-primary-600 mb-2"><?= $activity['student_count'] ?></div>
                    <div class="text-gray-600 font-medium">Participants</div>
                </div>
                <div class="glass p-6 rounded-2xl text-center">
                    <div class="text-4xl font-serif font-bold text-emerald-600 mb-2"><?= e($activity['value_practiced']) ?></div>
                    <div class="text-gray-600 font-medium">Value Practiced</div>
                </div>
                <div class="glass p-6 rounded-2xl text-center">
                    <div class="text-4xl font-serif font-bold text-primary-600 mb-2"><?= format_date($activity['date'], 'M Y') ?></div>
                    <div class="text-gray-600 font-medium">Date</div>
                </div>
            </div>

            <div class="prose prose-lg max-w-none">
                <h2 class="text-3xl font-serif font-bold text-gray-800 mb-6">About This Activity</h2>
                <p class="text-xl text-gray-700 leading-relaxed whitespace-pre-line"><?= e($activity['description']) ?></p>
            </div>

            <!-- Gallery Section -->
            <?php if (!empty($activity['images'])): ?>
            <div class="mt-16">
                <h2 class="text-3xl font-serif font-bold text-gray-800 mb-8 flex items-center gap-4">
                    <span class="w-12 h-1 bg-emerald-500 rounded-full"></span>
                    Activity Gallery (<?= count($activity['images']) ?> Photos)
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                    <?php foreach ($activity['images'] as $img): ?>
                    <div class="group relative rounded-2xl overflow-hidden shadow-lg aspect-video h-80 bg-gray-100">
                        <img src="<?= media($img['image']) ?>" alt="<?= e($img['caption'] ?: $activity['title']) ?>"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <?php if (!empty($img['caption'])): ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="absolute bottom-4 left-4 right-4 text-white text-sm font-medium">
                                <?= e($img['caption']) ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Impact Section -->
            <div class="mt-12 p-8 glass rounded-2xl border-2 border-emerald-200">
                <h3 class="text-2xl font-serif font-bold text-gray-800 mb-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    Impact & Learning
                </h3>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Through this activity, <strong><?= $activity['student_count'] ?> participants</strong> engaged with the theme of
                    <strong><?= e($activity['value_practiced']) ?></strong>,
                    contributing to a more harmonious and value-driven campus community.
                </p>
            </div>

            <!-- Back Button -->
            <div class="mt-12 text-center">
                <a href="<?= url('activities') ?>"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-full text-lg font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    View All Activities
                </a>
            </div>
        </div>
    </div>
</div>
