<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20" x-data="{ showForm: false }">
    <!-- Hero Section -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-10 mb-20 text-center md:text-left">
        <div class="max-w-2xl">
            <h1 class="text-6xl font-serif font-bold mb-6">
                <span class="gradient-text">Impact Stories</span>
            </h1>
            <p class="text-2xl text-gray-600 font-light">
                Real stories of transformation from our community through Universal Human Values.
            </p>
        </div>
        <div>
            <button @click="showForm = true"
                class="px-10 py-5 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-full font-bold shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
                Share Your Story
            </button>
        </div>
    </div>

    <!-- Uniform Voices Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($voices)): ?>
            <?php foreach ($voices as $voice): ?>
                <?php
                $firstMedia = !empty($voice['media']) ? $voice['media'][0]['file'] : null;
                $isImage = false;
                if ($firstMedia) {
                    $ext = strtolower(pathinfo($firstMedia, PATHINFO_EXTENSION));
                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                }
                ?>
                <div class="group card-3d glass-strong p-8 rounded-[2.5rem] shadow-glass hover:shadow-3d relative flex flex-col h-full overflow-hidden transition-all duration-500">
                    <!-- Gradient accent -->
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-primary-400 via-indigo-500 to-accent-400"></div>

                    <!-- Quote Icon Decoration -->
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-primary-100 rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition-opacity"></div>

                    <div class="relative z-10 flex flex-col h-full">
                        <svg class="w-10 h-10 text-primary-200 mb-6 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H9C9.55228 16 10 15.5523 10 15V9C10 8.44772 9.55228 8 9 8H5C4.44772 8 4 8.44772 4 9V15C4 16.6569 5.34315 18 7 18H9.983L9.983 21H14.017Z"></path>
                        </svg>

                        <div class="flex-grow">
                            <!-- Text clamped to 6 lines for uniformity -->
                            <p class="text-gray-700 leading-relaxed text-lg mb-8 italic font-light line-clamp-6 group-hover:line-clamp-none transition-all duration-700">
                                "<?= nl2br(e($voice['content'])) ?>"
                            </p>
                        </div>

                        <div class="flex items-center pt-8 mt-auto border-t border-gray-100 flex-shrink-0">
                            <?php if ($firstMedia && $isImage): ?>
                                <div class="w-20 h-20 rounded-3xl overflow-hidden shadow-xl border-4 border-white mr-6 flex-shrink-0 ring-8 ring-primary-50/50">
                                    <img src="<?= media($firstMedia) ?>" alt="<?= e($voice['name_display']) ?>" class="w-full h-full object-cover">
                                </div>
                            <?php else: ?>
                                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-black text-2xl shadow-xl mr-6 flex-shrink-0">
                                    <?= strtoupper(substr($voice['name_display'] ?: 'A', 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                            <div class="overflow-hidden">
                                <p class="text-sm font-black text-gray-900 truncate tracking-tight"><?= e($voice['name_display'] ?: 'Anonymous') ?></p>
                                <p class="text-[10px] font-bold text-primary-500 uppercase tracking-widest mt-0.5 opacity-70">
                                    Shared on <?= format_date($voice['created_at'], 'M j, Y') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full py-20 text-center glass rounded-3xl border-2 border-dashed border-primary-200">
                <p class="text-xl text-gray-400 italic">Impact stories are arriving soon. Be the first to share!</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Submission Modal -->
    <template x-teleport="body">
        <div x-show="showForm" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            style="display: none;">
            <div class="absolute inset-0 bg-primary-900/40 backdrop-blur-md" @click="showForm = false"></div>

            <div class="relative bg-white rounded-[2.5rem] shadow-2xl max-w-2xl w-full overflow-hidden transform transition-all border border-white/20">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary-500 to-accent-500"></div>

                <div class="p-8 md:p-12">
                    <div class="flex justify-between items-center mb-10">
                        <h3 class="text-4xl font-serif font-bold text-gray-900">Share Your Journey</h3>
                        <button @click="showForm = false" class="text-gray-400 hover:text-gray-900 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form method="post" action="<?= url('voices') ?>" enctype="multipart/form-data" class="space-y-6">
                        <?= csrf_field() ?>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-widest">Display Name</label>
                            <input type="text" name="name_display" placeholder="Your Name or Nickname (e.g. Rahul S., Batch of 2024)"
                                class="w-full px-6 py-4 rounded-2xl border-2 border-gray-200 bg-white/70 focus:outline-none focus:border-primary-500 transition-all font-sans text-gray-800"
                                value="<?= e(currentUser()['first_name'] ?? '') ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-widest">Your Story of Change</label>
                            <textarea name="content" rows="6" required placeholder="How did Universal Human Values, workshop sessions, or reflections influence your mindset, relationships, or decisions?"
                                class="w-full px-6 py-4 rounded-2xl border-2 border-gray-200 bg-white/70 focus:outline-none focus:border-primary-500 transition-all font-sans text-gray-800 leading-relaxed"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-widest">Media (Photos or Videos - Optional)</label>
                            <input type="file" name="media[]" multiple accept="image/*,video/*"
                                class="w-full px-6 py-4 rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50/50 hover:bg-white text-gray-600 focus:outline-none focus:border-primary-500 transition-all">
                            <p class="text-xs text-gray-400 mt-2">You can select multiple photos or short video clips.</p>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full py-5 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-2xl font-bold shadow-xl hover:shadow-2xl hover:bg-primary-800 transition-all text-lg flex items-center justify-center gap-2">
                                <span>Submit for Moderation</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
