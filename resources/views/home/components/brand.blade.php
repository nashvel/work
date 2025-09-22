{{-- <div class="brand-sec2 space" data-mask-src="/assets/home/img/bg/blog_bg_1.png">
    <div class="container">
        <div class="title-area mb-60 text-center">
            <h3 class="brand-title">Trusted by thousand of customers.</h3>
        </div>
        <div class="slider-area text-center">
            <div class="swiper th-slider brand-slider2" id="brandSlider2"
                data-slider-options='{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"5"},"1400":{"slidesPerView":"6"}}}'>
                <div class="swiper-wrapper">
                    @php
                        $clients = App\Models\ContentsClient::get();
                    @endphp

                    @foreach ($clients as $client)
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img src="{{ asset('storage/' . $client->image_path) }}" alt="Brand Logo"
                                    style=" max-height: 100px;">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="brand-sec6 bg-smoke2 overflow-hidden space bg-white" data-bg-src="assets/img/bg/brand_bg_2.png">
    <div class="container">
        <div class="title-area mb-60 text-center">
            <span class="sub-title sub-title5">Trusted Partners</span>
            <h3 class="mt-n1">Backed by Forward-Thinking Businesses</h3>
            <p class="brand-text">
                Hill Business Consulting Services is trusted by entrepreneurs, agencies, and operations teams across industries to deliver reliable virtual support, admin automation, and scalable solutions.
            </p>
        </div>

        <div class="slider-area text-center">
            <div class="swiper th-slider brandSlider6" id="brandSlider6"
                data-slider-options='{
                    "grid": { "rows": 2, "fill": "row" },
                    "breakpoints": {
                        "0": { "slidesPerView": 1 },
                        "576": { "slidesPerView": 2 },
                        "768": { "slidesPerView": 3 },
                        "992": { "slidesPerView": 3 },
                        "1200": { "slidesPerView": 4 },
                        "1400": { "slidesPerView": 6 }
                    }
                }'>
                <div class="swiper-wrapper">
                    <!-- Repeatable Partner Logos -->
                      @php
                        $clients = App\Models\ContentsClient::get();
                    @endphp

                    @foreach ($clients as $client)
                    <div class="swiper-slide">
                        <a href="about.html" class="brand-box3">
                            <img src="{{ asset('storage/' . $client->image_path) }}" style=" max-height: 100px;" alt="Partner Logo">
                        </a>
                    </div>
                     @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
