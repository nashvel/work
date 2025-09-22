@php
    $va = App\Models\User::where('users.id', $id)->first();
@endphp

<div class="flex items-center border-b border-defaultborder dark:border-defaultborder/10 main-chat-head flex-wrap">
    <span class="avatar avatar-md online chatstatusperson me-2 leading-none">
        <img class="chatimageperson" src="{{ asset('storage/' . $va->profile_photo_path ?? '') ?? '/user.png' }}"
            onerror="this.src='/user.png'" alt="img">
    </span>
    <div class="flex-auto">
        <p class="mb-0 font-medium text-[14px] leading-none mt-1">
            <a href="javascript:void(0);" data-hs-overlay="#offcanvasRight"
                class="chatnameperson responsive-userinfo-open">{{ $va->name ?? '' }}</a>
        </p>
        <p class="text-textmuted dark:text-textmuted/50 mb-0 chatpersonstatus mt-1">Online</p>
    </div>
    <div class="flex flex-wrap rightIcons items-center gap-2">
        <button aria-label="button" type="button" class="ti-btn ti-btn-icon ti-btn-soft-primary1 my-0  ti-btn-sm">
            <i class="ti ti-phone"></i>
        </button>
        <button aria-label="button" type="button"
            class="ti-btn ti-btn-icon ti-btn-soft-primary2 my-0 ti-btn-sm hidden sm:block">
            <i class="ti ti-video"></i>
        </button>
        <button aria-label="button" type="button"
            class="ti-btn ti-btn-icon ti-btn-outline-light  responsive-userinfo-open ti-btn-sm">
            <i class="ti ti-user-circle" id="responsive-chat-close"></i>
        </button>
        <div class="hs-dropdown ti-dropdown">
            <button aria-label="button"
                class="ti-btn ti-btn-icon ti-dropdown-toggle ti-btn-soft-primary2 btn-wave waves-light ti-btn-sm waves-effect waves-light"
                type="button" id="dropdownMenuButton1" aria-expanded="false">
                <i class="ti ti-dots-vertical"></i>
            </button>
            <ul class="hs-dropdown-menu ti-dropdown-menu hidden" aria-labelledby="dropdownMenuButton1">
                <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                            class="ri-user-3-line me-1"></i>Profile</a></li>
                <li><a class="ti-dropdown-item" href="javascript:void(0);"><i class="ri-format-clear me-1"></i>Clear
                        Chat</a></li>
                <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                            class="ri-user-unfollow-line me-1"></i>Delete User</a></li>
                <li><a class="ti-dropdown-item" href="javascript:void(0);"><i class="ri-user-forbid-line me-1"></i>Block
                        User</a></li>
                <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                            class="ri-error-warning-line me-1"></i>Report</a></li>
            </ul>
        </div>
        <button aria-label="button" type="button"
            class="ti-btn ti-btn-icon ti-btn-soft-danger my-0 responsive-chat-close ti-btn-sm">
            <i class="ri-close-line"></i>
        </button>
    </div>
</div>
