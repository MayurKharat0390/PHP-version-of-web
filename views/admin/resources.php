<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Resource Library Management';
    include __DIR__ . '/_header.php';
    ?>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-serif font-bold text-gray-900">UHV Learning Resources</h2>
            <p class="text-sm text-gray-500">Manage articles, videos, PDFs, and guides available in the resource repository.</p>
        </div>
        <a href="<?= url('admin/resources/create') ?>"
            class="px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
            <span>+ Add Resource</span>
        </a>
    </div>

    <div class="glass-strong rounded-3xl p-8 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-bold uppercase tracking-wider text-gray-400">
                        <th class="py-4 px-4">Title</th>
                        <th class="py-4 px-4">Category</th>
                        <th class="py-4 px-4">Type</th>
                        <th class="py-4 px-4">Views</th>
                        <th class="py-4 px-4">Status</th>
                        <th class="py-4 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($resources as $res): ?>
                        <tr class="hover:bg-white/50">
                            <td class="py-4 px-4 font-bold text-gray-900">
                                <a href="<?= url('resources/' . $res['id']) ?>" target="_blank" class="hover:text-primary-600">
                                    <?= e($res['title']) ?>
                                </a>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 uppercase">
                                    <?= e($res['category']) ?>
                                </span>
                            </td>
                            <td class="py-4 px-4 text-xs font-semibold text-gray-600 uppercase">
                                <?= e($res['resource_type']) ?>
                            </td>
                            <td class="py-4 px-4 text-xs text-gray-500">
                                👁️ <?= (int)$res['views_count'] ?>
                            </td>
                            <td class="py-4 px-4">
                                <?php if (!empty($res['is_featured'])): ?>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                        ★ Featured
                                    </span>
                                <?php else: ?>
                                    <span class="text-xs text-gray-400">Standard</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-4 text-right">
                                <form method="post" action="<?= url('admin/resources/' . $res['id'] . '/delete') ?>" onsubmit="return confirm('Permanently delete this resource?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-600 rounded-lg text-xs font-bold hover:bg-rose-100 transition-all">
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
