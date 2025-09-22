<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>403 — Unauthorized</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="/assets/raw/new.png" type="image/x-icon">
    <style>
        /* subtle paper pattern */
        body {
            background-image: url("{{ asset('errors/dot-grid.webp') }}");
            background-size: 400px;
            background-repeat: repeat;
        }

        /* motions (flat + gentle) */
        @keyframes floatA {
            0% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-12px)
            }

            100% {
                transform: translateY(0)
            }
        }

        @keyframes floatB {
            0% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(10px)
            }

            100% {
                transform: translateY(0)
            }
        }

        @keyframes driftX {
            0% {
                transform: translateX(0)
            }

            50% {
                transform: translateX(16px)
            }

            100% {
                transform: translateX(0)
            }
        }

        @keyframes driftY {
            0% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-16px)
            }

            100% {
                transform: translateY(0)
            }
        }

        @keyframes sway {
            0% {
                transform: rotate(0deg)
            }

            50% {
                transform: rotate(3deg)
            }

            100% {
                transform: rotate(0deg)
            }
        }

        .float-a {
            animation: floatA 14s ease-in-out infinite;
        }

        .float-b {
            animation: floatB 16s ease-in-out infinite;
        }

        .drift-x {
            animation: driftX 18s ease-in-out infinite;
        }

        .drift-y {
            animation: driftY 20s ease-in-out infinite;
        }

        .sway {
            animation: sway 22s ease-in-out infinite;
        }

        /* soft icon pulse (scale only, no glow) */
        @keyframes softPulse {

            0%,
            100% {
                transform: scale(1)
            }

            50% {
                transform: scale(1.06)
            }
        }

        .animate-soft-pulse {
            animation: softPulse 2.4s ease-in-out infinite;
        }

        /* stagger helpers */
        .delay-2s {
            animation-delay: 2s
        }

        .delay-4s {
            animation-delay: 4s
        }

        .delay-6s {
            animation-delay: 6s
        }

        @media (prefers-reduced-motion: reduce) {

            .float-a,
            .float-b,
            .drift-x,
            .drift-y,
            .sway,
            .animate-soft-pulse {
                animation: none !important;
            }
        }
    </style>
</head>

<body class="relative min-h-screen bg-slate-50 antialiased overflow-hidden">

    <!-- BACKDROP ICONS (above pattern, below card) -->
    <div class="fixed inset-0 pointer-events-none z-10">
        <!-- Top-left cluster -->
        <svg class="absolute -top-20 -left-20 h-64 w-64 text-slate-300/35 float-a" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
            <!-- warning triangle -->
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
        </svg>

        <!-- Bottom-right ring -->
        <svg class="absolute -bottom-24 -right-24 h-72 w-72 text-slate-300/30 float-b"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
            <circle cx="256" cy="256" r="210" fill="none" stroke="currentColor" stroke-width="18" />
        </svg>

        <!-- Mid-left lock (drifting) -->
        <svg class="absolute top-[22%] left-10 h-24 w-24 text-slate-300/30 drift-x delay-2s"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="1.2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 11V7a4 4 0 118 0v4m-9 0h10a2 2 0 012 2v5a2 2 0 01-2 2H7a2 2 0 01-2-2v-5a2 2 0 012-2z" />
        </svg>

        <!-- Top-right shield (sway) -->
        <svg class="absolute top-6 right-20 h-28 w-28 text-slate-300/25 sway delay-4s"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="1.2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6.75c-2.38 0-4.95-1.02-6.75-2.25C5.25 9 4.5 12.75 12 17.25c7.5-4.5 6.75-8.25 6.75-12.75-1.8 1.23-4.37 2.25-6.75 2.25z" />
        </svg>

        <!-- Mid-right triangle (drift Y) -->
        <svg class="absolute top-1/2 right-8 h-20 w-20 text-slate-300/25 drift-y delay-6s"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="1.2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
        </svg>

        <!-- Bottom-left small ring (float) -->
        <svg class="absolute bottom-8 left-10 h-16 w-16 text-slate-300/25 float-a delay-2s"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
            <circle cx="256" cy="256" r="120" fill="none" stroke="currentColor" stroke-width="16" />
        </svg>

        <!-- Center-left square (drift X) -->
        <svg class="absolute top-[58%] left-1/4 h-16 w-16 text-slate-200/30 drift-x" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512" fill="currentColor" aria-hidden="true">
            <rect x="96" y="96" width="320" height="320" rx="36" fill="currentColor" />
        </svg>
    </div>

    <!-- MAIN -->
    <main class="relative z-20 min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-3xl">
            <!-- watermark (top center, behind card) -->
            <div
                class="pointer-events-none absolute inset-x-0 top-10 text-center select-none text-9xl font-black tracking-tighter text-slate-100">
                403
            </div>

            <div class="relative rounded-2xl border border-slate-200 bg-white">
                <!-- flat red accent bar -->
                <div class="h-1 w-full bg-red-500"></div>

                <div class="px-10 py-14 text-center">
                    <!-- error icon (flat, subtle red, soft pulse) -->
                    <div
                        class="mx-auto mb-8 flex h-28 w-28 items-center justify-center rounded-full bg-red-50 animate-soft-pulse">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-red-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                        </svg>
                    </div>

                    <h1 class="text-5xl font-extrabold tracking-tight text-slate-900">
                        403 — Unauthorized
                    </h1>
                    <p class="mt-3 text-base text-slate-600 max-w-2xl mx-auto">
                        You do not have permission to access this page.
                    </p>

                    <!-- actions (flat styles, red only where needed) -->
                    <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
                        <a href="javascript:history.back()"
                            class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h20" />
                            </svg>
                            Go Back
                        </a>

                        <a href="{{ url('/dashboard') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-800 hover:bg-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h4m6 0h4a1 1 0 001-1V10" />
                            </svg>
                            Dashboard
                        </a>

                        <a href="mailto:support@hillbcs.com?subject=403%20Unauthorized"
                            class="inline-flex items-center gap-2 rounded-xl border border-red-300 bg-red-50 px-5 py-2.5 text-sm font-semibold text-red-700 hover:bg-red-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                            </svg>
                            Report This
                        </a>
                    </div>

                    <p class="mt-8 text-xs text-slate-500">
                        If you believe this is an error, please contact your administrator.
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
