<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <!-- Header -->
    <div class="text-center mb-20">
        <div class="inline-flex items-center gap-2 px-4 py-2 glass rounded-full text-xs font-bold uppercase tracking-wider text-accent-600 mb-6">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
            </svg>
            Learning Resources
        </div>
        <h1 class="text-6xl font-serif font-bold mb-6">
            <span class="gradient-text">Resources Library</span>
        </h1>
        <p class="text-2xl text-gray-600 font-light max-w-3xl mx-auto">
            Curated materials to deepen your understanding of universal human values.
        </p>
    </div>

    <!-- Category Filter -->
    <div class="flex flex-wrap justify-center gap-3 mb-16">
        <?php foreach ($categories as $catValue => $catLabel): ?>
            <a href="<?= url('resources?category=' . $catValue) ?>"
                class="px-6 py-3 rounded-full text-base font-bold transition-all <?= ($current_category === $catValue) ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg' : 'glass text-gray-700 hover:bg-white/70' ?>">
                <?= e($catLabel) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Resources Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($resources)): ?>
            <?php
            $gradients = [
                'from-primary-200 to-teal-200',
                'from-purple-200 to-purple-300',
                'from-accent-200 to-accent-300',
                'from-lime-200 to-lime-300'
            ];
            $gIdx = 0;
            ?>
            <?php foreach ($resources as $resource): ?>
                <?php
                $grad = $gradients[$gIdx % count($gradients)];
                $gIdx++;
                $catLabel = $categories[$resource['category']] ?? ucfirst($resource['category']);
                $typeLabel = \App\Models\Resource::getTypeDisplay($resource['resource_type'] ?? 'link');
                ?>
                <div class="group card-3d glass-strong rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl flex flex-col">
                    <!-- Thumbnail/Icon -->
                    <div class="h-48 bg-gradient-to-br <?= $grad ?> flex items-center justify-center relative overflow-hidden flex-shrink-0">
                        <?php if (!empty($resource['thumbnail'])): ?>
                            <img src="<?= media($resource['thumbnail']) ?>" alt="<?= e($resource['title']) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="text-6xl group-hover:scale-110 transition-transform duration-300">
                                <?php if ($resource['resource_type'] === 'article'): ?>📄
                                <?php elseif ($resource['resource_type'] === 'video'): ?>🎥
                                <?php elseif ($resource['resource_type'] === 'pdf'): ?>📚
                                <?php else: ?>🔗<?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($resource['is_featured'])): ?>
                            <div class="absolute top-4 right-4 px-3 py-1 bg-accent-500 text-white text-xs font-bold rounded-full shadow-lg">
                                Featured
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Content -->
                    <div class="p-8 flex-grow flex flex-col">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wider rounded-full">
                                <?= e($catLabel) ?>
                            </span>
                            <span class="px-3 py-1 glass text-gray-600 text-xs font-bold rounded-full">
                                <?= e($typeLabel) ?>
                            </span>
                        </div>

                        <h3 class="text-2xl font-serif font-bold text-gray-800 mb-3 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-accent-600 group-hover:to-accent-700 group-hover:bg-clip-text transition-all">
                            <a href="<?= url('resources/' . $resource['id']) ?>"><?= e($resource['title']) ?></a>
                        </h3>

                        <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed flex-grow">
                            <?= e($resource['description'] ?? '') ?>
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 mt-auto">
                            <div class="flex items-center gap-2 text-gray-500 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <?= (int)($resource['views_count'] ?? 0) ?> views
                            </div>
                            <a href="<?= url('resources/' . $resource['id']) ?>"
                                class="inline-flex items-center gap-2 text-indigo-600 font-bold hover:text-indigo-700 transition-colors">
                                <span>View</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full py-20 text-center glass-strong rounded-3xl shadow-lg">
                <div class="inline-block p-6 rounded-3xl bg-gradient-to-br from-accent-100 to-accent-200 mb-6">
                    <svg class="w-12 h-12 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <p class="text-xl text-gray-600 font-serif">No resources found in this category.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
