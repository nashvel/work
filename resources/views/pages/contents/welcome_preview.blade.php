<style>
    .custom-modal {
        padding-top: 20vh;
    }

    .confetti-bg {
        position: fixed;
        inset: 0;
        background: url("{{ asset('assets/welcome/confetti.webp') }}") center/cover no-repeat;
        z-index: 999;
        /* Below the modal */
        opacity: 1;
        animation: fadeInBg 0.8s ease-out 0s forwards;
    }

    /* Modal Animation */
    .ti-modal-box {
        opacity: 0;
        transform: translateY(50px) scale(0.95);
        animation: fadeInUp 0.8s ease-out 0s forwards;
        /* Delay of 3s before starting */
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(50px) scale(0.95);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .chat-avatar {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: flex;
        align-items: flex-end;
        gap: 10px;
        z-index: 1000;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInAvatar 0.8s ease-out 1s forwards;
    }

    @keyframes fadeInAvatar {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chat-box {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .chat-message {
        background: rgba(255, 255, 255, 0.8);
        /* Glass effect */
        backdrop-filter: blur(8px);
        color: #333;
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 14px;
        max-width: 260px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        opacity: 0;
        animation: fadeInMessage 0.8s ease-in-out 1s forwards, flashEffect 1.5s infinite alternate ease-in-out;
        overflow: hidden;
    }

    /* Flashing light effect */
    @keyframes flashEffect {
        0% {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        100% {
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.6);
        }
    }

    /* Fade-in effect for message */
    @keyframes fadeInMessage {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    @keyframes fadeInMessage {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chat-button-card {
        display: none;
        opacity: 0;
        animation: fadeInButton 0.8s ease-in-out forwards;
    }

    @keyframes fadeInButton {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chat-action-button {
        background-color: #FEBC59;
        box-shadow: 0px 0px 5px 1px #eee;
        border-radius: 20%;
        color: #333;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
        backdrop-filter: blur(8px);
        float: right;
    }

    .chat-action-button:hover {
        background-color: #45a049;
    }


    .chat-avatar img {
        width: 135px;
        /* Adjust as needed */
        height: auto;
        border-radius: 50%;
    }

    .ti-modal-body {
        position: relative;
        min-height: 370px;
        overflow-y: auto;
    }

    .ti-modal-body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('/assets/welcome/confetti2.webp') bottom/cover no-repeat;
        z-index: -1;
    }

    .blur-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('/assets/welcome/confetti2.webp') bottom/cover no-repeat;
        z-index: -1;
    }
</style>

<div id="welcome-message-preview-backdrop" data-hs-overlay-backdrop-template="" style="z-index: 998;"
    class="hs-overlay-backdrop transition duration fixed inset-0 bg-gray-900 bg-opacity-50 dark:bg-opacity-80 dark:bg-neutral-900">
</div>

<div id="welcome-message-preview" class="hs-overlay ti-modal fade open opened" aria-overlay="true" tabindex="-1">
    <div
        class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3  items-center justify-center">
        {{--  mx-auto lg:!mx-auto custom-modal --}}
        <div class="max-h-full fade w-full overflow-hidden ti-modal-content main-content-card">
            <div class="ti-modal-header text-center">
                <h5 class="modal-title text-center" id="welcomeModalLabel">
                    🎉 Greetings!
                </h5>
                <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                    data-hs-overlay="#welcome-message-preview">
                    <span class="sr-only">Close</span> ✖
                </button>
            </div>
            <input type="hidden" name="_token" value="SBzHTjz6S9JLXXv0Q87MoQolSErVHgmHZLMYzoPE" autocomplete="off">
            <div class="ti-modal-body overflow-y-auto" style="position: relative; min-height: 370px;">
                <!-- Blurred Background -->
                <div class="blur-bg"></div>

                @php
                    $clientId = $content->client_id;

                    $greetings = App\Models\WelcomeMessage::join('leads', 'leads.id', 'welcome_messages.client_id')
                        ->where('client_id', $clientId)
                        ->where('status', 'Active')
                        ->first();

                    $logo = asset('storage/' . $greetings->photo);
                    if ($id == 1) {
                        $logo = asset('assets/logo.png');
                    }
                @endphp

                <br>
                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                    <img src="{{ $logo }}" class="auto-zoom" id="logo-sidemenu"
                        style="height: {{ $id == 1 ? '150px' : '100px' }};" alt="">
                </div>

                <br>

                @php
                    // Extract content inside <div class="ql-editor">
                    preg_match('/<div class="ql-editor"[^>]*>(.*?)<\/div>/s', $greetings->welcome_message, $matches);
                @endphp

                <div class="project-description p-5">
                    <center>
                        <h6>{!! $matches[1] ?? '' !!}</h6>
                    </center>
                </div>
            </div>

        </div>
    </div>

</div>
