<div class="flex items-center justify-center min-h-[85vh] py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Abstract blobs -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-tr from-teal-100 to-primary-100 rounded-full blur-3xl opacity-60 -z-10 pointer-events-none"></div>

    <div class="max-w-md w-full glass-strong p-10 rounded-[2.5rem] shadow-3d border border-white/50 relative">
        <div class="text-center mb-10">
            <a href="<?= url('') ?>"
                class="inline-flex w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-500 to-primary-600 items-center justify-center font-serif font-bold text-2xl mb-6 shadow-glow-primary text-white">
                U
            </a>
            <h2 class="text-4xl font-serif font-bold mb-2">
                <span class="gradient-text">Join Us</span>
            </h2>
            <p class="mt-2 text-base text-gray-600">Start your journey of self-exploration.</p>
        </div>

        <form class="space-y-6" method="post" action="<?= url('signup') ?>">
            <?= csrf_field() ?>

            <div class="group">
                <label for="username" class="block text-sm font-bold text-gray-700 mb-2">Choose a Username</label>
                <input id="username" name="username" type="text" required
                    class="appearance-none rounded-2xl relative block w-full px-5 py-4 border-2 border-primary-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all bg-white/80 backdrop-blur-sm text-base"
                    placeholder="e.g. rahul_pccoe" value="<?= e($username ?? '') ?>">
                <p class="mt-2 text-sm text-gray-500">This will be your unique identifier</p>
                <?php if (!empty($errors['username'])): ?>
                    <p class="text-coral-500 text-sm mt-1 font-medium"><?= e($errors['username']) ?></p>
                <?php endif; ?>
            </div>

            <div class="group">
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                <input id="email" name="email" type="email" required
                    class="appearance-none rounded-2xl relative block w-full px-5 py-4 border-2 border-primary-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all bg-white/80 backdrop-blur-sm text-base"
                    placeholder="your.email@pccoepune.org" value="<?= e($email ?? '') ?>">
                <p class="mt-2 text-sm text-gray-500">We'll never share your email</p>
                <?php if (!empty($errors['email'])): ?>
                    <p class="text-coral-500 text-sm mt-1 font-medium"><?= e($errors['email']) ?></p>
                <?php endif; ?>
            </div>

            <div class="group">
                <label for="password1" class="block text-sm font-bold text-gray-700 mb-2">Create Password</label>
                <input id="password1" name="password1" type="password" required
                    class="appearance-none rounded-2xl relative block w-full px-5 py-4 border-2 border-primary-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all bg-white/80 backdrop-blur-sm text-base"
                    placeholder="At least 6 characters">
                <?php if (!empty($errors['password1'])): ?>
                    <p class="text-coral-500 text-sm mt-1 font-medium"><?= e($errors['password1']) ?></p>
                <?php endif; ?>
            </div>

            <div class="group">
                <label for="password2" class="block text-sm font-bold text-gray-700 mb-2">Confirm Password</label>
                <input id="password2" name="password2" type="password" required
                    class="appearance-none rounded-2xl relative block w-full px-5 py-4 border-2 border-primary-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all bg-white/80 backdrop-blur-sm text-base"
                    placeholder="Enter the same password again">
                <?php if (!empty($errors['password2'])): ?>
                    <p class="text-coral-500 text-sm mt-1 font-medium"><?= e($errors['password2']) ?></p>
                <?php endif; ?>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-lg font-bold rounded-full text-white bg-gradient-to-r from-teal-500 to-primary-600 hover:shadow-glow-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all shadow-lg hover:-translate-y-1">
                    Create Account
                </button>
            </div>

            <div class="text-center text-base pt-4">
                <span class="text-gray-600">Already a member?</span>
                <a href="<?= url('login') ?>" class="font-bold text-primary-600 hover:text-primary-700 ml-1">Sign in</a>
            </div>
        </form>
    </div>
</div>
