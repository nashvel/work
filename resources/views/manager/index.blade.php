<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-medium text-gray-900 dark:text-white">Users</h1>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Joined</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <a href="{{ route('manager.permissions', $user) }}" class="text-indigo-600 hover:text-indigo-900 p-2 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit Permissions">
                                                    Edit
                                                </a>
                                                <button onclick="openPreviewModal({{ $user->id }})" class="text-blue-600 hover:text-blue-900 p-2 hover:bg-blue-50 rounded-lg transition-colors" title="Preview Navigation">
                                                   View
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="navigationPreviewModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-xl w-96 max-h-[80vh] transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Navigation Preview</h3>
                <button onclick="closePreviewModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="p-4">
                <div class="text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400" id="accessSummary"></p>
                </div>
                
                <div class="mt-4">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Navigation Menu Preview:</h4>
                    <div id="navigationPreview" class="text-xs"></div>
                </div>
            </div>
            
            <div class="flex justify-end p-4 border-t border-gray-200 dark:border-gray-700">
                <button onclick="closePreviewModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentPreviewUrl = '';
        
        let isLoading = false;
        
        async function openPreviewModal(userId) {
            if (isLoading) return;
            
            isLoading = true;
            currentPreviewUrl = `/manager/${userId}/preview`;
            
            const modal = document.getElementById('navigationPreviewModal');
            const modalContent = document.getElementById('modalContent');
            const navLinksContainer = document.getElementById('previewNavLinks');
            const accessSummary = document.getElementById('accessSummary');
            
            if (navLinksContainer) {
                navLinksContainer.innerHTML = '<div class="flex justify-center"><div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div></div>';
            }
            if (accessSummary) {
                accessSummary.textContent = 'Loading...';
            }
            
            const navigationPreview = document.getElementById('navigationPreview');
            if (navigationPreview) {
                navigationPreview.innerHTML = '<span class="text-xs text-gray-500">Loading navigation...</span>';
            }
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
            
            try {
                const response = await fetch(currentPreviewUrl);
                const data = await response.json();
                
                const modal = document.getElementById('navigationPreviewModal');
                const modalContent = document.getElementById('modalContent');
                const navLinksContainer = document.getElementById('previewNavLinks');
                if (navLinksContainer) {
                    navLinksContainer.style.display = 'none';
                }
                
                if (accessSummary) {
                    accessSummary.textContent = `${data.accessible_count} of ${data.total_routes} routes accessible`;
                }
                
                const navigationPreview = document.getElementById('navigationPreview');
                if (navigationPreview) {
                    navigationPreview.innerHTML = `
                    <div class="bg-white border border-gray-200 rounded-md overflow-hidden" style="transform: scale(0.8); transform-origin: top left;">
                        <div class="px-3 py-2">
                            <div class="flex items-center h-8">
                                <div class="flex items-center">
                                    <!-- Jetstream Logo -->
                                    <div class="shrink-0 flex items-center mr-6">
                                        <svg class="h-6 w-6" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"/>
                                            <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"/>
                                        </svg>
                                    </div>

                                    <!-- Navigation Links -->
                                    <div class="flex flex-wrap gap-x-4 gap-y-1 items-center">
                                        <a href="#" class="text-indigo-600 border-b-2 border-indigo-600 px-1 pb-1 text-xs font-medium">Dashboard</a>
                                        ${data.routes.map(route => 
                                            `<a href="#" class="text-gray-500 hover:text-gray-700 px-1 pb-1 text-xs font-medium">${route.title}</a>`
                                        ).join('')}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                }
                
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
                
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closePreviewModal();
                    }
                });
            } catch (error) {
                console.error('Error fetching preview:', error);
                navLinksContainer.innerHTML = '<div class="text-red-600 text-center">Error loading preview</div>';
                accessSummary.textContent = 'Failed to load data';
                
                const navigationPreview = document.getElementById('navigationPreview');
                navigationPreview.innerHTML = '<span class="text-xs text-red-500">Error loading navigation</span>';
            } finally {
                isLoading = false;
            }
        }
        
        function closePreviewModal() {
            const modal = document.getElementById('navigationPreviewModal');
            const modalContent = document.getElementById('modalContent');
            if (modal && modalContent) {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }
    </script>
</x-app-layout>
