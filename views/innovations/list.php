<section class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center px-4 py-1.5 mb-6 glass rounded-full text-xs font-bold tracking-widest uppercase text-primary-600">
                Digital Transformation
            </div>
            <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6">
                <span class="gradient-text">UHV Innovations</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto font-light leading-relaxed">
                Showcasing digital tools, apps, and platforms developed by our students and faculty to spread human values in the digital age.
            </p>
        </div>

        <!-- Featured Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php if (!empty($innovations)): ?>
                <?php foreach ($innovations as $project): ?>
                    <?php
                    $type = $project['innovation_type'] ?? 'app';
                    $typeLabels = ['app' => 'Mobile App', 'website' => 'Web Platform', 'other' => 'Digital Tool'];
                    $typeLabel = $typeLabels[$type] ?? ucfirst($type);
                    ?>
                    <div class="group card-3d glass-strong rounded-[2.5rem] overflow-hidden shadow-lg hover:shadow-2xl flex flex-col">
                        <!-- Thumbnail Placeholder/Image -->
                        <div class="relative h-80 overflow-hidden">
                            <?php if (!empty($project['thumbnail'])): ?>
                                <img src="<?= media($project['thumbnail']) ?>" alt="<?= e($project['title']) ?>"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br <?php if ($type === 'app'): ?>from-primary-400 to-teal-500<?php elseif ($type === 'website'): ?>from-purple-400 to-purple-600<?php else: ?>from-accent-400 to-rose-500<?php endif; ?> flex items-center justify-center p-8">
                                    <div class="text-white text-center">
                                        <div class="text-6xl mb-4 group-hover:scale-125 transition-transform duration-500">
                                            <?php if ($type === 'app'): ?>📱<?php elseif ($type === 'website'): ?>🌐<?php else: ?>🛠️<?php endif; ?>
                                        </div>
                                        <span class="text-sm font-bold uppercase tracking-widest opacity-80"><?= $typeLabel ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Type Badge -->
                            <div class="absolute top-6 left-6">
                                <span class="px-4 py-2 glass-strong rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">
                                    <?= $typeLabel ?>
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8 flex-grow flex flex-col">
                            <h3 class="text-2xl font-serif font-bold text-gray-800 mb-3 group-hover:text-primary-600 transition-colors">
                                <a href="<?= url('innovations/' . $project['id']) ?>"><?= e($project['title']) ?></a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-6 flex-grow leading-relaxed">
                                <?= e($project['short_description'] ?? '') ?>
                            </p>

                            <div class="border-t border-gray-100 pt-6 mt-auto">
                                <div class="flex items-center mb-6">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mr-3 text-lg">
                                        👨‍💻
                                    </div>
                                    <div class="text-xs">
                                        <span class="block text-gray-400 font-bold uppercase mb-0.5">Developed By</span>
                                        <span class="text-gray-800 font-medium"><?= e($project['developed_by'] ?? 'UHV Team') ?></span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <a href="<?= url('innovations/' . $project['id']) ?>"
                                        class="flex items-center justify-center py-3 px-4 glass rounded-xl font-bold text-gray-700 hover:bg-gray-100 transition-all text-sm">
                                        Read Story
                                    </a>
                                    <a href="<?= e($project['link']) ?>" target="_blank"
                                        class="flex items-center justify-center py-3 px-4 bg-gradient-to-r <?php if ($type === 'app'): ?>from-primary-500 to-teal-500<?php elseif ($type === 'website'): ?>from-purple-500 to-purple-600<?php else: ?>from-accent-500 to-accent-600<?php endif; ?> text-white rounded-xl font-bold shadow hover:shadow-lg transition-all text-sm">
                                        Visit
                                        <svg class="ml-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-20 text-center glass rounded-3xl">
                    <p class="text-xl text-gray-500 italic">Innovative projects are coming soon...</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
