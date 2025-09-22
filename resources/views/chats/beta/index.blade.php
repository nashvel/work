<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Chat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <style>
        .slide-up {
            animation: slideUp 0.3s ease-out forwards;
        }

        .slide-down {
            animation: slideDown 0.3s ease-out forwards;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(0);
                opacity: 1;
            }

            to {
                transform: translateY(100%);
                opacity: 0;
            }
        }

        #chat-list {
            max-height: 350px;
            overflow-y: auto;
            scroll-behavior: smooth;
        }

        #chat-panel {
            width: 30rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            border-radius: 1rem;
            overflow: hidden;
        }

        .message-bubble {
            padding: 0.75rem 1rem;
            border-radius: 1.25rem;
            max-width: 75%;
            font-size: 0.875rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        button:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        #chat-toggle {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            z-index: 9999;
        }

        #chat-toggle button {
            background-color: #2563eb;
            color: white;
            font-size: 1rem;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            border: none;
            cursor: pointer;
        }

        #chat-toggle button img {
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 9999px;
        }

        #notification-badge {
            position: absolute;
            top: -0.5rem;
            left: -0.5rem;
            width: 0.75rem;
            height: 0.75rem;
            background-color: #ef4444;
            border-radius: 9999px;
            display: none;
        }

        #chat-list ul {
            list-style-type: disc;
            padding-left: 1.5rem;
        }

        #chat-list ul ul {
            list-style-type: circle;
            padding-left: 1.5rem;
        }

        #chat-list li {
            margin-bottom: 0.3rem;
            line-height: 1.6;
            font-size: 14px;
            color: #333;
        }

        #chat-list li strong {
            display: block;
            font-weight: 600;
            font-size: 15px;
            color: #222;
        }
    </style>
</head>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('chat-toggle');
        const button = toggle.querySelector('button');
        const loader = document.getElementById('chat-button-loader');
        const label = document.getElementById('btn-name');

        loader.style.display = 'none';
        button.disabled = false;
        label.textContent = 'Live Portal Chat';
    });

    function toggleChatPanel() {
        const panel = document.getElementById("chat-panel");
        const label = document.getElementById("btn-name");
        if (!panel) return;

        if (panel.classList.contains("slide-up")) {
            panel.classList.remove("slide-up");
            panel.classList.add("slide-down");
            setTimeout(() => {
                panel.classList.add("hidden");
                panel.classList.remove("slide-down");
                label.textContent = 'Live Portal Chat';
            }, 300);
        } else {
            panel.classList.remove("hidden");
            panel.classList.add("slide-up");
            label.textContent = 'Live Portal Chat';
        }
    }
</script>

