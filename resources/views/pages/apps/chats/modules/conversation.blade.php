@php

    if (Auth::user()->role !== 'Virtual Assistant') {
        $va = App\Models\VirtualAssistant::JOIN('users', 'users.email', 'virtual_assistants.email')
            ->where('virtual_assistants.id', $id)
            ->first();
    }

    $discussions = App\Models\Chats::whereIn('user_id', [$id, Auth::user()->id])
        ->whereIn('receiver_id', [$id, Auth::user()->id])
        ->orderBy('id', 'ASC')
        ->limit(50)
        ->get();

    function formatTime($timestamp)
    {
        return $timestamp->diffInSeconds(now()) < 60 ? 'Just Now' : $timestamp->diffForHumans();
    }
@endphp

{{-- <li class="chat-day-label">
    <span>Today</span>
</li> --}}
@foreach ($discussions as $discussion)
    @php
        $check = App\Models\Chats::where('id', $discussion->id)->first();
    @endphp
    {{-- {{ $check->user_id }}
    {{ $check->receiver_id == $id && $check->user_id == Auth::user()->id ? 'check' : '' }} --}}

    <li class="chat-item-{{ $discussion->user_id == Auth::user()->id ? 'end' : 'start' }}">
        <div class="chat-list-inner">
            <div class="chat-user-profile {{ $discussion->user_id == Auth::user()->id ? 'hidden' : '' }}">
                <span class="avatar avatar-md online chatstatusperson">
                    @php
                        $user = App\Models\User::where('id', $discussion->user_id)->first();
                    @endphp
                    <img class="chatimageperson"
                        src="{{ $user->profile_photo_path == null ? '' : asset('storage/' . $user->profile_photo_path) }}"
                        onerror="this.src='/user.png'" alt="{{ $discussion->username }}">
                </span>
            </div>


            @if ($discussion->user_id == Auth::user()->id)
                <div class="me-3 flex flex-col items-end text-right">
                    <div class="main-chat-msg">
                        <div>
                            <p class="mb-0">{{ $discussion->message }}</p>
                        </div>
                    </div>
                    <span class="chatting-user-info">
                        <span class="msg-sent-time">
                            <span class="chat-read-mark align-middle d-inline-flex">
                                <i class="ri-check-double-line"></i>
                            </span>
                            {{ formatTime($discussion->created_at) }}
                        </span>
                        You
                    </span>
                </div>
            @else
                <div class="ms-3">
                    <div class="main-chat-msg">
                        <div>
                            <p class="mb-0"> {{ $discussion->message }}</p>
                        </div>
                    </div>
                    <span class="chatting-user-info">
                        <span class="chatnameperson">{{ $discussion->username }}</span> <span class="msg-sent-time">
                            {{ formatTime($discussion->created_at) }}
                        </span>
                    </span>
                </div>
            @endif

            <div class="chat-user-profile {{ $discussion->user_id == Auth::user()->id ? '' : 'hidden' }}">
                <span class="avatar avatar-md online">
                    <img class="chatimageperson" src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" onerror="this.src = '/user.png'" alt="{{ $discussion->username }}">
                </span>
            </div>
        </div>
    </li>

@endforeach
