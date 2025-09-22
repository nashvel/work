<x-app-layout>

    <x-slot name="title">Create New Task</x-slot>
    <x-slot name="url_1">{{ $project ? route('projects.tasks.index', $project) : route('tasks.index') }}</x-slot>
    <x-slot name="url_2">Tasks</x-slot>
    <x-slot name="active">Create</x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">Create a New Task</h5>
                </div>
                <div class="box-body">
                    <form action="{{ $project ? route('projects.tasks.store', $project) : route('tasks.store') }}" method="POST">
                        @csrf

                        {{-- Hidden project_id if it exists --}}
                        @if($project)
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                        @endif

                        <div class="grid grid-cols-12 gap-4">
                            {{-- Task Title --}}
                            <div class="col-span-12">
                                <label for="title" class="ti-form-label">Task Title <span class="text-red-500">*</span></label>
                                <input type="text" class="ti-form-input @error('title') !border-red-500 @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter task title" required>
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Priority --}}
                            <div class="xl:col-span-4 col-span-12">
                                <label for="priority" class="ti-form-label">Priority</label>
                                <select class="ti-form-select @error('priority') !border-red-500 @enderror" id="priority" name="priority">
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                                @error('priority')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Due Date --}}
                            <div class="xl:col-span-4 col-span-12">
                                <label for="due_date" class="ti-form-label">Due Date</label>
                                <input type="date" class="ti-form-input @error('due_date') !border-red-500 @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}">
                                @error('due_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="xl:col-span-4 col-span-12">
                                <label for="status" class="ti-form-label">Status</label>
                                <select class="ti-form-select @error('status') !border-red-500 @enderror" id="status" name="status">
                                    <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Assignees --}}
                            <div class="col-span-12">
                                <label for="user_ids" class="ti-form-label">Assign To</label>
                                <select class="ti-form-select @error('user_ids') !border-red-500 @enderror" id="user_ids" name="user_ids[]" multiple>
                                    <option value="">Select Users</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ in_array($user->id, old('user_ids', [])) ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-gray-500 text-xs">Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</span>
                                @error('user_ids')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            <a href="{{ $project ? route('projects.tasks.index', $project) : route('tasks.index') }}" class="ti-btn ti-btn-secondary">Cancel</a>
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ri-save-line"></i> Create Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    {{-- You can add any page-specific scripts here if needed --}}
    @endpush

</x-app-layout>