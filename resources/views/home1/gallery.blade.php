<section id="gallery" class="gallery section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p>
            Explore moments that define us! Our gallery showcases the milestones, events, and achievements that
            highlight our journey and commitment to excellence.
        </p>
    </div>

    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
        @php
            $galleryItems = App\Models\CMS_Gallery::orderBy('img_column')->orderBy('img_row')->get();
        @endphp
        <div class="row g-0">
            @for ($col = 1; $col <= 4; $col++)
                <div class="col-lg-3 col-md-4">
                    @foreach ($galleryItems->where('img_column', $col)->sortBy('img_row') as $item)
                        <div class="gallery-item">
                            <a href="{{ Storage::url($item->image_path) }}" class="glightbox"
                                data-gallery="images-gallery">
                                <img src="{{ Storage::url($item->image_path) }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>

</section>
