<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Faculty Mentors Management';
    include __DIR__ . '/_header.php';
    ?>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-serif font-bold text-gray-900">Faculty Mentors</h2>
            <p class="text-sm text-gray-500">Mentors guiding students in Universal Human Values and value education.</p>
        </div>
        <a href="<?= url('admin/faculty/create') ?>"
            class="px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
            <span>+ Add Faculty Member</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($faculties as $f): ?>
            <div class="glass-strong rounded-3xl p-6 shadow-sm flex flex-col justify-between text-center">
                <div>
                    <div class="w-28 h-28 mx-auto rounded-2xl overflow-hidden shadow-md mb-4 bg-gray-100">
                        <?php if (!empty($f['image'])): ?>
                            <img src="<?= media($f['image']) ?>" alt="<?= e($f['name']) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-2xl">
                                <?= strtoupper(substr($f['name'], 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg"><?= e($f['name']) ?></h3>
                    <p class="text-xs text-primary-600 font-bold uppercase tracking-wider mb-3"><?= e($f['role']) ?></p>
                    <?php if (!empty($f['philosophy'])): ?>
                        <p class="text-xs text-gray-600 italic leading-relaxed line-clamp-3">"<?= e($f['philosophy']) ?>"</p>
                    <?php endif; ?>
                </div>

                <div class="pt-4 mt-4 border-t border-gray-100">
                    <form method="post" action="<?= url('admin/faculty/' . $f['id'] . '/delete') ?>" onsubmit="return confirm('Delete this faculty mentor?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-600 rounded-lg text-xs font-bold hover:bg-rose-100 transition-all">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
