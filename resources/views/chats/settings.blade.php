<style>
    @import url("https://fonts.googleapis.com/css?family=Raleway|Ubuntu&display=swap");

    .chat-box {
        max-height: 50%;
        width: 400px;
        position: fixed;
        right: 0;
        bottom: 0;
        margin: 15px;
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        z-index: 15;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        visibility: hidden;
    }

    .chat-box-header {
        height: 8%;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        font-size: 14px;
        box-shadow: 0 1px 10px rgba(0, 0, 0, 0.025);
    }

    .chat-box-header h3 {
        font-family: Ubuntu;
        font-weight: 400;
        margin: 0;
    }

    .chat-box-header p {
        cursor: pointer;
        margin: 0;
    }

    .chat-box-body {
        height: 75%;
        background: #f8f8f8;
        overflow-y: auto;
        padding: 12px;
    }

    .chat-box-body-send,
    .chat-box-body-receive {
        width: 250px;
        background: white;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.015);
        margin-bottom: 14px;
    }

    .chat-box-body-send {
        float: right;
        clear: both;
    }

    .chat-box-body-receive {
        float: left;
        clear: both;
    }

    .chat-box-body p {
        margin: 0 0 0.25rem 0;
        color: #444;
        font-size: 14px;
    }

    .chat-box-body span {
        float: right;
        color: #777;
        font-size: 10px;
    }

    .chat-box-footer {
        display: flex;
        align-items: center;
        padding: 10px;
        background: #fff;
    }

    .chat-box-footer button {
        border: none;
        padding: 10px;
        font-size: 14px;
        background: white;
        cursor: pointer;
    }

    .chat-box-footer input {
        flex-grow: 1;
        padding: 10px;
        border: none;
        border-radius: 50px;
        background: whitesmoke;
        font-family: Ubuntu;
        font-weight: 600;
        color: #444;
        margin: 0 10px;
    }

    .chat-box-footer input:focus {
        outline: none;
    }

    .chat-box-footer .send {
        cursor: pointer;
        font-size: 18px;
        color: #2C50EF;
    }

    .chat-button {
        padding: 25px 16px;
        background: transparent;  /* #2C50EF; */
        width: auto;
        position: fixed;
        bottom: 0;
        right: 0;
        /* margin: 15px; */
        /* border-radius: 25px 25px 0 25px;
        box-shadow: 0 2px 15px rgba(44, 80, 239, 0.21); */
        cursor: pointer;
    }

    .chat-button span::before {
        content: "";
        height: 15px;
        width: 15px;
        background: #47cf73;
        position: absolute;
        transform: translate(0, -7px);
        border-radius: 15px;
        display: none;
        /* This hides the green bullet */
    }

    .chat-button span::after {
        /* content: "Virtual Assistant"; */
        font-size: 14px;
        color: white;
        position: absolute;
        left: 60px;
        top: 15px;
    }






    .modal-close-button {
        float: right;
        width: 1.5rem;
        line-height: 1.5rem;
        text-align: center;
        cursor: pointer;
        border-radius: 0.25rem;
        background-color: lightgray;
    }

    .modal-close-button:hover {
        background-color: darkgray;
    }

    .show-modal {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
        transition: all 0.25s ease;
    }

    @media screen and (max-width: 450px) {
        .chat-box {
            width: 100% !important;
            border-radius: 0;
        }
    }

    @keyframes fadeUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-up {
        animation: fadeUp 0.4s ease-out forwards;
    }

    .chat-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .chat-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .chat-message {
        display: flex;
        align-items: flex-start;
        margin-bottom: 14px;
    }

    .chat-box-body-send .chat-message {
        flex-direction: row-reverse;
        text-align: right;
    }

    .chat-box-body-receive .chat-message {
        flex-direction: row;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chatButton = document.querySelector('.chat-button');
        const chatBox = document.querySelector('.chat-box');
        const closeButton = document.getElementById('closeChatBtn');

        chatButton.addEventListener('click', function() {
            chatButton.style.display = 'none';
            chatBox.style.visibility = 'visible';
            chatBox.classList.remove('fade-up');
            void chatBox.offsetWidth; // trigger reflow
            chatBox.classList.add('fade-up');
        });

        closeButton.addEventListener('click', function() {
            chatButton.style.display = 'block';
            chatBox.style.visibility = 'hidden';
        });

        const modal = document.querySelector(".modal");
        const modalClose = document.querySelector(".modal-close-button");


        addExtra.addEventListener("click", function() {
            modal.classList.toggle("show-modal");
        });

        modalClose.addEventListener("click", function() {
            modal.classList.toggle("show-modal");
        });

        document.getElementById('closeChatBtn').addEventListener('click', function() {
            document.getElementById('chatBox').style.display = 'none';
        });

    });
</script>
