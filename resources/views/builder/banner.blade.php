<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Integrity Outsourcing Services (IOS)</title>
    <meta name="description" content="Integrity Outsourcing Services (IOS)">
    <meta name="keywords" content="Integrity Outsourcing Services (IOS)">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="/assets//img/new.png" rel="icon">
    <link href="/assets//img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets//vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets//vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets//vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets//vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets//vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="/assets//css/main.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.botframework.com/botframework-webchat/latest/webchat.js"></script>
</head>

<body class="index-page">

    <span class="hidden" style="display: none;">
        @include('home.navbar')
    </span>

    <main class="main">
        <section id="hero" class="hero section light-background" style="background-image: url('/assets/img/stats-bg.jpg');">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-md-start"
                        data-aos="fade-up">
                        <h2>
                            <span style="font-size: 85px;" class="hero-title">
                                {{ explode(' ', $hero->welcome_message)[0] }}  <!-- First word "INTEGRITY" -->
                            </span> 
                            <br>
                            {{ implode(' ', array_slice(explode(' ', $hero->welcome_message), 1)) }}  <!-- Rest of the message -->
                        </h2>
                        
                        <p style="letter-spacing: 2px;">{{ $hero->sub_message }}</p>
                        <div class="d-flex mt-4 justify-content-center justify-content-md-start">
                            <a href="{{ $hero->get_started_link }}" target="_blank" class="cta-btn bg-warning"><i class="bi bi-person"></i> Get Started</a>&ensp;
                            <a href="{{ $hero->contact_us_link }}" style="border-color: #202020 !important;"
                                class="cta-btn bg-secondary text-white border-gray-200"><i class="bi bi-telephone"></i> Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                        <img src="/assets/img/hero-img.png" class="img-fluid animated" alt=""
                            style="
                                filter: drop-shadow(0px 0px 50px rgba(255, 255, 255, 0.9));
                                backdrop-filter: blur(2px);
                                border-radius: 15px;
                            ">
                    </div>
                </div>
            </div>
        
            <style>
                .hero-title {
                    text-align: center !important;
                    /* Optional for alignment */
                }
        
                .hero-title {
                    font-size: 85px !important;
                    /* Default size for larger screens */
                }
        
                @media screen and (max-width: 768px) {
        
                    /* For smaller screens (tablets and below) */
                    .hero-title {
                        font-size: 45px !important;
                        /* Adjust the size for smaller screens */
                    }
                }
        
                @media screen and (max-width: 480px) {
        
                    /* For very small screens (mobile devices) */
                    .hero-title {
                        font-size: 30px !important;
                        /* Further adjustment for mobile */
                    }
                }
            </style>
        
        
        </section>
    </main>


    <!-- Scroll Top -->
    <a href="#" id="scroll-top"
        style="display: none; background-color: transparent; color: transparent; opacity: 0"
        class="scroll-top xd-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <!-- Vendor JS Files -->
    <script src="/assets//vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets//vendor/php-email-form/validate.js"></script>
    <script src="/assets//vendor/aos/aos.js"></script>
    <script src="/assets//vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/assets//vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/assets//vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="/assets//vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/assets//vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="/assets//js/main.js"></script>

</body>

</html>
