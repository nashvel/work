@php
    $discussions = App\Models\Discussion::orderBy('id', 'ASC')->get();
@endphp
@foreach ($discussions as $discussion)
    <li>
        <div>
            <span class="avatar avatar-sm shadow-sm bg-light avatar-rounded profile-timeline-avatar">
                <img src="{{ $discussion->avatar }}" alt="{{ $discussion->username }}">
            </span>
            <div class="mb-2 flex items-start gap-2">
                <div>
                    <span class="font-medium">{{ $discussion->username }}</span>
                </div>
                <span class="ms-auto bg-light text-textmuted dark:text-textmuted/50 badge">
                    {{ $discussion->created_at->format('D, F d, Y - h:i A') }}
                </span>
            </div>
            <p class="text-textmuted dark:text-textmuted/50 mb-0">
                {{ $discussion->message }}
            </p>

            @if ($discussion->file_path)
                <p>
                    <a href="{{ asset('storage/' . $discussion->file_path) }}" target="_blank" class="text-blue-500">
                        {{ $discussion->file_type == 'jpg' || $discussion->file_type == 'png' ? 'View Image' : 'Download File' }}
                    </a>
                </p>
            @endif
        </div>
    </li>
@endforeach
