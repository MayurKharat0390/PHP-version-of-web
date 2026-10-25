<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Student Impact Stories Moderation';
    include __DIR__ . '/_header.php';
    ?>

    <div class="glass-strong rounded-3xl p-8 shadow-sm">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-serif font-bold text-gray-900">Community Voices & Impact Stories</h2>
                <p class="text-sm text-gray-500">Review, approve, or remove student submissions before they appear live on the website.</p>
            </div>
            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                Total: <?= count($voices) ?> Stories
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($voices as $v): ?>
                <?php
                $isApproved = !empty($v['is_approved']);
                ?>
                <div class="p-6 rounded-3xl border-2 <?= $isApproved ? 'border-emerald-200 bg-white/70' : 'border-amber-300 bg-amber-50/50' ?> flex flex-col justify-between shadow-sm">
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg"><?= e($v['name_display'] ?: 'Anonymous') ?></h3>
                                <p class="text-xs text-gray-400">Submitted on <?= format_date($v['created_at'], 'M j, Y g:i A') ?></p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider <?= $isApproved ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-200 text-amber-800' ?>">
                                <?= $isApproved ? 'Live & Approved' : 'Pending Moderation' ?>
                            </span>
                        </div>

                        <p class="text-gray-700 text-sm italic leading-relaxed mb-4">
                            "<?= nl2br(e($v['content'])) ?>"
                        </p>

                        <?php if (!empty($v['media'])): ?>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <?php foreach ($v['media'] as $m): ?>
                                    <div class="w-16 h-16 rounded-xl overflow-hidden border border-gray-200">
                                        <img src="<?= media($m['file']) ?>" class="w-full h-full object-cover">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-2">
                        <div class="flex items-center gap-2">
                            <?php if (!$isApproved): ?>
                                <form method="post" action="<?= url('admin/voices/' . $v['id'] . '/approve') ?>">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 transition-all">
                                        ✓ Approve & Publish
                                    </button>
                                </form>
                            <?php else: ?>
                                <form method="post" action="<?= url('admin/voices/' . $v['id'] . '/reject') ?>">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="px-4 py-2 bg-amber-100 text-amber-800 rounded-xl text-xs font-bold hover:bg-amber-200 transition-all">
                                        Unpublish
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <form method="post" action="<?= url('admin/voices/' . $v['id'] . '/delete') ?>" onsubmit="return confirm('Permanently delete this story?');">
                            <?= csrf_field() ?>
                            <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-600 rounded-xl text-xs font-bold hover:bg-rose-100 transition-all">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
