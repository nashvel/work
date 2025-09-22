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
