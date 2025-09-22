<x-app-layout>
    <x-slot name="header">Emails</x-slot>

    {{-- Action Buttons --}}
    <div class="flex gap-2 mb-4">
        <a href="{{ route('emails.fetch') }}" class="ti-btn ti-btn-primary">Fetch from Gmail</a>
        <a href="{{ route('emails.compose') }}" class="ti-btn ti-btn-outline-primary">Compose</a>
    </div>

    {{-- Error Message --}}
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Main Mail Layout --}}
    <div class="main-mail-container mb-2 gap-2 flex">
        {{-- Sidebar Navigation --}}
        <div class="mail-navigation border border-defaultborder dark:border-defaultborder/10">
            <div class="grid items-top p-4 border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                <button class="ti-btn ti-btn-primary flex items-center justify-center" data-hs-overlay="#mail-Compose">
                    <i class="ri-add-circle-line text-[1rem] align-middle me-1"></i>Compose Mail
                </button>
            </div>
            <ul class="list-none mail-main-nav" id="mail-main-nav">
                <li class="px-0 pt-0">
                    <span class="text-[11px] text-textmuted dark:text-textmuted/50 opacity-70 font-medium">MAILS</span>
                </li>
                <li class="active mail-type">
                    <a href="javascript:void(0);">
                        <div class="flex items-center">
                            <i class="ti ti-mail me-2 text-[1rem]"></i>All Mails
                            <span class="badge bg-primarytint1color rounded-full ms-auto">2,142</span>
                        </div>
                    </a>
                </li>
                <li class="mail-type">
                    <a href="javascript:void(0);">
                        <div class="flex items-center">
                            <i class="ti ti-inbox me-2 text-[1rem]"></i>Inbox
                            <span class="badge bg-primarytint2color rounded-full ms-auto">12</span>
                        </div>
                    </a>
                </li>
                <li class="mail-type">
                    <a href="javascript:void(0);">
                        <div class="flex items-center">
                            <i class="ti ti-send me-2 text-[1rem]"></i>Sent
                        </div>
                    </a>
                </li>
                <li class="px-0">
                    <span class="text-[11px] text-textmuted dark:text-textmuted/50 opacity-70 font-medium">SETTINGS</span>
                </li>
                <li>
                    <a href="mail-settings.html">
                        <div class="flex items-center">
                            <i class="ti ti-settings me-2 text-[14px]"></i>Settings
                        </div>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Mail List Area --}}
        <div class="total-mails border border-defaultborder dark:border-defaultborder/10">
            {{-- Search + Toolbar --}}
            <div class="p-4 flex items-center justify-between border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                <div class="input-group w-full">
                    <input type="text" class="form-control !border-s shadow-none" placeholder="Search Email">
                    <button class="ti-btn ti-btn-primary !m-0" type="button"><i class="ri-search-line me-1"></i> Search</button>
                </div>
            </div>

            {{-- Header Actions --}}
            <div class="px-3 py-2 flex items-center border-b border-defaultborder dark:border-defaultborder/10 flex-wrap gap-2">
                <input class="form-check-input check-all me-2" type="checkbox" id="checkAll" aria-label="...">
                <h6 class="font-medium mb-0 flex-auto">All Mails</h6>
                <div class="flex gap-2">
                    <button class="ti-btn ti-btn-icon bg-light lg:hidden total-mails-close">
                        <i class="ri-close-line"></i>
                    </button>
                    <button class="ti-btn ti-btn-sm ti-btn-soft-primary1 btn-wave"><i class="ri-inbox-archive-line me-1"></i> Archive</button>
                    <button class="ti-btn ti-btn-sm ti-btn-soft-primary2 btn-wave"><i class="ri-error-warning-line me-1"></i> Spam</button>
                    <div class="ti-dropdown hs-dropdown">
                        <button class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-primary3 ti-dropdown-toggle hs-dropdown-toggle">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Recent</a></li>
                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Unread</a></li>
                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Mark All Read</a></li>
                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete All</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Emails Display --}}
            <div class="mail-messages" id="mail-messages"  style="max-height: 500px; overflow-y: auto;">
                <ul class="list-none mb-0 mail-messages-container">
                    @forelse ($emails as $email)
                        <li>
                            <div class="flex items-start gap-3 p-3 border-b border-defaultborder dark:border-defaultborder/10">
                                <input class="form-check-input mt-1" type="checkbox" aria-label="...">
                                <div class="leading-none">
                                    <span class="avatar avatar-md avatar-rounded mail-msg-avatar">
                                        <img src="/user.png" alt="User">
                                    </span>
                                </div>
                                <div class="flex-auto truncate">
                                    <p class="mb-1 text-xs font-medium">
                                        {{ $email->from }}
                                        <span class="float-end text-textmuted font-normal text-[11px]">— {{ $email->received_at->format('g:i A') }}</span>
                                    </p>
                                    <span class="block font-medium truncate w-[75%]">{{ $email->subject ?? '(No Subject)' }}</span>
                                    <div class="text-xs text-textmuted truncate w-[75%]">
                                        {{ $email->snippet }}
                                        <button class="ti-btn p-0 float-end border-0"><i class="ri-star-line text-[14px]"></i></button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="p-4 text-center text-gray-500">No emails found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
