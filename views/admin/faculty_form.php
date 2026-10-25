<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Add Faculty Mentor';
    include __DIR__ . '/_header.php';
    ?>

    <div class="glass-strong rounded-3xl p-8 md:p-10 shadow-sm">
        <div class="mb-8">
            <a href="<?= url('admin/faculty') ?>" class="text-sm font-bold text-gray-500 hover:text-gray-800 flex items-center gap-1 mb-3">
                &larr; Back to Faculty Mentors
            </a>
            <h2 class="text-3xl font-serif font-bold text-gray-900">Add Faculty Mentor</h2>
        </div>

        <form method="post" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Full Name</label>
                    <input type="text" name="name" required placeholder="e.g. Dr. Rajesh Kumar"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Designation / Role</label>
                    <input type="text" name="role" required placeholder="e.g. Professor & UHV Cell Coordinator"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Teaching Philosophy & Quote</label>
                <textarea name="philosophy" rows="4" required placeholder="A guiding philosophy or inspiring advice for students..."
                    class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500 leading-relaxed"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Profile Photo</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full px-5 py-3 rounded-2xl border-2 border-dashed border-gray-300 bg-white/50 hover:bg-white text-sm">
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all text-base">
                    Save Faculty Profile
                </button>
            </div>
        </form>
    </div>
</div>
