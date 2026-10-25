<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Daily Quotes Management';
    include __DIR__ . '/_header.php';
    ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Add New Quote Form -->
        <div class="glass-strong rounded-3xl p-8 shadow-sm">
            <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6">Add Inspiring Quote</h2>
            <form method="post" action="<?= url('admin/quotes/create') ?>" class="space-y-4">
                <?= csrf_field() ?>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Quote Text</label>
                    <textarea name="text" rows="4" required placeholder="Enter quote..."
                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200 bg-white text-sm focus:outline-none focus:border-primary-500 leading-relaxed"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Author / Source</label>
                    <input type="text" name="author" required placeholder="e.g. Swami Vivekananda, APJ Abdul Kalam"
                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200 bg-white text-sm focus:outline-none focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Category</label>
                    <input type="text" name="category" value="general" placeholder="e.g. harmony, truth, wisdom"
                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200 bg-white text-sm focus:outline-none focus:border-primary-500">
                </div>
                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-md hover:shadow-lg transition-all text-sm">
                    + Add Quote
                </button>
            </form>
        </div>

        <!-- Quotes Table -->
        <div class="lg:col-span-2 glass-strong rounded-3xl p-8 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-serif font-bold text-gray-900">Quotes Collection</h2>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest"><?= count($quotes) ?> Quotes</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 text-xs font-bold uppercase tracking-wider text-gray-400">
                            <th class="py-3 px-3">Quote</th>
                            <th class="py-3 px-3">Author</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($quotes as $q): ?>
                            <tr class="hover:bg-white/50">
                                <td class="py-3 px-3 text-gray-800 italic max-w-sm">"<?= e($q['text']) ?>"</td>
                                <td class="py-3 px-3 font-bold text-xs text-primary-700 whitespace-nowrap"><?= e($q['author']) ?></td>
                                <td class="py-3 px-3">
                                    <form method="post" action="<?= url('admin/quotes/' . $q['id'] . '/toggle') ?>">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?= !empty($q['is_active']) ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' ?>">
                                            <?= !empty($q['is_active']) ? 'Active' : 'Disabled' ?>
                                        </button>
                                    </form>
                                </td>
                                <td class="py-3 px-3 text-right">
                                    <form method="post" action="<?= url('admin/quotes/' . $q['id'] . '/delete') ?>" onsubmit="return confirm('Delete quote?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="text-xs font-bold text-rose-500 hover:text-rose-700">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
