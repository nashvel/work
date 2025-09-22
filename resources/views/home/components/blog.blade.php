<section class="blog-area overflow-hidden bg-white space-extra2" id="blog-sec">
    <div class="container">
        <div class="title-area text-center">
            <span class="sub-title sub-title2">News & Updates</span>
            <h2 class="sec-title">Latest News, Advisories & Community Stories</h2>
        </div>

        <div class="row gy-4">
            <!-- Repeat this block for each post (up to 6 total) -->

            {{-- @foreach (App\Models\postModel::latest()->get() as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-box h-100">
                        <div class="blog-img">
                            <a href="/blog/{{ $blog->post_id }}/{{ Str::slug($blog->post_title) }}">
                                <img src="{{ asset($blog->post_thumbnail) }}" alt="{{ $blog->post_title }}">
                            </a>
                        </div>
                        <div class="box-content">
                            <div class="blog-meta">
                                <a href="/blog/{{ $blog->post_id }}/{{ Str::slug($blog->post_title) }}"><i
                                        class="far fa-calendar"></i>{{ date_format($blog->created_at, 'd M, Y') }}</a>
                                <a href="/blog/{{ $blog->post_id }}/{{ Str::slug($blog->post_title) }}"><i
                                        class="fa-regular fa-clock"></i>{{ $blog->created_at->diffForHumans() }}</a>
                            </div>
                            <h3 class="box-title">
                                <a
                                    href="/blog/{{ $blog->post_id }}/{{ Str::slug($blog->post_title) }}">{{ $blog->post_title }}</a>
                            </h3>
                            <a href="/blog/{{ $blog->post_id }}/{{ Str::slug($blog->post_title) }}"
                                class="line-btn">Read Details<i class="fa-solid fa-angles-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach --}}



            {{-- <div class="col-md-6 col-lg-4">
                <div class="blog-box h-100">
                    <div class="blog-img">
                        <img src="/assets/home/img/blog/506029100_1127230446112195_4867283996211253057_n.jpg" alt="blog image">
                    </div>
                    <div class="box-content">
                        <div class="blog-meta">
                            <a href="#"><i class="far fa-calendar"></i>20 Aug, 2025</a>
                            <a href="#"><i class="fa-regular fa-clock"></i>2 min read</a>
                        </div>
                        <h3 class="box-title">
                            <a href="#">[POWER ADVISORY]: EMERGENCY POWER INTERRUPTION</a>
                        </h3>
                        <a href="#" class="line-btn">Read Details<i class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="blog-box h-100">
                    <div class="blog-img">
                        <img src="/assets/home/img/blog/Slide1.png" alt="blog image">
                    </div>
                    <div class="box-content">
                        <div class="blog-meta">
                            <a href="#"><i class="far fa-calendar"></i>10 Aug, 2025</a>
                            <a href="#"><i class="fa-regular fa-clock"></i>2 min read</a>
                        </div>
                        <h3 class="box-title">
                            <a href="#">[RATES]: Electricity Rates Update April 2023</a>
                        </h3>
                        <a href="#" class="line-btn">Read Details<i class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="blog-box h-100">
                    <div class="blog-img">
                        <img src="/assets/home/img/blog/District-III-Talacogon-and-San-Luis-440x264.jpg" alt="blog image">
                    </div>
                    <div class="box-content">
                        <div class="blog-meta">
                            <a href="#"><i class="far fa-calendar"></i>15 Aug, 2025</a>
                            <a href="#"><i class="fa-regular fa-clock"></i>3 min read</a>
                        </div>
                        <h3 class="box-title">
                            <a href="#">District III – Talacogon & San Luis Election for Board of Director</a>
                        </h3>
                        <a href="#" class="line-btn">Read Details<i class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="blog-box h-100">
                    <div class="blog-img">
                        <img src="/assets/home/img/blog/District-VIII-scaled.jpg" alt="blog image">
                    </div>
                    <div class="box-content">
                        <div class="blog-meta">
                            <a href="#"><i class="far fa-calendar"></i>18 Aug, 2025</a>
                            <a href="#"><i class="fa-regular fa-clock"></i>4 min read</a>
                        </div>
                        <h3 class="box-title">
                            <a href="#">District VIII – San Francisco Election for Board of Director</a>
                        </h3>
                        <a href="#" class="line-btn">Read Details<i class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="blog-box h-100">
                    <div class="blog-img">
                        <img src="/assets/home/img/blog/Qualifications-and-Disqualifications-1170x640.jpg" alt="blog image">
                    </div>
                    <div class="box-content">
                        <div class="blog-meta">
                            <a href="#"><i class="far fa-calendar"></i>20 Aug, 2025</a>
                            <a href="#"><i class="fa-regular fa-clock"></i>2 min read</a>
                        </div>
                        <h3 class="box-title">
                            <a href="#">QUALIFICATIONS OF A BOARD OF DIRECTOR AND AN OFFICER</a>
                        </h3>
                        <a href="#" class="line-btn">Read Details<i class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            </div> --}}
            <!-- Add up to 6 total cards -->
        </div>
    </div>
</section>


<style>
    .blog-box {
        display: flex;
        flex-direction: column;
        height: 100%;
        background: #fff;
        border: 1px solid #eee;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* Fix height for image section */
    .blog-img {
        height: 200px;
        overflow: hidden;
    }

    .blog-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensures image fills without distortion */
        display: block;
    }

    .box-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
    }

    .box-title {
        flex-grow: 1;
        margin-bottom: 20px;
    }
</style>
