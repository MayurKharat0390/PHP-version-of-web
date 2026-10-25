<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $isEdit = !empty($activity);
    $title = $isEdit ? 'Edit Activity' : 'Create New Activity';
    include __DIR__ . '/_header.php';
    ?>

    <div class="glass-strong rounded-3xl p-8 md:p-10 shadow-sm">
        <div class="mb-8">
            <a href="<?= url('admin/activities') ?>" class="text-sm font-bold text-gray-500 hover:text-gray-800 flex items-center gap-1 mb-3">
                &larr; Back to Activities
            </a>
            <h2 class="text-3xl font-serif font-bold text-gray-900"><?= $isEdit ? 'Edit Activity Details' : 'New UHV Workshop / Activity' ?></h2>
        </div>

        <form method="post" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Activity Title</label>
                    <input type="text" name="title" required value="<?= e($activity['title'] ?? '') ?>"
                        placeholder="e.g. Student Induction Program - UHV Workshop"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Value Practiced</label>
                    <input type="text" name="value_practiced" required value="<?= e($activity['value_practiced'] ?? 'Harmony') ?>"
                        placeholder="e.g. Harmony, Trust, Mutual Respect"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Event Date</label>
                    <input type="date" name="date" required value="<?= e($activity['date'] ?? date('Y-m-d')) ?>"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Student Participants Count</label>
                    <input type="number" name="student_count" required value="<?= (int)($activity['student_count'] ?? 100) ?>"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Description / Report</label>
                <textarea name="description" rows="5" required placeholder="Detailed overview of the activity, objectives, faculty mentors involved, and student takeaways..."
                    class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500 leading-relaxed"><?= e($activity['description'] ?? '') ?></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Main Cover Photo</label>
                <?php if (!empty($activity['image'])): ?>
                    <div class="w-40 h-28 rounded-2xl overflow-hidden mb-3 border border-gray-200">
                        <img src="<?= media($activity['image']) ?>" class="w-full h-full object-cover">
                    </div>
                <?php endif; ?>
                <input type="file" name="image" accept="image/*"
                    class="w-full px-5 py-3 rounded-2xl border-2 border-dashed border-gray-300 bg-white/50 hover:bg-white text-sm">
            </div>

            <div class="pt-6 border-t border-gray-200">
                <label class="block text-sm font-bold text-gray-800 mb-1">Add More Photos to Gallery (Optional)</label>
                <p class="text-xs text-gray-500 mb-3">Upload multiple workshop pictures for the event gallery.</p>
                <input type="file" name="gallery[]" multiple accept="image/*"
                    class="w-full px-5 py-3 rounded-2xl border-2 border-dashed border-gray-300 bg-white/50 hover:bg-white text-sm">

                <?php if (!empty($activity['gallery'])): ?>
                    <div class="mt-4">
                        <p class="text-xs font-bold text-gray-600 mb-2">Existing Gallery Photos (<?= count($activity['gallery']) ?>):</p>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($activity['gallery'] as $img): ?>
                                <div class="w-20 h-20 rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                    <img src="<?= media($img['image']) ?>" class="w-full h-full object-cover">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all text-base">
                    <?= $isEdit ? 'Save Activity Updates' : 'Publish Activity' ?>
                </button>
            </div>
        </form>
    </div>
</div>
