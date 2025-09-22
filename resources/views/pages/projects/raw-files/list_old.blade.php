<x-app-layout>

    <x-slot name="title">Construction Bidding</x-slot>
    <x-slot name="active">List of Bidding</x-slot>
    <x-slot name="buttons">
        @if (Auth::user()->role == 'Client')
            <a href="/bid/new" class="ti-btn ti-btn-primary !border-0 btn-wave me-0" data-hs-overlay="#modal_default">
                <i class="bi bi-plus me-1"></i> New Bidding
            </a>
        @endif
    </x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        @foreach (App\Models\Project::get() as $data)

            @php
                $bid = App\Models\Bid::where('user_id', Auth::user()->id)
                    ->where('project_id', $data->id)
                    ->count();

                $prospec_bid = App\Models\Bid::where('project_id', $data->id)->count();

                $building_types = [
                    'Residential Buildings' => [
                        'Single-family Home',
                        'Apartment Building',
                        'Condominium',
                        'Townhouse',
                        'Duplex/Triplex',
                        'Mobile Home',
                    ],
                    'Commercial Buildings' => [
                        'Office Building',
                        'Retail Store',
                        'Shopping Mall',
                        'Restaurant/Café',
                        'Hotel/Resort',
                        'Mixed-Use Building',
                    ],
                    'Industrial Buildings' => [
                        'Factory/Manufacturing Plant',
                        'Warehouse/Storage Facility',
                        'Data Center',
                        'Distribution Center',
                    ],
                    'Institutional Buildings' => [
                        'School/University',
                        'Hospital/Clinic',
                        'Church/Mosque/Temple',
                        'Library',
                        'Government Building',
                    ],
                    'Recreational & Cultural Buildings' => [
                        'Theater/Cinema',
                        'Stadium/Sports Complex',
                        'Museum/Exhibition Hall',
                        'Convention Center',
                    ],
                    'Special Purpose Buildings' => [
                        'Skyscraper',
                        'Airport Terminal',
                        'Train/Bus Station',
                        'Parking Garage',
                        'Lighthouse',
                    ],
                ];

                $search_value = $data->building_type;
                $category_name = 'Unknown'; // Default if not found

                foreach ($building_types as $category => $buildings) {
                    if (in_array($search_value, $buildings)) {
                        $category_name = $category;
                        break; // Stop the loop once found
                    }
                }

            @endphp
            @if ($bid == 0)
                <div class="xxl:col-span-3 xl:col-span-4 md:col-span-6 col-span-12">
                    <div class="box overflow-hidden">
                        <div class="mb-0 text-white bg-warning nft-auction-time">
                            <div id="countdown-{{ $data->id }}" class="font-semibold text-md countdown-timer"
                                data-start-date="{{ date('Y-m-d H:i:s', strtotime($data->start_date)) }}"
                                data-end-date="{{ date('Y-m-d H:i:s', strtotime($data->end_date)) }}">
                            </div>
                        </div>
                        <div class="relative">
                            <img src="{{ asset('storage/' . $data->thumbnail) }}" class="card-img-top img-responsive"
                                alt="Thumbnail">
                            <style>
                                .img-responsive {
                                    width: 100%;
                                    /* Ensures it fits the container */
                                    min-height: 300px;
                                    /* Limits height to prevent oversized images */
                                    object-fit: cover;
                                    /* Ensures image fills the space properly */
                                    transition: transform 0.3s ease-in-out;
                                    /* Smooth zoom effect */
                                }
                            </style>
                            <span class="badge nft-like-badge text-white">
                                <i class="ri-heart-fill me-1 text-danger align-middle inline-block"></i>
                                {{ $category_name }}
                            </span>
                        </div>
                        <div class="box-body nft-body">
                            <p class="text-[15px] mb-2 font-semibold">{{ $data->name }}</p>
                            <div class="flex mb-3 items-center flex-wrap gap-2">
                                <div class="flex-auto">
                                    <p class="mb-0 text-xs font-medium">
                                        
                                        <hr class=" mb-2">
                                        <span class="text-textmuted dark:text-textmuted/50">
                                            <span class="text-dark">Building Status : </span>
                                            <span class="badge bg-{{ $data->building_status == 'Private' ? 'info' : 'primary' }}/10 
                                                text-{{ $data->building_status == 'Private' ? 'info' : 'primary' }}">
                                                <b >{{ $data->building_status }}</b>
                                            </span>
                                        </span><br>
                                        <span class="text-textmuted dark:text-textmuted/50">
                                            <span class="text-dark">Building Type : </span>
                                            <b class="text-dark">{{ $data->building_type }}</b>
                                        </span>
                                        <hr class="mt-2 mb-2">
                                        <span class="text-dark"> Date Start :</span>
                                        <b class="text-dark">{{ date_format(date_create($data->start_date), 'D, F d, Y h:i A') }}</b>
                                        <br>
                                        <span class="text-dark"> Date End :</span>                                       
                                        <b class="text-dark">{{ date_format(date_create($data->end_date), 'D, F d, Y h:i A') }}</b><br>
                                        
                                    </p>
                                    <hr class="mt-2">
                                </div>
                            </div>
                            <div class="flex justify-between items-center mb-3">
                                <p class="mb-0">Current Prospective Bidder :</p>
                                <h6 class="font-semibold mb-0 bid-amt align-middle flex items-center gap-2">
                                    {{ number_format($prospec_bid, 0) }} <i class="bi bi-people-fill"></i>
                                    {{-- @if (Auth::user()->role == 'Client')
                                        {{ number_format($prospec_bid, 0) }} <i class="bi bi-people-fill"></i>
                                    @else
                                        {{ number_format($bid, 0) }} <i class="bi bi-people-fill"></i>
                                    @endif --}}
                                </h6>

                            </div>

                            <hr class="mb-2">

                            <div class="grid">
                                @if (Auth::user()->role == 'Client')
                                    {{-- <a href="/bid/details/{{ $data->id }}"
                                        class="ti-btn bg-light text-dark mb-md-0 mb-0">View
                                        Details</a> --}}
                                    <a href="/bid/details/{{ $data->id }}"
                                        class="ti-btn bg-light text-dark mb-md-0 mb-0">
                                        Prospective Bidder
                                        @if ($prospec_bid != 0)
                                            <span
                                                class=" translate-middle  badge !rounded-full bg-danger">{{ number_format($prospec_bid, 0) }}
                                            </span>
                                        @endif
                                    </a>
                                @else
                                    <form id="bid-form" data-project-id="{{ $data->id }}">
                                        @csrf
                                        <center>
                                            <a href="/bid/details/{{ $data->id }}"
                                                class="ti-btn ti-btn-sm bg-warning w-500 text-white mb-md-0 mb-0">
                                                <i class="bi bi-eye"></i>
                                                View More
                                            </a>
                                            <button type="button"
                                                class="ti-btn ti-btn-sm bg-info w-500 text-white mb-md-0 mb-0"
                                                onclick="bid({{ $data->id }})">
                                                <i class="bi bi-hand-index-thumb-fill"></i>
                                                Place Bid
                                            </button>
                                        </center>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function bid(id) {

                Swal.fire({
                    title: "Are you sure?",
                    text: "Once placed, you can cancel your bid at any time as long as it remains pending. However, once the bidding process is finalized or accepted, cancellation will no longer be possible. Please ensure your bid is accurate before confirming.",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#FB4242",
                    confirmButtonText: "Yes, Please Proceed!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/bids') }}/" + id, // URL to send request
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: "Submitted",
                                        text: "Your bid has been placed successfully!",
                                        icon: "success"
                                    });
                                    setInterval(() => {
                                        window.location.reload()
                                    }, 2000);

                                } else {
                                    Swal.fire("Error!", response.message, "error");
                                }
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                            }
                        });
                    }
                });
            }

            function cancel(id) {

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#FB4242",
                    confirmButtonText: "Yes, Cancel it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/bids-cancel') }}/" + id, // URL to send request
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: "Cancelled!",
                                        text: "Your bid has been cancelled.",
                                        icon: "success"
                                    });
                                    setInterval(() => {
                                        window.location.reload()
                                    }, 2000);

                                } else {
                                    Swal.fire("Error!", response.message, "error");
                                }
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                            }
                        });
                    }
                });
            }
        </script>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let countdowns = document.querySelectorAll(".countdown-timer");

            countdowns.forEach(function(countdownElement) {
                let startDateStr = countdownElement.getAttribute("data-start-date");
                let endDateStr = countdownElement.getAttribute("data-end-date");
                if (!startDateStr || !endDateStr) return; // Skip if no dates

                let startDate = new Date(startDateStr).getTime();
                let endDate = new Date(endDateStr).getTime();

                function updateCountdown() {
                    let now = new Date().getTime();

                    if (now < startDate) {
                        // Auction has not started yet
                        let timeLeft = startDate - now;
                        let days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                        let hours = Math.floor((timeLeft / (1000 * 60 * 60)) % 24);
                        let minutes = Math.floor((timeLeft / (1000 * 60)) % 60);
                        let seconds = Math.floor((timeLeft / 1000) % 60);

                        days = days.toString().padStart(2, '0');
                        hours = hours.toString().padStart(2, '0');
                        minutes = minutes.toString().padStart(2, '0');
                        seconds = seconds.toString().padStart(2, '0');

                        countdownElement.innerHTML =
                            `Starts in ${days}d : ${hours}hrs : ${minutes}m : ${seconds}s`;
                    } else if (now >= startDate && now < endDate) {
                        // Auction is running
                        let timeLeft = endDate - now;
                        let days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                        let hours = Math.floor((timeLeft / (1000 * 60 * 60)) % 24);
                        let minutes = Math.floor((timeLeft / (1000 * 60)) % 60);
                        let seconds = Math.floor((timeLeft / 1000) % 60);

                        days = days.toString().padStart(2, '');
                        hours = hours.toString().padStart(2, '0');
                        minutes = minutes.toString().padStart(2, '0');
                        seconds = seconds.toString().padStart(2, '0');

                        countdownElement.innerHTML = `${days}d : ${hours}hrs : ${minutes}m : ${seconds}s`;
                    } else {
                        // Auction has ended
                        countdownElement.innerHTML = "Bidding Expired!";
                        clearInterval(interval);
                    }
                }

                // Update countdown every second
                let interval = setInterval(updateCountdown, 1000);
                updateCountdown(); // Run once immediately
            });
        });
    </script>

    {{-- <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body">
                       
                    </div>
                </div>
            </div>
        </div>


        <div id="modal" class="hs-overlay hidden ti-modal">
            <div
                class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="max-h-full w-full overflow-hidden ti-modal-content">
                    <div class="ti-modal-header">
                        <h6 class="modal-title text-[1rem] font-semiboldmodal-title" id="modal-form-title"></h6>
                        <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#modal">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                    @include('pages.clients.forms.new_client')
                    <script>
                        document.getElementById('modal-form-title').innerHTML = 'New Client Registration';
                    </script>
                </div>
            </div>
        </div>

    </div> --}}
</x-app-layout>
