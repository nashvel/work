<x-app-layout>
    <x-slot name="title">Send Email</x-slot>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('email.send') }}" method="POST">
        @csrf
        <div>
            <label class="form-label">Recipient Email:</label>
            <input type="email" name="recipient" class="form-control" required>
        </div>
        <div>
            <label class="form-label">Subject:</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <div>
            <label class="form-label">Message:</label>
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="ti-btn ti-btn-primary btn-wave mt-3">Send Email</button>
    </form>
</x-app-layout>
