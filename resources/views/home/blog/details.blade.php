<section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-lg-7">
                <div class="th-blog blog-single bg-white">
                    <div class="blog-img">
                        <img src="{{ asset($blog->post_thumbnail) }}" alt="{{ $blog->post_title }}">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <a href="#"><i
                                    class="fa-regular fa-calendar"></i>{{ date_format($blog->created_at, 'd M, Y') }}</a>
                            <a href="#"><i
                                    class="fa-regular fa-clock"></i>{{ $blog->created_at->diffForHumans() }}</a>
                        </div>
                        <h2 class="blog-title pb-0 mb-0">{{ $blog->post_title }}</h2>

                        <link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
                        <link rel="stylesheet" href="/assets/libs/quill/quill.bubble.css">
                        <script src="/assets/libs/quill/quill.js"></script>

                        <div class="prose custom-description" style="border: none !important; width: 100% !important;">
                            <div id="blog-description" style="font-family: 'DM Sans', sans-serif !important">
                                {!! $blog->post_content !!}</div>
                            <script>
                                const quill = new Quill(`#blog-description`, {
                                    theme: "snow",
                                    readOnly: true, // disables editing
                                    modules: {
                                        toolbar: false // disables (hides) the ribbon
                                    }
                                });
                            </script>
                        </div>


                        <style>
                            .ql-container.ql-snow.ql-disabled {
                                border: none !important;
                                width: 100% !important;
                                padding: 0 !important;
                                background: transparent !important;
                                font-family: 'DM Sans', sans-serif !important
                            }

                            .ql-editor {
                                padding: 0 !important;
                                font-family: 'DM Sans', sans-serif !important;
                                margin: 0 0 18px 0 !important;
                                color: #5C6574 !important;
                                line-height: 1.75 !important;
                                font-size: 16px !important;
                            }

                            #blog-description img {
                                border-radius: 20px;
                                margin-top: 20px;
                                margin-bottom: 20px;
                            }

                            #blog-description h1,
                            #blog-description h2,
                            #blog-description h3 {
                                font-family: 'DM Sans', sans-serif !important;
                                margin-top: 20px;
                                margin-bottom: 20px;
                            }

                            #blog-description p {
                                padding: 0 !important;
                                font-family: 'DM Sans', sans-serif !important;
                                color: #3c424b !important;
                                line-height: 1.75 !important;
                                font-size: 16px !important;
                                margin-top: 20px !important;
                                margin-bottom: 20px !important;
                            }

                            #blog-description ul,
                            #blog-description li {
                                font-family: 'DM Sans', sans-serif !important;
                                color: #3c424b !important;
                                margin-top: 20px !important;
                                margin-bottom: 20px !important;
                            }
                        </style>
                        <br>

                    </div>
                    <div class="share-links clearfix ">
                        <div class="row justify-content-between">
                            <div class="col-sm-auto text-xl-end">
                                <span class="share-links-title">Share:</span>
                                <ul class="social-links">
                                    <li><a href="https://facebook.com/" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://twitter.com/" target="_blank"><i
                                                class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://linkedin.com/" target="_blank"><i
                                                class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="https://instagram.com/" target="_blank"><i
                                                class="fab fa-instagram"></i></a></li>
                                </ul><!-- End Social Share -->
                            </div><!-- Share Links Area end -->
                        </div>
                    </div>
                </div>
                <div class="th-comment-form  bg-white">
                    <div class="form-title mb-25">
                        <h3 class="blog-inner-title">Leave a Reply</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" placeholder="Your Name*" class="form-control">
                            <i class="fal fa-user"></i>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" placeholder="Your Email*" class="form-control">
                            <i class="fal fa-envelope"></i>
                        </div>
                        <div class="col-12 form-group">
                            <input type="text" placeholder="Website" class="form-control">
                            <i class="fal fa-globe"></i>
                        </div>
                        <div class="col-12 form-group">
                            <textarea placeholder="Write a Comment*" class="form-control"></textarea>
                            <i class="fal fa-pencil"></i>
                        </div>
                        <div class="col-12 form-group mb-0">
                            <button class="th-btn btn-fw">Submit Comment</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-5">
                <aside class="sidebar-area">
                    <div class="widget widget_search  bg-white  ">
                        <form class="search-form">
                            <input type="text" placeholder="Enter Keyword">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>
                    <div class="widget  bg-white ">
                        <h3 class="widget_title">Recent Posts</h3>
                        <div class="recent-post-wrap">
                            @foreach (App\Models\postModel::where('post_id', '<>', $id)->latest()->limit(3)->get() as $blog)
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="blog-details.html"><img src="{{ asset($blog->post_thumbnail) }}" alt="{{ $blog->post_title }}"></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title"><a class="text-inherit" href="blog-details.html">
                                        {{ $blog->post_title }}    
                                        </a></h4>
                                        <div class="recent-post-meta">
                                            <a href="blog.html">{{ date_format($blog->created_at, 'd M, Y') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="recent-post">
                                <div class="media-img">
                                    <a href="blog-details.html"><img src="assets/img/blog/recent-post-1-2.jpg"
                                            alt="Blog Image"></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="post-title"><a class="text-inherit" href="blog-details.html">The
                                            Benefits
                                            of Managed IT Services post could</a></h4>
                                    <div class="recent-post-meta">
                                        <a href="blog.html">22 July, 2025</a>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-post">
                                <div class="media-img">
                                    <a href="blog-details.html"><img src="assets/img/blog/recent-post-1-3.jpg"
                                            alt="Blog Image"></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="post-title"><a class="text-inherit" href="blog-details.html">The
                                            Benefits of Managed IT Services post could</a></h4>
                                    <div class="recent-post-meta">
                                        <a href="blog.html">23 July, 2025</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
