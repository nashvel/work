<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
          rel="stylesheet">
</head>


@php
    $yourAssignedVAs = App\Models\User::where('id', Auth::user()->id)->first()?->assign_id;
    $ids = explode(',', $yourAssignedVAs ?? ''); // This could also be a variable like $user_ids
    if (Auth::user()->role === 'Sub-Client') {
        if (Auth::user()->email == 'californiacustomcoatings@yahoo.com') {
            $ids = [30, 9799];
        } else {
            $ids = [30];
        }
    }
    $users = App\Models\User::whereIn('id', $ids)->get();
@endphp


@include('modules.chats.old.temp.script')
@include('modules.chats.old.temp.styles')

<body class="bg-gray-100">


<div id="chat-toggle" class="flex items-center gap-3 bg-none p-2 rounded">
    @foreach ($users as $user)
        <div class="relative w-16 h-16">
            <img id="avatar-{{ $user->id }}" src="{{ asset('storage/' . $user->profile_photo_path) }}"
                 onerror="this.src='/user.png'" alt="Avatar" onclick="toggleChatPanel({{ $user->id }})"
                 class="rounded-full w-full h-full object-cover cursor-pointer hover:scale-105 transition-transform duration-200">

            <span id="badge-{{ $user->id }}"
                  class="absolute top-0 right-0 text-danger bg-danger text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow hidden">
                    1
                </span>
        </div>
    @endforeach
</div>

<!-- Chat Panel -->
<div id="chat-panel" class="fixed hidden bg-white flex flex-col z-50"
     style="right: 20px; bottom: 100px; font-family: Rubik, sans-serif; min-height: 500px;">
    <div class="bg-blue-600 text-white px-4 py-3 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div id="back-to-selector" class="hidden">
                <button onclick="returnToSelection()" class="text-white text-sm underline hover:text-gray-300">
                    <i class="bi bi-chevron-double-left"></i>
                </button>
            </div>
            <img id="va-avatar" src="/v1/comment.png" class="w-10 h-10 rounded-full" onerror="this.src='/user.png'">
            <div>
                <div id="va-name" class="font-semibold text-sm">Virtual Assistant</div>
                <div class="text-xs opacity-80">We are here to help you out</div>
            </div>
        </div>
        <button class="text-white text-md"><i class="bi bi-telephone-fill"></i></button>
        <button class="text-white text-md"><i class="bi bi-camera-video-fill"></i></button>
        <button class="text-white text-md"><i class="bi bi-arrows-fullscreen"></i></button>
        <button onclick="toggleChatPanelClose()" class="text-white text-md"><i class="bi bi-back"></i></button>
    </div>

    <!-- Staff Selection -->
    @php
        $yourAssignedVAs = App\Models\User::where('id', Auth::user()->id)->first()?->assign_id;
        $ids = explode(',', $yourAssignedVAs ?? ''); // This could also be a variable like $user_ids
        if (Auth::user()->role === 'Sub-Client') {
            if (Auth::user()->email == 'californiacustomcoatings@yahoo.com') {
                $ids = [30, 9799];
            } else {
                $ids = [30];
            }
        }
        $users_va = App\Models\User::whereIn('id', $ids)->get();
    @endphp

            <!-- Messages -->
    <div id="chat-list" class="flex-1 px-4 py-3  text-sm bg-white space-y-3"
         style="font-family: Rubik, sans-serif;">
        <div id="chat-placeholder" class="text-center text-sm text-gray-500 mt-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="h-20 w-20 md:h-24 md:w-24 text-primary/30 mx-auto mb-4 md:mb-6">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <p class="font-semibold text-base">No Conversation Selected</p>
            <p class="text-xs mt-1">Select a conversation from the sidebar to start
                messaging, or create a new one.</p>
        </div>
    </div>

    <!-- Incoming Call UI -->
    <div id="incoming-call"
         class="hidden flex items-start gap-4 p-4 mx-4 my-3 rounded-xl shadow-lg border border-blue-300 text-white"
         style="background: linear-gradient(135deg, #2462EB, #1e3a8a);">
        <div class="text-white text-xl pt-1">
            <i class="bi bi-telephone-inbound-fill text-warning"></i>
        </div>
        <div class="flex-1">
            <p class="font-semibold text-white text-base mb-1">Incoming Call</p>
            <p class="text-sm">
                You have an incoming call.
                <a id="incoming-call-link" href="#" target="_blank"
                   class="underline font-medium text-white hover:text-blue-100"></a>
            </p>
            <div class="flex gap-2 mt-4">
                <a id="incoming-call-link" onclick="acceptCall()" href="#" target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-dark bg-white rounded-lg shadow hover:opacity-90 transition">
                    <i class="bi bi-camera-video-fill text-success"></i> Accept
                </a>
                <button onclick="dismissIncomingCall()"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-dark bg-white rounded-lg shadow hover:opacity-90 transition">
                    <i class="bi bi-x-circle-fill text-danger"></i> Decline
                </button>
            </div>
        </div>
    </div>

    <br>

    <!-- Chat Input -->
    <form id="chat-form" class="p-3 border-t flex gap-2 bg-white" autocomplete="off">
        <input type="text" id="chat-input" placeholder="Write a reply.."
               class="flex-1 border rounded-full px-4 py-2 text-sm">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm">➤</button>
    </form>
</div>

<audio id="incoming-ringtone" src="/sounds/ringtone.mp3" preload="auto"></audio>

@include('modules.chats.old.temp.firebase')


</body>

</html>
