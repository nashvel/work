@php
    use App\Models\User;
@endphp

<x-app-layout>
    <x-slot name="return">{"link": "/users/manage", "text": "Back"}</x-slot>
    <x-slot name="url_1">{"link": "/users/manage", "text": "User Management"}</x-slot>
    <x-slot name="url_2">{"link": "/users/manage/xx/details", "text": "Tools"}</x-slot>
    <x-slot name="active">Details</x-slot>
    <x-slot name="buttons"></x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <!-- Header -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                                Developer — Helper
                            </h1>
                            <p class="text-sm text-gray-500">
                                Activate Google Drive access for a user. Use search to filter quickly.
                            </p>
                        </div>
                        <div class="relative w-full md:w-80">
                            <input
                                id="userSearch"
                                type="text"
                                placeholder="Search name or email…"
                                class="w-full rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16Z"/>
                            </svg>
                        </div>
                    </div>

                    <hr class="my-4">

                    @if ($errors->any())
                        <div class="rounded-xl border border-red-200 bg-red-50/80 p-4 text-sm text-red-800">
                            <div class="font-semibold">Whoops! Something went wrong:</div>
                            <ul class="list-disc list-inside mt-2">
                                @foreach ($errors->all() as $error)
                                    <li><i>{{ $error }}</i></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Responsive table -> cards on small screens -->
                    <div class="mt-4">
                        <div class="overflow-x-auto rounded-xl ring-1 ring-gray-200 dark:ring-white/10">
                            <table class="min-w-full text-sm hidden md:table">
                                <thead class="bg-gray-50 dark:bg-gray-800/50">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">User</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Email</th>
                                        <th class="px-4 py-3 text-right font-semibold text-gray-600">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody" class="divide-y divide-gray-100 dark:divide-white/10">
                                    @foreach (User::get() as $user)
                                        <tr class="hover:bg-gray-50/60 dark:hover:bg-gray-800/40 transition">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-9 w-9 rounded-full bg-indigo-100 text-indigo-700 grid place-items-center font-semibold">
                                                        {{ strtoupper(mb_substr($user->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                                        <div class="text-xs text-gray-500 md:hidden">{{ $user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $user->email }}</td>
                                            <td class="px-4 py-3 text-right">
                                                <button
                                                    type="button"
                                                    class="ti-btn ti-btn-primary btn-wave rounded-lg px-3 py-2 text-sm font-semibold inline-flex items-center gap-2 activate-btn"
                                                    data-user-id="{{ $user->id }}"
                                                >
                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z"/>
                                                    </svg>
                                                    Activate Google Drive
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Card list for mobile -->
                            <div id="userCardList" class="md:hidden divide-y divide-gray-100 dark:divide-white/10">
                                @foreach (User::get() as $user)
                                    <div class="p-4">
                                        <div class="flex items-start justify-between gap-3">
                                            <div class="flex items-center gap-3">
                                                <div class="h-9 w-9 rounded-full bg-indigo-100 text-indigo-700 grid place-items-center font-semibold">
                                                    {{ strtoupper(mb_substr($user->name ?? 'U', 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                            <button
                                                type="button"
                                                class="ti-btn ti-btn-primary btn-wave rounded-lg px-3 py-2 text-xs font-semibold inline-flex items-center gap-2 activate-btn"
                                                data-user-id="{{ $user->id }}"
                                            >
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z"/>
                                                </svg>
                                                Activate
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Scripts -->
                    <script>
                        (function () {
                            const csrf = '{{ csrf_token() }}';
                            const searchInput = document.getElementById('userSearch');
                            const tableBody = document.getElementById('userTableBody');
                            const cardList  = document.getElementById('userCardList');

                            // Simple filter (client-side)
                            function normalize(s){ return (s || '').toLowerCase().trim(); }
                            function filterLists(q){
                                const query = normalize(q);

                                // Table rows
                                if (tableBody) {
                                    [...tableBody.querySelectorAll('tr')].forEach(tr => {
                                        const name  = normalize(tr.querySelector('td:nth-child(1)')?.innerText);
                                        const email = normalize(tr.querySelector('td:nth-child(2)')?.innerText);
                                        tr.style.display = (name.includes(query) || email.includes(query)) ? '' : 'none';
                                    });
                                }

                                // Cards
                                if (cardList) {
                                    [...cardList.children].forEach(card => {
                                        const text = normalize(card.innerText);
                                        card.style.display = text.includes(query) ? '' : 'none';
                                    });
                                }
                            }

                            let searchTimer = null;
                            searchInput?.addEventListener('input', (e) => {
                                clearTimeout(searchTimer);
                                searchTimer = setTimeout(() => filterLists(e.target.value), 120);
                            });

                            // Activate handlers (shared for table & cards)
                            function setLoading(btn, on){
                                if (!btn) return;
                                if (on) {
                                    btn.dataset.prevText = btn.innerHTML;
                                    btn.disabled = true;
                                    btn.classList.add('opacity-70', 'pointer-events-none');
                                    btn.innerHTML = `
                                        <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v3m0 12v3m9-9h-3M6 12H3m15.364 6.364-2.121-2.121M8.757 8.757 6.636 6.636m10.728 0-2.121 2.121M8.757 15.243l-2.121 2.121"/>
                                        </svg>
                                        <span>Activating…</span>
                                    `;
                                } else {
                                    btn.disabled = false;
                                    btn.classList.remove('opacity-70', 'pointer-events-none');
                                    if (btn.dataset.prevText) btn.innerHTML = btn.dataset.prevText;
                                }
                            }

                            async function activateGoogleDrive(id, btn){
                                const confirmed = await Swal.fire({
                                    title: "Activate Google Drive?",
                                    text: "This will enable Google Drive integration for the selected user.",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Yes, activate",
                                }).then(r => r.isConfirmed);

                                if (!confirmed) return;

                                try {
                                    setLoading(btn, true);

                                    const res = await fetch('/google-drive-actived', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-Token': csrf,
                                            'Accept': 'application/json',
                                        },
                                        body: JSON.stringify({ id })
                                    });

                                    if (!res.ok) {
                                        const text = await res.text();
                                        throw new Error(text || 'Request failed');
                                    }

                                    // Expecting the response to be a redirect URL
                                    let redirectUrl = '';
                                    try {
                                        const data = await res.json();
                                        redirectUrl = data || '';
                                    } catch {
                                        redirectUrl = await res.text();
                                    }

                                    await Swal.fire({
                                        title: "Activated!",
                                        text: "Google Drive has been activated for the user.",
                                        icon: "success",
                                        timer: 1500,
                                        showConfirmButton: false
                                    });

                                    if (redirectUrl) {
                                        window.location.href = redirectUrl;
                                    }
                                } catch (err) {
                                    console.error(err);
                                    Swal.fire({
                                        title: "Error",
                                        text: "There was a problem activating Google Drive. " + (err?.message || ''),
                                        icon: "error"
                                    });
                                } finally {
                                    setLoading(btn, false);
                                }
                            }

                            // Delegate clicks for both table & cards
                            document.addEventListener('click', (e) => {
                                const btn = e.target.closest('.activate-btn');
                                if (!btn) return;
                                const id = btn.getAttribute('data-user-id');
                                if (!id) return;
                                activateGoogleDrive(id, btn);
                            });
                        })();
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
