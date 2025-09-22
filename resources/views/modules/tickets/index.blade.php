<x-app-layout>

    <x-slot name="title">Support Tickets</x-slot>
    <x-slot name="url_1">{"link": "/tickets", "text": "Tickets"}</x-slot>
    <x-slot name="active">Tickets</x-slot>
    <x-slot name="buttons">
        <a href="/tickets/create" class="ti-btn text-dark ti-btn-light shadow-none rounded-lg btn-wave me-0 waves-effect waves-light" >
            <i class="bi bi-ticket-perforated align-middle"></i>Submit Ticket
        </a>
    </x-slot>

    <div class="box">
        <div class="box-body">
            <h5 class="mb-4"><i class="bi bi-list-check me-1"></i> Ticket List</h5>

            <div class="table-responsive">
                <table
                    class="ti-custom-table ti-custom-table-head !border border-defaultborder dark:border-defaultborder/10 w-full">
                    <thead>
                        <tr
                            class="bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold uppercase tracking-wider border-b border-defaultborder dark:border-defaultborder/10">
                            <th class="p-3">Ticket ID</th>
                            <th class="p-3">Project</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Priority</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Created</th>
                            <th class="p-3">Submitted By</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                <td class="p-3 text-sm font-medium text-gray-900 dark:text-white">#{{ $ticket->id }}
                                </td>
                                <td class="p-3 text-sm">{{ $ticket->proj_name }}</td>
                                <td class="p-3 text-sm">
                                    @php
                                        $categoryIcon = match ($ticket->category) {
                                            'Bug' => 'bi-bug-fill text-red-500',
                                            'Suggestion' => 'bi-lightbulb-fill text-yellow-500',
                                            'Question' => 'bi-question-circle-fill text-blue-500',
                                            'Feedback' => 'bi-chat-left-text-fill text-green-500',
                                            default => 'bi-info-circle',
                                        };
                                    @endphp

                                    <i class="bi {{ $categoryIcon }} me-1"></i>
                                    {{ $ticket->category }}
                                </td>
                                {{-- Priority (Plain text only now) --}}
                                <td class="p-3 text-sm">
                                    {{ $ticket->priority }}
                                </td>

                                {{-- Status (Now with color badge) --}}
                                <td class="p-3 text-sm">
                                    <span
                                        class="inline-block rounded-full px-2 py-1 text-xs font-semibold
                                        {{ $ticket->status === 'Open'
                                            ? 'bg-blue-100 text-blue-600'
                                            : ($ticket->status === 'In Progress'
                                                ? 'bg-yellow-100 text-yellow-700'
                                                : ($ticket->status === 'Resolved'
                                                    ? 'bg-green-100 text-green-600'
                                                    : ($ticket->status === 'Closed'
                                                        ? 'bg-gray-200 text-gray-700'
                                                        : 'bg-slate-100 text-slate-600'))) }}">
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                <td class="p-3 text-sm">{{ $ticket->created_at->format('M d, Y') }}</td>
                                <td class="p-3 text-sm">
                                    {{ $ticket->user->name ?? 'N/A' }}
                                </td>
                                <td class="p-3 text-sm">
                                    <button data-hs-overlay="#ticket-modal-{{ $ticket->id }}"
                                        class="text-blue-600 hover:underline">
                                        <i class="bi bi-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-4 text-center text-sm text-gray-500">No tickets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

   @foreach ($tickets as $ticket)
