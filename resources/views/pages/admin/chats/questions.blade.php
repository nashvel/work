<x-app-layout>

    <x-slot name="title">Chat Questions</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Messages</x-slot>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('v1/style-table.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the chatbot here.
                    <hr class="mb-3 mt-3">
                    <div class="custom-box">
                        <div class="max-w-4xl mx-auto p-6">
                            <h1 class="text-2xl font-semibold mb-1">Messages</h1>
                            <hr>
                            @if (session('success'))
                                <div class="mt-4 text-green-600">{{ session('success') }}</div>
                            @endif

                            <table class="w-full mt-6 border border-gray-200 rounded overflow-hidden">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-left px-4 py-2">Message</th>
                                        <th class="text-left px-4 py-2">IP Address</th>
                                        <th class="text-left px-4 py-2">Device</th>
                                        <th class="text-left px-4 py-2">Browser</th>
                                        <th class="text-left px-4 py-2">OS</th>
                                        <th class="text-left px-4 py-2">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (App\Models\ChatMessage::latest()->get() as $chat)
                                        <tr class="border-t">
                                            <td class="px-4 py-2">{{ Str::limit($chat->message, 60) }}</td>
                                            <td class="px-4 py-2">{{ $chat->ip_address }}</td>
                                            <td class="px-4 py-2">{{ $chat->device }}</td>
                                            <td class="px-4 py-2">{{ $chat->browser }}</td>
                                            <td class="px-4 py-2">{{ $chat->os }}</td>
                                            <td class="px-4 py-2">{{ $chat->created_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr class="mt-5 mb-6">
                            <h1 class="text-2xl font-semibold mb-1">Chat Questions</h1>
                            <hr>
                            @if (session('success'))
                                <div class="mt-4 text-green-600">{{ session('success') }}</div>
                            @endif
                            <div class="grid grid-cols-12 gap-6">
                                <div class="xl:col-span-8 col-span-8">
                                    <table class="w-full mt-6 border border-gray-200 rounded overflow-hidden">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-left px-4 py-2">Identifier</th>
                                                <th class="text-left px-4 py-2">Question</th>
                                                <th class="text-left px-4 py-2">Response</th>
                                                <th class="text-left px-4 py-2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (App\Models\ChatQuestion::get() as $question)
                                                <tr class="border-t">
                                                    <td class="px-4 py-2">{{ $question->identifier }}</td>
                                                    <td class="px-4 py-2">{{ Str::limit($question->question, 50) }}
                                                    </td>
                                                    <td class="px-4 py-2">{{ Str::limit($question->response, 50) }}
                                                    </td>
                                                    <td class="px-4 py-2 flex gap-2">
                                                        {{-- <a href="{{ route('chat-questions.edit', $question) }}"
                                                   class="text-blue-600 hover:underline">Edit</a>
                        
                                                <form action="{{ route('chat-questions.destroy', $question) }}" method="POST"
                                                      onsubmit="return confirm('Delete this question?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-600 hover:underline">Delete</button>
                                                </form> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="xl:col-span-4 col-span-4">
                                    <br>
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="max-w-xl mx-auto p-6">
                                                <h1 class="text-2xl font-semibold mb-4">Add New Chat Question</h1>
                                                <form method="POST" action="{{ route('chat-questions.store') }}"
                                                    class="space-y-4">
                                                    @csrf
                                                    <div>
                                                        <label class="block text-sm font-medium mb-1">Identifier</label>
                                                        <input type="text" name="identifier"
                                                            value="{{ old('identifier') }}"
                                                            class="w-full border rounded px-3 py-2" required>
                                                        @error('identifier')
                                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-medium mb-1">Question</label>
                                                        <textarea name="question" rows="2" class="w-full border rounded px-3 py-2" required>{{ old('question') }}</textarea>
                                                        @error('question')
                                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-medium mb-1">Response</label>
                                                        <textarea name="response" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('response') }}</textarea>
                                                        @error('response')
                                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <button
                                                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Save</button>
                                                </form>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</x-app-layout>
