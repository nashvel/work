<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Staff Chat Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
          rel="stylesheet">

</head>

@include('modules.chats.old.temp.script')
@include('modules.chats.old.temp.styles')

<body class="bg-gray-100 font-[Rubik]">
<div id="chat-toggle" class="fixed bottom-4 right-4 z-50">
    <button onclick="toggleChatPanel()"
            class="bg-blue-600 text-white text-sm px-4 py-2 rounded-full flex items-center gap-2 shadow-lg">
        <img src="/v1/comment.png" class="w-6 h-6 rounded-full" alt="Chat">
        <span id="chat-button-loader" style="display:none">
                <svg width="16" height="16" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg"
                     stroke="#fff">
                    <g fill="none" fill-rule="evenodd">
                        <g transform="translate(1 1)" stroke-width="2">
                            <circle stroke-opacity=".5" cx="18" cy="18" r="18"/>
                            <path d="M36 18c0-9.94-8.06-18-18-18">
                                <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18"
                                                  dur="1s" repeatCount="indefinite"/>
                            </path>
                        </g>
                    </g>
                </svg>
            </span>
        <span id="btn-name">Live Portal Chat</span>
        <span id="notification-badge" class="hidden w-3 h-3 bg-red-500 rounded-full absolute top-0 left-0"></span>
    </button>
</div>

<div id="chat-panel"
     class="fixed hidden bg-white flex flex-col z-50 w-full max-w-5xl right-4 bottom-24 shadow-lg rounded-2xl overflow-hidden"
     style="right: 20px; bottom: 80px; font-family: Rubik, sans-serif; width: 100vh;">
    <div class="bg-blue-600 text-white px-4 py-3 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="/v1/comment.png" class="w-10 h-10 rounded-full">
            <div>
                <div class="font-semibold text-sm">Support Panel</div>
                <div class="text-xs opacity-80">Manage customer conversations</div>
            </div>
        </div>
        <button onclick="toggleChatPanel()" class="text-white text-xl">&times;</button>
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-full xl:w-1/4 max-w-sm bg-white border-r px-4 py-5 overflow-y-auto">
            <h3 class="text-base font-medium mb-4">Customer Conversations</h3>
            <ul id="conversation-list" class="space-y-2 text-sm"></ul>
        </aside>
        <!-- Chat Section -->
        <main class="flex-1 bg-white flex flex-col rounded-lg overflow-hidden pt-3"
              style="height: 600px; padding-right: 10px;">
            <!-- Chat Header -->
            <div id="chat-with" class="bg-blue-600 text-white px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="/user.png" id="chat-avatar"
                         class="w-9 h-9 rounded-full hidden border-2 border-white"/>
                    <div>
                        <p id="chat-title" class="font-semibold text-base leading-tight">Select a conversation</p>
                        <p class="text-xs text-white/80">Start chatting or initiate a call</p>
                    </div>
                </div>
            </div>

            <!-- Call Actions -->
            <div id="call-actions" class="hidden px-6 py-3  bg-gray-50 border-b flex items-center gap-3">
                <button onclick="startCall('audio')"
                        class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-blue-200 rounded-lg hover:bg-blue-50 shadow-sm transition">
                    📞 Call
                </button>
                <button onclick="startCall('video')"
                        class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-blue-200 rounded-lg hover:bg-blue-50 shadow-sm transition">
                    🎥 Video Call
                </button>

                <button onclick="cancelCall()"
                        class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-blue-200 rounded-lg hover:bg-blue-50 shadow-sm transition">
                    ❌
                    Cancel
                    Call
                </button>
            </div>
            <div id="chat-list" class="flex-1 p-4 space-y-2 overflow-y-auto bg-gray-50">
                <div id="chat-placeholder" class="text-center text-sm text-gray-500 mt-20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round"
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
            <form id="chat-form" class="border-t p-4 flex gap-2 hidden">
                    <textarea type="text" id="chat-input" placeholder="Type your reply"
                              class="flex-1 border rounded px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">Send
                </button>
            </form>
        </main>
    </div>
</div>

@include('modules.chats.old.temp.firebase')

</body>

</html>
