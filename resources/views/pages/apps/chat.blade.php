<x-app-layout>
    <x-slot name="title">Chat with Us</x-slot>
    <x-slot name="active">Chat</x-slot>

    <div class="main-chart-wrapper lg:gap-2 gap-0 mb-2 lg:flex">
        <div class="chat-info border border-defaultborder dark:border-defaultborder/10">
            <div class="chat-search p-4 border-b border-defaultborder dark:border-defaultborder/10">
                <div class="input-group">
                    <input type="text" class="form-control !border-s border-defaultborder dark:border-defaultborder/10"
                        placeholder="Search Chat" aria-describedby="button-addon01">
                    <button aria-label="button" class="ti-btn ti-btn-soft-primary !m-0" type="button"
                        id="button-addon01">
                        <i class="ri-search-line"></i>
                    </button>
                </div>
            </div>
            <nav class="flex rtl:space-x-reverse p-4 border-b border-defaultborder dark:border-defaultborder/10 flex-wrap sm:flex-nowrap gap-2"
                aria-label="Tabs" role="tablist">
                <button type="button"
                    class="hs-tab-active:bg-primary hs-tab-active:text-white flex-grow sm:flex-grow-0 bg-primary/10 py-2 px-[1.35rem] inline-flex items-center gap-2 text-sm font-medium text-center text-primary rounded-sm hover:text-primary  dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white active"
                    id="users-tab" data-hs-tab="#users-tab1" aria-controls="users-tab1">
                    Recent
                    <span
                        class="!text-[0.63rem] py-[0.3rem] px-2 leading-none bg-primarytint1color !text-white rounded-full float-end shadow-sm">1</span>
                </button>
                {{-- <button type="button"
                    class="hs-tab-active:bg-primary hs-tab-active:text-white flex-grow sm:flex-grow-0 py-2 px-[1.35rem] inline-flex items-center gap-2 bg-primary/10 text-sm font-medium text-center text-primary rounded-sm hover:text-primary  dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white"
                    id="groups-tab" data-hs-tab="#groups-tab-pane" aria-controls="groups-tab-pane">
                    Groups
                    <span
                        class="!text-[0.63rem] py-[0.3rem] px-2 leading-none bg-primarytint3color !text-white rounded-full float-end shadow-sm">2</span>
                </button>
                <button type="button"
                    class="hs-tab-active:bg-primary hs-tab-active:text-white flex-grow sm:flex-grow-0 py-2 px-[1.35rem] inline-flex items-center gap-2 bg-primary/10 text-sm font-medium text-center text-primary rounded-sm hover:text-primary  dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white"
                    id="contacts-tab" data-hs-tab="#contacts-tab-pane" aria-controls="contacts-tab-pane">
                    Contacts
                </button> --}}
            </nav>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane show active border-0 chat-users-tab" id="users-tab1" role="tabpanel"
                    aria-labelledby="users-tab">
                    <ul class="list-none mb-0 mt-2 chat-users-tab" id="chat-msg-scroll">
                        <li class="pb-0">
                            <p class="text-textmuted dark:text-textmuted/50 text-[11px] font-medium mb-2 opacity-70">
                                ACTIVE CHATS</p>
                        </li>
                        <div id="discussion-message">
                            @include('pages.apps.chats.messages')
                        </div>


                    </ul>
                </div>
                <div class="tab-pane border-0 chat-groups-tab hidden" id="groups-tab-pane" role="tabpanel"
                    aria-labelledby="groups-tab">
                    <ul class="list-none mb-0 mt-2 ">
                        <li class="pb-0">
                            <p class="text-textmuted dark:text-textmuted/50 text-[11px] font-medium mb-1 opacity-70">
                                MY CHAT GROUPS</p>
                        </li>
                        <li>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="mb-0 font-medium"><i
                                            class="ri-checkbox-blank-circle-fill leading-none text-primary me-1 text-[8px] align-middle"></i>Huge
                                        Rocks </p>
                                    <p class="mb-0"><span
                                            class="badge bg-primarytint3color/10 text-primarytint3color">4
                                            Online</span></p>
                                </div>
                                <div class="avatar-list-stacked my-auto">
                                    <span class="avatar avatar-sm avatar-rounded">
                                        <img src="/assets/images/faces/2.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-sm avatar-rounded">
                                        <img src="/assets/images/faces/8.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-sm avatar-rounded">
                                        <img src="/assets/images/faces/2.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-sm avatar-rounded">
                                        <img src="/assets/images/faces/10.jpg" alt="img">
                                    </span>
                                    <a class="avatar avatar-sm bg-primary text-white avatar-rounded"
                                        href="javascript:void(0);">
                                        +19
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="mb-0 font-medium"><i
                                            class="ri-checkbox-blank-circle-fill leading-none text-primarytint2color me-1 text-[8px] align-middle"></i>Creative
                                        Group </p>
                                    <p class="mb-0"><span
                                            class="badge bg-primarytint2color/10 text-primarytint2color">32
                                            Online</span></p>
                                </div>
                                <div class="avatar-list-stacked my-auto">
                                    <span class="avatar avatar-sm avatar-rounded">
                                        <img src="/assets/images/faces/1.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-sm avatar-rounded">
                                        <img src="/assets/images/faces/7.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-sm avatar-rounded">
                                        <img src="/assets/images/faces/3.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-sm avatar-rounded">
                                        <img src="/assets/images/faces/9.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-sm avatar-rounded">
                                        <img src="/assets/images/faces/12.jpg" alt="img">
                                    </span>
                                    <a class="avatar avatar-sm bg-primary text-white avatar-rounded"
                                        href="javascript:void(0);">
                                        +123
                                    </a>
                                </div>
                            </div>
                            {{-- </li>
                                <li>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="mb-0 font-medium"><i
                                                    class="ri-checkbox-blank-circle-fill leading-none text-primary3 me-1 text-[8px] align-middle"></i>Anyside
                                                Spriritual</p>
                                            <p class="mb-0"><span
                                                    class="badge bg-primarytint1color/10 text-primarytint1color">3
                                                    Online</span></p>
                                        </div>
                                        <div class="avatar-list-stacked my-auto">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/4.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/8.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/13.jpg" alt="img">
                                            </span>
                                            <a class="avatar avatar-sm bg-primary text-white avatar-rounded"
                                                href="javascript:void(0);">
                                                +15
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="mb-0 font-medium"><i
                                                    class="ri-checkbox-blank-circle-fill leading-none text-secondary me-1 text-[8px] align-middle"></i>Fun
                                                Time</p>
                                            <p class="mb-0"><span class="badge bg-secondary/10 text-secondary">5
                                                    Online</span></p>
                                        </div>
                                        <div class="avatar-list-stacked my-auto">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/1.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/7.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/14.jpg" alt="img">
                                            </span>
                                            <a class="avatar avatar-sm bg-primary text-white avatar-rounded"
                                                href="javascript:void(0);">
                                                +28
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="mb-0 font-medium"><i
                                                    class="ri-checkbox-blank-circle-fill leading-none text-warning me-1 text-[8px] align-middle"></i>Latest
                                                News</p>
                                            <p class="mb-0"><span class="badge bg-warning/10 text-warning">2
                                                    Online</span>
                                            </p>
                                        </div>
                                        <div class="avatar-list-stacked my-auto">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/5.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/6.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/12.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/3.jpg" alt="img">
                                            </span>
                                            <a class="avatar avatar-sm bg-primary text-white avatar-rounded"
                                                href="javascript:void(0);">
                                                +53
                                            </a>
                                        </div>
                                    </div>
                                </li> --}}
                    </ul>
                    {{-- <ul class="list-none mb-0 mt-2 ">
                                <li class="pb-0">
                                    <p
                                        class="text-textmuted dark:text-textmuted/50 text-[11px] font-medium mb-1 opacity-70">
                                        GROUP CHATS</p>
                                </li>
                                <li class="checkforactive">
                                    <a href="javascript:void(0);"
                                        onclick="changeTheInfo(this,' Huge Rocks &#128525;','17','online')">
                                        <div class="flex items-top">
                                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md online me-2">
                                                    <img src="/assets/images/faces/17.jpg" alt="img">
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <p class="mb-0 font-medium">
                                                    Huge Rocks &#128525; <span
                                                        class="float-end text-textmuted dark:text-textmuted/50 font-normal text-[11px]">12:24PM</span>
                                                </p>
                                                <p class="text-xs mb-0 chat-msg-typing ">
                                                    <span class="chat-msg truncate">Mony Typing...</span>
                                                    <span class="chat-read-icon float-end align-middle"><i
                                                            class="ri-check-double-fill"></i></span>
                                                    <span
                                                        class="badge bg-primarytint3color !rounded-full float-end">2</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="chat-msg-unread checkforactive">
                                    <a href="javascript:void(0);"
                                        onclick="changeTheInfo(this,'Creative Group','18','online')">
                                        <div class="flex items-top">
                                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md online me-2">
                                                    <img src="/assets/images/faces/18.jpg" alt="img">
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <p class="mb-0 font-medium">
                                                    Creative Group <span
                                                        class="float-end text-textmuted dark:text-textmuted/50 font-normal text-[11px]">06:16AM</span>
                                                </p>
                                                <p class="text-xs mb-0">
                                                    <span class="chat-msg truncate"><span
                                                            class="group-indivudial">Kin:</span>Have any updates
                                                        today?</span>
                                                    <span class="chat-read-icon float-end align-middle"><i
                                                            class="ri-check-double-fill"></i></span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="chat-inactive checkforactive">
                                    <a href="javascript:void(0);"
                                        onclick="changeTheInfo(this,' Anyside Spriritual &#128526;','19','offline')">
                                        <div class="flex items-top">
                                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md offline me-2">
                                                    <img src="/assets/images/faces/19.jpg" alt="img">
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <p class="mb-0 font-medium">
                                                    Anyside Spriritual &#128526; <span
                                                        class="float-end text-textmuted dark:text-textmuted/50 font-normal text-[11px]">2
                                                        days
                                                        ago</span>
                                                </p>
                                                <p class="text-xs mb-0">
                                                    <span class="chat-msg truncate">Samantha, Adam, Jessica, Emily,
                                                        Alex</span>
                                                    <span class="chat-read-icon float-end align-middle"><i
                                                            class="ri-check-double-fill"></i></span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="chat-inactive checkforactive">
                                    <a href="javascript:void(0);"
                                        onclick="changeTheInfo(this,'DialogDynasty','20','offline')">
                                        <div class="flex items-top">
                                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md offline me-2">
                                                    <img src="/assets/images/faces/20.jpg" alt="img">
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <p class="mb-0 font-medium">
                                                    Fun Time <span
                                                        class="float-end text-textmuted dark:text-textmuted/50 font-normal text-[11px]">3
                                                        days
                                                        ago</span>
                                                </p>
                                                <p class="text-xs mb-0">
                                                    <span class="chat-msg truncate">Elsa,Henry,Susan, Emily,
                                                        Ashlin</span>
                                                    <span class="chat-read-icon float-end align-middle"><i
                                                            class="ri-check-double-fill"></i></span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="chat-inactive checkforactive">
                                    <a href="javascript:void(0);"
                                        onclick="changeTheInfo(this,'Latest News','21','offline')">
                                        <div class="flex items-top">
                                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md offline me-2">
                                                    <img src="/assets/images/faces/21.jpg" alt="img">
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <p class="mb-0 font-medium">
                                                    Latest News <span
                                                        class="float-end text-textmuted dark:text-textmuted/50 font-normal text-[11px]">10
                                                        days
                                                        ago</span>
                                                </p>
                                                <p class="text-xs mb-0">
                                                    <span class="chat-msg truncate">Emanuel, Rony, Alina, Lilly,
                                                        Rush</span>
                                                    <span class="chat-read-icon float-end align-middle"><i
                                                            class="ri-check-double-fill"></i></span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul> --}}
                </div>
                <div class="tab-pane border-0 chat-contacts-tab hidden" id="contacts-tab-pane" role="tabpanel"
                    aria-labelledby="contacts-tab">
                    <ul class="list-none mb-0 chat-contacts-tab">
                        <li>
                            <span class="text-defaulttextcolor font-semibold">A</span>
                        </li>
                        <li>
                            <div class="flex items-center gap-4">
                                <div class="leading-none">
                                    <span class="avatar avatar-sm">
                                        <img src="/assets/images/faces/5.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <span class="block font-semibold">
                                        Ava Taylor
                                    </span>
                                </div>
                                <div
                                    class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-outline-light">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-message-2-line me-2"></i>Chat</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-phone-line me-2"></i>Audio Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-live-line me-2"></i>Video Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-spam-2-line me-2"></i>Block</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center gap-4">
                                <div class="leading-none">
                                    <span class="avatar avatar-sm">
                                        <img src="/assets/images/faces/12.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <span class="block font-semibold">
                                        Alice Angel
                                    </span>
                                </div>
                                <div
                                    class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-outline-light">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-message-2-line me-2"></i>Chat</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-phone-line me-2"></i>Audio Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-live-line me-2"></i>Video Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-spam-2-line me-2"></i>Block</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="text-defaulttextcolor font-semibold">B</span>
                        </li>
                        <li>
                            <div class="flex items-center gap-4">
                                <div class="leading-none">
                                    <span class="avatar avatar-sm">
                                        <img src="/assets/images/faces/14.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <span class="block font-semibold">
                                        Blessy diamond
                                    </span>
                                </div>
                                <div
                                    class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-outline-light">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-message-2-line me-2"></i>Chat</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-phone-line me-2"></i>Audio Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-live-line me-2"></i>Video Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-spam-2-line me-2"></i>Block</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="text-defaulttextcolor font-semibold">D</span>
                        </li>
                        <li>
                            <div class="flex items-center gap-4">
                                <div class="leading-none">
                                    <span class="avatar avatar-sm bg-primary">
                                        C
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <span class="block font-semibold">
                                        Catalina Keira
                                    </span>
                                </div>
                                <div
                                    class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-outline-light">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-message-2-line me-2"></i>Chat</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-phone-line me-2"></i>Audio Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-live-line me-2"></i>Video Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-spam-2-line me-2"></i>Block</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="text-defaulttextcolor font-semibold">D</span>
                        </li>
                        <li>
                            <div class="flex items-center gap-4">
                                <div class="leading-none">
                                    <span class="avatar avatar-sm">
                                        <img src="/assets/images/faces/7.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <span class="block font-semibold">
                                        Danny Raj
                                    </span>
                                </div>
                                <div
                                    class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-outline-light">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-message-2-line me-2"></i>Chat</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-phone-line me-2"></i>Audio Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-live-line me-2"></i>Video Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-spam-2-line me-2"></i>Block</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="text-defaulttextcolor font-semibold">G</span>
                        </li>
                        <li>
                            <div class="flex items-center gap-4">
                                <div class="leading-none">
                                    <span class="avatar avatar-sm">
                                        <img src="/assets/images/faces/15.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <span class="block font-semibold">
                                        Gatin Leo
                                    </span>
                                </div>
                                <div
                                    class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-outline-light">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-message-2-line me-2"></i>Chat</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-phone-line me-2"></i>Audio Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-live-line me-2"></i>Video Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-spam-2-line me-2"></i>Block</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="text-defaulttextcolor font-semibold">L</span>
                        </li>
                        <li>
                            <div class="flex items-center gap-4">
                                <div class="leading-none">
                                    <span class="avatar avatar-sm bg-primary">
                                        M
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <span class="block font-semibold">
                                        Monte Christ
                                    </span>
                                </div>
                                <div
                                    class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-outline-light">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-message-2-line me-2"></i>Chat</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-phone-line me-2"></i>Audio Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-live-line me-2"></i>Video Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-spam-2-line me-2"></i>Block</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center gap-4">
                                <div class="leading-none">
                                    <span class="avatar avatar-sm">
                                        <img src="/assets/images/faces/2.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <span class="block font-semibold">
                                        Thomas Lie
                                    </span>
                                </div>
                                <div
                                    class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-outline-light">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-message-2-line me-2"></i>Chat</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-phone-line me-2"></i>Audio Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-live-line me-2"></i>Video Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-spam-2-line me-2"></i>Block</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="text-defaulttextcolor font-semibold">N</span>
                        </li>
                        <li>
                            <div class="flex items-center gap-4">
                                <div class="leading-none">
                                    <span class="avatar avatar-sm">
                                        <img src="/assets/images/faces/10.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <span class="block font-semibold">
                                        Nelson Gold
                                    </span>
                                </div>
                                <div
                                    class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-outline-light">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-message-2-line me-2"></i>Chat</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-phone-line me-2"></i>Audio Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-live-line me-2"></i>Video Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-spam-2-line me-2"></i>Block</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="text-defaulttextcolor font-semibold">V</span>
                        </li>
                        <li>
                            <div class="flex items-center gap-4">
                                <div class="leading-none">
                                    <span class="avatar avatar-sm">
                                        <img src="/assets/images/faces/16.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <span class="block font-semibold">
                                        Victoria Gracie
                                    </span>
                                </div>
                                <div
                                    class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-outline-light">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-message-2-line me-2"></i>Chat</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-phone-line me-2"></i>Audio Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-live-line me-2"></i>Video Call</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-spam-2-line me-2"></i>Block</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-chat-area border border-defaultborder dark:border-defaultborder/10">
            @include('pages.apps.chats.header')
            <div class="chat-content overflow-y-auto" id="discussion-container" id="main-chat-content">
                <ul class="list-none">
                    <div id="discussion-list">
                        @include('pages.apps.chats.conversation')
                    </div>
                </ul>
            </div>

            @auth
                <form id="discussion-form" onsubmit="#" enctype="multipart/form-data">
                    @csrf
                    <div class="chat-footer !border-defaultborder dark:!border-defaultborder/10">
                        <a aria-label="anchor" onclick="document.getElementById('file-input').click();"
                            class="ti-btn bg-primarytint1color/10 text-primarytint1color me-2 ti-btn-icon btn-send"
                            href="javascript:void(0)">
                            <i class="ri-attachment-2"></i>
                        </a>
                        <a aria-label="anchor"
                            class="ti-btn ti-btn-icon me-2 bg-primarytint2color text-white emoji-picker"
                            href="javascript:void(0)">
                            <i class="ri-emotion-line"></i>
                        </a>

                        <!-- Hidden File Input -->
                        <input type="file" name="file" id="file-input" class="hidden"
                            accept="image/*,.pdf,.docx">

                        <input class="form-control chat-message-space" name="message" id="message-input" required
                            placeholder="Type your message here..." type="text">

                        <button type="submit" aria-label="anchor"
                            class="ti-btn ti-btn-primary ms-2 ti-btn-icon btn-send" href="javascript:void(0)">
                            <i class="ri-send-plane-2-line"></i>
                        </button>
                    </div>
                </form>

                <!-- Container to Update -->


                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    function scrollToBottom() {
                        var container = document.getElementById("discussion-container");
                        container.scrollTop = container.scrollHeight;
                    }

                    // Scroll to bottom on page load
                    document.addEventListener("DOMContentLoaded", scrollToBottom);

                    $(document).ready(function() {
                        $("#discussion-form").submit(function(e) {
                            e.preventDefault(); // Prevent default form submission

                            let formData = new FormData(this);
                            formData.append('receiver_id', {!! json_encode($id) !!});

                            $.ajax({
                                url: @json(route('chats.old.store')),
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                headers: {
                                    'X-CSRF-TOKEN': $('input[name="_token"]').val() // CSRF protection
                                },
                                success: function(response) {
                                    console.log(response)
                                    //$("#discussion-list").append(response.html);
                                    // //$("#discussion-list").append(response.html);
                                    getMessages();
                                    $("#message-input").val("");
                                    $("#file-input").val("");
                                    scrollToBottom();
                                },
                                error: function(xhr) {
                                    alert("Something went wrong! Please try again.");
                                }
                            });
                        });
                    });

                    let lastMessageId = 0; // Store last message ID

                    function getMessages() {
                        $.ajax({
                            url: "{{ route('chats.old.list') }}", // Laravel route
                            type: "POST",
                            data: {
                                last_id: lastMessageId,
                                id: {!! json_encode($id) !!}
                            }, // Send last message ID
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
                            success: function(response) {
                                if (response.new_data) {
                                    $("#discussion-list").html(response.html);
                                    $("#discussion-message").html(response.messages);
                                    lastMessageId = response.last_id; // Update last message ID
                                    scrollToBottom();
                                }
                            },
                            error: function(xhr) {
                                console.error("Error fetching messages:", xhr);
                            }
                        });
                    }

                    //Run every 10 seconds
                    setInterval(() => {
                        getMessages();
                    }, 2000);
                </script>

            </div>
        @endauth


    </div>
    </div>


    <div class="hs-overlay hidden ti-offcanvas ti-offcanvas-right" id="offcanvasRight">
        <div class="ti-offcanvas-body">
            <button type="button"
                class="ti-btn  btn-wave flex-shrink-0 p-0 transition-none text-gray-500 hover:text-gray-700 focus:ring-gray-400 focus:ring-offset-white text-textmuted dark:text-textmuted/50 dark:hover:text-white/80 dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                data-hs-overlay="#offcanvasRight">
                <span class="sr-only">Close modal</span>
                <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                        fill="currentColor"></path>
                </svg>
            </button>
            <div class="chat-user-details" id="chat-user-details">
                <div class="text-center mb-4">
                    <span class="avatar avatar-rounded online avatar-xxl me-2 mb-3 chatstatusperson">
                        <img class="chatimageperson" src="/assets/images/faces/2.jpg" alt="img">
                    </span>
                    <p class="mb-1 text-[15px] font-medium text-dark leading-none chatnameperson">Jamison Jen</p>
                    <p class="text-xs text-textmuted dark:text-textmuted/50 mb-4"><span
                            class="chatnameperson">jamisonjen0114</span>@gmail.com</p>
                    <p class="text-center mb-0 flex gap-2 flex-wrap">
                        <button type="button" aria-label="button"
                            class="ti-btn ti-btn-soft-primary btn-wave flex-auto"><i
                                class="ri-phone-line me-2 align-middle"></i>Call</button>
                        <button type="button" aria-label="button"
                            class="ti-btn bg-primarytint1color/10 text-primarytint1color btn-wave flex-auto"><i
                                class="ri-video-add-line me-2 align-middle"></i>Video Call</button>
                        <button type="button" aria-label="button"
                            class="ti-btn bg-info/10 text-info btn-wave flex-auto"><i
                                class="ri-chat-1-line me-2 align-middle"></i>Message</button>
                    </p>
                </div>
                <div class="mb-4 pt-2">
                    <div class="font-medium mb-4">Shared Files
                        <span class="badge bg-primarytint2color ms-1 rounded-full">17</span>
                        <span class="float-end text-[11px]"><a href="javascript:void(0);"
                                class="text-xs text-textmuted dark:text-textmuted/50"> View All<i
                                    class="ti ti-arrow-narrow-right ms-1"></i> </a></span>
                    </div>
                    <ul class="shared-files list-none">
                        <li>
                            <div class="flex items-center">
                                <div class="me-2 bg-primary/10 !rounded-full">
                                    <span class="shared-file-icon">
                                        <i class="ti ti-file-text text-primary"></i>
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <p class="text-xs font-medium mb-0">notification.pdf</p>
                                    <p class="mb-0 text-textmuted dark:text-textmuted/50 text-[11px]">15,Dec 2024 -
                                        12:45PM</p>
                                </div>
                                <div class="text-lg">
                                    <a aria-label="anchor" href="javascript:void(0)"><i
                                            class="ri-download-2-line text-textmuted dark:text-textmuted/50"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <div class="me-2 bg-secondary/10 !rounded-full">
                                    <span class="shared-file-icon">
                                        <i class="ri-image-line text-secondary"></i>
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <p class="text-xs font-medium mb-0">Image_file1.Jpg</p>
                                    <p class="mb-0 text-textmuted dark:text-textmuted/50 text-[11px]">03,Oct 2024 -
                                        03:20AM</p>
                                </div>
                                <div class="text-lg">
                                    <a aria-label="anchor" href="javascript:void(0)"><i
                                            class="ri-download-2-line text-textmuted dark:text-textmuted/50"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <div class="me-2 bg-success/10 !rounded-full">
                                    <span class="shared-file-icon">
                                        <i class="ri-image-line text-success"></i>
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <p class="text-xs font-medium mb-0">Imagefile_12.Jpg</p>
                                    <p class="mb-0 text-textmuted dark:text-textmuted/50 text-[11px]">19,Oct 2024 -
                                        01:23PM</p>
                                </div>
                                <div class="text-lg">
                                    <a aria-label="anchor" href="javascript:void(0)"><i
                                            class="ri-download-2-line text-textmuted dark:text-textmuted/50"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <div class="me-2 bg-orangemain/10 !rounded-full">
                                    <span class="shared-file-icon">
                                        <i class="ri-video-line text-orangemain"></i>
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <p class="text-xs font-medium mb-0">Video-rec-20-10-2021.MP4</p>
                                    <p class="mb-0 text-textmuted dark:text-textmuted/50 text-[11px]">13,May 2024 -
                                        16:25AM</p>
                                </div>
                                <div class="text-lg">
                                    <a href="javascript:void(0)"><i
                                            class="ri-download-2-line text-textmuted dark:text-textmuted/50"></i></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="mb-0 pt-2">
                    <div class="font-medium mb-4">Photos & Media
                        <span class="badge bg-primarytint3color ms-1 rounded-full">15</span>
                        <span class="float-end text-[11px]"><a href="javascript:void(0);"
                                class="text-xs text-textmuted dark:text-textmuted/50"> View All<i
                                    class="ti ti-arrow-narrow-right ms-1"></i> </a></span>
                    </div>
                    <div class="grid grid-cols-12 gap-x-6 gap-y-3">
                        <div class="lg:col-span-4 md:col-span-4 sm:col-span-6 col-12">
                            <a href="/assets/images/media/media-40.jpg" class="glightbox box mb-0"
                                data-gallery="gallery1">
                                <img src="/assets/images/media/media-40.jpg" alt="image">
                            </a>
                        </div>
                        <div class="lg:col-span-4 md:col-span-4 sm:col-span-6 col-12">
                            <a href="/assets/images/media/media-41.jpg" class="glightbox box mb-0"
                                data-gallery="gallery1">
                                <img src="/assets/images/media/media-41.jpg" alt="image">
                            </a>
                        </div>
                        <div class="lg:col-span-4 md:col-span-4 sm:col-span-6 col-span-12">
                            <a href="/assets/images/media/media-42.jpg" class="glightbox box mb-0"
                                data-gallery="gallery1">
                                <img src="/assets/images/media/media-42.jpg" alt="image">
                            </a>
                        </div>
                        <div class="lg:col-span-4 md:col-span-4 sm:col-span-6 col-span-12">
                            <a href="/assets/images/media/media-43.jpg" class="glightbox box mb-0"
                                data-gallery="gallery1">
                                <img src="/assets/images/media/media-43.jpg" alt="image">
                            </a>
                        </div>
                        <div class="lg:col-span-4 md:col-span-4 sm:col-span-6 col-span-12">
                            <a href="/assets/images/media/media-44.jpg" class="glightbox box mb-0"
                                data-gallery="gallery1">
                                <img src="/assets/images/media/media-44.jpg" alt="image">
                            </a>
                        </div>
                        <div class="lg:col-span-4 md:col-span-4 sm:col-span-6 col-span-12">
                            <a href="/assets/images/media/media-45.jpg" class="glightbox box mb-0"
                                data-gallery="gallery1">
                                <img src="/assets/images/media/media-45.jpg" alt="image">
                            </a>
                        </div>
                        <div class="lg:col-span-4 md:col-span-4 sm:col-span-6 col-span-12">
                            <a href="/assets/images/media/media-46.jpg" class="glightbox box mb-0"
                                data-gallery="gallery1">
                                <img src="/assets/images/media/media-46.jpg" alt="image">
                            </a>
                        </div>
                        <div class="lg:col-span-4 md:col-span-4 sm:col-span-6 col-span-12">
                            <a href="/assets/images/media/media-60.jpg" class="glightbox box mb-0"
                                data-gallery="gallery1">
                                <img src="/assets/images/media/media-60.jpg" alt="image">
                            </a>
                        </div>
                        <div class="lg:col-span-4 md:col-span-4 sm:col-span-6 col-span-12">
                            <a href="/assets/images/media/media-61.jpg" class="glightbox box mb-0"
                                data-gallery="gallery1">
                                <img src="/assets/images/media/media-61.jpg" alt="image">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Popper JS -->
    <script src="/assets/libs/@popperjs/core/umd/popper.min.js"></script>

    <!-- Preline JS -->
    <script src="/assets/libs/preline/preline.js"></script>

    <!-- Defaultmenu JS -->
    <script src="/assets/js/defaultmenu.min.js"></script>

    <!-- Node Waves JS-->
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <!-- Sticky JS -->
    <script src="/assets/js/sticky.js"></script>

    <!-- Simplebar JS -->
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/js/simplebar.js"></script>

    <!-- Auto Complete JS -->
    <script src="/assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script>

    <!-- Color Picker JS -->
    <script src="/assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

    <!-- Date & Time Picker JS -->
    <script src="/assets/libs/flatpickr/flatpickr.min.js"></script>

    <!-- Emojji Picker JS -->
    <script src="/assets/libs/fg-emoji-picker/fgEmojiPicker.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new FgEmojiPicker({
                trigger: ['.emoji-picker'],
                position: ['bottom', 'right'],
                preFetch: true,
                dir: '/assets/vendor/', // Ensure correct path
                insertInto: document.querySelector('#message-input')
            });
        });
    </script>

    <!-- Gallery JS -->
    <script src="/assets/libs/glightbox/js/glightbox.min.js"></script>

    <!-- Chat JS -->
    <script src="/assets/js/chat.js"></script>

    <!-- Custom JS -->
    <script src="/assets/js/custom.js"></script>

</x-app-layout>
