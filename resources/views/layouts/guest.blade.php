<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In — Hill Business Consulting Services</title>
    <link rel="icon" href="/assets/raw/new.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

        body {
            font-family: "Rubik", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }
    </style>
</head>

<body class="bg-[#f7f9fa]">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
            <div class="flex justify-center mb-6">
                <!-- Replace with your logo if needed -->
                <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12 4.5c-2.25 0-4.5 1.25-6 3.25C7.5 9 9.75 10 12 10s4.5-1 6-2.25C16.5 5.75 14.25 4.5 12 4.5zM6 13c-1.25 1.25-2 2.75-2 4.5 0 .75.25 1.5.75 2s1.25.75 2 .75h10c.75 0 1.5-.25 2-.75s.75-1.25.75-2c0-1.75-.75-3.25-2-4.5C16.5 14 14.25 15 12 15s-4.5-1-6-2z" />
                </svg>
            </div>

            <h2 class="text-center text-2xl font-bold text-gray-900">Sign in to your account</h2>
            {{ $slot }}

        </div>
    </div>
</body>

</html>
