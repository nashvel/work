<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Permissions') }} - {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-medium text-gray-900 dark:text-white">Route Permissions</h1>
                        <button onclick="showPreview()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            Preview Navigation
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($routes as $route)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="mb-2">
                                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name:</span>
                                                <span class="text-lg font-medium text-gray-900 dark:text-white ml-2">{{ $route->title }}</span>
                                            </div>
                                            <div class="mb-2">
                                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description:</span>
                                                <span class="text-sm text-gray-600 dark:text-gray-400 ml-2">{{ $route->description }}</span>
                                            </div>
                                            <div>
                                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Path:</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-500 font-mono bg-gray-100 dark:bg-gray-600 px-2 py-1 rounded ml-2">{{ $route->path }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="checkbox" 
                                                       data-route-id="{{ $route->id }}"
                                                       data-user-id="{{ $user->id }}"
                                                       {{ (isset($currentPermissions[$route->id]) && $currentPermissions[$route->id]) ? 'checked' : '' }}
                                                       onchange="window.permissionsHook.handleToggleChange(this)"
                                                       class="sr-only permission-toggle"
                                                       @if(isset($currentPermissions[$route->id]) && $currentPermissions[$route->id]) data-initial-state="true" @else data-initial-state="false" @endif>
                                                <div class="relative">
                                                    <div class="w-12 h-6 {{ (isset($currentPermissions[$route->id]) && $currentPermissions[$route->id]) ? 'bg-blue-500' : 'bg-red-400' }} rounded-full shadow-inner transition-colors duration-200 toggle-bg"></div>
                                                    <div class="absolute w-5 h-5 bg-white rounded-full shadow-lg top-0.5 left-0.5 transition-transform duration-200 ease-in-out toggle-dot {{ (isset($currentPermissions[$route->id]) && $currentPermissions[$route->id]) ? 'translate-x-6' : 'translate-x-0' }}"></div>
                                                </div>
                                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 permission-status">
                                                    {{ (isset($currentPermissions[$route->id]) && $currentPermissions[$route->id]) ? 'Allowed' : 'Denied' }}
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('manager.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to Users
                            </a>
                        </div>

                        <div id="navigationPreviewModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden backdrop-blur-sm">
                            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-xl w-96 max-h-[80vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
                                <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Navigation Preview</h3>
                                    <button onclick="closePreview()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
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
                                    <button onclick="closePreview()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/toast.js') }}"></script>
    <script src="{{ asset('js/permissions-hook.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.toast = new Toast();
            window.permissionsHook = new PermissionsHook({
                updateUrl: '{{ route("manager.permissions.update", $user) }}',
                previewUrl: '{{ route("manager.preview", $user) }}',
                csrfToken: '{{ csrf_token() }}'
            });
            
            document.querySelectorAll('.permission-toggle').forEach(toggle => {
                window.permissionsHook.updateToggleStyle(toggle);
            });
        });
    </script>
</x-app-layout>
