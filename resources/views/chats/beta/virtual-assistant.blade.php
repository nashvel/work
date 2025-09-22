<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Staff Chat Panel</title>
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
            max-height: 320px;
            overflow-y: auto;
            scroll-behavior: smooth;
        }

        #chat-panel {
            width: 22rem;
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

         ul {
            list-style-type: disc;
            padding-left: 1.5rem;
        }

        ul ul {
            list-style-type: circle;
            padding-left: 1.5rem;
        }

        li {
            margin-bottom: 0.3rem;
            line-height: 1.6;
            font-size: 14px;
            color: #333;
        }

        li strong {
            display: block;
            font-weight: 600;
            font-size: 15px;
            color: #222;
        }

    </style>
</head>

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
                            <circle stroke-opacity=".5" cx="18" cy="18" r="18" />
                            <path d="M36 18c0-9.94-8.06-18-18-18">
                                <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18"
                                    dur="1s" repeatCount="indefinite" />
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
                            class="w-9 h-9 rounded-full hidden border-2 border-white" />
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
                        class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-blue-200 rounded-lg hover:bg-blue-50 shadow-sm transition">❌
                        Cancel
                        Call</button>
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
                        class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">Send</button>
                </form>
            </main>
        </div>

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
                serverTimestamp,
                query,
                orderBy,
                onSnapshot,
                getDocs
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
            const supportId = {{ Auth::user()->id }}; // Blade variable for support user ID
            let selectedCustomerId = null;
            let unsubscribe = null;

            const conversationList = document.getElementById('conversation-list');
            const chatBox = document.getElementById('chat-list');
            const chatForm = document.getElementById('chat-form');
            const chatInput = document.getElementById('chat-input');
            const chatWith = document.getElementById('chat-title');
            const chatAvatar = document.getElementById('chat-avatar');

            function loadConversations() {
                const convoRef = collection(db, 'conversations');

                onSnapshot(convoRef, (snapshot) => {
                    conversationList.innerHTML = '';

                    snapshot.forEach(convo => {
                        const convoId = convo.id;
                        const [id1, id2] = convoId.split('_').map(Number);

                        if (id1 !== supportId && id2 !== supportId) return;

                        const customerId = id1 === supportId ? id2 : id1;

                        const li = document.createElement('li');
                        li.className =
                            'cursor-pointer flex items-center gap-2 p-2 rounded hover:bg-blue-50 border';

                        // Default before fetch
                        li.innerHTML = `
                        <img src="/user.png" class="w-6 h-6 rounded-full" />
                        <span>Customer ${customerId}</span>
                                        `;
                        fetch(`/api/user-name/${customerId}`)
                            .then(res => res.json())
                            .then(data => {
                                const name = data.name ?? `Customer ${customerId}`;
                                const avatar = data.avatar ?? '/user.png';
                                li.innerHTML = `
                                                    <img src="${avatar}" class="w-6 h-6 rounded-full" />
                                                    <span>${name}</span>
                                                `;
                            });

                        li.onclick = () => openConversation(customerId);
                        conversationList.appendChild(li);
                    });

                });
            }

            function formatDate(timestamp) {
                const date = timestamp?.toDate?.();
                if (!date) return '';
                return new Intl.DateTimeFormat('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                }).format(date);
            }

            async function openConversation(customerId) {
                selectedCustomerId = customerId;
                chatWith.textContent = 'Loading conversation...';
                chatAvatar.classList.remove('hidden');
                chatAvatar.src = '/user.png'; // fallback default

                fetch(`/api/user-name/${customerId}`)
                    .then(res => res.json())
                    .then(data => {
                        chatWith.textContent = `Chatting with ${data.name ?? 'Customer ' + customerId}`;
                        chatAvatar.src = data.avatar ?? '/user.png';
                    })
                    .catch(() => {
                        chatWith.textContent = `Chatting with Customer ${customerId}`;
                    });

                chatAvatar.classList.remove('hidden');
                chatBox.innerHTML = '';
                chatForm.classList.remove('hidden');

                if (unsubscribe) unsubscribe();

                const conversationId = [customerId, supportId].sort((a, b) => a - b).join('_');
                const messagesRef = collection(db, `conversations/${conversationId}/messages`);
                const q = query(messagesRef, orderBy('timestamp', 'asc'));

                let alreadyRendered = new Set();

                unsubscribe = onSnapshot(q, snapshot => {
                    snapshot.docChanges().forEach(change => {
                        if (alreadyRendered.has(change.doc.id)) return;
                        alreadyRendered.add(change.doc.id);

                        const data = change.doc.data();
                        const isSupport = data.sender_id === supportId;
                        const timestampStr = formatDate(data.timestamp);

                        const msgDiv = document.createElement('div');
                        msgDiv.className =
                            `flex items-end gap-2 mb-1 ${isSupport ? 'justify-end' : 'justify-start'}`;
                        msgDiv.innerHTML = `
                            <div class="${isSupport ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-900'} px-4 py-2 rounded-lg max-w-[75%] text-sm">
                                <div>${renderCallMessage(data)}</div>
                                <div class="text-[10px] mt-1 text-right opacity-70">${timestampStr}</div>
                            </div>
                        `;
                        chatBox.appendChild(msgDiv);

                        // ✅ Mark as read if sent by customer and not read
                        if (!isSupport && !data.read) {
                            setDoc(change.doc.ref, {
                                read: true
                            }, {
                                merge: true
                            });
                        }
                    });


                    chatBox.scrollTop = chatBox.scrollHeight;
                });


                chatForm.onsubmit = async (e) => {
                    e.preventDefault();
                    const message = chatInput.value.trim();
                    if (!message) return;

                    await addDoc(collection(db, `conversations/${conversationId}/messages`), {
                        sender_id: supportId,
                        message: message,
                        timestamp: serverTimestamp()
                    });

                    chatInput.value = '';
                };

                document.getElementById('call-actions').classList.remove('hidden');
            }


            async function startCall(type) {
                if (!selectedCustomerId) return;

                const conversationId = [selectedCustomerId, supportId].sort((a, b) => a - b).join('_');
                const messagesRef = collection(db, `conversations/${conversationId}/messages`);
                const q = query(messagesRef, orderBy('timestamp', 'desc'));
                const snapshot = await getDocs(q);

                for (const doc of snapshot.docs) {
                    const data = doc.data();
                    if (data.type === 'call' && data.status === 'started' && data.started_at?.toDate) {
                        const start = data.started_at.toDate();
                        const now = new Date();
                        const diff = (now - start) / 1000;
                        if (diff < 60) {
                            console.warn('Call already started recently.');
                            return;
                        }
                        break;
                    }
                }

                const callType = type === 'video' ? 'Video Call' : 'Call';
                const callLink = `https://meet.hillbcs.com/${conversationId}`;
                const callMessage =
                    `<i class="text-muted"> 🔔 ${callType} started: <a href="${callLink}" target="_blank" class="text-blue-600 underline">Join Now</a></i>`;

                await addDoc(messagesRef, {
                    sender_id: supportId,
                    type: 'call',
                    status: 'started',
                    link: callLink,
                    message: callMessage,
                    started_at: serverTimestamp(),
                    timestamp: serverTimestamp()
                });

                console.log('Attempting to start call to', selectedCustomerId);
            }




            function cancelCall(silent = false) {
                if (!selectedCustomerId) return;

                const conversationId = [selectedCustomerId, supportId].sort((a, b) => a - b).join('_');

                // Add cancel message
                addDoc(collection(db, `conversations/${conversationId}/messages`), {
                    sender_id: supportId,
                    message: `<i class="text-muted">🚫 The call has been cancelled.</i>`,
                    type: 'call',
                    status: 'cancelled',
                    timestamp: serverTimestamp()
                });

                if (!silent) {
                    // Optional: update UI (hide ringing, etc.)
                }
            }


            function renderCallMessage(data) {
                if (data.type === 'call' && data.status === 'started' && data.link && data.started_at?.toDate) {
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


            // ✅ Make it globally accessible for HTML inline onclick=
            window.startCall = startCall;
            window.cancelCall = cancelCall;

            loadConversations();
            // Start listening to conversations
        </script>
    </div>

    <!-- HTML remains unchanged -->




    <script>
        function toggleChatPanel() {
            const panel = document.getElementById('chat-panel');
            const label = document.getElementById('btn-name');
            if (panel.classList.contains('slide-up')) {
                panel.classList.remove('slide-up');
                panel.classList.add('slide-down');
                setTimeout(() => {
                    panel.classList.add('hidden');
                    panel.classList.remove('slide-down');
                    label.textContent = 'Live Portal Chat';
                }, 300);
            } else {
                panel.classList.remove('hidden');
                panel.classList.add('slide-up');
                label.textContent = 'Live Portal Chat';
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById('chat-form').classList.add('hidden');
        });

        document.getElementById('chat-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const input = document.getElementById('chat-input');
            let message = input.value.trim();

            if (!message || !messagesRef) return;

            // Convert newlines to <br> for display
            const formattedMessage = message.replace(/\n/g, '<br>');

            await addDoc(messagesRef, {
                sender_id: customerId,
                message: formattedMessage,
                timestamp: serverTimestamp()
            });

            input.value = '';
        });
    </script>

</body>

</html>
