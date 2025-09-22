<div class="flex gap-1 lg:nowrap flex-wrap justify-content-sm-end sm:w-[80%]">
    <div class="input-group sm:!w-[50%] mx-3">
        <input type="text" class="form-control !border-s" placeholder="Search File" aria-describedby="button-addon01">
        <button class="ti-btn ti-btn-soft-primary !m-0" type="button" id="button-addon01"><i
                class="ri-search-line"></i></button>
    </div>
    <button id="getSelectedFiles"
        class="ti-btn ti-btn-success !m-0 btn-w-md flex items-center justify-center btn-wave waves-light text-nowrap">
        <i class="bi bi-send"></i>
        <span>Send Proposal</span>
    </button>
</div>


<script>
    document.getElementById('getSelectedFiles').addEventListener('click', function() {
        let selectedFiles = [];
        document.querySelectorAll('.file-checkbox:checked').forEach(checkbox => {
            selectedFiles.push(checkbox.value);
        });

        Swal.fire({
            title: "Are you sure you want to send this document?",
            text: "You are about to send these documents to all General Contractor.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#000",
            confirmButtonText: "Yes, Confirmed"
        }).then((result) => {
            if (result.isConfirmed) {
                if (selectedFiles.length > 0) {
                    let timerInterval;
                    Swal.fire({
                        title: "Sending..",
                        html: "Hold on! We're submitting your bidding proposal now. Please wait..",
                        timerProgressBar: true,
                        allowOutsideClick: false, // Prevent users from closing manually
                        didOpen: () => {
                            Swal.showLoading();

                            fetch('/file-manager/submit', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        file_ids: selectedFiles,
                                        proj_id: {{ $id }}
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Success!",
                                        text: "Your bidding proposal has been submitted.",
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        //location.reload(); // Refresh the page
                                    });
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error",
                                        text: "Something went wrong. Please try again later."
                                    });
                                    console.error('Error:', error);
                                });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "No files selected",
                        text: "Please select at least one file before submitting."
                    });
                }
            }
        });

    });


    document.getElementById("fileInput").addEventListener("change", function() {
        const file = this.files[0]; // Get selected file
        const maxSize = 50 * 1024 * 1024; // 50MB in bytes

        if (file && file.size > maxSize) {
            Swal.fire({
                title: "Maximum allowed size of 50MB",
                text: "The selected file exceeds the maximum allowed size of 50MB. Please contact the VA to assist you with uploading large files.",
                icon: "warning"
            });
            this.value = ""; // Clear the input
        }
    });
</script>
