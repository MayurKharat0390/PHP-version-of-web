<div class="flex items-center justify-center min-h-[85vh] py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Ambient glow orbs -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-gradient-to-tr from-purple-200/50 via-indigo-200/40 to-teal-100/50 rounded-full blur-3xl opacity-70 -z-10 pointer-events-none"></div>

    <div class="max-w-md w-full glass-strong p-10 rounded-[2.5rem] shadow-3d border border-white/60 relative">
        <div class="text-center mb-10">
            <div class="inline-flex w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-600 to-indigo-700 items-center justify-center mb-6 shadow-glow-primary text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-2">
                Administration Portal
            </h2>
            <p class="text-sm text-gray-500 font-medium">UHV PCCOE Control Center • Restricted Access</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="mb-6 glass-strong border-2 border-rose-300 bg-rose-50/80 text-rose-700 px-5 py-3.5 rounded-2xl text-sm font-semibold text-center flex items-center justify-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span><?= e($error) ?></span>
            </div>
        <?php endif; ?>

        <form class="space-y-6" method="post" action="<?= url('admin/login') ?>">
            <?= csrf_field() ?>

            <div class="space-y-5">
                <div>
                    <label for="username" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Administrator Username</label>
                    <input id="username" name="username" type="text" required autofocus
                        class="appearance-none rounded-2xl relative block w-full px-5 py-4 border-2 border-primary-100 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all bg-white/80 backdrop-blur-sm text-base"
                        placeholder="Admin username" value="<?= e($username ?? '') ?>">
                </div>
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Password</label>
                    <input id="password" name="password" type="password" required
                        class="appearance-none rounded-2xl relative block w-full px-5 py-4 border-2 border-primary-100 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all bg-white/80 backdrop-blur-sm text-base"
                        placeholder="Enter password">
                </div>
            </div>

            <div class="pt-3">
                <button type="submit"
                    class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-base font-bold rounded-full text-white bg-gradient-to-r from-primary-600 via-primary-700 to-indigo-700 hover:shadow-glow-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all shadow-md hover:-translate-y-0.5 cursor-pointer">
                    Sign In to Admin Panel
                </button>
            </div>

            <div class="text-center pt-3">
                <a href="<?= url('') ?>" class="text-xs font-bold text-gray-500 hover:text-primary-600 transition-colors inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span>Return to Live Website</span>
                </a>
            </div>
        </form>
    </div>
</div>
