<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <!-- Header -->
    <div class="text-center mb-20">
        <div class="inline-flex items-center gap-2 px-4 py-2 glass rounded-full text-xs font-bold uppercase tracking-wider text-teal-600 mb-6">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                    clip-rule="evenodd"></path>
            </svg>
            Your Journey
        </div>
        <h1 class="text-6xl font-serif font-bold mb-6">
            <span class="gradient-text">My Progress</span>
        </h1>
        <p class="text-2xl text-gray-600 font-light max-w-3xl mx-auto">
            Track your reflection journey and celebrate your growth.
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <!-- Total Reflections -->
        <div class="card-3d glass-strong rounded-3xl p-8 shadow-lg hover:shadow-2xl text-center">
            <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h3 class="text-5xl font-serif font-bold text-gray-800 mb-2"><?= (int)($progress['total_reflections'] ?? 0) ?></h3>
            <p class="text-gray-600 font-medium">Total Reflections</p>
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
            <h3 class="text-5xl font-serif font-bold bg-gradient-to-r from-teal-600 to-teal-700 bg-clip-text text-transparent mb-2">
                <?= (int)($progress['current_streak'] ?? 0) ?>
            </h3>
            <p class="text-gray-600 font-medium">Day Streak 🔥</p>
        </div>

        <!-- Journal Entries -->
        <div class="card-3d glass-strong rounded-3xl p-8 shadow-lg hover:shadow-2xl text-center">
            <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h3 class="text-5xl font-serif font-bold text-gray-800 mb-2"><?= (int)($progress['total_journal_entries'] ?? 0) ?></h3>
            <p class="text-gray-600 font-medium">Journal Entries</p>
        </div>
    </div>

    <!-- Achievement Badge -->
    <?php if (!empty($progress['longest_streak']) && $progress['longest_streak'] > 0): ?>
        <div class="max-w-2xl mx-auto mb-16">
            <div class="glass-strong rounded-3xl p-8 shadow-lg text-center border-2 border-accent-200">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-accent-400 to-accent-600 text-white mb-6 shadow-lg">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-serif font-bold text-gray-800 mb-2">Personal Best</h3>
                <p class="text-gray-600 text-lg">Your longest streak: <span class="font-bold text-accent-600"><?= (int)$progress['longest_streak'] ?> days</span></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- 30-Day Activity Calendar Grid -->
    <div class="glass-strong rounded-3xl p-8 shadow-lg mb-16 max-w-4xl mx-auto">
        <h3 class="text-2xl font-serif font-bold text-gray-800 mb-6 text-center">Recent Activity (Last 30 Days)</h3>
        <?php
        $loggedDates = [];
        if (!empty($recent_logins)) {
            foreach ($recent_logins as $lg) {
                $loggedDates[$lg['date']] = true;
            }
        }
        ?>
        <div class="grid grid-cols-6 sm:grid-cols-10 gap-3">
            <?php for ($i = 29; $i >= 0; $i--): ?>
                <?php
                $dayStr = date('Y-m-d', strtotime("-$i days"));
                $isToday = ($dayStr === date('Y-m-d'));
                $hasLoggedIn = isset($loggedDates[$dayStr]) || $isToday;
                ?>
                <div class="flex flex-col items-center p-3 rounded-2xl <?= $hasLoggedIn ? 'bg-teal-500/10 border-2 border-teal-500 text-teal-700' : 'bg-gray-100/50 border border-gray-200 text-gray-400' ?>">
                    <span class="text-[10px] font-bold uppercase tracking-wider"><?= date('M j', strtotime($dayStr)) ?></span>
                    <span class="text-lg mt-1"><?= $hasLoggedIn ? '🔥' : '⚪' ?></span>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-2xl mx-auto">
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
    </div>
</div>
