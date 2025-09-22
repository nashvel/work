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
        <section id="about" class="about section p-1  m-0">
                <div class="row gy-4">
        
                    <div class="col-lg-6 position-relative" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('storage/'. $about->banner_link) }}" class="img-fluid" alt="">
                        <a href="{{ asset('storage/'. $about->video_link) }}" class="glightbox pulsating-play-btn"></a>
                    </div>
        
                    <div class="col-lg-6 ps-lg-4 content d-flex flex-column justify-content-center aos-init aos-animate"
                        data-aos="fade-up" data-aos-delay="200">
                        <h3>About Us</h3>
                        <p>
                            {{ $about->description }}
                        </p>
        
                        <h4> {{ $about->sub_header }}</h4>
                        <ul>
                            <li>
                                <i class="bi bi-clock icon"></i>
                                <div>
                                    <h5>{{ $about->sub_title_1 }}</h5>
                                    <p>
                                        {{ $about->sub_title_description_1 }}
                                    </p>
                                </div>
                            </li>
                            <li>
                                <i class="bi bi-person-check icon"></i>
                                <div>
                                    <h5>{{ $about->sub_title_2 }}</h5>
                                    <p>
                                        {{ $about->sub_title_description_2 }}
                                    </p>
                                </div>
                            </li>
                            <li>
                                <i class="bi bi-file-earmark-check icon"></i>
                                <div>
                                    <h5>{{ $about->sub_title_3 }}</h5>
                                    <p>
                                        {{ $about->sub_title_description_3 }}
                                    </p>
                                </div>
                            </li>
                            <li>
                                <i class="bi bi-alarm icon"></i>
                                <div>
                                    <h5>{{ $about->sub_title_4 }}</h5>
                                    <p>
                                        {{ $about->sub_title_description_4 }}
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
        
                </div>
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
