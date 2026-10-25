<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Add Learning Resource';
    include __DIR__ . '/_header.php';
    ?>

    <div class="glass-strong rounded-3xl p-8 md:p-10 shadow-sm">
        <div class="mb-8">
            <a href="<?= url('admin/resources') ?>" class="text-sm font-bold text-gray-500 hover:text-gray-800 flex items-center gap-1 mb-3">
                &larr; Back to Resources
            </a>
            <h2 class="text-3xl font-serif font-bold text-gray-900">Add Learning Resource</h2>
        </div>

        <form method="post" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Resource Title</label>
                <input type="text" name="title" required placeholder="e.g. Fundamental Guidelines for Self-Exploration"
                    class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Category</label>
                    <select name="category" class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                        <?php foreach (\App\Models\Resource::getCategories() as $k => $label): ?>
                            <?php if ($k !== 'all'): ?>
                                <option value="<?= $k ?>"><?= $label ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Resource Type</label>
                    <select name="resource_type" class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                        <option value="article">Article / Reading</option>
                        <option value="video">Video Lecture / Talk</option>
                        <option value="pdf">PDF Document / Handout</option>
                        <option value="link">External Web Link</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">External URL (Optional)</label>
                <input type="url" name="url" placeholder="https://..."
                    class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Detailed Summary & Description</label>
                <textarea name="description" rows="5" required placeholder="Key takeaways, concepts covered, and suggested reflection questions..."
                    class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500 leading-relaxed"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Cover Thumbnail (Optional)</label>
                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-dashed border-gray-300 bg-white/50 hover:bg-white text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Upload Document / PDF (Optional)</label>
                    <input type="file" name="file" accept=".pdf,.doc,.docx"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-dashed border-gray-300 bg-white/50 hover:bg-white text-sm">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" class="w-4 h-4 text-primary-600 rounded">
                <label for="is_featured" class="text-sm font-bold text-gray-700">Mark as Featured Resource</label>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all text-base">
                    Save and Publish Resource
                </button>
            </div>
        </form>
    </div>
</div>
