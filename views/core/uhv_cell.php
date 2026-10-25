<!-- Hero Section -->
<section class="relative py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-widest uppercase text-primary-600 bg-primary-50 rounded-full">Institutional Framework</span>
            <h1 class="text-4xl md:text-6xl font-serif font-black text-gray-900 mb-6 leading-tight">
                <span class="gradient-text">Institute Universal Human Values Cell</span>
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed font-medium">
                Implementing Universal Human Values through structured programs and collaborative mentorship.
            </p>
        </div>
    </div>
</section>

<!-- Objectives Section -->
<section class="py-16 bg-white/50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-8">
                    Objectives of the <br><span class="text-primary-600">Institute Universal Human Values Cell</span>
                </h2>
                <div class="space-y-6">
                    <?php foreach ($objectives as $idx => $obj): ?>
                    <div class="flex items-start gap-4 p-5 rounded-2xl bg-white shadow-sm hover:shadow-md transition-all border border-gray-100 group">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center text-primary-600 font-bold group-hover:bg-primary-600 group-hover:text-white transition-colors">
                            <?= $idx + 1 ?>
                        </div>
                        <p class="text-gray-700 font-medium leading-relaxed">
                            <?= e($obj) ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-tr from-primary-100 to-accent-100 rounded-[2rem] blur-2xl opacity-50"></div>
                <div class="relative rounded-3xl overflow-hidden shadow-2xl bg-white p-8">
                    <img src="<?= asset('images/uhv_cell_concept.png') ?>" alt="UHV Cell Concept" class="w-full h-auto rounded-2xl mb-8">
                    <div class="p-6 bg-primary-900 rounded-2xl text-white">
                        <h4 class="font-bold text-xl mb-2">Our Vision</h4>
                        <p class="text-primary-50 font-sans font-semibold leading-relaxed">"To create a values-based educational ecosystem that fosters holistic development of students and staff."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Members Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
        <h2 class="text-3xl md:text-5xl font-serif font-black text-gray-900 mb-4">Cell <span class="text-primary-600">Members</span></h2>
        <p class="text-gray-600 max-w-2xl mx-auto font-medium">Dedicated faculty and staff committed to building a values-driven campus.</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[2rem] shadow-glass overflow-hidden border border-white/50">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-8 py-6 text-left text-sm font-bold text-gray-500 uppercase tracking-widest">Sr. No.</th>
                        <th class="px-8 py-6 text-left text-sm font-bold text-gray-500 uppercase tracking-widest">Role</th>
                        <th class="px-8 py-6 text-left text-sm font-bold text-gray-500 uppercase tracking-widest">Name</th>
                        <th class="px-8 py-6 text-left text-sm font-bold text-gray-500 uppercase tracking-widest">Designation / Dept</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($members as $member): ?>
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-8 py-6 text-gray-400 font-mono text-sm"><?= e($member['sr']) ?></td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 rounded-full text-xs font-bold <?= $member['role'] === 'Chairperson' ? 'bg-primary-100 text-primary-700' : ($member['role'] === 'Convener' ? 'bg-accent-100 text-accent-800' : 'bg-gray-100 text-gray-600') ?>">
                                <?= e($member['role']) ?>
                            </span>
                        </td>
                        <td class="px-8 py-6 font-bold text-gray-900 group-hover:text-primary-600 transition-colors">
                            <div class="flex items-center gap-4">
                                <?php if (!empty($member['image'])): ?>
                                <div class="w-20 h-20 md:w-24 md:h-24 rounded-3xl overflow-hidden shadow-xl border-4 border-white flex-shrink-0 bg-primary-50 group-hover:scale-110 transition-transform duration-500 ring-4 ring-primary-50/50">
                                    <img src="<?= asset($member['image']) ?>" alt="<?= e($member['name']) ?>" class="w-full h-full object-cover">
                                </div>
                                <?php endif; ?>
                                <span class="text-lg"><?= e($member['name']) ?></span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-gray-600 font-medium"><?= e($member['dept']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
