<section id="clients" class="clients section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Our Clients</h2>
            <p>
                We serve diverse industries, providing tailored virtual outsourcing and real-time reporting
                solutions to enhance efficiency and reduce costs, empowering businesses to thrive.
            </p>
        </div>

        <div class="row g-0 clients-wrap">
            @php
                $clients = App\Models\ContentsClient::get();
            @endphp

            @foreach ($clients as $client)
                <div class="col-xl-3 col-md-4 client-logo ">
                    <a class="openVideoModal position-relative d-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#videoModal"
                        data-video="{{ asset('storage/' . $client->video_ads) }}">

                        <!-- Client Logo -->
                        <img src="{{ asset('storage/' . $client->image_path) }}" 
                            style="padding: 0px; padding-top: 15px; padding-bottom: 15px" class="img-fluid !p-0"
                            alt="Client Logo">

                        <!-- Play Button Overlay (Hidden Initially) -->
                        <div class="play-button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="50px"
                                height="50px">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>

                    </a>
                    {{-- @if (!empty($client->ads_video_link))
                        <a class="openVideoModal position-relative d-flex align-items-center justify-content-center"
                            data-bs-toggle="modal" data-bs-target="#videoModal"
                            data-video="{{ asset($client->ads_video_link) }}">

                            <!-- Client Logo -->
                            <img src="{{ asset('storage/' . $client->client_logo) }}" style="padding: 0px; padding-top: 15px; padding-bottom: 15px" class="img-fluid !p-0"
                                alt="Client Logo">

                            <!-- Play Button Overlay (Hidden Initially) -->
                            <div class="play-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"
                                    width="50px" height="50px">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>

                        </a>
                    @else
                        <img src="{{ asset('storage/' . $client->client_logo) }}" class="img-fluid" alt="Client Logo">
                    @endif --}}
                </div>
            @endforeach
        </div>
    </div>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Watch Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <video id="videoPlayer" width="100%" controls>
                        <source src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ Play Button & Layout Styles -->
    <style>
        .client-logo {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .client-logo img {
            display: block;
            transition: transform 0.3s ease-in-out;
        }

        /* Make the image full on hover */
        .client-logo:hover img {
            transform: scale(1.1);
            /* Slight zoom effect */
        }

        /* Play Button Overlay - Initially Hidden */
        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #FFC006;
            /* Play button color */
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            z-index: 10;
            cursor: pointer;
            /* Ensure it's above the image */
        }

        /* Show play button on hover */
        .client-logo:hover .play-button {
            opacity: 1;
        }

        .play-button svg {
            width: 40px;
            height: 40px;
            fill: white;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var videoModal = document.getElementById('videoModal');
            var videoPlayer = document.getElementById('videoPlayer');
            var videoSource = videoPlayer.querySelector("source");

            // Handle video play when clicking an open button
            document.querySelectorAll(".openVideoModal").forEach(button => {
                button.addEventListener("click", function() {
                    var videoUrl = this.getAttribute("data-video");

                    if (videoUrl) {
                        videoSource.src = videoUrl;
                        videoPlayer.load();
                        videoPlayer.play();
                    }

                    // Update modal title if needed
                    document.getElementById("videoModalLabel").innerText = "Now Playing";
                });
            });

            // Stop video when modal closes
            videoModal.addEventListener('hidden.bs.modal', function() {
                videoPlayer.pause();
                videoPlayer.currentTime = 0;
            });
        });
    </script>
</section>
