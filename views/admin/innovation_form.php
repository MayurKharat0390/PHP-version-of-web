<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Add New Digital Innovation';
    include __DIR__ . '/_header.php';
    ?>

    <div class="glass-strong rounded-3xl p-8 md:p-10 shadow-sm">
        <div class="mb-8">
            <a href="<?= url('admin/innovations') ?>" class="text-sm font-bold text-gray-500 hover:text-gray-800 flex items-center gap-1 mb-3">
                &larr; Back to Innovations
            </a>
            <h2 class="text-3xl font-serif font-bold text-gray-900">Add Innovation Project</h2>
        </div>

        <form method="post" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Project Title</label>
                    <input type="text" name="title" required placeholder="e.g. UHV Mobile Reflection Companion"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Innovation Type</label>
                    <select name="innovation_type" class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                        <option value="app">Mobile App</option>
                        <option value="website">Web Platform</option>
                        <option value="tool">Digital Tool</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Developed By (Team or Individual)</label>
                    <input type="text" name="developed_by" required placeholder="e.g. Mayur Kharat & PCCOE UHV Team"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Project URL / Link</label>
                    <input type="url" name="link" required placeholder="https://..."
                        class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Short Summary / Vision</label>
                <input type="text" name="short_description" required placeholder="A brief one-line description for project cards..."
                    class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Full Project Story & Architecture</label>
                <textarea name="description" rows="5" required placeholder="Comprehensive story of how the project was built, technologies used, and its impact on students..."
                    class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500 leading-relaxed"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Thumbnail / Banner Image</label>
                <input type="file" name="thumbnail" accept="image/*"
                    class="w-full px-5 py-3 rounded-2xl border-2 border-dashed border-gray-300 bg-white/50 hover:bg-white text-sm">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" class="w-4 h-4 text-primary-600 rounded">
                <label for="is_featured" class="text-sm font-bold text-gray-700">Feature this innovation on the Home Page</label>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all text-base">
                    Publish Innovation
                </button>
            </div>
        </form>
    </div>
</div>
