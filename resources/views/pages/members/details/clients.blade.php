<x-app-layout>

    <x-slot name="title">Manage Clients</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Clients</x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-8 col-span-12">
            <div class="box custom-box">

                @php
                    $client = App\Models\ContactPerson::where('id', $id)->first();
                @endphp

                <form action="{{ route('client.update', $id) }}" method="POST" enctype="multipart/form-data"
                    autocomplete="off" autocomplete="on">
                    @csrf
                    <div class="box-body p-5">
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                role="alert">
                                <strong class="font-bold">Whoops! Something went wrong.</strong>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <hr>
                        @endif

                        <div class="flex items-center gap-2 flex-wrap ">

                            <div class="flex items-start flex-wrap gap-4 p-2">
                                <div>
                                    <span class="avatar avatar-xxl">
                                        <img src="{{ asset('storage/' . $client->photo) }}"
                                            onerror="this.src = '/avatar.png'" alt="" id="profile-img">
                                    </span>
                                </div>

                                <div>
                                    <div class="btn-list mb-1 mt-3">
                                        <label for="profile-change"
                                            class="ti-btn ti-btn-sm ti-btn-soft-light text-dark btn-wave waves-effect waves-light">
                                            <i class="ri-upload-2-line me-1"></i>Change Image
                                        </label>
                                        <input type="file" name="photo" id="profile-change" class="hidden"
                                            accept="image/*">
                                        <button type="button" id="remove-img"
                                            class="ti-btn ti-btn-sm ti-btn-light btn-wave waves-effect waves-light">
                                            <i class="ri-delete-bin-line me-1"></i>Remove
                                        </button>
                                    </div>
                                    <span class="block text-xs text-textmuted dark:text-textmuted/50">
                                        Use JPEG, PNG, or GIF. Best size: 200x200 pixels. Keep it under 5MB
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-0 mb-5">
                        @include('pages.members.partials.client-details')
                    </div>

                    <div class="box-footer flex gap-3 justify-end ">
                        <button type="button" onclick="remove_data({{ $id }}, 'client')"
                            class="bg-gray-100 text-danger px-4 py-2 rounded-md !hover:bg-green-800 transition">
                            <i class="bi bi-trash "></i>
                            <span class="mx-1">Delete</span>
                        </button>
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-md !hover:bg-green-800 transition">
                            <i class="bi bi-check2-circle"></i>
                            <span class="mx-1">Save Changes</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="xxl:col-span-4 col-span-12">

            @php
                $user = Auth::user();
                $clientId = null;

                if ($user->role === 'Virtual Assistant') {
                    $clientId = $user->company;
                } elseif ($user->role === 'Sub-Client') {
                    $clientId = App\Models\Clients::where('email', $user->email)->value('lead_id');
                } else {
                    $clientId = App\Models\Lead::where('email', $user->email)->value('id');
                }

                $id = $clientId;

                $lead_profile = App\Models\Lead::where('id', $id)->first();

                $credit_total = App\Models\Credit::where('client_id', $id)->where('type', 'add')->sum('amount');
                $credit_charge = App\Models\Credit::where('client_id', $id)->where('type', 'charge')->sum('amount');

                $remaining_credit = $credit_total - $credit_charge;
                $percentage = $credit_total > 0 ? ($remaining_credit / $credit_total) * 100 : 0;

                $progressClass = 'bg-success'; // Default
                $progressClassText = 'text-success'; // Default

                if ($percentage < 20) {
                    $progressClass = 'bg-danger';
                    $progressClassText = 'text-danger';
                } elseif ($percentage >= 20 && $percentage <= 60) {
                    $progressClass = 'bg-primary';
                    $progressClassText = 'text-primary';
                }

            @endphp

            <div class="sm:col-span-6 xl:col-span-6 col-span-12">
                <div class="box overflow-hidden main-content-card">
                    <div class="box-body">
                        <div class="flex items-start justify-between ">
                            <div>
                                <span class="text-textmuted dark:text-textmuted/50 block mb-1">Total
                                    Credit</span>
                                <h4 class="font-medium mb-0">{{ number_format($remaining_credit, 0) }} /
                                    <b>{{ number_format($credit_total, 0) }}</b> hours
                                </h4>
                            </div>

                        </div>
                        <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Remaining Credit
                            <span class="{{ $progressClassText }}">{{ number_format($percentage, 0) }}%</span>
                        </div>
                        <div class="progress progress-lg !rounded-full p-1 ms-auto bg-primary/10 mb-2 mt-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated {{ $progressClass }}"
                                role="progressbar" style="width: {{ number_format($percentage, 0) }}%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="box custom-box">
                <div class="box-body" style="min-height: 320px">
                    <i class="bi bi-bell px-1"></i> Pending Invitations
                    <span class="mx-2 translate-middle badge !rounded-full bg-danger">1</span>
                    <hr class="mb-3 mt-3">
                    <p class="text-center text-dark p-6">
                        No Available Records Yet.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-body">
                    <i class="bi bi-clock-history px-1"></i> Project Biddings
                    <hr class="mb-3 mt-3">
                    @include('pages.members.tables.projects')
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('profile-change').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('remove-img').addEventListener('click', function() {
            document.getElementById('profile-img').src = "/assets/images/faces/9.jpg";
            document.getElementById('profile-change').value = '';
        });
    </script>
</x-app-layout>
