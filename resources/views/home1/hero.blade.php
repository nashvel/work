<section id="hero" class="hero section light-background" style="background-image: url('/assets/img/stats-bg.jpg');">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-md-start"
                data-aos="fade-up">
                
                @php
                    $words = explode(' ', $hero->welcome_message);
                @endphp

                <h2>
                    <span style="font-size: 85px;" class="hero-title">
                        {{ $words[0] ?? '' }} {{ $words[1] ?? '' }}
                    {{ implode(' ', array_slice($words, 2)) }}
                    </span>
                </h2>


                <p style="letter-spacing: 2px;">{{ $hero->sub_message }}</p>
                <div class="d-flex mt-4 justify-content-center justify-content-md-start">
                    <a href="{{ $hero->get_started_link }}" class="cta-btn bg-warning"><i class="bi bi-person"></i> Get
                        Started</a>&ensp;
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
