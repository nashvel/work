<style>
    .chat-box {
        width: 350px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2) !important;
        font-family: 'Poppins', sans-serif;
        background: #fff;
        display: flex;
        flex-direction: column;
    }

    .chat-box-header {
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #2C51EE;
        background-color: #2C51EE;
        /* gray-300 */
    }

    .chat-box-header h4 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }

    .chat-box-header p {
        cursor: pointer;
        color: #6b7280;
        /* gray-500 */
        transition: color 0.2s;
        margin: 0;
        font-size: 0.9rem;
    }

    .chat-box-header p:hover {
        color: #1f2937;
        /* gray-800 */
    }

    .chat-box-body {
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .chat-box-body-send,
    .chat-box-body-receive {
        display: flex;
        align-items: flex-end;
        gap: 0.75rem;
        max-width: 100%;
    }

    .chat-box-body-send p {
        background-color: #3b82f6;
        /* blue-500 */
        color: white;
        padding: 12px;
        border-radius: 12px;
        margin: 0;
        max-width: 100%;
    }

    .chat-box-body-receive p {
        background-color: #e5e7eb;
        /* gray-200 */
        padding: 12px;
        border-radius: 12px;
        margin: 0;
        max-width: 100%;
    }

    .chat-box-body span {
        font-size: 0.75rem;
        color: #9ca3af;
        /* gray-400 */
        user-select: none;
    }

    .chat-avatar img {
        border-radius: 9999px;
        width: 40px;
        height: 40px;
    }

    .chat-box-footer {
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border-top: 1px solid #d1d5db;
        /* gray-300 */
    }

    .chat-box-footer button {
        background-color: #e5e7eb;
        /* gray-200 */
        border: none;
        padding: 8px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .chat-box-footer button:hover {
        background-color: #d1d5db;
        /* gray-300 */
    }

    .chat-box-footer input {
        flex-grow: 1;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 8px;
        font-size: 1rem;
    }

    .chat-box-footer .send {
        color: #2563eb;
        /* blue-600 */
        cursor: pointer;
        font-size: 1.25rem;
        transition: color 0.2s;
    }

    .chat-box-footer .send:hover {
        color: #1d4ed8;
        /* blue-800 */
    }
</style>



<style>
    .user-info {
        background-color: #fff;
        padding: 12px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        transition: background-color 0.2s ease;
        user-select: none;
        width: 100%;
        font-family: 'Poppins';
        justify-content: space-between;
        /* added */
    }

    .user-info:hover {
        background-color: #f3f4f6;
    }

    .user-info img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        object-fit: cover;
    }

    .user-info>div {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        flex-grow: 1;
        /* added */
    }

    .user-info p {
        margin: 0;
        font-weight: 600;
        font-size: 1rem;
        text-align: left;
    }

    .user-info span {
        font-size: 0.875rem;
        color: #6b7280;
        text-align: left;
        margin-top: 2px;
    }

    .user-info .chat-icon {
        font-size: 20px;
        color: #1f2421;
        flex-shrink: 0;
    }
</style>




<link rel="stylesheet" href="/assets/css/styles.css">


<!-- Modal -->
<div id="serviceModal" class="modal">
    <div class="modal-content fade-up">
        <div class="modal-close-button mb-3" onclick="closeServiceModal()">×</div>
        <hr><br>
        <p id="serviceModalMessage"></p>
    </div>
</div>


<div class="chat-box" id="chatBox" style="border: 1px solid #2563eb; border-top; none">
    <div class="chat-box-header" style="padding: 10px;">
        <p class="text-lg" style="color: #fff"><span class="bi bi-robot mx-1 "></span> Assigned Virtual Assistant</p>
        <p id="closeChatBtn" style="cursor:pointer; color: #fff"><i class="bi bi-x-lg chat-icon" aria-hidden="true"></i>
        </p>
    </div>

    <div class="chat-box-body">
        @php
            $yourAssignedVAs = App\Models\User::where('id', Auth::user()->id)->first()?->assign_id;
            $ids = explode(',', $yourAssignedVAs ?? ''); // This could also be a variable like $user_ids
            if (Auth::user()->role === 'Sub-Client') {
                if (Auth::user()->email == 'californiacustomcoatings@yahoo.com') {
                    $ids = [30, 9799];
                } else {
                    $ids = [30, 9803];
                }
            }
            $users = App\Models\User::whereIn('id', $ids)->get();
        @endphp
        @foreach ($users as $user)
            <span class="custom-tooltip">
                <a href="/chats/message?chat={{ $user->id }}" class="m-0 p-0">
                    <div class="user-info">
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" onerror="this.src='/user.png'"
                            alt="Kimber Labatero" />
                        <div class="text-content">
                            <p style="margin-bottom: 0">{{ $user->name }}</p>
                            <span>Virtual Assistant</span>
                        </div>
                        <i class="bi bi-chat-square-dots chat-icon" aria-hidden="true"></i>
                    </div>
                </a>
            </span>
        @endforeach
        @if (empty($yourAssignedVAs))
            @if (Auth::user()->role !== 'Sub-Client')
                <i>Sorry, No Assigned Virtual Assistant Yet!</i>
            @endif
        @endif
    </div>

    <div class="chat-box-footer">
        <center>
            @if (!empty($yourAssignedVAs))
                <i><span class="bi bi-info-circle mx-1"></span> Need help? Pick your assigned Virtual Assistant!</i>
            @endif
        </center>
    </div>
</div>

<div class="chat-button">
    <span></span>
    <div class="avatar-list-stacked">
        @foreach ($users as $user)
            <div class="avatar avatar-xl avatar-rounded shadow">
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" onerror="this.src='/user.png'"
                    alt="img">
            </div>&ensp;&ensp;
        @endforeach

    </div>
</div>


{{-- <div class="modal">
    <div class="modal-content">
        <span class="modal-close-button">&times;</span>
        <h1>Add What you want here.</h1>
    </div>
</div> --}}

<script>
    function openServiceModal(message) {
        document.getElementById('serviceModalMessage').innerText = message;
        document.getElementById('serviceModal').classList.add('show-modal');
    }

    function closeServiceModal() {
        document.getElementById('serviceModal').classList.remove('show-modal');
    }
</script>

@include('chats.settings')
<style>
    .service-buttons-inline {
        display: flex;
        gap: 10px;
        background: #fff;
        padding: 10px 15px;
        border: 1px solid #2563eb;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
    }

    .service-buttons-inline button {
        background-color: #2C51EE;
        color: white;
        border: none;
        padding: 8px 14px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .service-buttons-inline button:hover {
        background-color: #1e3aa5;
    }

    /* .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10000;
    }

    .modal-content-box {
        background: white;
        padding: 20px 30px;
        border-radius: 12px;
        max-width: 400px;
        text-align: center;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        position: relative;
    }

    .modal-close-button {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
    }

    .modal-content-box p {
        font-size: 1rem;
        color: #1f2937;
    } */

    .modal {
        position: fixed;
        inset: 0;
        /* same as top: 0; left: 0; right: 0; bottom: 0 */
        background-color: rgba(0, 0, 0, 0.6);
        /* dark background */
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transform: scale(1.05);
        transition: all 0.25s ease-in-out;
        z-index: 9999;
    }

    .modal-content {
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 12px;
        width: 90%;
        max-width: 600px;
        text-align: center;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        animation: fadeUp 0.3s ease;
    }


    .modal-close-button {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: #d1d5db;
        color: #111;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        line-height: 32px;
        text-align: center;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .modal-close-button:hover {
        background-color: #9ca3af;
    }

    .show-modal {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
    }

    @keyframes fadeUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }


    #serviceButtonsContainer {
        position: fixed;
        bottom: 0;
        left: 250px;
        margin: 15px;
        display: flex;
        gap: 10px;
        background: #fff;
        border-radius: 25px 25px 25px 0;
        padding: 10px 15px;
        box-shadow: 0 2px 15px rgba(44, 80, 239, 0.1);
        z-index: 15;
        font-family: 'Ubuntu', sans-serif;
    }

    .service-btn {
        background-color: #2C50EF;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.3s ease;
        box-shadow: 0 2px 8px rgba(44, 80, 239, 0.12);
    }

    .service-btn:hover {
        background-color: #1e3aa5;
    }

    #serviceModal p {
        font-family: Ubuntu, sans-serif;
        font-size: 15px;
        color: #333;
        margin: 0;
        padding: 10px 0;
        text-align: center;
    }
</style>
