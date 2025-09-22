    <section class="team-sec bg-smoke2 space">
        <div class="container z-index-common">
            <div class="title-area text-center">
                <span class="sub-title sub-title5">Expert Team</span>
                <h2 class="sec-title">Meet Our Expert Team Member</h2>
            </div>

            <div class="slider-area">
                <div class="swiper th-slider has-shadow" id="teamSlider1"
                    data-slider-options='{"loop":true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1300":{"slidesPerView":"4"}}}'>
                    <div class="swiper-wrapper">

                        @php
                            $galleryItems = App\Models\CMS_Teams::orderBy('img_column')->orderBy('id', 'DESC')->get();
                        @endphp
                        @foreach ($galleryItems as $item)
                            <!-- Single Item -->
                            <div class="swiper-slide h-100">
                                <div class="th-team team-card d-flex flex-column h-100"
                                    style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                                    <div class="box-img" >
                                        <img src="{{ Storage::url($item->image_path) }}"
                                            onerror="this.src = '/storage/cms/teams/images/y6qGc4tcfY7C6WOQMKXB1DC9stgjg5zDu0pj2i2Z.jpg'" alt="Team"
                                            style="">
                                    </div>
                                    <div
                                        class="box-content d-flex flex-column justify-content-between text-center p-3 bg-white flex-grow-1">
                                        <div>
                                            <h4 class="box-title mb-1 text-md"><a
                                                    href="#">{{ $item->name }}</a></h4>
                                            <span class="team-design text-sm text-muted">{{ $item->designation }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button data-slider-prev="#teamSlider1" class="slider-arrow slider-prev"><i
                        class="far fa-arrow-left"></i></button>
                <button data-slider-next="#teamSlider1" class="slider-arrow slider-next"><i
                        class="far fa-arrow-right"></i></button>
            </div>
        </div>
    </section>
