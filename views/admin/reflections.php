<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Daily Reflection Scenarios';
    include __DIR__ . '/_header.php';
    ?>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-serif font-bold text-gray-900">Reflection Questions & Dilemmas</h2>
            <p class="text-sm text-gray-500">Configure real-life campus scenarios and interactive multiple-choice options.</p>
        </div>
        <a href="<?= url('admin/reflections/create') ?>"
            class="px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
            <span>+ Create Scenario</span>
        </a>
    </div>

    <!-- Scenarios List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
        <?php foreach ($scenarios as $s): ?>
            <div class="glass-strong p-6 rounded-3xl shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-3">
                        <span class="px-3 py-1 bg-teal-50 text-teal-700 text-xs font-bold rounded-full uppercase tracking-wider">
                            <?= e($s['related_value'] ?: 'Human Value') ?>
                        </span>
                        <span class="text-xs text-gray-400">Date: <?= e($s['active_date']) ?></span>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-gray-800 mb-2"><?= e($s['title']) ?></h3>
                    <p class="text-sm text-gray-600 line-clamp-3 mb-4 leading-relaxed"><?= e($s['scenario_text']) ?></p>

                    <!-- Options Preview -->
                    <div class="space-y-1 mb-4">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Options (<?= count($s['options'] ?? []) ?>):</p>
                        <?php foreach (array_slice($s['options'] ?? [], 0, 4) as $idx => $opt): ?>
                            <div class="text-xs text-gray-600 flex items-start gap-1.5">
                                <span class="font-bold text-primary-500"><?= chr(65 + $idx) ?>.</span>
                                <span class="truncate"><?= e($opt['option_text']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-2">
                    <a href="<?= url('admin/reflections/' . $s['id'] . '/edit') ?>"
                        class="text-xs font-bold text-primary-600 hover:text-primary-800">
                        Edit Scenario &rarr;
                    </a>
                    <form method="post" action="<?= url('admin/reflections/' . $s['id'] . '/delete') ?>" onsubmit="return confirm('Delete this scenario and all associated responses?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="text-xs font-bold text-rose-500 hover:text-rose-700">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Student Responses Log -->
    <div class="glass-strong rounded-3xl p-8 shadow-sm">
        <h3 class="text-2xl font-serif font-bold text-gray-900 mb-6">Student Submissions Log (<?= count($responses) ?>)</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-bold uppercase tracking-wider text-gray-400">
                        <th class="py-3 px-4">Student</th>
                        <th class="py-3 px-4">Scenario</th>
                        <th class="py-3 px-4">Selected Response</th>
                        <th class="py-3 px-4">Score</th>
                        <th class="py-3 px-4">Submitted At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach (array_slice($responses, 0, 15) as $resp): ?>
                        <tr class="hover:bg-white/50">
                            <td class="py-3 px-4 font-bold text-gray-800"><?= e($resp['username'] ?? 'Anonymous') ?></td>
                            <td class="py-3 px-4 text-teal-700 font-medium"><?= e($resp['scenario_title']) ?></td>
                            <td class="py-3 px-4 text-gray-600 italic"><?= e($resp['option_text']) ?></td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 bg-primary-100 text-primary-800 rounded-lg text-xs font-bold">
                                    +<?= (int)($resp['alignment_score'] ?? 10) ?>
                                </span>
                            </td>
                            <td class="py-3 px-4 text-xs text-gray-400"><?= format_date($resp['created_at'], 'M j, Y g:i A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
