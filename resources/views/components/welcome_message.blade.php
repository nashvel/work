@if (session('show_welcome_modal'))
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

        .v3-chat-avatar {
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

        .v3-chat-box {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .v3-chat-message {
            background: rgba(238, 238, 238, 0.8) !important;
            /* Glass effect */
            backdrop-filter: blur(2px);
            color: #333;
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 14px;
            max-width: 285px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: #333 !important;
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
            cursor: pointer;
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
            width: 110px;
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let text = "Hi! ✋ I'm Kimberly, your Virtual Assistant. Need help? Let me know!";
            let i = 0;
            let speed = 50;
            let messageBox = document.querySelector(".typing-text");
            let buttonCard = document.querySelector(".chat-button-card");

            function typeMessage() {
                if (i < text.length) {
                    messageBox.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeMessage, speed);
                } else {
                    // After the message finishes, show the button
                    setTimeout(() => {
                        buttonCard.style.display = "block";
                        buttonCard.style.animation = "fadeInButton 0.8s ease-in-out forwards";
                    }, 1000); // Show button 1s after typing finishes
                }
            }

            setTimeout(typeMessage, 3000); // 5s delay before typing starts
        });
    </script>
    @if (Auth::user()->role !== 'Virtual Assistant' || Auth::user()->role !== 'Administrator')
        <div id="welcome-message-backdrop" data-hs-overlay-backdrop-template="" style="z-index: 998;"
            class="hs-overlay-backdrop transition duration fixed inset-0 bg-gray-900 bg-opacity-50 dark:bg-opacity-80 dark:bg-neutral-900">
        </div>

        <div id="welcome-message" class="hs-overlay ti-modal fade open opened" aria-overlay="true" tabindex="-1">
            <div
                class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3  items-center justify-center">
                {{--  mx-auto lg:!mx-auto custom-modal --}}
                <div class="max-h-full fade w-full overflow-hidden ti-modal-content main-content-card">
                    <div class="ti-modal-header">
                        <h5 class="modal-title text-center" id="welcomeModalLabel">
                            🎉 Welcome Greetings!
                        </h5>
                        <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                            data-hs-overlay="#welcome-message">
                            <span class="sr-only">Close</span> ✖
                        </button>
                    </div>
                    <input type="hidden" name="_token" value="SBzHTjz6S9JLXXv0Q87MoQolSErVHgmHZLMYzoPE"
                        autocomplete="off">
                    <div class="ti-modal-body overflow-y-auto" style="position: relative; min-height: 370px;">
                        <!-- Blurred Background -->
                        <div class="blur-bg"></div>

                        @php
                            if (Auth::user()->role === 'Developer') {
                                $clientId = Auth::user()->id;
                            } else {
                                if (Auth::user()->role == 'Virtual Assistant') {
                                    $clientId = Auth::user()->company;
                                } elseif (Auth::user()->role == 'Sub-Client') {
                                    $clientId = App\Models\ContactPerson::where('email', Auth::user()->email)->value(
                                        'company_id',
                                    );

                                    $greetings = App\Models\WelcomeMessage::where('client_id', $clientId)
                                        ->where('status', 'Active')
                                        ->where('type', 'CRM')
                                        ->where('isDeleted', 0)
                                        ->first();
                                } elseif (Auth::user()->role == 'Administrator') {
                                    $clientId = 1;
                                } else {
                                    $lead = App\Models\Lead::where('email', Auth::user()->email)
                                        ->select('id')
                                        ->first();
                                    $clientId = $lead->id;

                                    $greetings = App\Models\WelcomeMessage::join(
                                        'leads',
                                        'leads.id',
                                        'welcome_messages.client_id',
                                    )
                                        ->where('client_id', $clientId)
                                        ->where('status', 'Active')
                                        ->where('type', 'CLIENT')
                                        ->where('isDeleted', 0)
                                        ->first();
                                }
                            }

                        @endphp

                        @php
                            $filePath = $greetings->welcome_message ?? ''; // e.g., content/greetings/sample.jpg
                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp
                        <center>
                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <img src="{{ asset('storage/content/greetings/' . $filePath) }}" alt="Image Preview"
                                    class="max-h-48 rounded border border-gray-300 mt-2">
                            @elseif(in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                                <video controls class="w-full max-h-48 rounded border border-gray-300 mt-2">
                                    <source src="{{ asset('storage/content/greetings/' . $filePath) }}"
                                        type="video/{{ $extension }}">
                                    Your browser does not support the video tag.
                                </video>
                            @elseif(in_array(strtolower($extension), ['mp3', 'wav', 'ogg']))
                                <audio controls class="w-full rounded border border-gray-300 mt-2">
                                    <source src="{{ asset('storage/content/greetings/' . $filePath) }}"
                                        type="audio/{{ $extension }}">
                                    Your browser does not support the audio tag.
                                </audio>
                            @else
                                <p class="text-sm text-red-600 mt-2">Unsupported file format: .{{ $extension }}
                                </p>
                            @endif
                        </center>
                    </div>

                </div>
            </div>
            {{ session()->forget('show_welcome_modal') }}
        </div>

        {{-- <div class="v3-chat-avatar">
            <div class="v3-chat-box">
                <div class="v3-chat-message">
                    <span class="typing-text"></span>
                </div>
                @php
                    $user = App\Models\User::where('id', 30)->first();
                @endphp
                <div class="chat-button-card">
                    <a href="/chat/30" class="ti-btn w-full chat-action-button btn-round">🚀 Chat with Us</a>
                </div>
            </div>
            <a href="/chat/30">
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" onerror="this.src = '/user.png'"
                    style="border-radius: 50%; height: 130px; width: 130px; object-fit: cover;" alt="Chatbot"
                    class="xrobot-image">
            </a>

        </div> --}}
    @endif
@endif
