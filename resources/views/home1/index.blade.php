<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ config('app.name', 'Hill Business Consulting Services') }}</title>
    <meta name="Description"
        content="The history of Hill Business Consulting Services began with two business owners, Joe and Douglas, who both worked in the janitorial industry and were challenged by rising labor costs and the pressure these costs placed on profitability. Recognizing the need for a fresh approach, they sought a better solution. Drawing from Mr. Hill's extensive background in the high-tech industry, they introduced processes, methods, and technologies typically used by world-class Silicon Valley companies and applied these innovations to the janitorial sector. This innovative shift proved highly successful, demonstrating that advanced technology isn’t just for billion-dollar enterprises but can be effectively implemented at any scale when supported by experienced professionals. This laid the groundwork for outsourcing high-quality talent, utilizing internet technologies and software tools to provide cost-effective, top-notch support services. Today, IOS works closely with clients, ensuring they benefit from continuous advancements and the efficiencies of an ever-changing global market.">
    <meta name="Author" content="Hill Business Consulting Services">
    <meta name="keywords" content="iosbiz.com, iosbiz, Hill Business Consulting Services">
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

    @include('home1.navbar')

    <main class="main">

        <!-- Hero Section -->
        @include('home1.hero')
        <!-- /Hero Section -->

        <!-- About Section -->
        @include('home1.about')
        <!-- /About Section -->

        <!-- Stats Section -->
        @include('home1.stats')
        <!-- /Stats Section -->

        <!-- Clients Section -->
        @include('home1.client')
        <!-- /Clients Section -->

        <!-- Services Section -->
        @include('home1.services')
        <!-- /Services Section -->

        <!-- Portfolio Section -->
        @include('home1.portfolio')
        <!-- /Portfolio Section -->

        <!-- Testimonials Section -->
        @include('home1.testimonial')
        <!-- /Testimonials Section -->

        <!-- Team Section -->
        @include('home1.team')
        <!-- /Team Section -->

        <!-- Gallery Section -->
        @include('home1.gallery')
        <!-- /Gallery Section -->

        <!-- Contact Section -->
        @include('home1.contact')
        <!-- /Contact Section -->
        
        @include('home1.chat')
    </main>

    @include('home1.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top"
        style="display: none; background-color: transparent; color: transparent; opacity: 0"
        class="scroll-top xd-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>;

    <!-- Preloader -->
    <div id="preloader"></div>

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
