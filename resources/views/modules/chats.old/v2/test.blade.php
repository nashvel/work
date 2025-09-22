<x-app-layout>

    <x-slot name="return">{"link": "/users/manage", "text": "back"}</x-slot>
    <x-slot name="url_1">{"link": "/users/manage", "text": "User Management"}</x-slot>
    <x-slot name="active">Users</x-slot>
    <x-slot name="buttons">
        <a href="/relationship/list/register"
            class="ti-btn ti-btn-soft-success !text-default !rounded-full btn-wave waves-effect waves-light">
            <i class="bi bi-plus-circle me-1"></i>
            <span class="mx-1" style="font-weight: 400">Register New</span>
        </a>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                        <strong>User Management</strong>
                    </h6>

                    <span>You can manage the users details here.</span>
                    <hr class="mb-3 !mt-3">
                    @if ($errors->any())
                        <div
                            class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm flex items-center mx-3">
                            <div>
                                <strong class="text-danger">Whoops! Something went wrong:</strong>
                                <ul class="list-disc list-inside mt-2 mx-4">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-dark"><i>{{ $error }}</i></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="custom-box">
                        <div id="messages"></div>
                        <input type="text" id="message-input">
                        <button onclick="sendMessage()">Send</button>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.10.0/axios.min.js" integrity="sha512-WkZrEcQ5LMyNy6Y2PQf+Tu3vMcsmKKRKuPXtJSTHQJ3mpuvLRlA5dlDDhrrcXfyWr6Z/y3wIMfjfqVFO/gDZYQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                        <script>
                            

                            const conversationId = 1; // dynamic
                            window.Echo.private(`conversation.${conversationId}`)
                                .listen('MessageSent', (e) => {
                                    console.log('New message:', e);
                                    // append message to chat
                                });

                            function sendMessage() {
                                const message = document.getElementById('message-input').value;

                                axios.post(`/chat/${conversationId}/send`, {
                                    body: message
                                }).then(response => {
                                    // maybe also append to UI
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
