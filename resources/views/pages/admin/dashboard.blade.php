<x-layouts.app title="Administration">
    <div class="lg:col-span-8">
        <h1 class="my-10 text-3xl font-black md:text-4xl">Administration</h1>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="rounded-lg bg-classic-black/10 p-3 dark:bg-classic-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    @role('admin|verificator')
                        <a href="{{ route('admin.users.create') }}"
                            class="hover:text-vintageRed-default hover:underline">Créer un utilisateur</a>
                    @endrole
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <a href="{{ route('admin.posts.index') }}"
                        class="hover:text-vintageRed-default hover:underline">Voir tout</a>
                </div>
                <p>Publications</p>
                <div class="admin-card-body">
                    <h3 class="text-3xl font-bold">{{ number_format($postCount) }}</h3>
                    <x-admin.percentage :value="$postGrowthRate" />
                </div>
            </div>
            <div class="mt-10 md:col-span-2">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-2xl font-bold">Utilisateurs récents</h3>
                    <a href="{{ route('admin.users.index') }}"
                        class="hover:text-vintageRed-default hover:underline">Voir tout</a>
                </div>
                <livewire:admin.user-list />
            </div>
            <div class="mt-10 md:col-span-2">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-2xl font-bold">Publications récentes</h3>
                    <a href="{{ route('admin.posts.index') }}"
                        class="hover:text-vintageRed-default hover:underline">Voir tout</a>
                </div>
                <livewire:admin.post-list />
            </div>
        </div>
    </div>
</x-layouts.app>
