<?php
$adminSections = [
    'admin' => ['label' => 'Dashboard', 'icon' => '📊'],
    'admin/users' => ['label' => 'Users', 'icon' => '👥'],
    'admin/reflections' => ['label' => 'Scenarios', 'icon' => '💡'],
    'admin/activities' => ['label' => 'Activities', 'icon' => '🎯'],
    'admin/voices' => ['label' => 'Stories Moderation', 'icon' => '🎙️'],
    'admin/innovations' => ['label' => 'Innovations', 'icon' => '🚀'],
    'admin/resources' => ['label' => 'Resources', 'icon' => '📚'],
    'admin/faculty' => ['label' => 'Faculty', 'icon' => '🎓'],
    'admin/quotes' => ['label' => 'Quotes', 'icon' => '💬'],
    'admin/news' => ['label' => 'News Ticker', 'icon' => '📢'],
    'admin/messages' => ['label' => 'Inbox', 'icon' => '📬'],
    'admin/journals' => ['label' => 'Journals', 'icon' => '📖'],
];
$currentUri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
// fallback for query param route
if (isset($_GET['route'])) {
    $currentUri = trim($_GET['route'], '/');
}
?>
<div class="mb-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-gray-200">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-primary-100 text-primary-700 text-xs font-bold rounded-full uppercase tracking-wider mb-2">
                UHV PCCOE Administration
            </div>
            <h1 class="text-3xl md:text-4xl font-serif font-bold text-gray-900"><?= e($title ?? 'Control Panel') ?></h1>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?= url('') ?>" target="_blank" class="px-5 py-2.5 glass rounded-xl text-sm font-bold text-gray-700 hover:bg-white transition-all flex items-center gap-2">
                <span>View Live Site</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </a>
            <a href="<?= url('logout') ?>" class="px-5 py-2.5 bg-rose-50 text-rose-600 rounded-xl text-sm font-bold hover:bg-rose-100 transition-all">
                Sign Out
            </a>
        </div>
    </div>

    <!-- Admin Subnav Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto py-4 scrollbar-none">
        <?php foreach ($adminSections as $route => $sec): ?>
            <?php
            $isActive = ($currentUri === $route) || (str_starts_with($currentUri, $route . '/'));
            ?>
            <a href="<?= url($route) ?>"
                class="px-4 py-2.5 rounded-2xl text-xs md:text-sm font-bold whitespace-nowrap transition-all flex items-center gap-2 <?= $isActive ? 'bg-primary-600 text-white shadow-md shadow-primary-500/20' : 'glass text-gray-600 hover:bg-white hover:text-gray-900' ?>">
                <span><?= $sec['icon'] ?></span>
                <span><?= $sec['label'] ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</div>
