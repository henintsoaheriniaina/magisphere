<x-layouts.app title="Administration" isAdmin>
    <div class="lg:col-span-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="rounded-lg bg-classic-black/10 p-3 dark:bg-classic-white/10">
                        <i data-feather="users" class="size-7"></i>
                    </div>
                    <a href="#">Voir plus</a>
                </div>
                <p>Utilisateurs</p>
                <div class="admin-card-body">
                    <h3 class="text-3xl font-bold">{{ number_format($userCount) }}</h3>
                    <x-admin.percentage :value="$userGrowthRate" />
                </div>
            </div>
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="rounded-lg bg-classic-black/10 p-3 dark:bg-classic-white/10">
                        <i data-feather="file-text" class="size-7"></i>
                    </div>
                    <a href="#">Voir plus</a>
                </div>
                <p>Publications</p>
                <div class="admin-card-body">
                    <h3 class="text-3xl font-bold">{{ number_format($postCount) }}</h3>
                    <x-admin.percentage :value="$postGrowthRate" />
                </div>
            </div>
            <div class="md:col-span-2">
                <h3 class="mb-6 text-2xl font-bold">Utilisateurs récents</h3>
                <livewire:admin.user-list />
            </div>
        </div>
    </div>
</x-layouts.app>
