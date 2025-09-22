<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Main Theme Js -->
    <script src="/assets/js/main.js"></script>

    <!-- Style Css -->
    <link href="/assets/css/styles.css" rel="stylesheet" >

    <!-- Node Waves Css -->
    <link href="/assets/libs/node-waves/waves.min.css" rel="stylesheet" > 

    <!-- Simplebar Css -->
    <link href="/assets/libs/simplebar/simplebar.min.css" rel="stylesheet" >
    
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="/assets/libs/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="/assets/libs/@simonwep/pickr/themes/nano.min.css">

    <!-- Choices Css -->
    <link rel="stylesheet" href="/assets/libs/choices.js/public/assets/styles/choices.min.css">

    <!-- FlatPickr CSS -->
    <link rel="stylesheet" href="/assets/libs/flatpickr/flatpickr.min.css">

    <!-- Auto Complete CSS -->
    <link rel="stylesheet" href="/assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">
    <!-- Dropzone Css -->
<link rel="stylesheet" href="/assets/libs/dropzone/dropzone.css">

  

            <div class="grid grid-cols-12 gap-x-6">
                <div class="xxl:col-span-3 col-span-12">
                    <div class="grid grid-cols-12 gap-x-6">
                        <div class="xl:col-span-12 col-span-12">
                            <div class="box">
                                <div
                                    class="flex p-4 flex-wrap gap-2 items-center justify-between border-b border-defaultborder dark:border-defaultborder/10">
                                    <div class="flex-auto">
                                        <h6 class="font-medium mb-0">File Manager</h6>
                                    </div>
                                </div>
                                <div class="box-body !pt-0 !p-3">
                                    <ul class="list-none files-main-nav" id="files-main-nav">
                                        <li class="px-0 pt-0">
                                            <span class="text-xs text-textmuted dark:text-textmuted/50">My
                                                Files</span>
                                        </li>
                                        <li class="active files-type">
                                            <a href="javascript:void(0)">
                                                <div class="flex items-center">
                                                    <div class="me-2">
                                                        <i class="ri-folder-2-line text-[1rem]"></i>
                                                    </div>
                                                    <span class="flex-auto text-nowrap">
                                                        All Files
                                                    </span>
                                                    <span class="badge bg-primary">412</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="files-type">
                                            <a href="javascript:void(0)">
                                                <div class="flex items-center">
                                                    <div class="me-2">
                                                        <i class="ri-history-fill text-[1rem]"></i>
                                                    </div>
                                                    <span class="flex-auto text-nowrap">
                                                        Recent Files
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="files-type">
                                            <a href="javascript:void(0)">
                                                <div class="flex items-center">
                                                    <div class="me-2">
                                                        <i class="ri-share-forward-line text-[1rem]"></i>
                                                    </div>
                                                    <span class="flex-auto text-nowrap">
                                                        Shared Files
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="files-type">
                                            <a href="javascript:void(0)">
                                                <div class="flex items-center">
                                                    <div class="me-2">
                                                        <i class="ri-star-s-line text-[1rem]"></i>
                                                    </div>
                                                    <span class="flex-auto text-nowrap">
                                                        favourites
                                                    </span>
                                                    <span class="badge bg-primarytint1color">02</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="files-type">
                                            <a href="javascript:void(0)">
                                                <div class="flex items-center">
                                                    <div class="me-2">
                                                        <i class="ri-delete-bin-line text-[1rem]"></i>
                                                    </div>
                                                    <span class="flex-auto text-nowrap">
                                                        Recycle Bin
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <div class="flex items-center">
                                                    <div class="me-2">
                                                        <i class="ri-settings-3-line text-[1rem]"></i>
                                                    </div>
                                                    <span class="flex-auto text-nowrap">
                                                        Settings
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <div class="flex items-center">
                                                    <div class="me-2">
                                                        <i class="ri-questionnaire-line text-[1rem]"></i>
                                                    </div>
                                                    <span class="flex-auto text-nowrap">
                                                        Help Center
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <div class="flex items-center">
                                                    <div class="me-2">
                                                        <i class="ri-folder-line text-[1rem]"></i>
                                                    </div>
                                                    <span class="flex-auto text-nowrap">
                                                        Version
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="xl:col-span-12 col-span-12">
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-6 col-span-12">
                    <div class="box overflow-hidden">
                        <div class="box-body p-0">
                            <div class="file-manager-folders">
                                <div
                                    class="flex p-4 flex-wrap gap-2 items-center justify-between border-b border-defaultborder dark:border-defaultborder/10">
                                    <div class="flex-auto">
                                        <h6 class="font-medium mb-0">All Folders</h6>
                                    </div>
                                    <div class="flex gap-2 lg:nowrap flex-wrap justify-content-sm-end sm:w-[80%]">
                                        <div class="input-group sm:!w-[50%]">
                                            <input type="text" class="form-control !border-s"
                                                placeholder="Search File" aria-describedby="button-addon01">
                                            <button class="ti-btn ti-btn-soft-primary !m-0" type="button"
                                                id="button-addon01"><i class="ri-search-line"></i></button>
                                        </div>
                                        <button
                                            class="ti-btn ti-btn-primary !m-0 btn-w-md flex items-center justify-center btn-wave waves-light text-nowrap"
                                            data-hs-overlay="#create-folder">
                                            <i class="ri-add-circle-line align-middle"></i>Create Folder
                                        </button>
                                        <div id="create-folder"
                                            class="hs-overlay hidden size-full rounded-md fixed top-0 start-0 overflow-x-hidden overflow-y-auto pointer-events-none ti-modal">
                                            <div
                                                class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                                                <div class="ti-modal-content flex-grow">
                                                    <div class="ti-modal-header">
                                                        <h6 class="modal-title text-[1rem] font-semibold"
                                                            id="staticBackdropLabel1">Modal title
                                                        </h6>
                                                        <button type="button"
                                                            class="hs-dropdown-toggle ti-modal-close-btn"
                                                            data-hs-overlay="#create-folder">
                                                            <span class="sr-only">Close</span>
                                                            <svg class="w-3.5 h-3.5" width="8" height="8"
                                                                viewBox="0 0 8 8" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="ti-modal-body">
                                                        <label for="create-folder1" class="form-label">Folder
                                                            Name</label>
                                                        <input type="text" class="form-control"
                                                            id="create-folder1" placeholder="Folder Name">
                                                    </div>
                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                            class="hs-dropdown-toggle ti-btn ti-btn-light ti-btn-sm"
                                                            data-hs-overlay="#create-folder">
                                                            <i class="ri-close-fill"></i>
                                                        </button>
                                                        <a class="ti-btn ti-btn-success ti-btn-sm"
                                                            href="javascript:void(0);">
                                                            Create File
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button
                                            class="ti-btn !m-0 ti-btn-soft-primary1 btn-w-md flex items-center justify-center btn-wave waves-light"
                                            data-hs-overlay="#create-file">
                                            <i class="ri-add-circle-line align-middle"></i>Create File
                                        </button>
                                        <div id="create-file"
                                            class="hs-overlay hidden size-full rounded-md fixed top-0 start-0 overflow-x-hidden overflow-y-auto pointer-events-none ti-modal">
                                            <div
                                                class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                                                <div class="ti-modal-content flex-grow">
                                                    <div class="ti-modal-header">
                                                        <h6 class="modal-title text-[1rem] font-semibold"
                                                            id="staticBackdropLabel2">Modal title
                                                        </h6>
                                                        <button type="button"
                                                            class="hs-dropdown-toggle ti-modal-close-btn"
                                                            data-hs-overlay="#create-file">
                                                            <span class="sr-only">Close</span>
                                                            <svg class="w-3.5 h-3.5" width="8" height="8"
                                                                viewBox="0 0 8 8" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="ti-modal-body">
                                                        <label for="create-file1" class="form-label">File
                                                            Name</label>
                                                        <input type="text" class="form-control" id="create-file1"
                                                            placeholder="File Name">
                                                    </div>
                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                            class="hs-dropdown-toggle ti-btn ti-btn-light ti-btn-sm"
                                                            data-hs-overlay="#create-file">
                                                            <i class="ri-close-fill"></i>
                                                        </button>
                                                        <a class="ti-btn ti-btn-success ti-btn-sm"
                                                            href="javascript:void(0);">
                                                            Create File
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 file-folders-container">
                                    <div class="grid grid-cols-12 sm:gap-x-6 mb-2">
                                        <div
                                            class="xxl:col-span-3 xl:col-span-6 lg:col-span-6 md:col-span-6 col-span-12">
                                            <div
                                                class="box !shadow-none border border-defaultborder dark:border-defaultborder/10">
                                                <div class="box-body">
                                                    <div
                                                        class="mb-6 folder-svg-container flex flex-wrap justify-between items-top">
                                                        <div class="avatar">
                                                            <img src="/assets/images/media/file-manager/1.png"
                                                                alt="" class="img-fluid">
                                                        </div>
                                                        <div>
                                                            <div class="ti-dropdown hs-dropdown">
                                                                <a href="javascript:void(0);"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i
                                                                        class="ri-more-fill font-semibold text-textmuted dark:text-textmuted/50"></i>
                                                                </a>
                                                                <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Delete</a>
                                                                    </li>
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Rename</a>
                                                                    </li>
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Hide
                                                                            Folder</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="text-[14px] font-medium mb-1 leading-none">
                                                        <a href="javascript:void(0);">Invoices</a>
                                                    </p>
                                                    <div class="flex items-center justify-between flex-wrap">
                                                        <div>
                                                            <span
                                                                class="text-textmuted dark:text-textmuted/50 text-xs">
                                                                345 Files
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="text-defaulttextcolor font-medium">
                                                                124.16MB
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="xxl:col-span-3 xl:col-span-6 lg:col-span-6 md:col-span-6 col-span-12">
                                            <div
                                                class="box !shadow-none border border-defaultborder dark:border-defaultborder/10">
                                                <div class="box-body">
                                                    <div
                                                        class="mb-6 folder-svg-container flex flex-wrap justify-between items-top">
                                                        <div class="avatar">
                                                            <img src="/assets/images/media/file-manager/1.png"
                                                                alt="" class="img-fluid">
                                                        </div>
                                                        <div>
                                                            <div class="ti-dropdown hs-dropdown">
                                                                <a href="javascript:void(0);"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i
                                                                        class="ri-more-fill font-semibold text-textmuted dark:text-textmuted/50"></i>
                                                                </a>
                                                                <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Delete</a>
                                                                    </li>
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Rename</a>
                                                                    </li>
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Hide
                                                                            Folder</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="text-[14px] font-medium mb-1 leading-none">
                                                        <a href="javascript:void(0);">Contracts</a>
                                                    </p>
                                                    <div class="flex items-center justify-between flex-wrap">
                                                        <div>
                                                            <span
                                                                class="text-textmuted dark:text-textmuted/50 text-xs">
                                                                45 Files
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="text-defaulttextcolor font-medium">
                                                                451.15KB
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="xxl:col-span-3 xl:col-span-6 lg:col-span-6 md:col-span-6 col-span-12">
                                            <div
                                                class="box !shadow-none border border-defaultborder dark:border-defaultborder/10">
                                                <div class="box-body">
                                                    <div
                                                        class="mb-6 folder-svg-container flex flex-wrap justify-between items-top">
                                                        <div class="avatar">
                                                            <img src="/assets/images/media/file-manager/1.png"
                                                                alt="" class="img-fluid">
                                                        </div>
                                                        <div>
                                                            <div class="ti-dropdown hs-dropdown">
                                                                <a href="javascript:void(0);"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i
                                                                        class="ri-more-fill font-semibold text-textmuted dark:text-textmuted/50"></i>
                                                                </a>
                                                                <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Delete</a>
                                                                    </li>
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Rename</a>
                                                                    </li>
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Hide
                                                                            Folder</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="text-[14px] font-medium mb-1 leading-none">
                                                        <a href="javascript:void(0);">Podcast</a>
                                                    </p>
                                                    <div class="flex items-center justify-between flex-wrap">
                                                        <div>
                                                            <span
                                                                class="text-textmuted dark:text-textmuted/50 text-xs">
                                                                568 Files
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="text-defaulttextcolor font-medium">
                                                                1.45GB
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="xxl:col-span-3 xl:col-span-6 lg:col-span-6 md:col-span-6 col-span-12">
                                            <div
                                                class="box !shadow-none border border-defaultborder dark:border-defaultborder/10">
                                                <div class="box-body">
                                                    <div
                                                        class="mb-6 folder-svg-container flex flex-wrap justify-between items-top">
                                                        <div class="avatar">
                                                            <img src="/assets/images/media/file-manager/1.png"
                                                                alt="" class="img-fluid">
                                                        </div>
                                                        <div>
                                                            <div class="ti-dropdown hs-dropdown">
                                                                <a href="javascript:void(0);"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i
                                                                        class="ri-more-fill font-semibold text-textmuted dark:text-textmuted/50"></i>
                                                                </a>
                                                                <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Delete</a>
                                                                    </li>
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Rename</a>
                                                                    </li>
                                                                    <li><a class="ti-dropdown-item"
                                                                            href="javascript:void(0);">Hide
                                                                            Folder</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="text-[14px] font-medium mb-1 leading-none">
                                                        <a href="javascript:void(0);">Documents</a>
                                                    </p>
                                                    <div class="flex items-center justify-between flex-wrap">
                                                        <div>
                                                            <span
                                                                class="text-textmuted dark:text-textmuted/50 text-xs">
                                                                247 Files
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="text-defaulttextcolor font-medium">
                                                                15.88GB
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex mb-4 items-center justify-between">
                                        <p class="mb-0 font-medium text-[14px]">Recent Files</p>
                                        <a href="javascript:void(0);"
                                            class="text-xs text-textmuted dark:text-textmuted/50 font-medium"> View
                                            All<i class="ti ti-arrow-narrow-right ms-1"></i> </a>
                                    </div>
                                    <div class="grid grid-cols-12 gap-x-6">
                                        <div class="xl:col-span-12 col-span-12">
                                            <div
                                                class="table-responsive border border-defaultborder dark:border-defaultborder/10 border-b-0">
                                                <table
                                                    class="ti-custom-table ti-custom-table-head ti-custom-table-hover">
                                                    <thead>
                                                        <tr
                                                            class="border-b !border-defaultborder dark:!border-defaultborder/10">
                                                            <th scope="col">File Name</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Size</th>
                                                            <th scope="col">Date Modified</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="files-list">
                                                        <tr
                                                            class="border-b !border-defaultborder dark:!border-defaultborder/10">
                                                            <th scope="row">
                                                                <div class="flex items-center">
                                                                    <div class="me-0">
                                                                        <span
                                                                            class="avatar avatar-md !svg-primary !text-primary">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 256 256">
                                                                                <rect width="256" height="256"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M112,175.67V168a8,8,0,0,0-8-8H48a8,8,0,0,0-8,8v40a8,8,0,0,0,8,8h56a8,8,0,0,0,8-8v-8.82L144,216V160Z"
                                                                                    opacity="0.2" />
                                                                                <polyline
                                                                                    points="112 175.67 144 160 144 216 112 199.18"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <rect x="40" y="160" width="72"
                                                                                    height="56" rx="8"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <polygon
                                                                                    points="152 32 152 88 208 88 152 32"
                                                                                    opacity="0.2" />
                                                                                <polyline points="152 32 152 88 208 88"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <path
                                                                                    d="M176,224h24a8,8,0,0,0,8-8V88L152,32H56a8,8,0,0,0-8,8v88"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                    <div>
                                                                        <a href="javascript:void(0);"
                                                                            data-hs-overlay="#offcanvasRight">VIDEO_88745_KKI451.mp4</a>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <td>Videos</td>
                                                            <td>89MB</td>
                                                            <td>15,Aug 2024</td>
                                                            <td>
                                                                <div class="hstack gap-2 text-[15px]">
                                                                    <a href="javascript:void(0);"
                                                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary2"><i
                                                                            class="ri-eye-line"></i></a>
                                                                    <a href="javascript:void(0);"
                                                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary3"><i
                                                                            class="ri-delete-bin-line"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            class="border-b !border-defaultborder dark:!border-defaultborder/10">
                                                            <th scope="row">
                                                                <div class="flex items-center">
                                                                    <div class="me-0">
                                                                        <span
                                                                            class="avatar avatar-md !svg-primarytint1color !text-primarytint1color">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 256 256">
                                                                                <rect width="256" height="256"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M112,175.67V168a8,8,0,0,0-8-8H48a8,8,0,0,0-8,8v40a8,8,0,0,0,8,8h56a8,8,0,0,0,8-8v-8.82L144,216V160Z"
                                                                                    opacity="0.2" />
                                                                                <polyline
                                                                                    points="112 175.67 144 160 144 216 112 199.18"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <rect x="40" y="160" width="72"
                                                                                    height="56" rx="8"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <polygon
                                                                                    points="152 32 152 88 208 88 152 32"
                                                                                    opacity="0.2" />
                                                                                <polyline points="152 32 152 88 208 88"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <path
                                                                                    d="M176,224h24a8,8,0,0,0,8-8V88L152,32H56a8,8,0,0,0-8,8v88"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                    <div>
                                                                        <a href="javascript:void(0);"
                                                                            data-hs-overlay="#offcanvasRight">VID-14211110-AKP823.mp4</a>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <td>Videos</td>
                                                            <td>12MB</td>
                                                            <td>18,May 2024</td>
                                                            <td>
                                                                <div class="hstack gap-2 text-[15px]">
                                                                    <a href="javascript:void(0);"
                                                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary2"><i
                                                                            class="ri-eye-line"></i></a>
                                                                    <a href="javascript:void(0);"
                                                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary3"><i
                                                                            class="ri-delete-bin-line"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            class="table-active border-b !border-defaultborder dark:!border-defaultborder/10 bg-light">
                                                            <th scope="row">
                                                                <div class="flex items-center">
                                                                    <div class="me-0">
                                                                        <span
                                                                            class="avatar avatar-md !svg-primarytint2color !text-primarytint2color">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 256 256">
                                                                                <rect width="256" height="256"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M168,192h16a20,20,0,0,0,0-40H168v56"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <line x1="128" y1="152"
                                                                                    x2="128" y2="208"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <polyline
                                                                                    points="56 152 88 152 56 208 88 208"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <polygon
                                                                                    points="152 32 152 88 208 88 152 32"
                                                                                    opacity="0.2" />
                                                                                <path
                                                                                    d="M48,112V40a8,8,0,0,1,8-8h96l56,56v24"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <polyline points="152 32 152 88 208 88"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                    <div>
                                                                        <a href="javascript:void(0);"
                                                                            data-hs-overlay="#offcanvasRight">AC-20241.zip</a>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <td>Archives</td>
                                                            <td>564KB</td>
                                                            <td>06,Mar 2024</td>
                                                            <td>
                                                                <div class="hstack gap-2 text-[15px]">
                                                                    <a href="javascript:void(0);"
                                                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary2"><i
                                                                            class="ri-eye-line"></i></a>
                                                                    <a href="javascript:void(0);"
                                                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary3"><i
                                                                            class="ri-delete-bin-line"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            class="border-b !border-defaultborder dark:!border-defaultborder/10">
                                                            <th scope="row">
                                                                <div class="flex items-center">
                                                                    <div class="me-0">
                                                                        <span
                                                                            class="avatar avatar-md !svg-primarytint3color !text-primarytint3color">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 256 256">
                                                                                <rect width="256" height="256"
                                                                                    fill="none" />
                                                                                <polygon
                                                                                    points="48 200 48 160 72 160 96 136 96 224 72 200 48 200"
                                                                                    opacity="0.2" />
                                                                                <polygon
                                                                                    points="48 200 48 160 72 160 96 136 96 224 72 200 48 200"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <path d="M128,152a32.5,32.5,0,0,1,0,56"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <polygon
                                                                                    points="152 32 152 88 208 88 152 32"
                                                                                    opacity="0.2" />
                                                                                <polyline points="152 32 152 88 208 88"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <path
                                                                                    d="M168,224h32a8,8,0,0,0,8-8V88L152,32H56a8,8,0,0,0-8,8v80"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                    <div>
                                                                        <a href="javascript:void(0);"
                                                                            data-hs-overlay="#offcanvasRight">AUD__145_24152.mp3</a>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <td>Archives</td>
                                                            <td>264KB</td>
                                                            <td>26,Apr 2024</td>
                                                            <td>
                                                                <div class="hstack gap-2 text-[15px]">
                                                                    <a href="javascript:void(0);"
                                                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary2"><i
                                                                            class="ri-eye-line"></i></a>
                                                                    <a href="javascript:void(0);"
                                                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary3"><i
                                                                            class="ri-delete-bin-line"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            class="!border-b !border-defaultborder dark:!border-defaultborder/10">
                                                            <th scope="row">
                                                                <div class="flex items-center">
                                                                    <div class="me-0">
                                                                        <span
                                                                            class="avatar avatar-md !svg-secondary !text-secondary">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 256 256">
                                                                                <rect width="256" height="256"
                                                                                    fill="none" />
                                                                                <polygon
                                                                                    points="152 32 152 88 208 88 152 32"
                                                                                    opacity="0.2" />
                                                                                <path
                                                                                    d="M48,112V40a8,8,0,0,1,8-8h96l56,56v24"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <polyline points="152 32 152 88 208 88"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <polyline
                                                                                    points="216 152 184 152 184 208"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <line x1="208" y1="184"
                                                                                    x2="184" y2="184"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <path
                                                                                    d="M48,192H64a20,20,0,0,0,0-40H48v56"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                                <path
                                                                                    d="M112,152v56h16a28,28,0,0,0,0-56Z"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="16" />
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                    <div>
                                                                        <a href="javascript:void(0);"
                                                                            data-hs-overlay="#offcanvasRight">Document-file.pdf</a>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <td>Documents</td>
                                                            <td>2.6MB</td>
                                                            <td>07,Feb 2024</td>
                                                            <td>
                                                                <div class="hstack gap-2 text-[15px]">
                                                                    <a href="javascript:void(0);"
                                                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary2"><i
                                                                            class="ri-eye-line"></i></a>
                                                                    <a href="javascript:void(0);"
                                                                        class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary3"><i
                                                                            class="ri-delete-bin-line"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <nav aria-label="Page navigation"
                                                    class="pagination-style-2 border-y px-4 py-3 border-t-0 flex justify-end border-defaultborder dark:border-defaultborder/10">
                                                    <ul class="ti-pagination mb-0 flex-wrap">
                                                        <li class="page-item disabled">
                                                            <a class="page-link" href="javascript:void(0);">
                                                                Prev
                                                            </a>
                                                        </li>
                                                        <li class="page-item "><a class="page-link active"
                                                                href="javascript:void(0);">1</a></li>
                                                        <li class="page-item"><a class="page-link"
                                                                href="javascript:void(0);">2</a></li>
                                                        <li class="page-item">
                                                            <a class="page-link !text-primary"
                                                                href="javascript:void(0);">
                                                                next
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-3 col-span-12">
                    <div class="box overflow-hidden">
                        <div class="box-body">
                            <div class="flex items-start gap-4">
                                <div>
                                    <span class="avatar avatar-md bg-secondary/10 !text-secondary">
                                        <i class="ri-hard-drive-2-fill text-[1rem]"></i>
                                    </span>
                                </div>
                                <div class="flex-auto">
                                    <div class=" mb-3"> All Folders
                                        <p class="mb-0"><span class="font-bold text-[14px]">68.12GB</span> Used</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer p-0">
                            <div class="m-3 mb-0">
                                <span class="text-xs text-textmuted dark:text-textmuted/50">Storage Details</span>
                            </div>
                            <ul class="ti-list-group list-group-flush !border-0">
                                <li class="ti-list-group-item">
                                    <div class="flex items-center gap-4">
                                        <div class="main-card-icon primary">
                                            <div class="avatar avatar-lg bg-primary/10 border border-primary/10">
                                                <div class="avatar avatar-sm !text-primary">
                                                    <i class="ti ti-photo text-xl"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-auto">
                                            <span class="font-medium">Media</span>
                                            <span class="text-textmuted dark:text-textmuted/50 text-xs block">3,145
                                                files</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-primary mb-0 text-[14px]">45GB</span>
                                        </div>
                                    </div>
                                    <div class="progress progress-md p-1 bg-primary/10 mt-3" role="progressbar"
                                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            style="width: 90%"></div>
                                    </div>
                                </li>
                                <li class="ti-list-group-item">
                                    <div class="flex items-center gap-4">
                                        <div class="main-card-icon primary1">
                                            <div
                                                class="avatar avatar-lg bg-primarytint1color/10 border border-primarytint1color/10">
                                                <div class="avatar avatar-sm !text-primarytint1color">
                                                    <i class="ti ti-download text-xl"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-auto">
                                            <span class="font-medium">Downloads</span>
                                            <span class="text-textmuted dark:text-textmuted/50 text-xs block">568
                                                files</span>
                                        </div>
                                        <div>
                                            <span
                                                class="font-medium text-primarytint1color mb-0 text-[14px]">66GB</span>
                                        </div>
                                    </div>
                                    <div class="progress progress-md p-1 bg-primarytint1color/10 mt-3"
                                        role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-striped bg-primarytint1color progress-bar-animated"
                                            style="width: 86%"></div>
                                    </div>
                                </li>
                                <li class="ti-list-group-item">
                                    <div class="flex items-center gap-4">
                                        <div class="main-card-icon primary2">
                                            <div
                                                class="avatar avatar-lg bg-primarytint2color/10 border border-primarytint2color/10">
                                                <div class="avatar avatar-sm !text-primarytint2color">
                                                    <i class="ti ti-layout-grid text-xl"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-auto">
                                            <span class="font-medium">Apps</span>
                                            <span class="text-textmuted dark:text-textmuted/50 text-xs block">74
                                                files</span>
                                        </div>
                                        <div>
                                            <span
                                                class="font-medium text-primarytint2color mb-0 text-[14px]">55GB</span>
                                        </div>
                                    </div>
                                    <div class="progress progress-md p-1 bg-primarytint2color/10 mt-3"
                                        role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-striped bg-primarytint2color progress-bar-animated"
                                            style="width: 75%"></div>
                                    </div>
                                </li>
                                <li class="ti-list-group-item">
                                    <div class="flex items-center gap-4">
                                        <div class="main-card-icon primary3">
                                            <div
                                                class="avatar avatar-lg bg-primarytint3color/10 border border-primarytint3color/10">
                                                <div class="avatar avatar-sm !text-primarytint3color">
                                                    <i class="ti ti-file-description text-xl"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-auto">
                                            <span class="font-medium">Documents</span>
                                            <span class="text-textmuted dark:text-textmuted/50 text-xs block">1,441
                                                files</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-primary3 mb-0 text-[14px]">34GB </span>
                                        </div>
                                    </div>
                                    <div class="progress progress-md p-1 bg-primarytint3color/10 mt-3"
                                        role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-striped bg-primarytint3color progress-bar-animated"
                                            style="width: 80%"></div>
                                    </div>
                                    <ul class="mt-4">
                                        <li
                                            class="!p-4 border border-dashed border-defaultborder dark:border-defaultborder/10">
                                            <label class="form-label text-[11px]">Drop File here :</label>
                                            <form data-single="true" method="post" action="https://httpbin.org/post"
                                                class="dropzone !bg-light"></form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

   

    <div class="ti-offcanvas ti-offcanvas-right hs-overlay hidden" id="offcanvasRight">
        <div class="ti-offcanvas-body !p-0">
            <div class="selected-file-details">
                <div
                    class="flex p-4 items-center justify-between border-b border-defaultborder dark:border-defaultborder/10">
                    <div>
                        <h6 class="font-medium mb-0">File Details</h6>
                    </div>
                    <div class="flex items-center">
                        <div class="ti-dropdown hs-dropdown me-1">
                            <button
                                class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-primary btn-wave waves-light waves-effect waves-light"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                            </button>
                            <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                                <li><a class="ti-dropdown-item" href="javascript:void(0);">Share</a></li>
                                <li><a class="ti-dropdown-item" href="javascript:void(0);">Copy</a></li>
                                <li><a class="ti-dropdown-item" href="javascript:void(0);">Move</a></li>
                                <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                <li><a class="ti-dropdown-item" href="javascript:void(0);">Raname</a></li>
                            </ul>
                        </div>
                        <button type="button"
                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-outline-light btn-wave flex-shrink-0 p-0 transition-none text-gray-500 hover:text-gray-700 focus:ring-gray-400 focus:ring-offset-white text-textmuted dark:text-textmuted/50 dark:hover:text-white/80 dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                            data-hs-overlay="#offcanvasRight">
                            <span class="sr-only">Close modal</span>
                            <svg class="w-2.5 h-2.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="filemanager-file-details" id="filemanager-file-details">
                    <div
                        class="p-4 text-center border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                        <div class="file-details mb-3">
                            <img src="/assets/images/media/blog/9.jpg" alt="" class="!inline-flex">
                        </div>
                        <div>
                            <p class="mb-0 font-medium text-[1rem]">IMG-09123878-SPK734.jpeg</p>
                            <p class="mb-0 text-textmuted dark:text-textmuted/50 text-[10px]">422KB | 23,Nov 2024
                            </p>
                        </div>
                    </div>
                    <div class="p-4 border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                        <ul class="ti-list-group">
                            <li class="ti-list-group-item">
                                <div>
                                    <span class="font-medium">File Format : </span><span
                                        class="text-xs text-textmuted dark:text-textmuted/50">jpeg</span>
                                </div>
                            </li>
                            <li class="ti-list-group-item">
                                <div>
                                    <p class="font-medium mb-0">File Description : </p>
                                    <span class="text-xs text-textmuted dark:text-textmuted/50">This file contains 3
                                        folder Xintra.main & Xintra.premium & Xintra.featured and 42 images and
                                        layout styles are added in this update.</span>
                                </div>
                            </li>
                            <li class="ti-list-group-item">
                                <p class="font-medium mb-0">File Location : </p>
                                <span
                                    class="text-xs text-textmuted dark:text-textmuted/50">Device/Storage/Archives/IMG-09123878-SPK734.jpeg</span>
                            </li>
                        </ul>
                    </div>
                    <div class="p-4 border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                        <p class="mb-1 font-medium text-[14px]">Downloaded from :</p>
                        <a class="text-primary font-medium text-break"
                            href="https://themeforest.net/user/spruko/portfolio" target="_blank">
                            <u>https://themeforest.net/user/spruko/portfolio</u>
                        </a>
                    </div>
                    <div class="p-4">
                        <p class="mb-2 font-medium text-[14px]">Shared With :</p>
                        <a href="javascript:void(0);">
                            <div class="flex items-center p-2 mb-1">
                                <span class="avatar avatar-sm me-2 avatar-rounded">
                                    <img src="/assets/images/faces/1.jpg" alt="">
                                </span>
                                <span class="font-medium flex-auto">Akira Susan</span>
                                <span class="badge bg-success/10 text-success font-normal">28,Nov 2024</span>
                            </div>
                        </a>
                        <a href="javascript:void(0);">
                            <div class="flex items-center p-2 mb-1">
                                <span class="avatar avatar-sm me-2 avatar-rounded">
                                    <img src="/assets/images/faces/15.jpg" alt="">
                                </span>
                                <span class="font-medium flex-auto">Khalid Ahmad</span>
                                <span class="badge bg-success/10 text-success font-normal">16,Oct 2024</span>
                            </div>
                        </a>
                        <a href="javascript:void(0);">
                            <div class="flex items-center p-2 mb-1">
                                <span class="avatar avatar-sm me-2 avatar-rounded">
                                    <img src="/assets/images/faces/8.jpg" alt="">
                                </span>
                                <span class="font-medium flex-auto">Jeremiah Jackson</span>
                                <span class="badge bg-success/10 text-success font-normal">05,Dec 2024</span>
                            </div>
                        </a>
                        <a href="javascript:void(0);">
                            <div class="flex items-center p-2">
                                <span class="avatar avatar-sm me-2 avatar-rounded">
                                    <img src="/assets/images/faces/13.jpg" alt="">
                                </span>
                                <span class="font-medium flex-auto">Brigo Jhonson</span>
                                <span class="badge bg-success/10 text-success font-normal">26,Apr 2024</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Switch JS -->
    <script src="/assets/js/switch.js"></script>

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



    <!-- Custom-Switcher JS -->
    <script src="/assets/js/custom-switcher.min.js"></script>

    <!-- Apex Charts JS -->
    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Dropzone JS -->
    <script src="/assets/libs/dropzone/dropzone-min.js"></script>

    <!-- Internal File Manager JS -->
    <script src="/assets/js/file-manager.js"></script>

    <!-- Custom JS -->
    <script src="/assets/js/custom.js"></script>
</x-app-layout>
