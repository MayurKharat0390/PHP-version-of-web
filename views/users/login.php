<div class="flex items-center justify-center min-h-[85vh] py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Abstract blobs -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-tr from-purple-100 to-teal-100 rounded-full blur-3xl opacity-60 -z-10 pointer-events-none"></div>

    <div class="max-w-md w-full glass-strong p-10 rounded-[2.5rem] shadow-3d border border-white/50 relative">
        <div class="text-center mb-10">
            <a href="<?= url('') ?>"
                class="inline-flex w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-700 items-center justify-center font-serif font-bold text-2xl mb-6 shadow-lg text-white">
                U
            </a>
            <h2 class="text-4xl font-serif font-bold mb-2">
                <span class="gradient-text">Welcome Back</span>
            </h2>
            <p class="mt-2 text-base text-gray-600">Sign in to access your journal & reflections</p>
        </div>

        <form class="space-y-6" method="post" action="<?= url('login') ?>">
            <?= csrf_field() ?>

            <?php if (!empty($error)): ?>
                <div class="glass-strong border-2 border-coral-300 text-coral-700 px-5 py-4 rounded-2xl text-base text-center font-medium">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <div class="space-y-5">
                <div>
                    <label for="username" class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                    <input id="username" name="username" type="text" required
                        class="appearance-none rounded-2xl relative block w-full px-5 py-4 border-2 border-primary-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all bg-white/80 backdrop-blur-sm text-base"
                        placeholder="Enter your username" value="<?= e($username ?? '') ?>">
                </div>
                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <input id="password" name="password" type="password" required
                        class="appearance-none rounded-2xl relative block w-full px-5 py-4 border-2 border-primary-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all bg-white/80 backdrop-blur-sm text-base"
                        placeholder="Enter your password">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-lg font-bold rounded-full text-white bg-gradient-to-r from-purple-500 to-purple-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all shadow-md hover:-translate-y-1">
                    Sign In
                </button>
            </div>

            <div class="text-center text-base pt-4">
                <span class="text-gray-600">Don't have an account?</span>
                <a href="<?= url('signup') ?>" class="font-bold text-purple-600 hover:text-purple-700 ml-1">Create one</a>
            </div>
        </form>
    </div>
</div>

<style>
    input:focus {
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1) !important;
    }
</style>
