<x-app-layout>
    @php
        $client = App\Models\ContactPerson::where('id', $id)->first();
        $company = App\Models\Contact::where('id', $client->company_id)->first();
    @endphp
    <x-slot name="title">{{ $client->first_name }} {{ $client->last_name }} ({{ $company->company_name }})</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "CRM Engagement"}</x-slot>
    <x-slot name="active">Clients</x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-12 col-span-12">
            <div class="box custom-box">

                <form action="{{ route('sales.update', $id) }}" method="POST" enctype="multipart/form-data"
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
                        <table
                            class="ti-custom-table ti-custom-table-head !border border-defaultborder dark:border-defaultborder/10">

                            <!-- Company and Position -->
                            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                <td width="100"
                                    class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                    Complete Name: <strong class="text-danger">*</strong>
                                </td>
                                <td colspan="3"
                                    class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
                                    <div class="relative p-1">
                                        <input type="text" name="" id="" placeholder="Company"
                                            readonly
                                            value="{{ $client->first_name }} {{ $client->last_name }} ({{ $company->company_name }})"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-building"></i>
                                        </div>
                                    </div>
                                </td>
                                <td width="100"
                                    class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                    Status : <strong class="text-danger">*</strong>
                                </td>
                                <td width="120" colspan="2"
                                    class="border-2 border-defaultborder dark:border-defaultborder/10 !p-0 !m-0">
                                    <div class="relative p-1">
                                        <select name="status" id="status"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10">
                                            <option value="" disabled selected>Select Status</option>
                                            <option value="New" {{ $client->status == 'New' ? 'selected' : '' }}>New
                                                – Just entered the system, not yet contacted</option>
                                            <option value="Contacted"
                                                {{ $client->status == 'Contacted' ? 'selected' : '' }}>Contacted –
                                                Initial contact made</option>
                                            <option value="Interested"
                                                {{ $client->status == 'Interested' ? 'selected' : '' }}>Interested –
                                                Positive response or interest shown</option>
                                            <option value="In Discussion"
                                                {{ $client->status == 'In Discussion' ? 'selected' : '' }}>In
                                                Discussion – Ongoing communication</option>
                                            <option value="Qualified"
                                                {{ $client->status == 'Qualified' ? 'selected' : '' }}>Qualified –
                                                Verified as a good potential client</option>
                                            <option value="Unqualified"
                                                {{ $client->status == 'Unqualified' ? 'selected' : '' }}>Unqualified –
                                                Not a fit or dropped lead</option>
                                            <option value="Follow-up"
                                                {{ $client->status == 'Follow-up' ? 'selected' : '' }}>Follow-up –
                                                Scheduled for future check-in</option>
                                            <option value="No Response"
                                                {{ $client->status == 'No Response' ? 'selected' : '' }}>No Response –
                                                Contacted but no reply</option>
                                            <option value="On Hold"
                                                {{ $client->status == 'On Hold' ? 'selected' : '' }}>On Hold –
                                                Temporarily paused</option>
                                            <option value="Archived"
                                                {{ $client->status == 'Archived' ? 'selected' : '' }}>Archived – Closed
                                                without conversion</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </table>

                    </div>

                    <div class="box-footer flex gap-3 justify-end ">
                        <button type="button" onclick="remove_data({{ $id }}, 'sales')"
                            class="bg-gray-100 text-danger px-4 py-2 rounded-md !hover:bg-green-800 transition">
                            <i class="bi bi-trash "></i>
                            <span class="mx-1">Delete</span>
                        </button>
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-md !hover:bg-green-800 transition">
                            <i class="bi bi-check2-circle"></i>
                            <span class="mx-1">Update Status</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-x-6">
        
        <div class="xxl:col-span-8 col-span-12">
            <div class="box custom-box shadow-md border border-gray-200 rounded-lg bg-white">
                <div class="box-body p-6">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
                        <i class="bi bi-stickies text-yellow-500"></i> Your Notes
                    </h2>
        
                    @php
                        $notes = App\Models\Note::where('user_id', Auth::id())->where('client_id', $id)->latest()->get();
                    @endphp
        
                    <div class="space-y-4">
                        @forelse($notes as $note)
                            <div class="border rounded-lg p-4 bg-gray-50 relative shadow-sm hover:shadow-md transition duration-200">
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="right: 20px; font-size: 11px" class="absolute  text-xs text-end">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this note?')"
                                            class="text-red-500 hover:text-red-700 text-xs">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>

                                <h5 class="font-semibold text-gray-800 mb-1">{{ $note->title }}</h5>
                                <p class="text-sm text-gray-700">{{ $note->content }}</p>
                                <span class="text-xs text-gray-500 block mt-2">{{ $note->created_at->diffForHumans() }}</span>
        
                                {{-- Delete Button at the Bottom --}}
                                
                            </div>
                        @empty
                            <p class="text-gray-500 italic">No notes yet. Start by adding a note on the left.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="xxl:col-span-4 col-span-12">
            <div class="box custom-box shadow-md border border-gray-200 rounded-lg bg-white">
                <div class="box-body p-6">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded flex items-center gap-2">
                            <i class="bi bi-check-circle-fill text-green-500"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
        
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
                        <i class="bi bi-journal-text text-blue-600"></i> Add a New Note
                    </h2>
        
                    <form action="{{ route('notes.store') }}" method="POST" class="space-y-4">
                        @csrf
        
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" name="title" id="title" placeholder="e.g. Meeting Notes"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" required>
                        </div>
        
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                            <input type="hidden" name="id" value="{{ $id }}">
                            <textarea name="content" id="content" placeholder="Write your note here..."
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                                rows="5" required></textarea>
                        </div>
        
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md transition duration-150 ease-in-out">
                                <i class="bi bi-plus-circle me-1"></i> Add Note
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    {{-- <div class="box custom-box">
                <div class="box-body" style="min-height: 320px">
                    <i class="bi bi-bell px-1"></i> Pending Invitations
                    <span class="mx-2 translate-middle badge !rounded-full bg-danger">1</span>
                    <hr class="mb-3 mt-3">
                    <p class="text-center text-dark p-6">
                        No Available Records Yet.
                    </p>
                </div>
            </div> --}}

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

    {{-- @include('pages.crm.partials.company-contact') --}}

</x-app-layout>
