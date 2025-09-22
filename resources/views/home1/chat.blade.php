<style>
    /* Chat Box Container */
    .chat-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
    }

    /* Chat Box Styling */
    .chat-box {
        display: none;
        width: 350px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        min-height: 500px;
    }

    .chat-header {
        background-color: #FFBC58;
        color: #fff;
        padding: 10px;
        font-size: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-header .close-btn {
        background-color: transparent;
        border: none;
        color: #fff;
        font-size: 18px;
        cursor: pointer;
    }

    /* Chat Content Area */
    .chat-content {
        max-height: 300px;
        overflow-y: auto;
        padding: 10px;
        font-size: 13px;
        border-top: 1px solid #ddd;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* Message Styling */
    .message {
        padding: 10px 15px;
        border-radius: 20px;
        max-width: 80%;
        word-wrap: break-word;
        margin: 5px 0;
    }

    /* Bot's Message (Aligned to the Left) */
    .bot-message {
        background-color: #e0e0e0;
        color: #333;
        align-self: flex-start;
        /* Align to the left */
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    /* User's Message (Aligned to the Right) */
    .user-message {
        background-color: #FFBC58;
        color: white;
        font-size: 12px !important;
        align-self: flex-end;
        /* Align to the right */
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .user-message:focus {
        border: 1px solid #eee !important;
    }

    /* Chat Input Area */
    .chat-input {
        display: flex;
        padding: 10px;
        background-color: #f9f9f9;
        border-top: 1px solid #ddd;
    }

    .chat-input input {
        width: 80%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    .chat-input button {
        background-color: #FFBC58;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 10px;
        cursor: pointer;
        margin-left: 5px;
        opacity: 0.6;
        pointer-events: none;
    }

    .chat-input button:enabled {
        opacity: 1;
        pointer-events: auto;
    }

    /* Button to open the chat box */
    .open-chat-btn {
        background-color: #FFBC58;
        color: white;
        border: none;
        padding: 12px 16px;
        border-radius: 5%;
        cursor: pointer;
    }

    .open-chat-btn:hover {
        color: #fff;
        background-color: #FFC107;
    }

    /* Option buttons styling */
    .options {
        justify-content: space-evenly;
        margin-top: 10px;
        padding: 10px;
    }

    .option-btn {
        border-color: #FFBC58;
        border: none;
        border-top: 1px solid #FFBC58;
        border-left: 1px solid #FFBC58;
        border-right: 1px solid #FFBC58;
        border-bottom: 1px solid #FFBC58;
        background-color: #fff;
        color: #45a049 color: white;
        padding: 5px 9px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 12px;
        width: 100%;
        margin-bottom: 5px;
    }

    .option-btn:hover {
        color: #fff;
        background-color: #FFBC58;
    }

    .option-btn:active {
        transform: scale(0.98);
    }
</style>
<div class="chat-container">
    <!-- Button to open chat box -->
    <button class="open-chat-btn" style="display: none" onclick="openChat()">💬 Chat with Us</button>

    <!-- Chat box -->
    <div class="chat-box">
        <div class="chat-header">
            <span>Chat with Us</span>
            <button class="close-btn" onclick="closeChat()">×</button>
        </div>
        <div class="chat-content" id="chat-content">
            <!-- Chat messages will appear here -->
            <div class="message bot-message">Welcome to Integrity Outsourcing Services! How can I assist you
                today? You can ask about our services, billing, or anything else you need help with.</div>
        </div>
        <div class="chat-input">
            <input type="text" id="user-message" style="font-size: 13px;" oninput="enableSendButton(event)"
                placeholder="Write a message.." onkeydown="checkEnter(event)">
            <button id="send-btn" onclick="sendMessage()" disabled>Send</button>
        </div>
        <div class="options">
            <button class="option-btn" onclick="showInfo('get_started')">How do I get started?</button><br>
            <button class="option-btn" onclick="showInfo('transition_process')">What’s the transition process
                like?</button><br>
            <button class="option-btn" onclick="showInfo('contact_us')">How do I contact you?</button><br>
            <button class="option-btn" onclick="showInfo('why_ios')">Why choose IOS over big firms?</button><br>
            <button class="option-btn" onclick="showInfo('outsourcing_benefits')">How can outsourcing benefit my
                business?</button>

            <!-- Add more options as needed -->
        </div>
    </div>
</div>
<script>
    // Function to open the chat box
    function openChat() {
        document.querySelector('.chat-box').style.display = 'flex';
        document.querySelector('.open-chat-btn').style.display = 'none';
    }

    // Function to close the chat box
    function closeChat() {
        document.querySelector('.chat-box').style.display = 'none';
        document.querySelector('.open-chat-btn').style.display = 'block';
    }

    function sendMessage() {
        var userMessage = document.getElementById('user-message').value.trim();
        if (!userMessage) return;

        // Display user's message
        var userMsgDiv = document.createElement('div');
        userMsgDiv.classList.add('message', 'user-message');
        userMsgDiv.textContent = userMessage;
        document.getElementById('chat-content').appendChild(userMsgDiv);
        document.getElementById('user-message').value = '';
        scrollToBottom();

        // Send to backend
        fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    message: userMessage
                })
            })
            .then(response => response.json())
            .then(data => {
                const botMsg = document.createElement('div');
                botMsg.classList.add('message', 'bot-message');
                botMsg.textContent = data.response || "Sorry, I couldn't find an answer to that.";
                document.getElementById('chat-content').appendChild(botMsg);
                scrollToBottom();
            });
    }

    function checkEnter(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent form submission if inside a form
            sendMessage(); // Call your existing sendMessage() function
        }
    }

    function scrollToBottom() {
        const chatContent = document.getElementById('chat-content');
        chatContent.scrollTop = chatContent.scrollHeight;
    }

    // Enable the Send button when user types something
    function enableSendButton(event) {
        var sendButton = document.getElementById('send-btn');
        if (event.target.value.trim() !== '') {
            sendButton.disabled = false;
        } else {
            sendButton.disabled = true;
        }
    }

    function showInfo(identifier) {
        let userQuestion = '';
        let botResponse = '';

        switch (identifier) {
            case 'billing':
                userQuestion = 'What is my billing information?';
                botResponse =
                    'Here is your billing information: You have a total of $120 due for services rendered this month.';
                break;
            case 'accounting':
                userQuestion = 'What are the accounting charges?';
                botResponse = 'Here are the accounting charges: The total charges for your account are $250.';
                break;
            case 'get_started':
                userQuestion = 'How do I get started?';
                botResponse =
                    'Simply contact us for a consultation, and we’ll work with you to create a customized outsourcing plan that aligns with your business goals. You can reach us via our website, email, or phone. Let’s talk again soon to get started!';
                break;
            case 'transition_process':
                userQuestion = 'What’s the transition process like?';
                botResponse =
                    'We ensure a smooth transition by closely working with you throughout the assessment, planning, and implementation stages. Our team provides ongoing support to ensure seamless operations. Let’s discuss how we can make it easy for you.';
                break;
            case 'contact_us':
                userQuestion = 'How do I contact you?';
                botResponse =
                    'You can easily get in touch with us through our website’s contact form, email us at integrity.outsourcing.services@gmail.com, or call +1 855-913-4059. We are always ready to assist you! Feel free to reach out anytime.';
                break;
            case 'why_ios':
                userQuestion = 'Why choose IOS over big firms?';
                botResponse =
                    'Unlike large firms that offer generic services, we provide tailored, flexible solutions that are designed to meet your specific business needs, ensuring better service and cost reduction. Let’s talk more about what we can do for you.';
                break;
            case 'outsourcing_benefits':
                userQuestion = 'How can outsourcing benefit my business?';
                botResponse =
                    'Outsourcing with IOS helps you reduce overhead costs, access skilled labor, and maintain competitiveness in a market with rising labor costs and shortages. Let’s chat to explore the benefits in detail.';
                break;
            default:
                // Fallback: fetch dynamic FAQ from backend
                fetch(`/chat/faq/${identifier}`)
                    .then(res => res.json())
                    .then(data => {
                        const userMsg = document.createElement('div');
                        userMsg.classList.add('message', 'user-message');
                        userMsg.textContent = data.question || 'You selected an option.';
                        document.getElementById('chat-content').appendChild(userMsg);

                        const botMsg = document.createElement('div');
                        botMsg.classList.add('message', 'bot-message');
                        botMsg.textContent = data.response || 'No response available.';
                        document.getElementById('chat-content').appendChild(botMsg);

                        scrollToBottom();
                    })
                    .catch(() => {
                        const botMsg = document.createElement('div');
                        botMsg.classList.add('message', 'bot-message');
                        botMsg.textContent = "Sorry, I couldn't find an answer.";
                        document.getElementById('chat-content').appendChild(botMsg);
                        scrollToBottom();
                    });
                return; // exit early so we don’t append messages twice
        }

        // Append predefined response
        const userMsg = document.createElement('div');
        userMsg.classList.add('message', 'user-message');
        userMsg.textContent = userQuestion;
        document.getElementById('chat-content').appendChild(userMsg);

        const botMsg = document.createElement('div');
        botMsg.classList.add('message', 'bot-message');
        botMsg.textContent = botResponse;
        document.getElementById('chat-content').appendChild(botMsg);

        scrollToBottom();
    }


    // Show information based on the option selected
    // function showInfo(option) {
    //     let botResponse = '';
    //     let userQuestion = '';

    //     // Corresponding information for each option
    //     switch (option) {
    //         case 'billing':
    //             userQuestion = 'What is my billing information?';
    //             botResponse =
    //                 'Here is your billing information: You have a total of $120 due for services rendered this month.';
    //             break;
    //         case 'accounting':
    //             userQuestion = 'What are the accounting charges?';
    //             botResponse = 'Here are the accounting charges: The total charges for your account are $250.';
    //             break;
    //         case 'get_started':
    //             userQuestion = 'How do I get started?';
    //             botResponse =
    //                 'Simply contact us for a consultation, and we’ll work with you to create a customized outsourcing plan that aligns with your business goals. You can reach us via our website, email, or phone. Let’s talk again soon to get started!';
    //             break;
    //         case 'transition_process':
    //             userQuestion = 'What’s the transition process like?';
    //             botResponse =
    //                 'We ensure a smooth transition by closely working with you throughout the assessment, planning, and implementation stages. Our team provides ongoing support to ensure seamless operations. Let’s discuss how we can make it easy for you.';
    //             break;
    //         case 'contact_us':
    //             userQuestion = 'How do I contact you?';
    //             botResponse =
    //                 'You can easily get in touch with us through our website’s contact form, email us at integrity.outsourcing.services@gmail.com, or call +1 855-913-4059. We are always ready to assist you! Feel free to reach out anytime.';
    //             break;
    //         case 'why_ios':
    //             userQuestion = 'Why choose IOS over big firms?';
    //             botResponse =
    //                 'Unlike large firms that offer generic services, we provide tailored, flexible solutions that are designed to meet your specific business needs, ensuring better service and cost reduction. Let’s talk more about what we can do for you.';
    //             break;
    //         case 'outsourcing_benefits':
    //             userQuestion = 'How can outsourcing benefit my business?';
    //             botResponse =
    //                 'Outsourcing with IOS helps you reduce overhead costs, access skilled labor, and maintain competitiveness in a market with rising labor costs and shortages. Let’s chat to explore the benefits in detail.';
    //             break;
    //         default:
    //             userQuestion = 'Invalid option selected.';
    //             botResponse = 'Sorry, I do not have information for this option.';
    //             break;
    //     }

    //     // Display the user's selected question in the chat
    //     var userMsgDiv = document.createElement('div');
    //     userMsgDiv.classList.add('message', 'user-message');
    //     userMsgDiv.textContent = userQuestion;
    //     document.getElementById('chat-content').appendChild(userMsgDiv);

    //     // Display the bot's response
    //     var botMsgDiv = document.createElement('div');
    //     botMsgDiv.classList.add('message', 'bot-message');
    //     botMsgDiv.textContent = botResponse;
    //     document.getElementById('chat-content').appendChild(botMsgDiv);

    //     // Scroll to the bottom of the chat
    //     var chatContent = document.getElementById('chat-content');
    //     chatContent.scrollTop = chatContent.scrollHeight;
    // }
</script>
