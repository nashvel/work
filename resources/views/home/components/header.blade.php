<header class="th-header header-layout4 header-absolute "  style="padding-right: 20px; padding-left: 20px;">
    <div class="sticky-wrapper">
        <!-- Main Menu Area -->
        <div class="menu-area">
            <div class="container-fluid p-0">
                <div class="row align-items-center justify-content-between">
                    <!-- Logo -->
                    <div class="col-auto">
                        <div class="header-logo p-0">
                            <a class="icon-masking" href="/">
                                <img src="/assets/logo.png" alt="Hill Business Consulting Logo"
                                    style="max-height: 70px;">
                            </a>
                        </div>
                    </div>

                    <!-- Main Navigation -->
                    <div class="col-auto">
                        <nav class="main-menu style2 d-none d-lg-inline-block">
                            <ul>
                                <li><a href="/">Home</a></li>

                                <li class="menu-item-has-children">
                                    <a href="#">About</a>
                                    <ul class="sub-menu">
                                        <li><a href="#">Our Story</a></li>
                                        <li><a href="#">Leadership</a></li>
                                        <li><a href="#">Vision & Mission</a></li>
                                    </ul>
                                </li>

                                <li class="menu-item-has-children">
                                    <a href="#">Services</a>
                                    <ul class="sub-menu">
                                        <li><a href="#">Virtual Assistants</a></li>
                                        <li><a href="#">Admin Outsourcing</a></li>
                                        <li><a href="#">Process Automation</a></li>
                                        <li><a href="#">Custom Solutions</a></li>
                                    </ul>
                                </li>

                                <li><a href="#">Resources</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </nav>
                        <button type="button" class="th-menu-toggle d-block d-lg-none">
                            <i class="far fa-bars"></i>
                        </button>
                    </div>

                    <!-- Header Button -->
                    <div class="col-auto d-none d-lg-inline-block">
                        <div class="header-button">
                            <a href="#" class="th-btn style1 d-none d-xl-block" data-bs-toggle="modal"
                                data-bs-target="#loginModal">Client Portal</a>
                            <a href="#" class="icon-btn sideMenuTogglerX">
                                <i class="fa-light fa-grid"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="loginModalLabel">Client Portal Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">❌</button>
            </div>

            <div class="modal-body">
                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                    @csrf
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address : <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter your email address..." required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password : <span class="text-danger">*</span></label>
                        <input type="password" class="form-control pe-5" id="password" name="password"
                            placeholder="Enter your password..." required>
                        <span class="position-absolute translate-middle-y end-0 me-3"
                            style="cursor: pointer; top: 60px;" onclick="togglePassword()">
                            <i id="togglePasswordIcon" class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                    <script>
                        function togglePassword() {
                            const passwordInput = document.getElementById("password");
                            const icon = document.getElementById("togglePasswordIcon");
                            const isPassword = passwordInput.type === "password";
                            passwordInput.type = isPassword ? "text" : "password";
                            icon.classList.toggle("bi-eye");
                            icon.classList.toggle("bi-eye-slash");
                        }
                    </script>

                    <!-- Remember Me & Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-3 mx-0">
                        <div class="form-check px-2 pt-2">
                            <input class="form-check-input" checked type="checkbox" name="remember" id="remember_me">
                            <label class="form-check-label" for="remember_me">
                                Remember me
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot
                            Password?</a>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn"
                            style="background-color: #FFC107; color: #000; border-radius: 20px;">
                            <strong>Sign In</strong>
                        </button>
                    </div>



                    <div class="text-center pt-3 pb-0">
                        <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                    </div>

                    <button style="border-radius: 20px !important; width: 100%" type="button"
                        class="!w-full mb-2 text-center items-center px-4 py-2 btn-light bg-white border border-transparent rounded-md font-semibold text-xs text-dark uppercase tracking-widest hover:bg-violet-700 focus:bg-gray-700 active:bg-violet-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 flex  justify-center">
                        <img src="/social-media/microsoft.png" style="height: 24px; margin-right: 15px;"
                            alt="Facebook">
                        <span>Login with Microsoft Account </span>
                    </button>

                    <a href="{{ route('google.login') }}" style=" border-radius: 20px !important; width: 100%"
                        type="button"
                        class="!w-full mb-4 text-center items-center px-4 py-2 btn-light bg-white border border-transparent rounded-md font-semibold text-xs text-dark uppercase tracking-widest hover:bg-violet-700 focus:bg-gray-700 active:bg-violet-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 flex  justify-center">
                        <img src="/social-media/search.png" style="height: 24px; margin-right: 15px;" alt="Google">
                        <span>Login with Google Account &ensp;&nbsp;</span>
                    </a>

                </form>
            </div>

            <div class="modal-footerx border-0 text-center w-100">
                <center> <small class="text-muted">Need help? <a href="#" class="text-dark">Contact
                            support</a></small></center>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="registerModalLabel">Create a Member Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">❌</button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name : <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter full name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address : <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter email address" value="{{ old('email') }}" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password : <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Create password" required>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password : <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirm password" required>
                    </div>

                    <!-- Terms & Policy -->
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="d-flex justify-content-between align-items-center mb-3 mx-0">
                            <div class="form-check px-2 pt-2">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms"
                                    required>
                                <label class="form-check-label text-sm" for="terms">
                                    I agree to the <a href="{{ route('terms.show') }}" target="_blank">Terms of
                                        Service</a> and <a href="{{ route('policy.show') }}" target="_blank">Privacy
                                        Policy</a>
                                </label>
                            </div>
                        </div>
                    @endif

                    <!-- Register Button -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn"
                            style="background-color: #70D614; color: #000; border-radius: 20px;">
                            <strong>Register</strong>
                        </button>
                    </div>
                </form>
            </div>

            <div class="modal-footerx border-0 text-center w-100">
                <center>
                    <small class="text-muted">
                        Already registered?
                        <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#loginModal"
                            data-bs-dismiss="modal">Login here</a>
                    </small>
                </center>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Invalid',
            text: '{{ session('error') }}',
            confirmButtonText: 'Try Again'
        });
    </script>
@endif


<style>
    .header-layout4 .menu-area {
        max-width: 1620px;
        display: block;
        margin: auto;
        color: #000 !important;
        background: rgba(31, 33, 36, 1);
        -webkit-backdrop-filter: blur(24.9px);
        backdrop-filter: blur(24.9px);
        border-radius: 50px;
        padding: 15px 23px 15px 30px;
    }
</style>
