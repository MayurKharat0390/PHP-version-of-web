<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Innovations Management';
    include __DIR__ . '/_header.php';
    ?>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-serif font-bold text-gray-900">UHV Digital Innovations</h2>
            <p class="text-sm text-gray-500">Showcase digital applications, websites, and community platforms built around human values.</p>
        </div>
        <a href="<?= url('admin/innovations/create') ?>"
            class="px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
            <span>+ Add Innovation</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($innovations as $inno): ?>
            <div class="glass-strong rounded-3xl overflow-hidden shadow-sm flex flex-col justify-between">
                <div>
                    <div class="h-44 relative bg-gray-100 overflow-hidden">
                        <?php if (!empty($inno['thumbnail'])): ?>
                            <img src="<?= media($inno['thumbnail']) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-purple-500 to-primary-600 flex items-center justify-center text-white text-5xl">
                                🚀
                            </div>
                        <?php endif; ?>
                        <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-xs font-bold text-purple-700 uppercase">
                            <?= e($inno['innovation_type']) ?>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-serif font-bold text-gray-900 mb-2"><?= e($inno['title']) ?></h3>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">By: <?= e($inno['developed_by'] ?? 'UHV Team') ?></p>
                        <p class="text-sm text-gray-600 line-clamp-3 mb-4 leading-relaxed"><?= e($inno['short_description'] ?? '') ?></p>
                        <a href="<?= e($inno['link']) ?>" target="_blank" class="text-xs font-bold text-primary-600 hover:underline">
                            <?= e($inno['link']) ?> &nearr;
                        </a>
                    </div>
                </div>

                <div class="px-6 pb-6 pt-2 flex items-center justify-between border-t border-gray-100">
                    <span class="text-xs text-gray-400"><?= format_date($inno['created_at'], 'M j, Y') ?></span>
                    <form method="post" action="<?= url('admin/innovations/' . $inno['id'] . '/delete') ?>" onsubmit="return confirm('Permanently remove this innovation?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="text-xs font-bold text-rose-500 hover:text-rose-700">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