<div id="ticket-modal-{{ $ticket->id }}" class="hs-overlay hidden ti-modal">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
        <div class="ti-modal-content">
            <div class="ti-modal-header">
                <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">
                    Ticket #{{ $ticket->id }}
                </h6>
                <button type="button" class="hs-dropdown-toggle text-[1rem] font-semibold text-defaulttextcolor"
                    data-hs-overlay="#ticket-modal-{{ $ticket->id }}">
                    <span class="sr-only">Close</span>
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="ti-modal-body px-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Project Name --}}
                        <div class="md:col-span-2">
                            <label class="font-semibold">Project Name</label>
                            <input type="text" name="proj_name" value="{{ $ticket->proj_name }}"
                                class="ti-form-input mt-1 w-full" required>
                        </div>

                        {{-- Category --}}
                        <div>
                            <label class="font-semibold">Category</label>
                            <select name="category" class="form-select mt-1 w-full">
                                <option value="Bug" {{ $ticket->category === 'Bug' ? 'selected' : '' }}>Bug</option>
                                <option value="Suggestion" {{ $ticket->category === 'Suggestion' ? 'selected' : '' }}>Suggestion</option>
                                <option value="Question" {{ $ticket->category === 'Question' ? 'selected' : '' }}>Question</option>
                                <option value="Feedback" {{ $ticket->category === 'Feedback' ? 'selected' : '' }}>Feedback</option>
                            </select>
                        </div>

                        {{-- Priority --}}
                        <div>
                            <label class="font-semibold">Priority</label>
                            <select name="priority" class="form-select mt-1 w-full">
                                <option value="Low" {{ $ticket->priority === 'Low' ? 'selected' : '' }}>Low</option>
                                <option value="Medium" {{ $ticket->priority === 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="High" {{ $ticket->priority === 'High' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="font-semibold">Status</label>
                            <select name="status" class="form-select mt-1 w-full">
                                <option value="Open" {{ $ticket->status === 'Open' ? 'selected' : '' }}>Open</option>
                                <option value="In Progress" {{ $ticket->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Resolved" {{ $ticket->status === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="Closed" {{ $ticket->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>

                        {{-- Submitted By --}}
                        <div>
                            <label class="font-semibold">Submitted By</label>
                            <input type="text" class="ti-form-input mt-1 w-full" value="{{ $ticket->user->name ?? 'N/A' }}"
                                readonly disabled>
                        </div>

                        {{-- Date Submitted --}}
                        <div>
                            <label class="font-semibold">Date Submitted</label>
                            <input type="text" class="ti-form-input mt-1 w-full"
                                value="{{ $ticket->created_at->format('F j, Y h:i A') }}" readonly disabled>
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label class="font-semibold">Description</label>
                            <textarea name="description" rows="4" class="ti-form-input mt-1 w-full"
                                placeholder="Enter description...">{{ $ticket->description }}</textarea>
                        </div>

                        {{-- Attachments --}}
                        @if (!empty($ticket->attachments))
                            <div class="md:col-span-2">
                                <label class="font-semibold">Existing Attachments</label>
                                <ul class="mt-2 space-y-2 list-disc list-inside">
                                    @foreach ($ticket->attachments as $file)
                                        <li>
                                            <a href="{{ asset('storage/' . $file) }}" class="text-blue-600 hover:underline"
                                                target="_blank">
                                                <i class="bi bi-paperclip me-1"></i> {{ basename($file) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Upload New Attachments --}}
                        <div class="md:col-span-2">
                            <label class="font-semibold mb-1">Add Attachments</label>
                            <br>
                            <input type="file" name="attachments[]" multiple
                                accept=".jpg,.jpeg,.png,.pdf,.docx,.log,.txt,.mp4,.mov,.avi"
                                class="ti-form-input mt-1 w-full">
                            <small class="text-xs text-gray-500">Max 50MB each. Leave blank to keep existing.</small>
                        </div>
                    </div>
                </div>

                <div class="ti-modal-footer px-4">
                    <div class="flex justify-between w-full">
                        <button type="button" class="ti-btn ti-btn-light"
                            data-hs-overlay="#ticket-modal-{{ $ticket->id }}">
                            Close
                        </button>
                        <button type="submit" class="ti-btn bg-blue-600 text-white">
                            <i class="bi bi-save me-1"></i> Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach



</x-app-layout>
