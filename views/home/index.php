<!-- Cinematic Hero Slider Container -->
<section x-data="{ 
    activeSlide: 0,
    progress: 0,
    slides: [
        { 
            image: '<?= asset('images/pccoe1.jpeg') ?>', 
            label: 'Institutional Excellence',
            title: 'Cultivating', 
            subtitle: 'Human Values', 
            desc: 'Bridge the gap between technical brilliance and ethical living at Institute UHV Cell.' 
        },
        { 
            image: '<?= asset('images/campus_landscape.png') ?>', 
            label: 'Nurturing Leaders',
            title: 'Ethical', 
            subtitle: 'Leadership', 
            desc: 'Fostering ethically grounded leaders who catalyze social harmony and well-being.' 
        },
        { 
            image: '<?= asset('images/polytechnic_campus.jpg') ?>', 
            label: 'Holistic Growth',
            title: 'Universal', 
            subtitle: 'Harmony', 
            desc: 'Discover your higher purpose through self-exploration and sustainable living.' 
        }
    ],
    next() { 
        this.activeSlide = (this.activeSlide + 1) % this.slides.length;
        this.progress = 0;
    },
    init() { 
        setInterval(() => {
            this.progress += 0.5;
            if (this.progress >= 100) { this.next() }
        }, 30);
    }
}" x-init="init()" class="relative h-[85vh] min-h-[600px] overflow-hidden bg-gray-900 group">

    <!-- Background Slides -->
    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="absolute inset-0 z-0">
            <img :src="slide.image"
                class="w-full h-full object-cover transition-transform duration-[10000ms] ease-linear transform scale-110"
                :class="activeSlide === index ? 'scale-100' : 'scale-110'" alt="Hero Background">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/80 via-gray-900/40 to-transparent"></div>
        </div>
    </template>

    <!-- Content Overlay -->
    <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center z-10">
        <div class="max-w-3xl">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" class="space-y-8">
                    <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-700 delay-300"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="inline-flex items-center px-4 py-2 glass rounded-full text-xs font-bold tracking-widest uppercase text-accent-400 border border-white/10 mb-6">
                            <span class="w-2 h-2 rounded-full bg-accent-500 mr-2 animate-pulse"></span>
                            <span x-text="slide.label"></span>
                        </div>
                    </div>

                    <h1 x-show="activeSlide === index" x-transition:enter="transition ease-out duration-700 delay-500"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="text-6xl md:text-8xl font-serif font-black text-white leading-tight">
                        <span class="block" x-text="slide.title"></span>
                        <span class="gradient-text block" x-text="slide.subtitle"></span>
                    </h1>

                    <p x-show="activeSlide === index" x-transition:enter="transition ease-out duration-700 delay-700"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="text-xl text-gray-200 font-light leading-relaxed max-w-xl" x-text="slide.desc"></p>

                    <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-700 delay-900"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="flex flex-col sm:flex-row items-center gap-6 pt-4">
                        <a href="<?= url('reflections') ?>"
                            class="w-full sm:w-auto px-8 py-4 bg-primary-600 text-white rounded-2xl text-lg font-bold shadow-2xl hover:bg-primary-500 hover:-translate-y-1 transition-all flex items-center justify-center gap-3 group/btn">
                            Begin Journey
                            <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="#nine-values"
                            class="w-full sm:w-auto px-8 py-4 glass-strong text-white rounded-2xl text-lg font-bold shadow-lg hover:bg-white/10 hover:-translate-y-1 transition-all border border-white/20">
                            Explore Values
                        </a>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Slider Navigation Dots -->
    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-20 flex items-center gap-4">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="activeSlide = index; progress = 0"
                class="relative h-1 transition-all duration-500 rounded-full bg-white/20 overflow-hidden"
                :class="activeSlide === index ? 'w-12' : 'w-6 hover:bg-white/40'">
                <div x-show="activeSlide === index" class="absolute inset-0 bg-accent-400"
                    :style="'width: ' + progress + '%'"></div>
            </button>
        </template>
    </div>
</section>

