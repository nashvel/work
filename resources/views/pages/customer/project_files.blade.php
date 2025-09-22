<div class="table-responsive border border-defaultborder dark:border-defaultborder/10 border-b-0">
    <form id="fileSelectionForm">
        <table class="ti-custom-table ti-custom-table-head ti-custom-table-hover">
            <thead>
                <tr class="border-b !border-defaultborder dark:!border-defaultborder/10">
                    <th width="20" scope="col">
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th scope="col" width="10">Status</th>
                    <th scope="col">File Name</th>
                    <th scope="col">Format</th>
                    <th scope="col">Size</th>
                    <th scope="col">Date Uploaded</th>
                </tr>
            </thead>
            <tbody class="files-list">
                @foreach ($files as $file)
                    @if (!$file->is_folder)
                        @php
                            $check_submitted = App\Models\FileSubmitted::where('file_id', $file->id)
                                ->where('project_id', $id)
                                ->where('user_id', Auth::user()->id)
                                ->first();
                        @endphp
                        <tr class="border-b !border-defaultborder dark:!border-defaultborder/10">
                            <td>
                                <input type="checkbox" class="file-checkbox" name="selected_files[]"
                                    value="{{ $file->id }}" {{ $check_submitted ? 'checked' : '' }}>
                            </td>
                            <td>
                                <center>
                                    <i
                                        class="bi bi-{{ $check_submitted ? 'check-circle' : 'clock' }} text-lg {{ $check_submitted ? 'text-success' : 'text-primary' }} "></i>
                                </center>
                            </td>
                            <th scope="row">
                                <div class="flex items-center">
                                    <div>
                                        <a href="javascript:void(0);"
                                            data-hs-overlay="#offcanvasRight">{{ $file->name }}</a>
                                    </div>
                                </div>
                            </th>
                            <td style="text-transform: uppercase">
                                {{ $file->format }}
                            </td>
                            <td>
                                <?php
                                $size = $file->size;
                                if ($size >= 1073741824) {
                                    echo number_format($size / 1073741824, 2) . ' GB';
                                } elseif ($size >= 1048576) {
                                    echo number_format($size / 1048576, 2) . ' MB';
                                } elseif ($size >= 1024) {
                                    echo number_format($size / 1024, 2) . ' KB';
                                } elseif ($size > 1) {
                                    echo $size . ' bytes';
                                } elseif ($size == 1) {
                                    echo $size . ' byte';
                                } else {
                                    echo '0 bytes';
                                }
                                ?>
                            </td>
                            <td class="text-gray-400">
                                {{ date_format($file->created_at, 'D, d, M. Y h:i A') }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>


    </form>

    <script>
        document.querySelectorAll('.privacy-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const fileId = this.dataset.id;
                const currentStatus = this.dataset.status;
                const newStatus = currentStatus === 'public' ? 'private' : 'public';

                Swal.fire({
                    title: "Are you sure you want to make this file " + newStatus + "?",
                    text: "You can change this setting again anytime.",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Confirmed"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Success!",
                            text: "Your record has been " + type,
                            icon: "success"
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                        // $.ajax({
                        //     url: '/bid/invitation/update',
                        //     type: 'post',
                        //     headers: {
                        //         'X-CSRF-Token': '{{ csrf_token() }}'
                        //     },
                        //     data: {
                        //         id: id,
                        //         type: type
                        //     },
                        //     success: function() {
                        //         Swal.fire({
                        //             title: "Success!",
                        //             text: "Your record has been " + type,
                        //             icon: "success"
                        //         });
                        //         setTimeout(() => {
                        //             window.location.reload();
                        //         }, 2000);
                        //     },
                        //     error: function(xhr, status, error) {
                        //         Swal.fire({
                        //             title: "Error!",
                        //             text: "There was a problem your record. " +
                        //                 error,
                        //             icon: "error"
                        //         });
                        //     }
                        // });
                    }
                });



                if (!window.confirm(confirmMessage)) {
                    return; // Stop if the user cancels
                }

                // Simulate AJAX request to update privacy status
                // fetch(`/update-file-privacy/${fileId}`, {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //     },
                //     body: JSON.stringify({
                //         is_public: newStatus === 'public'
                //     })
                // }).then(response => {
                //     if (response.ok) {
                //         // Update button appearance
                //         this.dataset.status = newStatus;
                //         this.innerHTML =
                //             `<i class="ri-${newStatus === 'public' ? 'unlock' : 'lock'}-line text-lg"></i>
            //                           <span class="ml-1">${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}</span>`;
                //     } else {
                //         alert('Failed to update privacy status.');
                //     }
                // });
            });
        });
    </script>

    <!-- JavaScript to handle checkboxes -->
    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.file-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        
    </script>

</div>
