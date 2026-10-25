<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <!-- Header -->
    <div class="text-center mb-16">
        <div class="inline-flex items-center gap-2 px-4 py-2 glass rounded-full text-xs font-bold uppercase tracking-wider text-primary-600 mb-6">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
            My Profile
        </div>
        <h1 class="text-6xl font-serif font-bold mb-6">
            <span class="gradient-text">Welcome, <?= e($user['first_name'] ?: $user['username']) ?>!</span>
        </h1>
        <p class="text-2xl text-gray-600 font-light">Track your UHV journey and personal growth</p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-16">
        <!-- Total Reflections -->
        <div class="card-3d glass-strong rounded-3xl p-8 shadow-lg hover:shadow-2xl text-center">
            <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h3 class="text-4xl font-serif font-bold text-gray-800 mb-2"><?= (int)($progress['total_reflections'] ?? 0) ?></h3>
            <p class="text-gray-600 font-medium">Reflections</p>
        </div>

        <!-- Current Streak -->
        <div class="card-3d glass-strong rounded-3xl p-8 shadow-lg hover:shadow-2xl text-center border-2 border-teal-200">
            <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-teal-400 to-teal-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path>
                </svg>
            </div>
            <h3 class="text-4xl font-serif font-bold bg-gradient-to-r from-teal-600 to-teal-700 bg-clip-text text-transparent mb-2">
                <?= (int)($progress['current_streak'] ?? 0) ?>
            </h3>
            <p class="text-gray-600 font-medium">Day Streak 🔥</p>
        </div>

        <!-- Best Streak -->
        <div class="card-3d glass-strong rounded-3xl p-8 shadow-lg hover:shadow-2xl text-center">
            <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            </div>
            <h3 class="text-4xl font-serif font-bold text-gray-800 mb-2"><?= (int)($progress['longest_streak'] ?? 0) ?></h3>
            <p class="text-gray-600 font-medium">Best Streak</p>
        </div>

        <!-- Journal Entries -->
        <div class="card-3d glass-strong rounded-3xl p-8 shadow-lg hover:shadow-2xl text-center">
            <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h3 class="text-4xl font-serif font-bold text-gray-800 mb-2"><?= (int)($progress['total_journal_entries'] ?? 0) ?></h3>
            <p class="text-gray-600 font-medium">Journal Entries</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <a href="<?= url('reflections') ?>"
            class="group card-3d glass-strong p-8 rounded-3xl shadow-lg hover:shadow-2xl text-center">
            <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Daily Reflection</h3>
            <p class="text-gray-600">Continue your practice</p>
        </a>

        <a href="<?= url('journals/create') ?>"
            class="group card-3d glass-strong p-8 rounded-3xl shadow-lg hover:shadow-2xl text-center">
            <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Write in Journal</h3>
            <p class="text-gray-600">Record your thoughts</p>
        </a>

        <a href="<?= url('progress') ?>"
            class="group card-3d glass-strong p-8 rounded-3xl shadow-lg hover:shadow-2xl text-center">
            <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-teal-400 to-teal-600 rounded-2xl flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">View Progress</h3>
            <p class="text-gray-600">See detailed stats</p>
        </a>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Journals -->
        <div class="glass-strong rounded-3xl p-8 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-serif font-bold text-gray-800">Recent Journals</h2>
                <a href="<?= url('journals') ?>" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">View All</a>
            </div>

            <?php if (!empty($recent_journals)): ?>
                <div class="space-y-4">
                    <?php foreach ($recent_journals as $entry): ?>
                        <a href="<?= url('journals/' . $entry['id']) ?>" class="block p-4 glass rounded-2xl hover:bg-white/70 transition-all">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold shadow-lg text-sm">
                                        <?= format_date($entry['created_at'], 'd') ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800"><?= e($entry['title'] ?: 'Journal Entry') ?></p>
                                        <p class="text-sm text-gray-500"><?= format_date($entry['created_at'], 'M j, Y') ?></p>
                                    </div>
                                </div>
                                <?php if (!empty($entry['mood'])): ?>
                                    <span class="text-2xl"><?= \App\Models\Journal::getMoods()[$entry['mood']] ?? $entry['mood'] ?></span>
                                <?php endif; ?>
                            </div>
                            <p class="text-gray-600 text-sm line-clamp-2"><?= e(substr($entry['content'], 0, 120)) ?>...</p>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-gray-500">No journal entries yet</p>
                    <a href="<?= url('journals/create') ?>" class="inline-block mt-4 text-purple-600 font-semibold hover:text-purple-700">Write your first entry</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Recent Reflections -->
        <div class="glass-strong rounded-3xl p-8 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-serif font-bold text-gray-800">Recent Reflections</h2>
                <a href="<?= url('reflections') ?>" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">New Reflection</a>
            </div>

            <?php if (!empty($recent_reflections)): ?>
                <div class="space-y-4">
                    <?php foreach ($recent_reflections as $response): ?>
                        <div class="p-4 glass rounded-2xl">
                            <div class="flex items-start gap-3 mb-2">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-400 to-teal-500 flex items-center justify-center text-white shadow-lg flex-shrink-0">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-800"><?= e($response['scenario_title']) ?></p>
                                    <p class="text-xs text-gray-500"><?= format_date($response['created_at'], 'M j, Y') ?></p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 pl-13 italic">"<?= e(substr($response['option_text'], 0, 100)) ?>..."</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-gray-500">No reflections yet</p>
                    <a href="<?= url('reflections') ?>" class="inline-block mt-4 text-purple-600 font-semibold hover:text-purple-700">Start reflecting</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