<!-- 9 Core Values Section -->
<section id="nine-values" class="py-24 relative overflow-hidden bg-gray-50/50">
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-0 right-1/4 w-[600px] h-[600px] bg-primary-100/20 rounded-full blur-[120px] animate-pulse-slow"></div>
        <div class="absolute bottom-0 left-1/4 w-[600px] h-[600px] bg-accent-100/20 rounded-full blur-[120px] animate-pulse-slow" style="animation-delay: 2s"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-24 slide-up">
            <div class="inline-flex items-center gap-3 px-4 py-2 border border-primary-200 bg-white/50 rounded-full text-xs font-black uppercase tracking-[0.2em] text-primary-700 mb-8 shadow-sm">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                </span>
                The Foundation of Relationships
            </div>
            <h2 class="text-5xl md:text-7xl font-serif font-black text-gray-900 mb-8 tracking-tighter leading-none">
                9 Core <span class="gradient-text">Human Values</span>
            </h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto font-medium leading-relaxed italic border-l-4 border-accent-500 pl-8 text-left md:text-center md:border-l-0 md:pl-0">
                "The essence of harmony lies in understanding these nine foundational feelings, guiding us from basic trust to universal love."
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12">
            <!-- 1. Trust -->
            <div class="group relative p-10 rounded-[3rem] bg-white border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-700 hover:-translate-y-3 overflow-hidden slide-up">
                <div class="relative z-10">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 text-white flex items-center justify-center text-4xl mb-10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-glow-primary">🛡️</div>
                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="text-4xl font-serif font-black text-gray-900 leading-none">Trust</span>
                        <span class="text-primary-600 font-sans font-black text-sm uppercase tracking-widest">(Vishwas)</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-semibold mb-6">The foundational value; the assurance that the other person wants my happiness and prosperity.</p>
                </div>
            </div>

            <!-- 2. Respect -->
            <div class="group relative p-10 rounded-[3rem] bg-white border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-700 hover:-translate-y-3 overflow-hidden slide-up">
                <div class="relative z-10">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-accent-500 to-accent-700 text-white flex items-center justify-center text-4xl mb-10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-glow-accent">⚖️</div>
                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="text-4xl font-serif font-black text-gray-900 leading-none">Respect</span>
                        <span class="text-accent-600 font-sans font-black text-sm uppercase tracking-widest">(Samman)</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-semibold mb-6">Right evaluation; recognizing the other person as an individual with similar potential and purpose.</p>
                </div>
            </div>

            <!-- 3. Affection -->
            <div class="group relative p-10 rounded-[3rem] bg-white border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-700 hover:-translate-y-3 overflow-hidden slide-up">
                <div class="relative z-10">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-600 text-white flex items-center justify-center text-4xl mb-10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">💞</div>
                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="text-4xl font-serif font-black text-gray-900 leading-none">Affection</span>
                        <span class="text-pink-600 font-sans font-black text-sm uppercase tracking-widest">(Sneha)</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-semibold mb-6">The feeling of being related to the other; accepting the other as my relative.</p>
                </div>
            </div>

            <!-- 4. Care -->
            <div class="group relative p-10 rounded-[3rem] bg-white border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-700 hover:-translate-y-3 overflow-hidden slide-up">
                <div class="relative z-10">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center text-4xl mb-10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">🫂</div>
                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="text-4xl font-serif font-black text-gray-900 leading-none">Care</span>
                        <span class="text-emerald-600 font-sans font-black text-sm uppercase tracking-widest">(Mamta)</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-semibold mb-6">The feeling of responsibility and commitment to nurture and protect the body of the other.</p>
                </div>
            </div>

            <!-- 5. Guidance -->
            <div class="group relative p-10 rounded-[3rem] bg-white border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-700 hover:-translate-y-3 overflow-hidden slide-up">
                <div class="relative z-10">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 text-white flex items-center justify-center text-4xl mb-10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">🧭</div>
                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="text-4xl font-serif font-black text-gray-900 leading-none">Guidance</span>
                        <span class="text-indigo-600 font-sans font-black text-sm uppercase tracking-widest">(Vatsalya)</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-semibold mb-6">The feeling of responsibility and commitment to ensure Right Understanding in the other.</p>
                </div>
            </div>

            <!-- 6. Reverence -->
            <div class="group relative p-10 rounded-[3rem] bg-white border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-700 hover:-translate-y-3 overflow-hidden slide-up">
                <div class="relative z-10">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 text-white flex items-center justify-center text-4xl mb-10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">🙏</div>
                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="text-4xl font-serif font-black text-gray-900 leading-none">Reverence</span>
                        <span class="text-amber-600 font-sans font-black text-sm uppercase tracking-widest">(Shraddha)</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-semibold mb-6">The feeling of acceptance of excellence in the other; recognizing greatness in others.</p>
                </div>
            </div>

            <!-- 7. Glory -->
            <div class="group relative p-10 rounded-[3rem] bg-white border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-700 hover:-translate-y-3 overflow-hidden slide-up">
                <div class="relative z-10">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-violet-500 to-fuchsia-600 text-white flex items-center justify-center text-4xl mb-10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">✨</div>
                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="text-4xl font-serif font-black text-gray-900 leading-none">Glory</span>
                        <span class="text-violet-600 font-sans font-black text-sm uppercase tracking-widest">(Gaurav)</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-semibold mb-6">The feeling of acceptance for those who have made efforts for excellence in life.</p>
                </div>
            </div>

            <!-- 8. Gratitude -->
            <div class="group relative p-10 rounded-[3rem] bg-white border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-700 hover:-translate-y-3 overflow-hidden slide-up">
                <div class="relative z-10">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-500 text-white flex items-center justify-center text-4xl mb-10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">🌸</div>
                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="text-4xl font-serif font-black text-gray-900 leading-none">Gratitude</span>
                        <span class="text-cyan-600 font-sans font-black text-sm uppercase tracking-widest">(Kritagyata)</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-semibold mb-6">The feeling of acceptance for those who have made efforts for my excellence.</p>
                </div>
            </div>

            <!-- 9. Love -->
            <div class="group relative p-10 rounded-[3rem] bg-white border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-700 hover:-translate-y-3 overflow-hidden slide-up">
                <div class="relative z-10">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 text-white flex items-center justify-center text-4xl mb-10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">🧡</div>
                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="text-4xl font-serif font-black text-gray-900 leading-none">Love</span>
                        <span class="text-orange-600 font-sans font-black text-sm uppercase tracking-widest">(Prema)</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed font-semibold mb-6">The complete value; the feeling of being related to all human beings and nature.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- UHV Innovations Section -->
