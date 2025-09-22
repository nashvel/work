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

        const users = @json($users->pluck('id'));
        let activeConversationId = null;

        users.forEach(staffId => {
            const conversationId = [customerId, staffId].sort((a, b) => a - b).join('_');
            const messagesRef = collection(db, `conversations/${conversationId}/messages`);
            const q = query(messagesRef, orderBy('timestamp', 'desc'));

            onSnapshot(q, (snapshot) => {
                if (!snapshot.empty) {
                    const latest = snapshot.docs[0].data();
                    if (latest.sender_id !== customerId && activeConversationId !== conversationId) {
                        const badge = document.getElementById(`badge-${staffId}`);
                        if (badge) badge.classList.remove('hidden');
                    }
                }
            });
        });

        let supportId = null;
        let conversationId = null;
        let messagesRef = null;
        let unsubscribe = null;
        let incomingCallActive = false;


        window.addEventListener('DOMContentLoaded', () => {
            window.toggleChatPanel = async function(staffId) {
                const panel = document.getElementById('chat-panel');
                const badge = document.getElementById('notification-badge');
                const avatar = document.getElementById('va-avatar');
                const label = document.getElementById('va-name');

                // Ensure it's open
                if (panel.classList.contains('hidden') || panel.classList.contains('slide-down')) {
                    panel.classList.remove('hidden', 'slide-down');
                    panel.classList.add('slide-up');
                    if (badge) {
                        badge.classList.add('hidden');
                        badge.textContent = '0';
                    }
                }

                // Show loading
                const chatBox = document.getElementById('chat-list');
                chatBox.innerHTML = '<div class="text-center text-gray-400 mt-4">Loading messages...</div>';

                // Start chat
                await initChatWithStaff(staffId);

                // Optional: Set header info (assumes staff info is available in a global JS object)
                const userData = {{ Js::from($users->keyBy('id')) }};
                if (userData[staffId]) {
                    label.textContent = userData[staffId].name;
                    avatar.src = userData[staffId].profile_photo_path ?
                        `/storage/${userData[staffId].profile_photo_path}` :
                        '/user.png';
                }
            };

            window.toggleChatPanelClose = function() {
                const panel = document.getElementById('chat-panel');
                if (panel.classList.contains('slide-up')) {
                    panel.classList.add('slide-down');
                    panel.classList.remove('slide-up');
                    setTimeout(() => {
                        panel.classList.add('hidden');
                        panel.classList.remove('slide-down');
                    }, 300);
                }
            }
        });

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

        }



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
