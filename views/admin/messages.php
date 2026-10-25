<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'Contact Messages Inbox';
    include __DIR__ . '/_header.php';
    ?>

    <div class="glass-strong rounded-3xl p-8 shadow-sm">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-serif font-bold text-gray-900">Inbound Inquiries</h2>
                <p class="text-sm text-gray-500">Messages sent via the website's Contact Us form.</p>
            </div>
            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                Total: <?= count($messages) ?> Messages
            </div>
        </div>

        <?php if (!empty($messages)): ?>
            <div class="space-y-4">
                <?php foreach ($messages as $msg): ?>
                    <div class="p-6 glass rounded-2xl border border-gray-100 flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="flex-grow">
                            <div class="flex flex-wrap items-center gap-3 mb-2">
                                <h3 class="font-bold text-gray-900 text-base"><?= e($msg['name']) ?></h3>
                                <a href="mailto:<?= e($msg['email']) ?>" class="text-xs font-bold text-primary-600 hover:underline">
                                    <?= e($msg['email']) ?>
                                </a>
                                <span class="text-xs text-gray-400">
                                    • <?= format_date($msg['created_at'], 'M j, Y g:i A') ?>
                                </span>
                            </div>
                            <h4 class="text-sm font-bold text-gray-800 mb-2">Subject: <?= e($msg['subject']) ?></h4>
                            <p class="text-sm text-gray-600 leading-relaxed bg-white/60 p-4 rounded-xl border border-gray-100">
                                <?= nl2br(e($msg['message'])) ?>
                            </p>
                        </div>
                        <div class="flex-shrink-0 flex items-center gap-2">
                            <a href="mailto:<?= e($msg['email']) ?>?subject=Re: <?= urlencode($msg['subject']) ?>"
                                class="px-4 py-2 bg-primary-600 text-white rounded-xl text-xs font-bold hover:bg-primary-700 transition-all">
                                Reply
                            </a>
                            <form method="post" action="<?= url('admin/messages/' . $msg['id'] . '/delete') ?>" onsubmit="return confirm('Delete this message?');">
                                <?= csrf_field() ?>
                                <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-600 rounded-xl text-xs font-bold hover:bg-rose-100 transition-all">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="py-16 text-center text-gray-400 italic">
                Inbox is empty. No messages have been submitted yet.
            </div>
        <?php endif; ?>
    </div>
</div>
