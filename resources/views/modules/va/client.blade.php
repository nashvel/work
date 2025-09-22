<x-app-layout>
    <x-slot name="return">{"link": "/va/assignments", "text": "Manage"}</x-slot>
    <x-slot name="title">My Assigned Clients</x-slot>
    <x-slot name="url_1">{"link": "/va/my-clients", "text": "My Assigned Clients"}</x-slot>
    <x-slot name="active">My Clients</x-slot>
    <x-slot name="buttons">
        <a href="{{ route('va.assignments.index') }}" class="ti-btn text-white !border-0 btn-wave me-0"
            style="background-color:#2563eb">
            <i class="bi bi-gear me-1"></i><span class="mx-1" style="font-weight:400">Back to Manage</span>
        </a>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        @forelse($clients as $client)
            <div class="xl:col-span-3 col-span-3 mt-0 !mb-0">
                <div class="box team-member text-center border shadow-none rounded-xl overflow-hidden !mb-0">
                    <!-- Decorative top shape -->
                    <div class="team-bg-shape primary"></div>

                    <div class="box-body p-6 flex flex-col h-full">
                        <!-- Avatar -->
                        <div class="mb-3 flex justify-center">
                            <span
                                class="avatar avatar-xl avatar-rounded bg-primary ring-2 ring-offset-2 ring-primary/30">
                                @if ($client->profile_photo_path)
                                    <img src="{{ asset('storage/' . $client->profile_photo_path) }}"
                                        onerror="this.src='/user.png'" alt="{{ $client->name }}"
                                        class="card-img object-cover">
                                @else
                                    <img src="/user.png" alt="{{ $client->name }}" class="card-img object-cover">
                                @endif
                            </span>
                        </div>

                        <!-- Name -->
                        <h6 class="mb-2 font-semibold text-gray-800 dark:text-white">
                            {{ $client->name }}
                        </h6>

                        <!-- Email -->
                        <p class="text-xs text-gray-500 mb-4">{{ $client->email }}</p>

                        <!-- Optional: company -->
                        @if (!empty($client->company))
                            <p class="text-textmuted dark:text-textmuted/50 text-xs mb-4 leading-relaxed">
                                {{ $client->company }}
                            </p>
                        @endif

                        <!-- Navigate Portal Button -->
                        <div class="mt-auto">

                            <form action="{{ route('grant.access') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $client->id }}">
                                <button class="border rounded-lg bg-white w-98 btn-wave p-2">
                                    <i class="bi bi-box-arrow-up-right mx-2"></i>
                                    <span class="mx-1"> Navigate Portal</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <span class="text-center text-gray-500 py-6">No Client Portal Assign yet.</span>
        @endforelse

    </div>
</x-app-layout>
