<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20" 
     x-data="{ tab: 'activities', activeVideo: null }"
     x-init="$watch('activeVideo', value => { if (value) document.body.style.overflow = 'hidden'; else document.body.style.overflow = ''; })">
    <div class="max-w-4xl mx-auto text-center mb-16">
        <h1 class="text-6xl font-serif font-bold mb-6">
            <span class="gradient-text">Impact & Awareness</span>
        </h1>
        <p class="text-2xl text-gray-600 font-light mb-12">
            Empowering students through real-world initiatives and value-based awareness.
        </p>

        <!-- Tab Navigation -->
        <div class="inline-flex w-full max-w-[480px] p-1.5 bg-gray-100/50 backdrop-blur-md rounded-[2.5rem] border border-white/50 shadow-glass relative overflow-hidden">
            <div 
                class="absolute inset-y-1.5 transition-all duration-500 cubic-bezier(0.4, 0, 0.2, 1) bg-primary-600 rounded-full shadow-glow-primary z-0"
                :style="tab === 'activities' ? 'left: 6px; width: calc(50% - 6px);' : 'left: 50%; width: calc(50% - 6px);'"
            ></div>

            <button 
                @click="tab = 'activities'"
                :class="tab === 'activities' ? 'text-white' : 'text-gray-500 hover:text-primary-600'"
                class="relative z-10 w-1/2 py-4 text-xs sm:text-sm font-black uppercase tracking-widest transition-colors duration-500"
            >
                Student Activities
            </button>
            <button 
                @click="tab = 'awareness'"
                :class="tab === 'awareness' ? 'text-white' : 'text-gray-500 hover:text-primary-600'"
                class="relative z-10 w-1/2 py-4 text-xs sm:text-sm font-black uppercase tracking-widest transition-colors duration-500"
            >
                Student Awareness
            </button>
        </div>
    </div>

    <!-- Tab Content Container -->
    <div class="relative overflow-hidden min-h-[600px]">
        
        <!-- Student Activities Tab -->
        <div 
            x-show="tab === 'activities'"
            x-transition:enter="transition ease-out duration-500 transform"
            x-transition:enter-start="opacity-0 translate-x-12"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300 transform absolute top-0 w-full"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-12"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
        >
            <?php if (!empty($activities)): ?>
                <?php foreach ($activities as $activity): ?>
                <a href="<?= url('activities/' . $activity['id']) ?>"
                    class="group card-3d glass-strong rounded-[2rem] overflow-hidden shadow-glass hover:shadow-3d block">
                    <div class="relative h-80 overflow-hidden">
                        <?php if (!empty($activity['image'])): ?>
                            <img src="<?= media($activity['image']) ?>" alt="<?= e($activity['title']) ?>"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-primary-200 via-purple-200 to-accent-200 flex items-center justify-center relative overflow-hidden">
                                <svg class="w-16 h-16 text-white relative z-10 animate-pulse-slow" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        <?php endif; ?>

                        <!-- Date Badge -->
                        <div class="absolute top-4 left-4 glass-strong text-gray-800 text-xs font-bold px-4 py-2 rounded-full shadow-glass">
                            <?= format_date($activity['date']) ?>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <div class="p-8">
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-glow-primary">
                                <?= e($activity['value_practiced']) ?>
                            </span>
                        </div>

                        <h3 class="text-2xl font-serif font-bold text-gray-800 mb-4 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-primary-600 group-hover:to-emerald-600 group-hover:bg-clip-text transition-all">
                            <?= e($activity['title']) ?>
                        </h3>

                        <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed"><?= e($activity['description']) ?></p>

                        <div class="pt-6 border-t border-white/50 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-gray-600">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-400 to-emerald-500 flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold"><?= $activity['student_count'] ?></span>
                            </div>
                            <div class="flex items-center gap-2 text-primary-600 font-bold text-sm opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all">
                                <span>View Details</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-20 text-center glass-strong rounded-3xl shadow-glass">
                    <p class="text-xl text-gray-600 font-serif">More activities coming soon.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Student Awareness Tab (Videos) -->
        <div 
            x-show="tab === 'awareness'"
            x-transition:enter="transition ease-out duration-500 transform"
            x-transition:enter-start="opacity-0 -translate-x-12"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300 transform absolute top-0 w-full"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-12"
            class="space-y-12"
            style="display: none;"
        >
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Video 1: YouTube -->
                <div class="group card-3d glass-strong rounded-[2.5rem] overflow-hidden shadow-glass p-4 flex flex-col cursor-pointer"
                     @click="activeVideo = 'https://www.youtube.com/embed/_0ucKrM912M?si=_7NQAsdYf3LXUC4j&autoplay=1'">
                    <div class="relative aspect-video rounded-[1.5rem] overflow-hidden shadow-2xl bg-black group-hover:shadow-glow-primary transition-all duration-500">
                        <img src="https://img.youtube.com/vi/_0ucKrM912M/maxresdefault.jpg" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-all flex items-center justify-center text-center">
                            <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4.5 2.691a.5.5 0 0 1 .75-.433l11.5 6.809a.5.5 0 1 1 0 .866L5.25 16.742a.5.5 0 0 1-.75-.433V2.691z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-2xl font-serif font-bold text-gray-800 mb-2 leading-tight">Seva Beyond Self: Journey of Compassion</h3>
                            <p class="text-gray-600 leading-relaxed font-light text-sm">
                                A heartwarming UHV Seva Synergy Project at Pune's Goshala. Witness the selfless service toward cows and the inspiring story of Shri Mohan Gupchup Kaka.
                            </p>
                            <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-primary-600 bg-primary-50 px-2 py-0.5 rounded">Neeraj Kore</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-primary-600 bg-primary-50 px-2 py-0.5 rounded">Prithviraj Sherikar</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-primary-600 bg-primary-50 px-2 py-0.5 rounded">Shreya Jadhav</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-primary-600 bg-primary-50 px-2 py-0.5 rounded">Madhura Barve</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video 2: Google Drive -->
                <div class="group card-3d glass-strong rounded-[2.5rem] overflow-hidden shadow-glass p-4 flex flex-col cursor-pointer"
                     @click="activeVideo = 'https://drive.google.com/file/d/1rvNx6mYHhoXZaky-m4XAWJTcC-9QaKoa/preview'">
                    <div class="relative aspect-video rounded-[1.5rem] overflow-hidden shadow-2xl bg-gray-900 group-hover:shadow-glow-primary transition-all duration-500">
                        <img src="<?= asset('images/drive_thumb_2.png') ?>" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-all flex items-center justify-center">
                            <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4.5 2.691a.5.5 0 0 1 .75-.433l11.5 6.809a.5.5 0 1 1 0 .866L5.25 16.742a.5.5 0 0 1-.75-.433V2.691z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-2xl font-serif font-bold text-gray-800 mb-2">Student Perspective I</h3>
                            <p class="text-gray-600 leading-relaxed font-light">Voices from the campus on universal human values.</p>
                        </div>
                    </div>
                </div>

                <!-- Video 3: Google Drive -->
                <div class="group card-3d glass-strong rounded-[2.5rem] overflow-hidden shadow-glass p-4 flex flex-col cursor-pointer"
                     @click="activeVideo = 'https://drive.google.com/file/d/1mG8SnnYU0XLF0aaCLoQWeRvqtjlNjvdZ/preview'">
                    <div class="relative aspect-video rounded-[1.5rem] overflow-hidden shadow-2xl bg-gray-900 group-hover:shadow-glow-primary transition-all duration-500">
                        <img src="<?= asset('images/drive_thumb_1.png') ?>" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-all flex items-center justify-center">
                            <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4.5 2.691a.5.5 0 0 1 .75-.433l11.5 6.809a.5.5 0 1 1 0 .866L5.25 16.742a.5.5 0 0 1-.75-.433V2.691z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-2xl font-serif font-bold text-gray-800 mb-2">Student Perspective II</h3>
                            <p class="text-gray-600 leading-relaxed font-light">Exploring harmony and relationships attraverso student initiatives.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Enhanced Video Lightbox Modal -->
    <template x-teleport="body">
        <div 
            x-show="activeVideo" 
            class="fixed inset-0 z-[99999] flex items-center justify-center p-4 sm:p-10"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            style="display: none;"
        >
            <div class="absolute inset-0 bg-black/90 backdrop-blur-3xl" @click="activeVideo = null"></div>
            
            <div 
                class="relative w-full max-w-6xl aspect-video bg-black rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/10"
                x-transition:enter="transition ease-out duration-500 transform"
                x-transition:enter-start="scale-90 opacity-0"
                x-transition:enter-end="scale-100 opacity-100"
            >
                <template x-if="activeVideo">
                    <iframe 
                        :src="activeVideo" 
                        class="w-full h-full"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen>
                    </iframe>
                </template>

                <button 
                    @click="activeVideo = null"
                    class="absolute top-6 right-6 w-12 h-12 bg-white/10 hover:bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white transition-all hover:rotate-90 z-[100000]"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>
