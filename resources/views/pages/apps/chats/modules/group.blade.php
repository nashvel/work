@php
    $discussions = App\Models\Chats::orderBy('id', 'ASC')->get();
@endphp
<li class="chat-day-label">
    <span>Today</span>
</li>
@foreach ($discussions as $discussion)
    <li class="chat-item-{{ $discussion->user_id == Auth::user()->id ? 'end' : 'start' }}">
        <div class="chat-list-inner">
            <div class="chat-user-profile {{ $discussion->user_id == Auth::user()->id ? 'hidden' : '' }}">
                <span class="avatar avatar-md online chatstatusperson">
                    <img class="chatimageperson" src="{{ $discussion->avatar }}" alt="{{ $discussion->username }}">
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
                        {{ $discussion->created_at->diffForHumans() }}
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
                        <span class="chatnameperson">{{ $discussion->username }}</span> <span
                            class="msg-sent-time">{{ $discussion->created_at->format('D, F d, Y - h:i A') }}</span>
                    </span>
                </div>
            @endif

            <div class="chat-user-profile {{ $discussion->user_id == Auth::user()->id ? '' : 'hidden' }}">
                <span class="avatar avatar-md online">
                    <img class="chatimageperson" src="{{ $discussion->avatar }}" alt="{{ $discussion->username }}">
                </span>
            </div>
        </div>
    </li>
@endforeach
