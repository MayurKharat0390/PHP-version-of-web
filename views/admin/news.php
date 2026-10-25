<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'News Ticker Management';
    include __DIR__ . '/_header.php';
    ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Add New Announcement Form -->
        <div class="glass-strong rounded-3xl p-8 shadow-sm">
            <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6">Add Announcement</h2>
            <form method="post" action="<?= url('admin/news/create') ?>" class="space-y-4">
                <?= csrf_field() ?>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Announcement Text</label>
                    <textarea name="text" rows="3" required placeholder="e.g. Next UHV Workshop scheduled for Nov 15th at PCCOE Auditorium!"
                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200 bg-white text-sm focus:outline-none focus:border-primary-500 leading-relaxed"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Icon Type</label>
                    <select name="icon_type" class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200 bg-white text-sm focus:outline-none focus:border-primary-500">
                        <option value="update">📢 Update</option>
                        <option value="event">📅 Event</option>
                        <option value="alert">⚠️ Important</option>
                        <option value="star">🌟 Highlight</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Target Link (Optional)</label>
                    <input type="text" name="link" placeholder="e.g. /activities or https://..."
                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200 bg-white text-sm focus:outline-none focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Sort Order</label>
                    <input type="number" name="order" value="0"
                        class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200 bg-white text-sm focus:outline-none focus:border-primary-500">
                </div>
                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-md hover:shadow-lg transition-all text-sm">
                    + Add to Ticker
                </button>
            </form>
        </div>

        <!-- News Ticker Table -->
        <div class="lg:col-span-2 glass-strong rounded-3xl p-8 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-serif font-bold text-gray-900">Current Ticker Items</h2>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest"><?= count($news) ?> Items</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 text-xs font-bold uppercase tracking-wider text-gray-400">
                            <th class="py-3 px-3">Type</th>
                            <th class="py-3 px-3">Announcement</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($news as $item): ?>
                            <tr class="hover:bg-white/50">
                                <td class="py-3 px-3">
                                    <span class="px-2 py-0.5 rounded-full text-xs bg-gray-100 font-bold uppercase">
                                        <?= e($item['icon_type']) ?>
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-gray-800 font-medium">
                                    <?= e($item['text']) ?>
                                    <?php if (!empty($item['link'])): ?>
                                        <a href="<?= e($item['link']) ?>" target="_blank" class="text-primary-500 ml-1 text-xs hover:underline">&nearr;</a>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-3">
                                    <form method="post" action="<?= url('admin/news/' . $item['id'] . '/toggle') ?>">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?= !empty($item['is_active']) ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' ?>">
                                            <?= !empty($item['is_active']) ? 'Visible' : 'Hidden' ?>
                                        </button>
                                    </form>
                                </td>
                                <td class="py-3 px-3 text-right">
                                    <form method="post" action="<?= url('admin/news/' . $item['id'] . '/delete') ?>" onsubmit="return confirm('Delete announcement?');">
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
