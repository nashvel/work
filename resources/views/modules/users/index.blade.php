<x-app-layout>

    <x-slot name="return">{"link": "/users/manage", "text": "back"}</x-slot>
    <x-slot name="url_1">{"link": "/users/manage", "text": "User Management"}</x-slot>
    <x-slot name="active">User Accounts</x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <!-- Left: title + subtitle -->
                        <div>
                            <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                                <strong>User Management</strong>
                            </h6>
                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                You can add, update, assign roles, and manage all user accounts in your system.
                            </span>
                        </div>

                        <!-- Right: actions -->
                        <div class="inline-flex items-center gap-2">
                            <button type="button"
                                class="inline-flex items-center gap-2 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                                <i class="bi bi-arrow-down"></i> Import
                            </button>

                            <a href="x"
                                class="inline-flex items-center gap-2 rounded-md border bg-white border-slate-300  px-3 py-2 text-sm font-medium text-slate-700 hover:bg-gray-500">
                                <i class="bi bi-plus-lg"></i> New User
                            </a>

                        </div>
                    </div>


                    <hr class="mb-3 !mt-3">
                    @if ($errors->any())
                        <div
                            class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm flex items-center mx-3">
                            <div>
                                <strong class="text-danger">Whoops! Something went wrong:</strong>
                                <ul class="list-disc list-inside mt-2 mx-4">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-dark"><i>{{ $error }}</i></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="custom-box">
                        @include('modules.users.tables.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
