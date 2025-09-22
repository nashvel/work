<div id="hs-extralarge-modal" class="hs-overlay hidden ti-modal">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
        <div class="ti-modal-content">
            <div class="ti-modal-header">
                <h6 class="ti-modal-title">Modal Title</h6>
                <button type="button" class="ti-modal-close-btn" data-hs-overlay="#hs-extralarge-modal">
                    <span class="sr-only">Close</span>
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="ti-modal-body">
                <i class="bi bi-info-circle px-1"></i> You can manage the client information here.
                <hr class="mb-3 mt-3">
                @include('pages.projects.partials.bidders')
            </div>
        </div>
    </div>
</div>
