<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Dashboard Overview';
    include __DIR__ . '/_header.php';
    ?>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-5 mb-12">
        <div class="glass-strong p-6 rounded-3xl shadow-sm text-center">
            <span class="text-3xl">👥</span>
            <h3 class="text-3xl font-serif font-bold text-gray-900 mt-2"><?= $stats['users'] ?></h3>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500 mt-1">Users</p>
        </div>
        <div class="glass-strong p-6 rounded-3xl shadow-sm text-center">
            <span class="text-3xl">💡</span>
            <h3 class="text-3xl font-serif font-bold text-gray-900 mt-2"><?= $stats['reflections'] ?></h3>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500 mt-1">Reflections</p>
        </div>
        <div class="glass-strong p-6 rounded-3xl shadow-sm text-center">
            <span class="text-3xl">🎯</span>
            <h3 class="text-3xl font-serif font-bold text-gray-900 mt-2"><?= $stats['activities'] ?></h3>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500 mt-1">Activities</p>
        </div>
        <div class="glass-strong p-6 rounded-3xl shadow-sm text-center">
            <span class="text-3xl">📖</span>
            <h3 class="text-3xl font-serif font-bold text-gray-900 mt-2"><?= $stats['journals'] ?></h3>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500 mt-1">Journals</p>
        </div>
        <div class="glass-strong p-6 rounded-3xl shadow-sm text-center border-2 <?= $stats['voices_pending'] > 0 ? 'border-amber-400 bg-amber-50/50' : 'border-transparent' ?>">
            <span class="text-3xl">🎙️</span>
            <h3 class="text-3xl font-serif font-bold text-gray-900 mt-2"><?= $stats['voices_total'] ?></h3>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500 mt-1">
                Stories <?= $stats['voices_pending'] > 0 ? "({$stats['voices_pending']} pending)" : '' ?>
            </p>
        </div>
        <div class="glass-strong p-6 rounded-3xl shadow-sm text-center">
            <span class="text-3xl">👁️</span>
            <h3 class="text-3xl font-serif font-bold text-gray-900 mt-2"><?= $stats['visitors'] ?></h3>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500 mt-1">Pageviews</p>
        </div>
    </div>

    <!-- Pending Stories Moderation Alert (if any) -->
    <?php if (!empty($pending_voices)): ?>
        <div class="glass-strong rounded-3xl p-8 mb-12 border-2 border-amber-300 shadow-md">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <span class="p-3 bg-amber-100 text-amber-700 rounded-2xl text-xl">⚠️</span>
                    <div>
                        <h2 class="text-2xl font-serif font-bold text-gray-900">Pending Student Stories</h2>
                        <p class="text-sm text-gray-500">The following stories were submitted by community members and require approval.</p>
                    </div>
                </div>
                <a href="<?= url('admin/voices') ?>" class="px-5 py-2.5 bg-amber-500 text-white rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-amber-600 transition-all">
                    Moderate All (<?= count($pending_voices) ?>)
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php foreach (array_slice($pending_voices, 0, 4) as $v): ?>
                    <div class="p-5 glass rounded-2xl flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-gray-900"><?= e($v['name_display']) ?></span>
                                <span class="text-xs text-gray-400"><?= format_date($v['created_at'], 'M j, Y') ?></span>
                            </div>
                            <p class="text-sm text-gray-600 italic line-clamp-3">"<?= e($v['content']) ?>"</p>
                        </div>
                        <div class="flex gap-2 mt-4 pt-3 border-t border-gray-100">
                            <form method="post" action="<?= url('admin/voices/' . $v['id'] . '/approve') ?>" class="inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="px-4 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-all">
                                    ✓ Approve
                                </button>
                            </form>
                            <form method="post" action="<?= url('admin/voices/' . $v['id'] . '/delete') ?>" class="inline" onsubmit="return confirm('Delete this story?');">
                                <?= csrf_field() ?>
                                <button type="submit" class="px-4 py-1.5 bg-rose-50 text-rose-600 rounded-lg text-xs font-bold hover:bg-rose-100 transition-all">
                                    ✕ Discard
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Two Columns: Recent Contact Messages & Recent Reflections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Messages Inbox -->
        <div class="glass-strong rounded-3xl p-8 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-serif font-bold text-gray-900">Recent Inquiries</h2>
                <a href="<?= url('admin/messages') ?>" class="text-primary-600 text-sm font-bold hover:underline">View All &rarr;</a>
            </div>

            <?php if (!empty($recent_messages)): ?>
                <div class="space-y-4">
                    <?php foreach ($recent_messages as $msg): ?>
                        <div class="p-4 glass rounded-2xl">
                            <div class="flex justify-between items-start mb-1">
                                <span class="font-bold text-gray-800 text-sm"><?= e($msg['name']) ?></span>
                                <span class="text-[11px] text-gray-400"><?= format_date($msg['created_at'], 'M j, g:i A') ?></span>
                            </div>
                            <p class="text-xs text-primary-600 mb-1"><?= e($msg['email']) ?></p>
                            <p class="text-sm font-medium text-gray-800"><?= e($msg['subject']) ?></p>
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2"><?= e($msg['message']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-400 italic py-8 text-center">No contact messages received yet.</p>
            <?php endif; ?>
        </div>

        <!-- Recent Reflections Responses -->
        <div class="glass-strong rounded-3xl p-8 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-serif font-bold text-gray-900">Latest Reflections</h2>
                <a href="<?= url('admin/reflections') ?>" class="text-primary-600 text-sm font-bold hover:underline">View All &rarr;</a>
            </div>

            <?php if (!empty($recent_responses)): ?>
                <div class="space-y-4">
                    <?php foreach ($recent_responses as $resp): ?>
                        <div class="p-4 glass rounded-2xl">
                            <div class="flex justify-between items-start mb-1">
                                <span class="font-bold text-gray-900 text-sm"><?= e($resp['username'] ?? 'Anonymous') ?></span>
                                <span class="text-[11px] text-gray-400"><?= format_date($resp['created_at'], 'M j, g:i A') ?></span>
                            </div>
                            <p class="text-xs font-bold text-teal-600 mb-1">Scenario: <?= e($resp['scenario_title']) ?></p>
                            <p class="text-xs text-gray-600 italic">"<?= e(substr($resp['option_text'], 0, 90)) ?>..."</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-400 italic py-8 text-center">No reflections recorded yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
