<section id="team" class="team section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p class="text-dark">Meet the people behind our success! Our dedicated and skilled professionals work
            passionately to deliver outstanding solutions and drive our vision forward.</p>
    </div><!-- End Section Title -->


    <div class="container">
        @php
            $galleryItems = App\Models\CMS_Teams::orderBy('img_column')->orderBy('img_row')->get();
        @endphp
        <div class="row gy-4">
            @for ($col = 1; $col <= 4; $col++)
                <div class="col-lg-3 col-md-6" >
                    @foreach ($galleryItems->where('img_column', $col)->sortBy('img_row') as $item)
                        <div class="member" style="max-height: 300px; margin: 20px">
                            <img src="{{ Storage::url($item->image_path) }}" class="img-fluid" alt="">
                            <div class="member-info" style="max-height: 300px">
                                <div class="member-info-content">
                                    <h4>{{ $item->name }}</h4>
                                    <span>{{ $item->designation }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>

    <div class="container">

        <div class="row gy-4">
            {{-- <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                @foreach (App\Models\TeamMemberContent::where('position_display', 'post_1')->get() as $rw)
                    <div class="member">
                        <img src="{{ Storage::url($rw->profile_picture) }}" class="img-fluid" alt="">
                        <div class="member-info">
                            <div class="member-info-content">
                                <h4>{{ $rw->name }}</h4>
                                <span>{{ $rw->position }}</span>
                                <div class="social">
                                    @if ($rw->social_media)
                                        <a href="{{ $rw->social_media }}"><i class="bi bi-twitter-x"></i></a>
                                    @endif

                                    @if ($rw->facebook)
                                        <a href="{{ $rw->facebook }}"><i class="bi bi-facebook"></i></a>
                                    @endif

                                    @if ($rw->instagram)
                                        <a href="{{ $rw->instagram }}"><i class="bi bi-instagram"></i></a>
                                    @endif

                                    @if ($rw->linkedin)
                                        <a href="{{ $rw->linkedin }}"><i class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}

            {{-- <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                @foreach (App\Models\TeamMemberContent::where('position_display', 'post_2')->get() as $rw)
                    <div class="member">
                        <img src="{{ Storage::url($rw->profile_picture) }}" class="img-fluid" alt="">
                        <div class="member-info">
                            <div class="member-info-content">
                                <h4>{{ $rw->name }}</h4>
                                <span>{{ $rw->position }}</span>
                                <div class="social">
                                    @if ($rw->social_media)
                                        <a href="{{ $rw->social_media }}"><i class="bi bi-twitter-x"></i></a>
                                    @endif

                                    @if ($rw->facebook)
                                        <a href="{{ $rw->facebook }}"><i class="bi bi-facebook"></i></a>
                                    @endif

                                    @if ($rw->instagram)
                                        <a href="{{ $rw->instagram }}"><i class="bi bi-instagram"></i></a>
                                    @endif

                                    @if ($rw->linkedin)
                                        <a href="{{ $rw->linkedin }}"><i class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                @foreach (App\Models\TeamMemberContent::where('position_display', 'post_4')->get() as $rw)
                    <div class="member">
                        <img src="{{ Storage::url($rw->profile_picture) }}" class="img-fluid" alt="">
                        <div class="member-info">
                            <div class="member-info-content">
                                <h4>{{ $rw->name }}</h4>
                                <span>{{ $rw->position }}</span>
                                <div class="social">
                                    @if ($rw->social_media)
                                        <a href="{{ $rw->social_media }}"><i class="bi bi-twitter-x"></i></a>
                                    @endif

                                    @if ($rw->facebook)
                                        <a href="{{ $rw->facebook }}"><i class="bi bi-facebook"></i></a>
                                    @endif

                                    @if ($rw->instagram)
                                        <a href="{{ $rw->instagram }}"><i class="bi bi-instagram"></i></a>
                                    @endif

                                    @if ($rw->linkedin)
                                        <a href="{{ $rw->linkedin }}"><i class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                @foreach (App\Models\TeamMemberContent::where('position_display', 'post_3')->get() as $rw)
                    <div class="member">
                        <img src="{{ Storage::url($rw->profile_picture) }}" class="img-fluid" alt="">
                        <div class="member-info">
                            <div class="member-info-content">
                                <h4>{{ $rw->name }}</h4>
                                <span>{{ $rw->position }}</span>
                                <div class="social">
                                    @if ($rw->social_media)
                                        <a href="{{ $rw->social_media }}"><i class="bi bi-twitter-x"></i></a>
                                    @endif

                                    @if ($rw->facebook)
                                        <a href="{{ $rw->facebook }}"><i class="bi bi-facebook"></i></a>
                                    @endif

                                    @if ($rw->instagram)
                                        <a href="{{ $rw->instagram }}"><i class="bi bi-instagram"></i></a>
                                    @endif

                                    @if ($rw->linkedin)
                                        <a href="{{ $rw->linkedin }}"><i class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}



            {{-- <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="member">
                    <img src="./assets/img/user.webp" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>Sarah Jhonson</h4>
                            <span>Product Manager</span>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                    <img src="./assets/img/user.webp" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>William Anderson</h4>
                            <span>CTO</span>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Team Member -->

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="member">
                    <img src="./assets/img/team/462650716_1071092074671702_5207882722915897446_n.png" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>Team Meeting</h4>
                            <span>Accountant</span>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Team Member --> --}}

        </div>

    </div>

</section>
