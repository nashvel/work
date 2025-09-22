<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password — Hill Business Consulting Services</title>
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

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-20 px-4">


            <div class="flex flex-col justify-center">
                <div class="text-center">
                    <img class="mx-auto h-32 w-auto" src="/assets/logo.png" alt="Logo" />
                </div>

                <form method="POST" method="POST" autocomplete="off"
                    class="mt-8 space-y-6 bg-white p-8 rounded-lg pt-2 shadow" action="{{ route('password.email') }}">
                    @csrf

                    <h2 class=" text-3xl !m-0 !p-0 !mt-4 font-extrabold text-gray-900">Forgot Password</h2>
                    <p class="!mt-2 text-gray-600">Forgot your password? No problem. Just let us know your email address
                        and we will email you a password reset link that will allow you to choose a new one.</p>
                    <hr>

                    <div class="block">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <x-input id="email" required placeholder="name@company.com"
                            class="mt-1 block w-full px-3 py-2 h-12 border bg-gray-50 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" />
                    </div>

                    <div class="!mt-3 grid grid-cols-2 gap-1">
                        <div class="flex items-center justify-start mt-4">
                           <a href="/" class="text-gray-700">
                                <i class="fa-solid fa-arrow-left mx-2"></i>
                                Sign In
                           </a>
                        </div>
                        <div class="flex items-center mt-4">
                            <button type="submit"
                                class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                style="letter-spacing: 0.5px; font-weight: semibold;">
                                Email Password Reset Link
                            </button>
                        </div>
                    </div>

                </form>
            </div>


            <div class="hidden md:flex items-center justify-center pt-12">
                <img src="https://flowbite.com/application-ui/demo/images/sign-in.svg" alt="Illustration"
                    class="max-w-full h-auto pt-12">
            </div>
        </div>
    </div>
</body>

</html>