<body class="bg-gray-100">

    <body class="bg-gray-100">

        <div id="chat-toggle" style=" font-family: Rubik, sans-serif;">
            <button onclick="toggleChatPanel()">
                <img src="/v1/comment.png" alt="Chat">
                <span id="chat-button-loader" style="display:none; margin-left:5px;">
                    <svg width="16" height="16" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg"
                        stroke="#fff">
                        <g fill="none" fill-rule="evenodd">
                            <g transform="translate(1 1)" stroke-width="2">
                                <circle stroke-opacity=".5" cx="18" cy="18" r="18" />
                                <path d="M36 18c0-9.94-8.06-18-18-18">
                                    <animateTransform attributeName="transform" type="rotate" from="0 18 18"
                                        to="360 18 18" dur="1s" repeatCount="indefinite" />
                                </path>
                            </g>
                        </g>
                    </svg>
                </span>
                <span id="btn-name"></span>
                <span id="notification-badge" style="display: none; color: rgb(238,69,68)"></span>
            </button>
        </div>

        <!-- Chat Panel -->
        <div id="chat-panel" class="fixed hidden bg-white flex flex-col z-50"
            style="right: 20px; bottom: 80px; font-family: Rubik, sans-serif; min-height: 500px;">
            <div class="bg-blue-600 text-white px-4 py-3 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div id="back-to-selector" class="hidden">
                        <button onclick="returnToSelection()" class="text-white text-sm underline hover:text-gray-300">
                            <i class="bi bi-chevron-double-left"></i>
                        </button>
                    </div>
                    <img id="va-avatar" src="/v1/comment.png" class="w-10 h-10 rounded-full"
                        onerror="this.src='/user.png'">
                    <div>
                        <div id="va-name" class="font-semibold text-sm">Virtual Assistant</div>
                        <div class="text-xs opacity-80">We are here to help you out</div>
                    </div>
                </div>
                <button class="text-white text-md"><i class="bi bi-telephone-fill"></i></button>
                <button class="text-white text-md"><i class="bi bi-camera-video-fill"></i></button>
                <button class="text-white text-md"><i class="bi bi-arrows-fullscreen"></i></button>
                <button onclick="toggleChatPanel()" class="text-white text-md"><i class="bi bi-back"></i></button>
            </div>

            <!-- Call Actions -->
            {{-- <div id="call-actions" class="hidden px-4 py-3 border-t bg-gray-50 flex items-center gap-3 justify-center">
                <button onclick="startCall('audio')"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white rounded-lg shadow transition"
                    style="background: linear-gradient(to right, #2563eb, #1d4ed8);">
                    <i class="bi bi-telephone-fill"></i> Call Support
                </button>
                <button onclick="startCall('video')"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white rounded-lg shadow transition"
                    style="background: linear-gradient(to right, #2563eb, #1d4ed8);">
                    <i class="bi bi-camera-video-fill"></i> Video Call
                </button>
            </div> --}}

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
            {{-- @foreach ($users as $user)
                <div class="avatar avatar-xl avatar-rounded shadow">
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" onerror="this.src='/user.png'"
                        alt="img">
                </div>&ensp;&ensp;
            @endforeach --}}

            <div id="staff-selection" class="px-4 py-3 border-b bg-white">
                <div class="relative">
                    <select id="staff-selector"
                        data-hs-select='{
                            "placeholder": "Choose Assigned Virtual Assistant",
                            "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none items-center hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-inputborder rounded-sm text-start text-sm focus:border-primary focus:ring-primary before:absolute before:inset-0 before:z-[1] dark:bg-bodybg dark:border-white/10 dark:text-white/70 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-primary",
                            "dropdownClasses": "mt-2 max-h-72 p-1 space-y-0.5 z-20 w-full bg-white border border-inputborder rounded-sm overflow-hidden overflow-y-auto dark:bg-bodybg dark:border-white/10",
                            "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-sm focus:outline-none focus:bg-gray-100 dark:bg-bodybg dark:hover:bg-bodybg dark:text-gray-200 dark:focus:bg-bodybg",
                            "optionTemplate": "<div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div><div class=\"hs-selected:font-semibold text-sm text-gray-800 dark:text-gray-200\" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"flex-shrink-0 size-4 text-primary\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>"
                        }'
                        class="block w-full">
                        <option value="" selected>Choose a Virtual Assistant</option>
                        @foreach ($users_va as $userx)
                            @php
                                $avatar = $userx->profile_photo_path
                                    ? asset('storage/' . $userx->profile_photo_path)
                                    : '/user.png';
                            @endphp
                            <option value="{{ $userx->id }}" data-avatar="{{ $avatar }}"
                                data-name="{{ $userx->name }}" data-hs-select-option='@json([
                                    'icon' => "<img class=\"inline-block size-6 rounded-full\" src=\"$avatar\" alt=\"" . e($userx->name) . "\" />",
                                ])'>
                                {{ $userx->name }}
                            </option>
                        @endforeach
                    </select>


                    <div class="absolute top-1/2 end-3 -translate-y-1/2">
                        <svg class="flex-shrink-0 size-3.5 text-gray-500 dark:text-white/70"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m7 15 5 5 5-5" />
                            <path d="m7 9 5-5 5 5" />
                        </svg>
                    </div>
                </div>

                {{-- <select id="staff-selector" class="w-full border rounded px-3 py-2 text-sm">
                    <option value="">Choose a Virtual Assistant</option>
                    <option value="30">Kimberly Ann Madelo (VA)</option>
                </select> --}}
            </div>


            <!-- Messages -->
            <div id="chat-list" class="flex-1 px-4 py-3  text-sm bg-white space-y-3"
                style="font-family: Rubik, sans-serif;">
                <div id="chat-placeholder" class="text-center text-sm text-gray-500 mt-5">
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
    </body>


    <!-- Firebase Chat Logic -->
    <script type="module">
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js";
        import {
            getFirestore,
            collection,
            doc,
            setDoc,
            addDoc,
            getDocs,
            serverTimestamp,
            query,
            orderBy,
            onSnapshot
        } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-firestore.js";

        const firebaseConfig = {
            apiKey: "AIzaSyCmOw_Wxob7gW257laT-2XhKmGJLLsNNpg",
            authDomain: "aselco-ph-chat-app.firebaseapp.com",
            projectId: "aselco-ph-chat-app",
            storageBucket: "aselco-ph-chat-app.appspot.com",
            messagingSenderId: "824198674025",
            appId: "1:824198674025:web:e2756feadf0d022e3c14f8"
        };

        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);

        const customerId = '{{ Auth::user()->id }}';
        let supportId = null;
        let conversationId = null;
        let messagesRef = null;
        let unsubscribe = null;
        let incomingCallActive = false;

        async function initChatWithStaff(staffId) {
            supportId = staffId;
            conversationId = [customerId, supportId].sort((a, b) => a - b).join('_');
            messagesRef = collection(db, `conversations/${conversationId}/messages`);

            await setDoc(doc(db, 'conversations', conversationId), {
                participants: [customerId, supportId],
                created_at: serverTimestamp()
            }, {
                merge: true
            });

            if (unsubscribe) unsubscribe();

            unsubscribe = onSnapshot(query(messagesRef, orderBy('timestamp', 'asc')), async (snapshot) => {
                const chatBox = document.getElementById('chat-list');
                chatBox.innerHTML = '';
                const now = new Date();

                if (snapshot.empty) {
                    chatBox.innerHTML = `
            <div class="text-center text-sm text-gray-500 mt-20">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8a9 9 0 100-18 9 9 0 000 18z" />
                </svg>
                <p class="font-medium">No messages yet</p>
                <p class="text-xs text-gray-400 mt-1">Start the conversation by sending a message.</p>
            </div>
        `;
                    return;
                }

                for (const docSnap of snapshot.docs) {
                    const data = docSnap.data();
                    const isMe = data.sender_id === customerId;
                    const isCallStarted = data.type === 'call' && data.status === 'started' && data
                        .started_at?.toDate();

                    if (!isMe && isCallStarted) {
                        const startTime = data.started_at.toDate();
                        const diffSeconds = (now - startTime) / 1000;

                        if (diffSeconds < 60 && !incomingCallActive) {
                            showIncomingCall(data.link);
                            setTimeout(() => dismissIncomingCall(), (60 - diffSeconds) * 1000);
                        } else if (diffSeconds >= 60) {
                            dismissIncomingCall();
                        }
                    }

                    if (!isMe && data.type === 'call' && data.status === 'cancelled') {
                        dismissIncomingCall();
                    }

                    let finalMessage = data.message;
                    if (isCallStarted) {
                        const diffMinutes = (now - data.started_at.toDate()) / 60000;
                        if (diffMinutes >= 2) {
                            finalMessage = `<i class="text-muted">The meeting link has expired.</i>`;
                        }
                    }

                    const msgDiv = document.createElement('div');
                    msgDiv.className = `flex items-end gap-2 ${isMe ? 'justify-end' : 'justify-start'}`;

                    if (!isMe) {
                        try {
                            const res = await fetch(`/api/user-name/${data.sender_id}`);
                            const userData = await res.json();
                            const avatar = userData.avatar || '/user.png';

                            msgDiv.innerHTML = `
                    <img src="${avatar}" class="w-8 h-8 rounded-full" onerror="this.src='/user.png'">
                    <div class="bg-gray-100 text-gray-900 message-bubble">${finalMessage}</div>
                `;
                        } catch {
                            msgDiv.innerHTML = `
                    <img src="/user.png" class="w-8 h-8 rounded-full">
                    <div class="bg-gray-100 text-gray-900 message-bubble">${finalMessage}</div>
                `;
                        }
                    } else {
                        msgDiv.innerHTML = `
                <div class="bg-blue-500 text-white message-bubble">${finalMessage}</div>
            `;
                    }

                    chatBox.appendChild(msgDiv);
                }

                chatBox.scrollTop = chatBox.scrollHeight;
            });

            // document.getElementById('call-actions').classList.remove('hidden');

        }

        const selector = document.getElementById('staff-selector');

        selector.addEventListener('change', async (e) => {
            const selectedStaffId = parseInt(e.target.value);
            if (!selectedStaffId) return;

            // Store to localStorage
            localStorage.setItem('selectedVA', selectedStaffId);

            document.getElementById('staff-selection').style.display = 'none';
            document.getElementById('chat-list').innerHTML =
                '<div class="text-center text-gray-400 mt-4">Loading messages...</div>';

            await initChatWithStaff(selectedStaffId);

            const selectedOption = selector.options[selector.selectedIndex];
            const avatar = selectedOption.getAttribute('data-avatar');
            const name = selectedOption.getAttribute('data-name');

            document.getElementById('va-avatar').src = avatar || '/v1/comment.png';
            document.getElementById('va-name').textContent = name || 'Virtual Assistant';

            document.getElementById('back-to-selector').classList.remove('hidden');
            // document.getElementById('call-actions').classList.remove('hidden');
        });

        window.addEventListener('DOMContentLoaded', async () => {
            const savedStaffId = localStorage.getItem('selectedVA');
            if (savedStaffId) {
                selector.value = savedStaffId;
                document.getElementById('staff-selection').style.display = 'none';
                document.getElementById('chat-list').innerHTML =
                    '<div class="text-center text-gray-400 mt-4">Loading messages...</div>';
                await initChatWithStaff(parseInt(savedStaffId));

                const selectedOption = selector.options[selector.selectedIndex];
                const avatar = selectedOption.getAttribute('data-avatar');
                const name = selectedOption.getAttribute('data-name');

                document.getElementById('va-avatar').src = avatar || '/v1/comment.png';
                document.getElementById('va-name').textContent = name || 'Virtual Assistant';

                document.getElementById('back-to-selector').classList.remove('hidden');
                // document.getElementById('call-actions').classList.remove('hidden');
            }
        });

        window.returnToSelection = function() {
            document.getElementById('staff-selection').style.display = 'block';
            document.getElementById('back-to-selector').classList.add('hidden');
            document.getElementById('chat-list').innerHTML = '';
            document.getElementById('chat-input').value = '';
            document.getElementById('staff-selector').value = '';
            document.getElementById('staff-selector').dispatchEvent(new Event('change'));
            localStorage.removeItem('selectedVA');

            if (unsubscribe) {
                unsubscribe();
                unsubscribe = null;
            }

            const callActions = document.getElementById('call-actions');
            if (callActions) {
                callActions.classList.add('hidden');
            }

            // Optionally reset avatar/name
            document.getElementById('va-avatar').src = '/v1/comment.png';
            document.getElementById('va-name').textContent = 'Virtual Assistant';
        };



        document.getElementById('chat-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const input = document.getElementById('chat-input');
            const message = input.value.trim();
            if (!message || !messagesRef) return;
            await addDoc(messagesRef, {
                sender_id: customerId,
                message: message,
                timestamp: serverTimestamp()
            });
            input.value = '';
        });

        const autoReplies = {
            "How do I update my contact information?": "Log in and go to 'My Profile' to update your email, phone number, or address.",
            "Where can I find service updates or notices?": "Service notices and updates are posted on your dashboard and under the 'Notifications' section of the portal.",
            "Can I report an issue online?": "Yes, use the 'Report a Problem' form in your portal to submit issues related to your service.",
            "How do I change my account password?": "You can change your password by going to 'Account Settings' and selecting 'Security'.",
            "Is customer support available on weekends?": "Our support team is available during business hours Monday to Friday. You can still submit a support ticket anytime and we’ll respond on the next business day."
        };

        window.sendPredefined = async function(msg) {
            if (!messagesRef) return;
            await addDoc(messagesRef, {
                sender_id: customerId,
                message: msg,
                timestamp: serverTimestamp()
            });
            if (autoReplies[msg]) {
                await addDoc(messagesRef, {
                    sender_id: supportId,
                    message: autoReplies[msg],
                    timestamp: serverTimestamp()
                });
            }
        };

        window.toggleChatPanel = function() {
            const panel = document.getElementById('chat-panel');
            const badge = document.getElementById('notification-badge');
            if (panel.classList.contains('hidden')) {
                panel.classList.remove('hidden');
                panel.classList.add('slide-up');
                badge.classList.add('hidden');
                badge.textContent = '0';
            } else {
                panel.classList.add('slide-down');
                setTimeout(() => {
                    panel.classList.add('hidden');
                    panel.classList.remove('slide-up', 'slide-down');
                }, 300);
            }
        };

        const toggleQuickBtn = document.getElementById('toggle-quick-questions');
        const quickSection = document.getElementById('quick-questions');

        toggleQuickBtn.addEventListener('click', () => {
            if (quickSection.classList.contains('hidden')) {
                quickSection.classList.remove('hidden');
                toggleQuickBtn.textContent = 'Hide';
            } else {
                quickSection.classList.add('hidden');
                toggleQuickBtn.textContent = 'Show';
            }
        });

        function showIncomingCall(link) {
            const ringtone = document.getElementById('incoming-ringtone');
            const callBox = document.getElementById('incoming-call');
            const callLink = document.getElementById('incoming-call-link');

            callLink.href = link;
            callBox.classList.remove('hidden');
            ringtone.currentTime = 0;
            ringtone.loop = true;
            ringtone.play().catch(() => {});
            incomingCallActive = true;
        }

        function dismissIncomingCall() {
            const callBox = document.getElementById('incoming-call');
            const ringtone = document.getElementById('incoming-ringtone');

            callBox.classList.add('hidden');
            ringtone.pause();
            ringtone.currentTime = 0;
            incomingCallActive = false;
        }

        function renderCallMessage(data) {
            if (data.type === 'call' && data.status === 'started' && data.link && data.started_at?.toDate()) {
                const start = data.started_at.toDate();
                const now = new Date();
                const diffMs = now - start;
                const diffMinutes = diffMs / 60000;

                if (diffMinutes >= 1) {
                    return '<i>⚠️ The meeting link has expired.</i>';
                }

                return data.message;
            }
            return data.message;
        }

        window.startCall = async function(type) {
            if (!supportId || !messagesRef || !conversationId) return;

            const now = new Date();
            const q = query(messagesRef, orderBy('timestamp', 'desc'));
            const snapshot = await getDocs(q);

            for (const doc of snapshot.docs) {
                const data = doc.data();
                if (data.type === 'call' && data.status === 'started' && data.started_at?.toDate()) {
                    const start = data.started_at.toDate();
                    const diff = (now - start) / 1000;
                    if (diff < 60) {
                        console.warn('Call already in progress.');
                        return;
                    }
                    break;
                }
            }

            const callType = type === 'video' ? 'Video Call' : 'Call';
            const callLink = `https://meet.hillbcs.com/${conversationId}`;
            const callMessage =
                `🔔 ${callType} started: <a href="${callLink}" target="_blank" class="text-white underline">Join Now</a>`;

            await addDoc(messagesRef, {
                sender_id: customerId,
                type: 'call',
                status: 'started',
                link: callLink,
                message: callMessage,
                started_at: serverTimestamp(),
                timestamp: serverTimestamp()
            });
        }

        window.cancelCall = async function() {
            if (!messagesRef) return;
            await addDoc(messagesRef, {
                sender_id: customerId,
                type: 'call',
                status: 'cancelled',
                message: '🚫 The call has been cancelled.',
                timestamp: serverTimestamp()
            });
        }
    </script>

</body>

</html>
