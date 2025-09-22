<section id="about" class="about section">

    <div class="container">

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

    </div>

</section>