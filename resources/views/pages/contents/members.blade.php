<x-app-layout>
    <x-slot name="back"></x-slot>
    <x-slot name="header">{{ __('Manage Team Members') }}</x-slot>
    <x-slot name="subHeader">{{ __('You can manage your team member and view profile here.') }}</x-slot>
    <x-slot name="btn">
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                        class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt"><a href="#" data-bs-toggle="modal" data-bs-target="#form"
                                class="btn btn-primary"><em class="icon ni ni-user-add"></em><span>Add Team
                                    Member</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="row g-gs">
                    <hr>
                    <div class="col-md-12">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block">
                                    <div id="kanban" class="nk-kanban"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="/vendor/assets/js/libs/jkanban.js?ver=3.0.3"></script>

                    @foreach ($data as $rw)
                        {{-- <div class="col-sm-6 col-lg-3 col-xxl-3">

                            <div class="gallery card">
                                <a class="gallery-image popup-image" href="{{ Storage::url($rw->profile_picture) }}">
                                    <img class="w-100 rounded-top" src="{{ Storage::url($rw->profile_picture) }}"
                                        alt="">
                                </a>
                                <div class="gallery-body card-inner align-center justify-center flex-wrap g-2">
                                    <div class="user-card">
                                        <div class="user-infox">
                                            <center>
                                                <h6 class="fw-bold text-xl">{{ $rw->name }}</h6>
                                                <span class="sub-text text-center">{{ $rw->position }}</span>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="team container">
                                        <hr class="mb-2">
                                        <div class="team-view">
                                            <a href="html/user-details-regular.html"
                                                class="btn btn-block btn-dim btn-primary"><span>View Profile</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="form" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" on="" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title text-2xl fw-bold">Team Members</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('content.team_members.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Profile Picture -->
                        <div class="row  align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="profile_picture">Profile Picture <b
                                            class="text-danger">*</b></label>
                                    <span class="form-note">Upload the profile picture of the team member.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="file" class="form-control" id="profile_picture"
                                            name="profile_picture" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name <b class="text-danger">*</b></label>
                                    <span class="form-note">Enter the full name of the team member.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-info"></em>
                                        </div>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter team member's name" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="position">Position <b
                                            class="text-danger">*</b></label>
                                    <span class="form-note">Enter the position of the team member.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-info"></em>
                                        </div>
                                        <input type="text" class="form-control" id="position" name="position"
                                            placeholder="Enter team member's position" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Generic Social Media -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="social_media">X / Twitter Social Media</label>
                                    <span class="form-note">Enter a X social media link.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="url" class="form-control" id="social_media"
                                            name="social_media" placeholder="Enter generic social media URL">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Facebook -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="facebook">Facebook</label>
                                    <span class="form-note">Enter the Facebook profile link.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="url" class="form-control" id="facebook" name="facebook"
                                            placeholder="Enter Facebook profile URL">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="instagram">Instagram</label>
                                    <span class="form-note">Enter the Instagram profile link.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="url" class="form-control" id="instagram" name="instagram"
                                            placeholder="Enter Instagram profile URL">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- LinkedIn -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="linkedin">LinkedIn</label>
                                    <span class="form-note">Enter the LinkedIn profile link.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="url" class="form-control" id="linkedin" name="linkedin"
                                            placeholder="Enter LinkedIn profile URL">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="col-lg-12" style="float: right">
                            <hr class="mt-3 mb-2">
                        </div>
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7 justify-end" style="float: right">
                            <div class="form-group mt-2 mb-2 justify-end">
                                <button type="reset" class="btn btn-light bg-white mx-3">
                                    <em class="icon ni ni-repeat"></em>&ensp;Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <em class="icon ni ni-save"></em>&ensp;Submit Record
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        "use strict";

        ! function(NioApp, $) {
            "use strict";

            // Variable
            var $win = $(window),
                $body = $('body'),
                breaks = NioApp.Break;

            NioApp.Kanban = function() {
                function titletemplate(title, count) {
                    var optionicon = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "more-h";
                    return `
                    <div class="kanban-header" style="display: none;">
                        <h6>${title}</h6>
                        <span>${count} Tasks</span>
                    </div>
                `;
                }

                var kanban = new jKanban({
                    element: '#kanban',
                    gutter: '0',
                    widthBoard: '300px',
                    responsivePercentage: false,
                    boards: [{
                            'id': 'post_1',
                            'title': titletemplate("Open", "3"),
                            'class': 'kanban-light',
                            'item': [
                                @foreach (App\Models\TeamMemberContent::where('position_display', 'post_1')->get() as $rw)
                                    {
                                        'id': '{{ $rw->id }}',
                                        'title': `
                                        <div class="kanban-item" style="padding: 0 !important;" data-id="{{ $rw->id }}">
                                           <div class="kanban-item" style="position: relative;">
                                                <div class="kanban-item-title">
                                                    <div class="gallery">
                                                        <!-- Remove Button -->
                                                        <a href="#" 
                                                        onclick="confirmation({{ $rw->id }}, 'team')" 
                                                        class="btn btn-xs btn-danger" 
                                                        style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                                            <em class="icon ni ni-trash"></em>
                                                        </a>

                                                        <!-- Profile Image -->
                                                        <div class="gallery card">
                                                            <a class="gallery-image popup-image" href="{{ Storage::url($rw->profile_picture) }}">
                                                                <img class="w-100 rounded-top" src="{{ Storage::url($rw->profile_picture) }}" alt="Profile Picture">
                                                            </a>

                                                            <!-- Card Body -->
                                                            <div class="gallery-body card-inner align-center justify-center flex-wrap g-2">
                                                                <div class="user-card">
                                                                    <div class="user-infox">
                                                                        <center>
                                                                            <h6 class="fw-bold text-xl">{{ $rw->name }}</h6>
                                                                            <span class="sub-text text-center">{{ $rw->position }}</span>
                                                                        </center>
                                                                    </div>
                                                                </div>

                                                                <!-- Team Section -->
                                                                <div class="team container">
                                                                    <hr class="mb-2">
                                                                    <div class="team-view">
                                                                        <a href="html/user-details-regular.html" class="btn btn-block btn-dim btn-primary">
                                                                            <span>View Profile</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                `
                                    },
                                @endforeach
                            ]
                        },
                        {
                            'id': 'post_2',
                            'title': titletemplate("In Progress", "4"),
                            'class': 'kanban-primary',
                            'item': [
                                @foreach (App\Models\TeamMemberContent::where('position_display', 'post_2')->get() as $rw)
                                    {
                                        'id': '{{ $rw->id }}',
                                        'title': `
                                        <div class="kanban-item" style="padding: 0 !important;" data-id="{{ $rw->id }}">
                                           <div class="kanban-item" style="position: relative;">
                                                <div class="kanban-item-title">
                                                    <div class="gallery">
                                                        <!-- Remove Button -->
                                                        <a href="#" 
                                                        onclick="confirmation({{ $rw->id }}, 'team')" 
                                                        class="btn btn-xs btn-danger" 
                                                        style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                                            <em class="icon ni ni-trash"></em>
                                                        </a>

                                                        <!-- Profile Image -->
                                                        <div class="gallery card">
                                                            <a class="gallery-image popup-image" href="{{ Storage::url($rw->profile_picture) }}">
                                                                <img class="w-100 rounded-top" src="{{ Storage::url($rw->profile_picture) }}" alt="Profile Picture">
                                                            </a>

                                                            <!-- Card Body -->
                                                            <div class="gallery-body card-inner align-center justify-center flex-wrap g-2">
                                                                <div class="user-card">
                                                                    <div class="user-infox">
                                                                        <center>
                                                                            <h6 class="fw-bold text-xl">{{ $rw->name }}</h6>
                                                                            <span class="sub-text text-center">{{ $rw->position }}</span>
                                                                        </center>
                                                                    </div>
                                                                </div>

                                                                <!-- Team Section -->
                                                                <div class="team container">
                                                                    <hr class="mb-2">
                                                                    <div class="team-view">
                                                                        <a href="html/user-details-regular.html" class="btn btn-block btn-dim btn-primary">
                                                                            <span>View Profile</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                `
                                    },
                                @endforeach
                            ]
                        },
                        {
                            'id': 'post_3',
                            'title': titletemplate("To Review", "2"),
                            'class': 'kanban-warning',
                            'item': [
                                @foreach (App\Models\TeamMemberContent::where('position_display', 'post_3')->get() as $rw)
                                    {
                                        'id': '{{ $rw->id }}',
                                        'title': `
                                        <div class="kanban-item" style="padding: 0 !important;" data-id="{{ $rw->id }}">
                                           <div class="kanban-item" style="position: relative;">
                                               <div class="kanban-item-title" style="position: relative;">
                                                    <div class="gallery">
                                                        <!-- Remove Button -->
                                                        <a href="#" 
                                                        onclick="confirmation({{ $rw->id }}, 'team')" 
                                                        class="btn btn-xs btn-danger" 
                                                        style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                                            <em class="icon ni ni-trash"></em>
                                                        </a>

                                                        <!-- Profile Image -->
                                                        <div class="gallery card">
                                                            <a class="gallery-image popup-image" href="{{ Storage::url($rw->profile_picture) }}">
                                                                <img class="w-100 rounded-top" src="{{ Storage::url($rw->profile_picture) }}" alt="Profile Picture">
                                                            </a>

                                                            <!-- Card Body -->
                                                            <div class="gallery-body card-inner align-center justify-center flex-wrap g-2">
                                                                <div class="user-card">
                                                                    <div class="user-infox">
                                                                        <center>
                                                                            <h6 class="fw-bold text-xl">{{ $rw->name }}</h6>
                                                                            <span class="sub-text text-center">{{ $rw->position }}</span>
                                                                        </center>
                                                                    </div>
                                                                </div>

                                                                <!-- Team Section -->
                                                                <div class="team container">
                                                                    <hr class="mb-2">
                                                                    <div class="team-view">
                                                                        <a href="html/user-details-regular.html" class="btn btn-block btn-dim btn-primary">
                                                                            <span>View Profile</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                `
                                    },
                                @endforeach
                            ]
                        },
                        {
                            'id': 'post_4',
                            'title': titletemplate("Completed", "0"),
                            'class': 'kanban-success',
                            'item': [
                                @foreach (App\Models\TeamMemberContent::where('position_display', 'post_4')->get() as $rw)
                                    {
                                        'id': '{{ $rw->id }}',
                                        'title': `
                                        <div class="kanban-item" style="padding: 0 !important;" data-id="{{ $rw->id }}">
                                           <div class="kanban-item" style="position: relative;">
                                                <div class="kanban-item-title">
                                                    <div class="gallery">
                                                        <!-- Remove Button -->
                                                        <a href="#" 
                                                        onclick="confirmation({{ $rw->id }}, 'team')" 
                                                        class="btn btn-xs btn-danger" 
                                                        style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                                            <em class="icon ni ni-trash"></em>
                                                        </a>

                                                        <!-- Profile Image -->
                                                        <div class="gallery card">
                                                            <a class="gallery-image popup-image" href="{{ Storage::url($rw->profile_picture) }}">
                                                                <img class="w-100 rounded-top" src="{{ Storage::url($rw->profile_picture) }}" alt="Profile Picture">
                                                            </a>

                                                            <!-- Card Body -->
                                                            <div class="gallery-body card-inner align-center justify-center flex-wrap g-2">
                                                                <div class="user-card">
                                                                    <div class="user-infox">
                                                                        <center>
                                                                            <h6 class="fw-bold text-xl">{{ $rw->name }}</h6>
                                                                            <span class="sub-text text-center">{{ $rw->position }}</span>
                                                                        </center>
                                                                    </div>
                                                                </div>

                                                                <!-- Team Section -->
                                                                <div class="team container">
                                                                    <hr class="mb-2">
                                                                    <div class="team-view">
                                                                        <a href="html/user-details-regular.html" class="btn btn-block btn-dim btn-primary">
                                                                            <span>View Profile</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                `
                                    },
                                @endforeach
                            ]
                        }
                    ],
                    dragEl: function(el, source) {
                        // console.log('Dragged Element:', el); // Inspect the element structure
                        // console.log('Dragged ID:', el.dataset.eid); // Access `data-id` 

                        // const draggedElementId = el.dataset.eid; // Access `data-id` of the dragged element
                        // const sourceBoardId = source.parentElement.getAttribute(
                        //     'data-id'); // Get the board's ID

                        // console.log('Dragged Element ID:',
                        //     draggedElementId); // Log the ID of the dragged element
                        // console.log('Dragged From Section (Board ID):', sourceBoardId);

                    },
                    dropEl: function(el, target, source) {
                        // const droppedElementId = el.dataset.id; // Access `data-id` of the dropped element
                        // const sourceBoardId = source.parentElement.getAttribute(
                        //     'data-id'); // Get the source board's ID
                        const targetBoardId = target.parentElement.getAttribute(
                            'data-id'); // Get the target board's ID

                        // console.log('Dropped Element:', el); // Inspect the element structure
                        // console.log('Dropped ID:', droppedElementId); // Log the ID of the dropped element
                        // console.log('Dragged From Section (Board ID):',
                        //     sourceBoardId); // Log the source board ID
                        // console.log('Dropped To Section (Board ID):',
                        //     targetBoardId); // Log the target board ID

                        console.log(el.dataset.eid)
                        console.log(targetBoardId)

                        $.ajax({
                            url: "{{ route('content.team_members.update') }}",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}", // Include CSRF token if needed
                                'Authorization': 'Bearer XXXX', // Example: Include an authorization token
                                'Custom-Header': 'CustomHeaderValue' // Add any additional custom headers here
                            },
                            data: {
                                id: el.dataset.eid, // ID of the element being updated
                                position: targetBoardId // New position or board ID
                            },
                            success: function(response) {
                                //console.log(response);
                            },
                            error: function(xhr, status, error) {
                                //console.error('Error:', error);
                            }
                        });

                    }
                });

                // Add buttons to boards
                // for (var i = 0; i < kanban.options.boards.length; i++) {
                //     var board = kanban.findBoard(kanban.options.boards[i].id);
                //     $(board).find("footer").html(
                //         `<button class="kanban-add-task btn btn-block"><em class="icon ni ni-upload"></em><span>Upload Photo</span></button>`
                //     );
                // }
            };

            NioApp.coms.docReady.push(NioApp.Kanban);
        }(NioApp, jQuery);
    </script>

    <script>
        function confirmation(id, type) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('content.team_members.delete') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}", // Include CSRF token if needed
                            'Authorization': 'Bearer XXXX', // Example: Include an authorization token
                            'Custom-Header': 'CustomHeaderValue' // Add any additional custom headers here
                        },
                        data: {
                            id: id, // ID of the element being updated
                            type: type
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your record has been deleted.",
                                icon: "success"
                            });
                            setInterval(() => {
                                window.location.reload();
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            //console.error('Error:', error);
                        }
                    });

                }
            });
        }
    </script>

    <style>
        .kanban-item {
            padding: 0 !important;
        }

        .kanban-board-header {
            display: none;
        }

        .gallery-img {
            width: 100%;
            /* Adjust image width to fit its container */
            height: auto;
            /* Maintain aspect ratio */
            max-width: 300px;
            /* Set a maximum width for the image */
            max-height: 300px;
            /* Set a maximum height for the image */
            object-fit: contain;
            /* Ensure the image fits within the defined dimensions */
            transition: transform 0.3s ease-in-out;
            /* Smooth zoom effect */
        }

        .gallery-img:hover {
            transform: scale(1.1);
            /* Slight zoom-in effect on hover */
        }
    </style>
</x-app-layout>
