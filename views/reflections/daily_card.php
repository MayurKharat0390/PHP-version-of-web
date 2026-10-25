<div class="max-w-4xl mx-auto px-4 py-20">
    <div class="text-center mb-16">
        <span class="inline-block px-4 py-2 glass rounded-full text-xs font-bold tracking-widest uppercase text-purple-600 mb-4 shadow-glass">Daily Practice</span>
        <h1 class="text-5xl md:text-6xl font-serif font-bold mb-6">
            <span class="gradient-text">Today's Reflection</span>
        </h1>
        <p class="text-xl text-gray-600 font-light">Pause. Reflect. There is no judgment here.</p>
    </div>

    <?php if (!empty($scenario)): ?>
    <div class="relative group" id="reflection-container">
        <div class="absolute -inset-1 bg-gradient-to-r from-primary-400 via-indigo-500 to-accent-400 rounded-[3rem] blur-xl opacity-40 group-hover:opacity-60 transition duration-1000"></div>

        <div class="relative glass-strong rounded-[2.5rem] shadow-3d overflow-hidden card-3d">
            <!-- Scenario Header -->
            <div class="p-12 md:p-16 text-center bg-gradient-to-b from-white/50 to-transparent relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary-400 via-indigo-500 to-accent-400"></div>

                <div class="mb-8">
                    <span class="inline-block px-4 py-2 glass rounded-full text-xs font-bold text-gray-600 shadow-glass">Scenario</span>
                </div>

                <div class="relative">
                    <svg class="absolute -top-4 -left-4 w-12 h-12 text-primary-200 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H9C9.55228 16 10 15.5523 10 15V9C10 8.44772 9.55228 8 9 8H5C4.44772 8 4 8.44772 4 9V15C4 16.6569 5.34315 18 7 18H9.983L9.983 21H14.017Z"></path>
                    </svg>
                    <h2 class="text-2xl md:text-3xl font-serif text-gray-800 leading-snug relative z-10">
                        <?= e($scenario['scenario_text']) ?>
                    </h2>
                </div>
            </div>

            <!-- Options Area -->
            <div id="reflection-area" class="p-10 md:p-16 bg-white/30">
                <p class="text-center text-gray-500 text-base font-bold uppercase tracking-wide mb-10 flex items-center justify-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-gradient-to-r from-primary-400 to-purple-500 animate-pulse"></span>
                    Choose your response
                </p>

                <div class="flex flex-col space-y-5" id="options-list">
                    <?php if (!empty($scenario['options'])): ?>
                        <?php foreach ($scenario['options'] as $option): ?>
                        <form method="post" action="<?= url('reflections/submit/' . $scenario['id']) ?>"
                            hx-post="<?= url('reflections/submit/' . $scenario['id']) ?>"
                            hx-target="#reflection-container"
                            hx-swap="innerHTML"
                            class="reflection-form">
                            <?= csrf_field() ?>
                            <input type="hidden" name="option" value="<?= $option['id'] ?>">
                            <button type="submit"
                                class="group/btn relative w-full text-left p-6 rounded-2xl glass-strong hover:shadow-lg border-2 border-transparent hover:border-primary-300 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg text-gray-700 font-semibold group-hover/btn:text-primary-600 transition-colors flex-1 pr-4">
                                        <?= e($option['option_text']) ?>
                                    </span>
                                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center opacity-0 group-hover/btn:opacity-100 transition-all transform group-hover/btn:translate-x-1">
                                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </div>
                                </div>
                            </button>
                        </form>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="text-center py-32 glass-strong rounded-[2.5rem] shadow-glass">
        <p class="text-2xl text-gray-600 font-serif">New reflections arrive daily.</p>
        <p class="text-gray-500 mt-2">Check back tomorrow.</p>
    </div>
    <?php endif; ?>
</div>
