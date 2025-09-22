<x-app-layout>

    <x-slot name="title">Client Portal Automated Greetings</x-slot>
    <x-slot name="url_1">{"link": "/content/client/greetings", "text": "Client Portal Automated Greetings"}</x-slot>
    <x-slot name="active"> {{ isset($id) ? 'Details' : 'Client Portal Registration' }} </x-slot>
    <x-slot name="buttons"></x-slot>

    <div class="grid grid-cols-12 gap-6">

        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body">
                        <form action="{{ route('content.client.greetings.update', $id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($welcomeMessage))
                                @method('PUT')
                            @endif

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

                            <div class="grid grid-cols-12 gap-6">
                                <div class="xl:col-span-4 col-span-8">
                                    <div class="mb-1">
                                        <label for="client_id" class="form-label">Client Informartion : <strong
                                                class="text-danger">*</strong></label>
                                        @if (isset($id))
                                            @php
                                                $info = App\Models\Lead::join(
                                                    'welcome_messages',
                                                    'welcome_messages.client_id',
                                                    'leads.id',
                                                )
                                                    ->where('welcome_messages.id', $id)
                                                    ->first();
                                            @endphp
                                            <input type="text" name="client_id" id="client_id"
                                                class="form-control form-control-lg bg-white text-dark" readonly
                                                value="{{ $info->company_name }}">
                                        @else
                                            <select name="client_id" id="client_id" class="form-select" required>
                                                <option value="">-</option>
                                                <optgroup label="Client Portal">
                                                    @foreach (App\Models\Lead::get() as $client)
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->company_name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="xl:col-span-8 col-span-8">
                                    <div class="mb-1">
                                        <label for="welcome_message" class="form-label">Update Multimedia : <strong
                                                class="text-danger">*</strong></label>
                                        <input type="file" name="welcome_message" id="welcome_message"
                                            accept="image/*,video/*,audio/*"
                                            class="block w-full border border-gray-200 rounded-sm text-sm file:border-0 file:bg-light file:me-4 file:py-3 file:px-4">
                                    </div>
                                </div>
                                @php
                                    if (isset($id)) {
                                        $content = App\Models\WelcomeMessage::where('id', $id)
                                            ->where('status', 'Active')
                                            ->first();
                                        $message = $content->welcome_message;
                                        preg_match('/<div class="ql-editor"[^>]*>(.*?)<\/div>/s', $message, $matches);
                                    }
                                @endphp
                                <div class="xl:col-span-4 col-span-4" style="display: none">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" name="status" class="form-select" required>
                                            <option value="Active"
                                                {{ old('status', $welcomeMessage->status ?? '') == 'Active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="Inactive"
                                                {{ old('status', $welcomeMessage->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="preview-container" class="mt-4 space-y-2">
                                @php
                                    $filePath = $info->welcome_message ?? '';
                                    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                    $url = asset('storage/' . $filePath);
                                @endphp

                                @if ($filePath)
                                    <center>
                                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <img id="preview-media" src="{{ $url }}" alt="Image"
                                                class="max-h-48 rounded border border-gray-300 mt-2">
                                        @elseif (in_array($extension, ['mp4', 'webm', 'ogg']))
                                            <video id="preview-media" controls
                                                class="w-full max-h-48 rounded border border-gray-300 mt-2">
                                                <source src="{{ $url }}" type="video/{{ $extension }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @elseif (in_array($extension, ['mp3', 'wav']))
                                            <audio id="preview-media" controls
                                                class="w-full rounded border border-gray-300 mt-2">
                                                <source src="{{ $url }}" type="audio/{{ $extension }}">
                                                Your browser does not support the audio tag.
                                            </audio>
                                        @else
                                            <p class="text-sm text-red-600 mt-2">Unsupported format:
                                                .{{ $extension }}</p>
                                        @endif
                                    </center>
                                @endif
                            </div>

                            <script>
                                document.getElementById('welcome_message').addEventListener('change', function(event) {
                                    const file = event.target.files[0];
                                    const previewContainer = document.getElementById('preview-container');
                                    previewContainer.innerHTML = ''; // Clear previous

                                    if (!file) return;

                                    const url = URL.createObjectURL(file);
                                    let previewEl;

                                    if (file.type.startsWith('image/')) {
                                        previewEl = `<img src="${url}" alt="Image" class="max-h-48 rounded border border-gray-300 mt-2">`;
                                    } else if (file.type.startsWith('video/')) {
                                        previewEl = `
                                        <video controls class="w-full max-h-48 rounded border border-gray-300 mt-2">
                                            <source src="${url}" type="${file.type}">
                                            Your browser does not support the video tag.
                                        </video>`;
                                                            } else if (file.type.startsWith('audio/')) {
                                                                previewEl = `
                                        <audio controls class="w-full rounded border border-gray-300 mt-2">
                                            <source src="${url}" type="${file.type}">
                                            Your browser does not support the audio tag.
                                        </audio>`;
                                    } else {
                                        previewEl = `<p class="text-sm text-red-600 mt-2">Unsupported file type: ${file.type}</p>`;
                                    }

                                    previewContainer.innerHTML = `<center>${previewEl}</center>`;
                                });
                            </script>


                            <hr class="mt-5 mb-5">
                            <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-800 transition float-end">
                                <i class="bi bi-save me-1"></i>
                                {{ isset($id) ? 'Update' : 'Create' }} Greetings
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
