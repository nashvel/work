<style>
    .media-preview {
        width: 100%;
        height: 180px;
        object-fit: contain;
        border-radius: 0.5rem;
        transition: transform 0.3s ease-in-out;
    }

    .group:hover .media-preview {
        transform: scale(1.02);
    }

    .hover-button {
        transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
    }

    .hover-button:hover {
        transform: scale(1.05);
    }

    .group:hover .group-hover\:opacity-100 {
        opacity: 1;
    }


    /* Column styling */
    .drag-column {
        border: 1px solid #d1d5db;
        padding: 0.5rem;
        min-height: 200px;
    }


    /* Each draggable item box */
    .draggable-item {
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1rem;
        background-color: #fff;
        margin-bottom: 1rem;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        overflow: visible;
        /* allow buttons to show */
        position: relative;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        gap: 0.75rem;
    }

    /* Logo image - full box */
    .draggable-item img {
        width: 100%;
        height: 180px;
        object-fit: contain;
        border-radius: 0.5rem;
        background: #ffffff;
    }

    /* Video file input */
    .video-upload-input {
        border: 1px solid #d1d5db;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background-color: #ffffff;
        font-size: 0.875rem;
        width: 100%;
        transition: border-color 0.2s ease-in-out;
    }

    .video-upload-input:focus {
        border-color: #3b82f6;
        outline: none;
    }

    /* Company name input with icon */
    .company-name-input {
        padding: 0.5rem 0.75rem 0.5rem 2.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        width: 100%;
        font-size: 0.875rem;
        background-color: #ffffff;
        transition: border-color 0.2s ease-in-out;
    }

    .company-name-input:focus {
        border-color: #3b82f6;
        outline: none;
    }

    /* Delete button */
    .delete-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: #ef4444;
        color: white;
        padding: 4px 8px;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: bold;
        opacity: 0;
        transition: opacity 0.2s ease-in-out;
    }

    .draggable-item:hover .delete-btn {
        opacity: 1;
    }
</style>

<script>
    function submit(event) {
        const btn = document.getElementById('submit-btn');

        // Optional: prevent form submission if this is not AJAX-based
        // event.preventDefault(); 

        btn.innerHTML = `
        <div class="ti-spinner inline-block align-middle" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    `;
        btn.disabled = true;
        btn.style.cursor = 'not-allowed';
        btn.classList.remove('bg-green-500', 'hover:bg-green-600');
        btn.classList.add('bg-info');
    }
    
    // Function to handle logo change or upload
    function changeLogo(itemId, currentLogoUrl, company) {


        if (company === '') {
            const uploadBtn = document.getElementById('upload-btn');
            uploadBtn.textContent = 'Company name is required.';
            uploadBtn.type = 'button';
            uploadBtn.disabled = true;
            uploadBtn.classList.remove('bg-green-500');
            uploadBtn.classList.add('bg-danger');
            uploadBtn.style.cursor = 'not-allowed'; // ✅ Proper cursor
        }else{
            const uploadBtn = document.getElementById('upload-btn');
            uploadBtn.textContent = 'Upload Logo';
            uploadBtn.type = 'submit';
            uploadBtn.disabled = false;
            uploadBtn.classList.add('bg-green-500');
            uploadBtn.classList.remove('bg-danger');
            uploadBtn.style.cursor = 'pointer'; // ✅ Proper cursor
        }

        const modal = document.getElementById("change-logo");
        const logoPreview = document.getElementById("logoPreview");
        const noLogoMessage = document.getElementById("noLogoMessage");
        const logoFileInput = document.getElementById("logoFile");

        const itemId_raw = document.getElementById("itemId");
        itemId_raw.value = itemId;

        // Show the modal
        modal.classList.remove('hidden');

        // Check if there's a current logo available
        if (currentLogoUrl && currentLogoUrl.trim() !== "") {
            // Show the logo preview
            logoPreview.src = currentLogoUrl;
            noLogoMessage.style.display = 'none'; // Hide the 'No logo' message
        } else {
            // Show 'No logo' message if there's no logo
            logoPreview.style.display = 'none';
            noLogoMessage.style.display = 'block';
        }

        // Handle logo file upload
        logoFileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Display the uploaded image preview
                    logoPreview.style.display = 'block';
                    logoPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }


    function watchVideo(itemId, videoUrl) {
        const modal = document.getElementById("watch-video");
        const videoPlayer = document.getElementById("videoPlayer");
        const videoSource = document.getElementById("videoSource");
        const noVideoMessage = document.getElementById("noVideoMessage");

        // Show the modal
        modal.classList.remove('hidden'); // Make sure the modal is visible

        console.log(videoUrl)
        console.log(videoUrl.trim())
        // Check if video URL exists
        if (videoUrl && videoUrl.trim() !== "" && videoUrl !== "http://127.0.0.1:8000/storage") {
            // Video URL exists
            videoPlayer.style.display = 'block';
            noVideoMessage.style.display = 'none'; // Hide "No video available" message

            // Set the video source and play
            videoSource.src = videoUrl;
            videoPlayer.load();
            videoPlayer.play();
        } else {
            // Video URL does not exist
            videoPlayer.style.display = 'none'; // Hide the video player
            noVideoMessage.style.display = 'block'; // Show "No video available" message
        }
    }


    function resetVideoPlayer() {
        const videoPlayer = document.getElementById("videoPlayer");
        const videoSource = document.getElementById("videoSource");

        videoPlayer.pause();
        videoPlayer.currentTime = 0;
        videoSource.src = "";
    }

    // Handle modal close via close button
    document.querySelector('.ti-modal-close-btn').addEventListener("click", resetVideoPlayer);

    // Handle Escape key
    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape") {
            const modal = document.getElementById("watch-video");
            if (!modal.classList.contains("hidden")) {
                resetVideoPlayer();
            }
        }
    });




    document.addEventListener("DOMContentLoaded", function() {
        // ✅ Delete Function for OnClick
        window.delete_image = function(itemId) {

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
                    fetch("{{ route('cms.partners.delete') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                id: itemId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                document.querySelector(`.draggable-item[data-id="${itemId}"]`)
                                    .remove();
                            }
                        })
                        .catch(error => console.error("Error deleting item:", error));

                }
            });
        };

        // ✅ Prevent Dragula from Dragging when Clicking Delete Button
        document.querySelectorAll(".delete-btn").forEach(btn => {
            btn.addEventListener("mousedown", function(e) {
                e.stopPropagation(); // Stops Dragula from interfering
            });
        });

        // ✅ Dragula Setup
        let columns = document.querySelectorAll(".drag-column");
        let drake = dragula([...columns], {
            moves: function(el, container, handle) {
                return !handle.classList.contains("delete-btn"); // Prevent drag on delete button
            }
        });

        drake.on("drop", function(el, target) {
            let positions = [];

            document.querySelectorAll(".drag-column").forEach((column, colIndex) => {
                column.querySelectorAll(".draggable-item").forEach((item, rowIndex) => {
                    let id = item.dataset.id;
                    positions.push({
                        id: id,
                        column: colIndex + 1, // Column number
                        row: rowIndex + 1 // Row order inside the column
                    });
                });
            });

            fetch("{{ route('cms.partners.position.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        positions: positions
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Positions updated successfully!");
                    }
                })
                .catch(error => console.error("Error updating positions:", error));
        });
    });
</script>
