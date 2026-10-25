<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Activities & Workshops';
    include __DIR__ . '/_header.php';
    ?>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-serif font-bold text-gray-900">Campus Activities & Workshops</h2>
            <p class="text-sm text-gray-500">Manage UHV events, values practiced, attendance records, and photo galleries.</p>
        </div>
        <a href="<?= url('admin/activities/create') ?>"
            class="px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
            <span>+ Create Activity</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($activities as $act): ?>
            <div class="glass-strong rounded-3xl overflow-hidden shadow-sm flex flex-col justify-between">
                <div>
                    <div class="h-48 relative overflow-hidden bg-gray-100">
                        <?php if (!empty($act['image'])): ?>
                            <img src="<?= media($act['image']) ?>" alt="<?= e($act['title']) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white text-4xl">
                                🎯
                            </div>
                        <?php endif; ?>
                        <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-xs font-bold text-primary-700">
                            <?= e($act['value_practiced']) ?>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-center text-xs text-gray-400 mb-2">
                            <span><?= format_date($act['date'], 'M j, Y') ?></span>
                            <span>👥 <?= (int)$act['student_count'] ?> Students</span>
                        </div>
                        <h3 class="text-xl font-serif font-bold text-gray-900 mb-2"><?= e($act['title']) ?></h3>
                        <p class="text-sm text-gray-600 line-clamp-3 mb-4 leading-relaxed"><?= e($act['description']) ?></p>

                        <?php if (!empty($act['gallery'])): ?>
                            <p class="text-xs text-teal-600 font-bold mb-2">📸 <?= count($act['gallery']) ?> Gallery Photos</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="px-6 pb-6 pt-2 flex items-center justify-between border-t border-gray-100">
                    <a href="<?= url('admin/activities/' . $act['id'] . '/edit') ?>"
                        class="text-xs font-bold text-primary-600 hover:text-primary-800">
                        Edit & Gallery &rarr;
                    </a>
                    <form method="post" action="<?= url('admin/activities/' . $act['id'] . '/delete') ?>" onsubmit="return confirm('Permanently delete this activity?');">
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
