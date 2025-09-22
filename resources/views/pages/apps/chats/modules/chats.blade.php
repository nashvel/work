{{-- <x-app-layout>

    <x-slot name="title">Messages</x-slot>
    <x-slot name="url_1">{"link": "/", "text": "Messages"}</x-slot>
    <x-slot name="active">Chats</x-slot>
    <x-slot name="buttons">
        <button onclick="goFullScreen()" class="ti-btn text-white !border-0 btn-wave me-0"
            style="background-color: #2563eb">
            Fullscreen Chat
        </button>
    </x-slot>

    <div class="box p-0 shadow">

        <style>
            iframe {
                width: 100%;
                height: 100vh;
                border: none;
                padding: 0;
                margin: 0;
            }
        </style>


        <iframe id="chatFrame" src="https://chat-test.repohive.com?{{ time() }}"
            allow="camera; microphone; clipboard-read; clipboard-write; fullscreen; display-capture; autoplay"
            style="width: 100%; height: 900px; border: none;">
        </iframe>

        @php
            $externalUsers = App\Models\User::where('role', '<>', 'Sub-Client')->get(['id', 'name', 'email']);
            $userData = [
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ];
            $mergedUsers = collect([$userData])
                ->merge($externalUsers)
                ->values();

        @endphp

        <script>
            const iframe = document.getElementById('chatFrame');
            const message = {
                externalUsers: @json($mergedUsers)
            };

            function sendMessageToIframe(attempt = 1) {
                if (attempt > 2) return; // Stop after 5 tries

                if (iframe.contentWindow) {
                    iframe.contentWindow.postMessage(message, 'https://chat-test.repohive.com?{{ time() }}');
                }

                setTimeout(() => {
                    sendMessageToIframe(attempt + 1);
                }, 500); // retry every 500ms
            }

            iframe.addEventListener('load', () => {
                sendMessageToIframe();
            });

            function goFullScreen() {
                if (iframe.requestFullscreen) {
                    iframe.requestFullscreen();
                } else if (iframe.webkitRequestFullscreen) {
                    iframe.webkitRequestFullscreen();
                } else if (iframe.msRequestFullscreen) {
                    iframe.msRequestFullscreen();
                }
            }
        </script>



    </div>

</x-app-layout> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/assets/raw/new.png" type="image/x-icon">
    <title>{{ config('app.name', 'Hill Business Consulting Services') }}</title>
    <meta name="Description"
        content="The history of Hill Business Consulting Services began with two business owners, Joe and Douglas, who both worked in the janitorial industry and were challenged by rising labor costs and the pressure these costs placed on profitability. Recognizing the need for a fresh approach, they sought a better solution. Drawing from Mr. Hill's extensive background in the high-tech industry, they introduced processes, methods, and technologies typically used by world-class Silicon Valley companies and applied these innovations to the janitorial sector. This innovative shift proved highly successful, demonstrating that advanced technology isn’t just for billion-dollar enterprises but can be effectively implemented at any scale when supported by experienced professionals. This laid the groundwork for outsourcing high-quality talent, utilizing internet technologies and software tools to provide cost-effective, top-notch support services. Today, IOS works closely with clients, ensuring they benefit from continuous advancements and the efficiencies of an ever-changing global market.">
    <meta name="Author" content="Hill Business Consulting Services">
    <meta name="keywords" content="iosbiz.com, iosbiz, Hill Business Consulting Services">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @include('components.nav-link')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Mogra&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    @livewireStyles

</head>

<body>

    <div id="loader">
        <center>
            <img src="/assets/images/media/loader.svg" alt=""> <br />
            Please wait a moment... <br /> We are securely processing your request. <br />
            Retrieving large files may take a few minutes.
        </center>
    </div>

    <div class="page">

        <!-- /app-header -->
        <!-- Start::app-sidebar -->


        @include('components.nav-top')
        @include('components.nav-sidemenu')

        <div class="main-content app-content">
            <div class="container-fluid">

                <style>
                    iframe {
                        width: 100%;
                        height: 100vh;
                        border: none;
                        padding: 0;
                        margin: 0;
                    }
                </style>


                <iframe id="chatFrame" src="https://chat-test.repohive.com?{{ time() }}"
                    allow="camera; microphone; clipboard-read; clipboard-write; fullscreen; display-capture; autoplay"
                    style="width: 100%; max-height: 720px; border: 2px solid #eee;">
                </iframe>

                @php
                    $externalUsers = App\Models\User::where('role', '<>', 'Sub-Client')->get(['id', 'name', 'email']);
                    $userData = [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                    ];
                    $mergedUsers = collect([$userData])
                        ->merge($externalUsers)
                        ->values();

                @endphp

                <script>
                    const iframe = document.getElementById('chatFrame');
                    const message = {
                        externalUsers: @json($mergedUsers)
                    };

                    function sendMessageToIframe(attempt = 1) {
                        if (attempt > 5) return; // Stop after 5 tries

                        if (iframe.contentWindow) {
                            iframe.contentWindow.postMessage(message, 'https://chat-test.repohive.com?{{ time() }}');
                        }

                        setTimeout(() => {
                            sendMessageToIframe(attempt + 1);
                        }, 500); // retry every 500ms
                    }

                    iframe.addEventListener('load', () => {
                        sendMessageToIframe();
                    });

                    function goFullScreen() {
                        if (iframe.requestFullscreen) {
                            iframe.requestFullscreen();
                        } else if (iframe.webkitRequestFullscreen) {
                            iframe.webkitRequestFullscreen();
                        } else if (iframe.msRequestFullscreen) {
                            iframe.msRequestFullscreen();
                        }
                    }

                    document.addEventListener('DOMContentLoaded', () => {
                        const audio = document.querySelector('audio');

                        if (audio) {
                            audio.addEventListener('play', () => {
                                parent.postMessage({
                                    type: 'audio-playing'
                                }, '*');
                            });

                            audio.addEventListener('pause', () => {
                                parent.postMessage({
                                    type: 'audio-paused'
                                }, '*');
                            });
                        }
                    });
                </script>

            </div>
        </div>
        <br><br>

        @include('components.nav-footer')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const mobileNavToggleBtn = document.querySelector('.sidemenu-toggle');

                if (mobileNavToggleBtn) {
                    // Trigger the click once on page load
                    mobileNavToggleBtn.click();

                    // Add the normal event listener (if needed)
                    mobileNavToggleBtn.addEventListener('click', function() {
                        document.body.classList.toggle('mobile-nav-active');

                        const sidebar = document.getElementById('sidebar');
                        const page = document.querySelector('.page');

                        if (sidebar) sidebar.classList.toggle('collapsed');
                        if (page) page.classList.toggle('sidebar-collapsed');
                    });
                }
            });
        </script>



    </div>

    {{-- @stack('modals') --}}

    <!-- Scroll To Top -->
    @include('components.nav-footer-link')

    @include('chats.index')

    {{-- @livewireScripts --}}


</body>

</html>
