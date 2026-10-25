<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Student Journal Entries';
    include __DIR__ . '/_header.php';
    ?>

    <div class="glass-strong rounded-3xl p-8 shadow-sm">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-serif font-bold text-gray-900">Student Journal Reflections</h2>
                <p class="text-sm text-gray-500">Self-exploration entries submitted by registered students.</p>
            </div>
            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                Total: <?= count($entries) ?> Entries
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-bold uppercase tracking-wider text-gray-400">
                        <th class="py-4 px-4">Student</th>
                        <th class="py-4 px-4">Mood</th>
                        <th class="py-4 px-4">Journal Excerpt</th>
                        <th class="py-4 px-4">Words</th>
                        <th class="py-4 px-4">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if (!empty($entries)): ?>
                        <?php foreach ($entries as $e): ?>
                            <tr class="hover:bg-white/50">
                                <td class="py-4 px-4 font-bold text-gray-800"><?= e($e['username'] ?? 'User #' . $e['user_id']) ?></td>
                                <td class="py-4 px-4 text-xl">
                                    <?= \App\Models\Journal::getMoods()[$e['mood']] ?? '📝' ?>
                                </td>
                                <td class="py-4 px-4 max-w-md">
                                    <p class="text-gray-700 italic line-clamp-2">"<?= e($e['content']) ?>"</p>
                                </td>
                                <td class="py-4 px-4 text-xs font-bold text-gray-400">
                                    <?= word_count($e['content']) ?> words
                                </td>
                                <td class="py-4 px-4 text-xs text-gray-400 whitespace-nowrap">
                                    <?= format_date($e['created_at'], 'M j, Y g:i A') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-400 italic">No student journals recorded yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
