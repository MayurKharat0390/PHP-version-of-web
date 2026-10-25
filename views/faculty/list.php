<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center mb-20">
        <div class="inline-flex items-center gap-2 px-4 py-2 glass rounded-full text-xs font-bold uppercase tracking-wider text-primary-600 mb-6">
            Guiding Lights
        </div>
        <h1 class="text-5xl md:text-6xl font-serif font-bold text-gray-900 mb-6">Our Mentors</h1>
        <p class="text-xl text-gray-500 font-light max-w-2xl mx-auto leading-relaxed">
            Faculty members dedicated to guiding students through the journey of self-exploration and value-based living.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
        <?php if (!empty($faculty)): ?>
            <?php foreach ($faculty as $member): ?>
                <div class="group flex flex-col items-center text-center">
                    <div class="relative mb-6">
                        <!-- Abstract frame -->
                        <div class="absolute inset-0 bg-primary-100/60 rounded-[2rem] transform rotate-3 transition-transform duration-500 group-hover:rotate-6"></div>

                        <div class="relative w-64 h-80 overflow-hidden rounded-[2.5rem] shadow-xl bg-white">
                            <?php if (!empty($member['image'])): ?>
                                <img src="<?= media($member['image']) ?>" alt="<?= e($member['name']) ?>"
                                    class="w-full h-full object-cover filter grayscale group-hover:grayscale-0 transition-all duration-700">
                            <?php else: ?>
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300">
                                    <svg class="h-24 w-24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <h3 class="text-xl font-serif font-bold text-gray-900 mb-1 group-hover:text-primary-600 transition-colors">
                        <?= e($member['name']) ?>
                    </h3>
                    <p class="text-xs text-primary-600 font-bold uppercase tracking-widest mb-4">
                        <?= e($member['role'] ?? 'Faculty Mentor') ?>
                    </p>

                    <?php if (!empty($member['philosophy'])): ?>
                        <div class="relative px-6">
                            <p class="text-gray-500 text-sm italic leading-relaxed">
                                "<?= e($member['philosophy']) ?>"
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full py-20 text-center glass rounded-3xl">
                <p class="text-gray-400">Faculty list updating.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
