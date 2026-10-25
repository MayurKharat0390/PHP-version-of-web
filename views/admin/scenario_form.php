<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $isEdit = !empty($scenario);
    $title = $isEdit ? 'Edit Reflection Scenario' : 'Create Reflection Scenario';
    include __DIR__ . '/_header.php';
    ?>

    <div class="glass-strong rounded-3xl p-8 md:p-10 shadow-sm">
        <div class="mb-8">
            <a href="<?= url('admin/reflections') ?>" class="text-sm font-bold text-gray-500 hover:text-gray-800 flex items-center gap-1 mb-3">
                &larr; Back to Scenarios
            </a>
            <h2 class="text-3xl font-serif font-bold text-gray-900"><?= $isEdit ? 'Edit Scenario' : 'New Daily Dilemma' ?></h2>
        </div>

        <form method="post" class="space-y-6">
            <?= csrf_field() ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Scenario Title</label>
                    <input type="text" name="title" required value="<?= e($scenario['title'] ?? '') ?>"
                        placeholder="e.g. The Lab Report Dilemma"
                        class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Related Human Value</label>
                    <select name="related_value" class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                        <?php
                        $values = ['Integrity', 'Trust', 'Respect', 'Responsibility', 'Harmony', 'Compassion', 'Courage', 'Humility', 'Perseverance'];
                        $currentVal = $scenario['related_value'] ?? 'Responsibility';
                        foreach ($values as $v):
                        ?>
                            <option value="<?= $v ?>" <?= ($currentVal === $v) ? 'selected' : '' ?>><?= $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Active Date</label>
                <input type="date" name="active_date" required value="<?= e($scenario['active_date'] ?? date('Y-m-d')) ?>"
                    class="w-full md:w-1/2 px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Scenario Narrative / Problem Statement</label>
                <textarea name="scenario_text" rows="4" required placeholder="Describe the realistic ethical or emotional situation that students may face..."
                    class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500 leading-relaxed"><?= e($scenario['scenario_text'] ?? '') ?></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">UHV Principle & Explanation (Shown after submission)</label>
                <textarea name="explanation" rows="3" placeholder="Explain the deeper value behind this reflection..."
                    class="w-full px-5 py-3 rounded-2xl border-2 border-gray-200 bg-white focus:outline-none focus:border-primary-500 leading-relaxed"><?= e($scenario['explanation'] ?? '') ?></textarea>
            </div>

            <!-- 4 Multiple Choice Options -->
            <div class="pt-6 border-t border-gray-200">
                <h3 class="text-xl font-serif font-bold text-gray-900 mb-2">Response Choices (4 Options)</h3>
                <p class="text-xs text-gray-500 mb-6">Provide distinct perspectives with corresponding feedback and alignment score (1-10).</p>

                <div class="space-y-6">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                        <?php
                        $opt = $scenario['options'][$i] ?? null;
                        $letters = ['A', 'B', 'C', 'D'];
                        ?>
                        <div class="p-6 glass rounded-2xl border border-gray-200">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-7 h-7 rounded-full bg-primary-600 text-white font-bold flex items-center justify-center text-xs">
                                    <?= $letters[$i] ?>
                                </span>
                                <span class="font-bold text-sm text-gray-800">Choice <?= $letters[$i] ?></span>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase mb-1">Option Text</label>
                                    <input type="text" name="options[<?= $i ?>][text]" required value="<?= e($opt['option_text'] ?? '') ?>"
                                        placeholder="What would the student choose to do?"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:border-primary-500">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                    <div class="md:col-span-3">
                                        <label class="block text-[11px] font-bold text-gray-600 uppercase mb-1">Feedback Message</label>
                                        <input type="text" name="options[<?= $i ?>][feedback]" required value="<?= e($opt['feedback_message'] ?? '') ?>"
                                            placeholder="Thoughtful guidance explaining the consequences or virtue of this choice"
                                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-gray-600 uppercase mb-1">Alignment Score (1-10)</label>
                                        <input type="number" min="1" max="10" name="options[<?= $i ?>][score]" required value="<?= (int)($opt['alignment_score'] ?? (10 - $i * 2)) ?>"
                                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:border-primary-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all text-base">
                    <?= $isEdit ? 'Save Changes' : 'Publish Reflection Scenario' ?>
                </button>
            </div>
        </form>
    </div>
</div>
