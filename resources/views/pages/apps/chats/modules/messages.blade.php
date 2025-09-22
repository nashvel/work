@php

$messages = App\Models\Chats::where('user_id', Auth::id())
    ->orWhere('receiver_id', Auth::id())
    ->selectRaw('CASE 
                    WHEN user_id = ? THEN receiver_id 
                    ELSE user_id 
                 END as contact_id', [Auth::id()])
    ->distinct()
    ->get();


    // $messages = App\Models\Chats::where('user_id', Auth::user()->id)
    //     ->select('receiver_id')
    //     ->distinct()
    //     ->get();

    // App\Models\Chats::where('user_id', Auth::user()->id)
    //     ->where('receiver_id', $id)
    //     ->update([
    //         'isRead' => 1,
    //     ]);
@endphp
@foreach ($messages as $msg)

    @php
        $get_contact = App\Models\User::where('id', $msg->contact_id)->first();
        $last_chat = App\Models\Chats::whereIn('user_id', [$msg->contact_id, Auth::user()->id])
            ->whereIn('receiver_id', [$msg->contact_id, Auth::user()->id])
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->first();
    @endphp

    <li class="checkforactive {{ $msg->contact_id == $id ? 'active' : '' }}">
        <a href="/chat/{{ $msg->contact_id }}" onclick="changeTheInfo(this,'Rashid Khan','5','online')">
            <div class="flex items-top">
                <div class="me-1 leading-none">
                    <span class="avatar avatar-md online me-2">
                        <img src="{{ asset('storage/' . $get_contact->profile_photo_path) }}"
                            onerror="this.src='/user.png'" alt="img">
                    </span>
                </div>
                <div class="flex-auto">
                    <p class="mb-0 font-medium">
                        @if ($last_chat->isRead == 0 && $last_chat->user_id !== Auth::user()->id)
                            <strong>{{ $get_contact->name }} </strong>
                        @else
                            {{ $get_contact->name }}
                        @endif
                        <span class="float-end text-textmuted dark:text-textmuted/50 font-normal text-[11px]">
                            11:12PM
                        </span>
                    </p>
                    <p class="text-xs mb-0">
                        <span class="chat-msg truncate">
                            <span
                                class="text-{{ $last_chat->isRead == 0 && $last_chat->user_id !== Auth::user()->id ? 'dark' : 'muted' }}">{{ $last_chat->message ?? '' }}</span>
                        </span>
                    </p>
                </div>
            </div>
        </a>
    </li>
@endforeach
