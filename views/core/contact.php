<section class="pt-6 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 w-64 h-64 bg-accent-100 rounded-full blur-3xl opacity-50"></div>
    <div class="absolute bottom-0 left-0 translate-y-24 -translate-x-12 w-96 h-96 bg-primary-100 rounded-full blur-3xl opacity-50"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-stretch">
            <!-- Left Side: Info -->
            <div class="flex flex-col justify-center">
                <span class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-widest uppercase text-primary-600 bg-primary-50 rounded-full self-start">Get In Touch</span>
                <h1 class="text-4xl md:text-6xl font-serif font-black text-gray-900 mb-8 leading-tight">
                    We'd Love to <br><span class="gradient-text">Hear From You</span>
                </h1>
                <p class="text-xl text-gray-600 mb-12 font-medium leading-relaxed">
                    Have questions about the UHV Cell, upcoming activities, or mentoring? Drop us a message and we'll get back to you as soon as possible.
                </p>

                <div class="space-y-8">
                    <div class="flex items-center gap-6 p-6 rounded-3xl bg-white shadow-glass border border-white/50 hover:scale-105 transition-transform">
                        <div class="w-14 h-14 rounded-2xl bg-primary-600 flex items-center justify-center text-white shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Email Us</p>
                            <p class="text-xl font-bold text-gray-900"><a href="mailto:uhv@pccoepune.org" class="hover:text-primary-600 transition-colors">uhv@pccoepune.org</a></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-6 p-6 rounded-3xl bg-white shadow-glass border border-white/50 hover:scale-105 transition-transform">
                        <div class="w-14 h-14 rounded-2xl bg-accent-500 flex items-center justify-center text-primary-900 shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Our Location</p>
                            <p class="text-xl font-bold text-gray-900">PCCOE, Sector 26, Nigdi, Pradhikaran, Pune</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="relative">
                <div class="absolute inset-0 bg-primary-900 rounded-[3rem] rotate-3 opacity-5"></div>
                <div class="relative bg-white rounded-[3rem] p-8 md:p-12 shadow-2xl border border-gray-100">
                    <form method="post" action="<?= url('contact') ?>" class="space-y-6">
                        <?= csrf_field() ?>

                        <?php if (!empty($errors)): ?>
                            <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-sm font-medium">
                                Please fix the errors below before submitting.
                            </div>
                        <?php endif; ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Full Name</label>
                                <input type="text" name="name" value="<?= e($name ?? '') ?>" required
                                    class="w-full px-5 py-4 rounded-2xl border-2 border-gray-100 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all outline-none text-lg bg-gray-50/50"
                                    placeholder="Your full name">
                                <?php if (!empty($errors['name'])): ?><p class="text-xs text-red-500 mt-1"><?= $errors['name'] ?></p><?php endif; ?>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Email Address</label>
                                <input type="email" name="email" value="<?= e($email ?? '') ?>" required
                                    class="w-full px-5 py-4 rounded-2xl border-2 border-gray-100 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all outline-none text-lg bg-gray-50/50"
                                    placeholder="your@email.com">
                                <?php if (!empty($errors['email'])): ?><p class="text-xs text-red-500 mt-1"><?= $errors['email'] ?></p><?php endif; ?>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Subject</label>
                            <input type="text" name="subject" value="<?= e($subject ?? '') ?>" required
                                class="w-full px-5 py-4 rounded-2xl border-2 border-gray-100 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all outline-none text-lg bg-gray-50/50"
                                placeholder="What can we help with?">
                            <?php if (!empty($errors['subject'])): ?><p class="text-xs text-red-500 mt-1"><?= $errors['subject'] ?></p><?php endif; ?>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Your Message</label>
                            <textarea name="message" required rows="5"
                                class="w-full px-5 py-4 rounded-2xl border-2 border-gray-100 focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all outline-none text-lg bg-gray-50/50 min-h-[150px]"
                                placeholder="Tell us more about your inquiry..."><?= e($message ?? '') ?></textarea>
                            <?php if (!empty($errors['message'])): ?><p class="text-xs text-red-500 mt-1"><?= $errors['message'] ?></p><?php endif; ?>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-primary-600 to-primary-800 text-white rounded-2xl py-5 text-lg font-bold shadow-glow-primary hover:shadow-xl hover:-translate-y-1 transition-all">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
