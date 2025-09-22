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
