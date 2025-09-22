<x-app-layout>
    <x-slot name="title">Create CORS</x-slot>
    <x-slot name="url_1">{"link": "/cors/list", "text": "CORS"}</x-slot>
    <x-slot name="url_2">{"link": "/cors/create", "text": "Create"}</x-slot>
    <x-slot name="active">New CORS</x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('pt.cors.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="on">
                        @csrf
                        @php
                            $projects = [];
                        @endphp
                        <div class="grid grid-cols-12 gap-4 p-5">
                            <!-- Project -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="project_id" class="form-label">Project <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <select name="project_id" id="project_id" required
                                        class="ti-form-input rounded-sm ps-11">
                                        <option value="">Select Project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-kanban"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="xl:col-span-8 col-span-12">
                                <label for="title" class="form-label">Title <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="text" name="title" id="title" required
                                        placeholder="CORS Title" class="ti-form-input rounded-sm ps-11">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-pencil-square"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="xl:col-span-12 col-span-12">
                                <label for="description" class="form-label">Description</label>
                                <div class="relative">
                                    <textarea name="description" id="description" rows="3" class="ti-form-input rounded-sm ps-11 resize-none"></textarea>
                                    <div class="absolute top-3 left-4 pointer-events-none z-20">
                                        <i class="bi bi-chat-left-text px-4"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="price" class="form-label">Price</label>
                                <div class="relative">
                                    <input type="number" name="price" id="price" step="0.01"
                                        placeholder="e.g. 15000.00" class="ti-form-input rounded-sm ps-11">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="status" class="form-label">Status</label>
                                <div class="relative">
                                    <select name="status" id="status" class="ti-form-input rounded-sm ps-11">
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-flag"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Sent Date -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="sent_date" class="form-label">Sent Date</label>
                                <div class="relative">
                                    <input type="date" name="sent_date" id="sent_date"
                                        class="ti-form-input rounded-sm ps-11">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- File Upload -->
                            <div class="xl:col-span-12 col-span-12">
                                <label for="attachment" class="form-label">Attachment</label>
                                <div class="relative">
                                    <input type="file" name="attachment" id="attachment"
                                        class="block w-full border border-gray-200 rounded-sm text-sm file:border-0 file:bg-light file:me-4 file:py-3 file:px-4">
                                   
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end gap-3">
                            <button type="reset"
                                class="bg-gray-100 text-dark px-4 py-2 rounded-md hover:bg-gray-300 transition">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition flex items-center gap-1">
                                <i class="bi bi-save"></i>
                                <span>Save COR</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
