<section id="contact" class="contact section">
    <!-- Section Title -->
    <div class="container section-title aos-init aos-animate" data-aos="fade-up">
        <h2>Contact</h2>
        <p>
            Have questions or need assistance? Reach out to us! Fill out the form below, and our team will get
            back to you shortly. We’re here to help you achieve your business goals.
        </p>
    </div>
    <!-- End Section Title -->

    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
        <div class="mb-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">

            <iframe style="border: 0; width: 100%; height: 270px"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3386.943427203552!2d-121.2601074!3d38.5818758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x809ae7ff1ecdaab9%3A0xd53289fd1047b60f!2s11350%20Monier%20Park%20Pl%2C%20Rancho%20Cordova%2C%20CA%2095742%2C%20USA!5e1!3m2!1sen!2sph!4v1733152896042!5m2!1sen!2sph"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- End Google Maps -->

        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="row gy-4">

                    <div class="col-lg-4">
                        <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi icon icon-bg bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Address</h3>
                                <p>11350 Monier Park Pl. Rancho Cordova, CA 95742</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Info Item -->
                    <div class="col-lg-4">
                        <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi icon icon-bg bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>+18559134059</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Info Item -->
                    <div class="col-lg-4">
                        <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
                            <i class="bi icon icon-bg bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p><a href="mailto:integrity.outsourcing.services@gmail.com"
                                        class="text-dark">integrity.outsourcing.services@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Info Item -->
                </div>
            </div>
            <!-- Contact Form -->
            <div class="col-lg-12">
                <hr>
                <form id="contact-form" class="php-email-form aos-init aos-animate" data-aos="fade-up"
                    data-aos-delay="200">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <label class="fw-bold">Your Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold">Your Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                        </div>

                        <div class="col-md-12">
                            <label class="fw-bold">Subject</label>
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                        </div>

                        <div class="col-md-12">
                            <label class="fw-bold">Message</label>
                            <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="loading" style="display: none;">Loading...</div>
                            <div class="error-message text-white" style="display: none;"></div>
                            <div class="sent-message text-white" style="display: none;">
                                Your message has been sent. Thank you!
                            </div>

                            <button type="submit" class="btn"
                                style="background-color: gold !important; color: #000">
                                Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <!-- AJAX Script -->
            <script>
                document.querySelector('#contact-form').addEventListener('submit', function(e) {
                    e.preventDefault();

                    const form = this;
                    const formData = new FormData(form);
                    const loading = form.querySelector('.loading');
                    const successMsg = form.querySelector('.sent-message');
                    const errorMsg = form.querySelector('.error-message');

                    loading.style.display = 'block';
                    successMsg.style.display = 'none';
                    errorMsg.style.display = 'none';

                    fetch('{{ route('messages.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                            },
                            body: formData,
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Network error');
                            return response.json();
                        })
                        .then(data => {
                            loading.style.display = 'none';
                            if (data.success) {
                                successMsg.style.display = 'block';
                                errorMsg.style.display = 'none';
                                form.reset();
                            } else {
                                errorMsg.textContent = 'Something went wrong. Please try again.';
                                errorMsg.style.display = 'block';
                            }
                        })
                        .catch(error => {
                            loading.style.display = 'none';
                            errorMsg.textContent = 'An error occurred. Please try again.';
                            errorMsg.style.display = 'block';
                            console.error('Submission error:', error);
                        });
                });
            </script>

            <!-- End Contact Form -->
        </div>
    </div>
</section>
