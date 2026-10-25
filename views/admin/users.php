<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    $title = 'User Management';
    include __DIR__ . '/_header.php';
    ?>

    <div class="glass-strong rounded-3xl p-8 shadow-sm overflow-hidden">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-serif font-bold text-gray-900">Registered Accounts</h2>
                <p class="text-sm text-gray-500">Manage user roles, privileges, and system access.</p>
            </div>
            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                Total: <?= count($users) ?> Users
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-bold uppercase tracking-wider text-gray-400">
                        <th class="py-4 px-4">User</th>
                        <th class="py-4 px-4">Email</th>
                        <th class="py-4 px-4">Current Role</th>
                        <th class="py-4 px-4">Change Role</th>
                        <th class="py-4 px-4">Joined</th>
                        <th class="py-4 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    <?php foreach ($users as $u): ?>
                        <?php
                        $roleBadge = 'Student';
                        $badgeClass = 'bg-blue-100 text-blue-700';
                        if (!empty($u['is_superuser'])) {
                            $roleBadge = 'Superuser';
                            $badgeClass = 'bg-purple-100 text-purple-700';
                        } elseif (!empty($u['is_staff'])) {
                            $roleBadge = 'Staff';
                            $badgeClass = 'bg-amber-100 text-amber-700';
                        } elseif (!empty($u['is_faculty'])) {
                            $roleBadge = 'Faculty';
                            $badgeClass = 'bg-emerald-100 text-emerald-700';
                        }
                        ?>
                        <tr class="hover:bg-white/50 transition-colors">
                            <td class="py-4 px-4 font-bold text-gray-900 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 text-white flex items-center justify-center font-bold text-xs">
                                    <?= strtoupper(substr($u['username'], 0, 1)) ?>
                                </div>
                                <span><?= e($u['username']) ?></span>
                            </td>
                            <td class="py-4 px-4 text-gray-600"><?= e($u['email'] ?: 'No email') ?></td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider <?= $badgeClass ?>">
                                    <?= $roleBadge ?>
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <form method="post" action="<?= url('admin/users/role') ?>" class="inline-flex items-center gap-2">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                    <select name="role" class="text-xs py-1.5 px-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-primary-500">
                                        <option value="student" <?= !empty($u['is_student']) && empty($u['is_faculty']) && empty($u['is_staff']) ? 'selected' : '' ?>>Student</option>
                                        <option value="faculty" <?= !empty($u['is_faculty']) ? 'selected' : '' ?>>Faculty</option>
                                        <option value="staff" <?= !empty($u['is_staff']) ? 'selected' : '' ?>>Staff / Admin</option>
                                    </select>
                                    <button type="submit" class="px-2.5 py-1 text-xs font-bold text-primary-600 hover:text-primary-800 bg-primary-50 rounded-lg">
                                        Update
                                    </button>
                                </form>
                            </td>
                            <td class="py-4 px-4 text-gray-400 text-xs">
                                <?= format_date($u['date_joined'], 'M j, Y') ?>
                            </td>
                            <td class="py-4 px-4 text-right">
                                <?php if ($u['id'] !== \App\Core\Auth::id()): ?>
                                    <form method="post" action="<?= url('admin/users/delete') ?>" class="inline" onsubmit="return confirm('Are you sure you want to permanently delete user <?= e($u['username']) ?>?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-600 rounded-lg text-xs font-bold hover:bg-rose-100 transition-all">
                                            Delete
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-xs text-gray-400 italic">Current User</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
