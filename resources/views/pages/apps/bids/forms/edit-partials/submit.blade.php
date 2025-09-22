 <script>
        function uploadProject(event) {
            event.preventDefault();

            const form = document.getElementById('projectForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const percentText = document.getElementById('uploadPercent');
            const statusText = document.getElementById('statusPercent');
            const uploadPanel = document.getElementById('upload-panel');
            const registerPanel = document.getElementById('register-panel');

            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();

            submitBtn.disabled = true;
            btnText.textContent = 'Saving...';
            uploadPanel.classList.remove('hidden');
            registerPanel.classList.add('hidden');
            percentText.classList.add('inline');
            percentText.textContent = 'Uploading: 0%';

            document.getElementById('project-name').innerHTML = document.getElementById('proj_name').value;

            // Track progress
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    const loadedMB = (e.loaded / (1024 * 1024)).toFixed(2);
                    const totalMB = (e.total / (1024 * 1024)).toFixed(2);
                    percentText.textContent = `Uploading: ${percent}% (${loadedMB} MB / ${totalMB} MB)`;
                }
            });

            // Handle response
            xhr.addEventListener('load', function() {

                if (xhr.status === 200 || xhr.status === 201) {
                    statusText.textContent = 'Project Created. Processing done.';
                    btnText.textContent = 'Saved!';
                    Swal.fire({
                        icon: 'success',
                        title: 'Saved Successfully',
                        text: 'Project Created. Processing done.',
                        confirmButtonText: 'OK'
                    });

                    console.log(xhr.response)

                    // Optional redirect
                    setTimeout(() => {
                        window.location.href = '/project/list/details/{{ $id }}';
                    }, 2000);

                } else if (xhr.status === 419 || xhr.responseText.includes('<form') || xhr.responseURL.includes(
                        '/login')) {
                    // 419 is CSRF mismatch, or Laravel redirected to login page
                    Swal.fire({
                        icon: 'error',
                        title: 'Authentication Error',
                        text: 'You were logged out. Please log in again.',
                        confirmButtonText: 'Login'
                    }).then(() => {
                        window.location.href = '/login';
                    });
                } else {
                    percentText.textContent = 'Server error. Try again.';
                    btnText.textContent = 'Create Bidding';
                    submitBtn.disabled = false;
                }
            });

            // Handle network error
            xhr.addEventListener('error', function() {
                alert('Upload failed!');
                submitBtn.disabled = false;
                btnText.textContent = 'Create Bidding';
                uploadPanel.classList.add('hidden');
                registerPanel.classList.add('hidden');
            });

            xhr.open('POST', "{{ route('project-bidding.update', $id) }}");
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.setRequestHeader('Accept', 'application/json');
            // Enable this if you're using cookies with cross-origin requests
            // xhr.withCredentials = true;

            xhr.send(formData);
        }
    </script>


    <script>
        let targetId = @json(request('t'));

        // Replace spaces with underscores
        if (targetId) {
            targetId = targetId.replace(/\s+/g, '_'); // replaces spaces and encoded %20
        }

        window.addEventListener('DOMContentLoaded', () => {
            if (targetId) {
                const el = document.getElementById(targetId);
                if (el) {
                    el.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        });
    </script>