<?php if (!empty($featured_innovations)): ?>
<section class="py-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
            <div class="max-w-2xl">
                <div class="inline-flex items-center px-4 py-1.5 mb-6 glass rounded-full text-xs font-bold tracking-widest uppercase text-primary-600">
                    Student Projects & Research
                </div>
                <h2 class="text-5xl font-serif font-bold mb-6">
                    Digital <span class="gradient-text">UHV Initiatives</span>
                </h2>
                <p class="text-xl text-gray-600 font-light">
                    Witness how our students and faculty are leveraging technology to propagate human values and social harmony.
                </p>
            </div>
            <a href="<?= url('innovations') ?>"
                class="group flex items-center gap-3 px-8 py-4 glass-strong rounded-2xl font-bold hover:shadow-xl transition-all">
                View All Projects
                <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($featured_innovations as $project): ?>
            <div class="group card-3d glass-strong rounded-[2rem] overflow-hidden shadow-lg hover:shadow-2xl flex flex-col">
                <div class="relative h-64 overflow-hidden">
                    <?php if (!empty($project['thumbnail'])): ?>
                        <img src="<?= media($project['thumbnail']) ?>" alt="<?= e($project['title']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-primary-400 to-teal-400 flex items-center justify-center p-6 text-white text-5xl">
                            <?= $project['innovation_type'] === 'app' ? '📱' : ($project['innovation_type'] === 'website' ? '🌐' : '🛠️') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?= e($project['title']) ?></h3>
                    <p class="text-gray-600 text-sm mb-6 line-clamp-2"><?= e($project['short_description']) ?></p>
                    <a href="<?= e($project['link']) ?>" target="_blank"
                        class="text-primary-600 font-bold text-sm flex items-center group/link">
                        Learn More
                        <svg class="ml-2 w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action with 3D Cards -->
<section class="py-24 relative">
    <div class="max-w-6xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-5xl md:text-6xl font-serif font-bold mb-8">
            <span class="gradient-text">Join the Movement</span>
        </h2>
        <p class="text-2xl text-gray-600 mb-16 max-w-3xl mx-auto font-light">
            Small acts of responsibility create ripples of harmony in the world.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 max-w-2xl mx-auto">
            <a href="<?= url('voices') ?>" class="group card-3d glass-strong p-8 rounded-3xl shadow-lg hover:shadow-2xl text-center">
                <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Impact Stories</h3>
                <p class="text-gray-600">Read inspiring transformational journeys</p>
            </a>

            <a href="<?= url('activities') ?>" class="group card-3d glass-strong p-8 rounded-3xl shadow-lg hover:shadow-2xl text-center">
                <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Our Activities</h3>
                <p class="text-gray-600">See values in action</p>
            </a>
        </div>
    </div>
</section>
