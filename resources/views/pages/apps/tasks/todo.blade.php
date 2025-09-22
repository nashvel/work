<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Node Waves Css -->
    <link href="/assets/libs/node-waves/waves.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
    <link rel="stylesheet" href="/assets/libs/quill/quill.bubble.css">

    <link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css">


            <div class="grid grid-cols-12 gap-x-6">
                <div class="xl:col-span-3 col-span-12">
                    <div class="box">
                        <div class="box-header gap-4 items-center pb-3 border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                            <span class="avatar avatar-md bg-primary avatar-rounded"><i class="ri-file-list-3-line text-[1rem]"></i></span>
                            <div class="box-title">
                                To Do List
                                <span class="text-textmuted dark:text-textmuted/50 block text-xs"> Create new list</span>
                            </div>
                            <button class="ti-btn ti-btn-sm ti-btn-soft-primary1 ms-auto !rounded-full">
                                <i class="ri-add-line"></i>Add New List
                            </button>
                        </div>
                        <div class="box-body p-0">
                            <div class="p-4 task-navigation border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                                <ul class="list-none task-main-nav mb-0">
                                    <li class="px-0 pt-0">
                                        <span class="text-[11px] text-textmuted dark:text-textmuted/50 opacity-70 font-medium">General</span>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void(0);">
                                            <div class="flex items-center">
                                                <span class="me-2 leading-none">
                                                    <i class="ri-checkbox-multiple-line align-middle text-[14px]"></i>
                                                </span>
                                                <span class="flex-auto text-nowrap">
                                                    All Tasks
                                                </span>
                                                <span class="badge bg-info/10 text-info rounded-full">167</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="flex items-center">
                                                <span class="me-2 leading-none">
                                                    <i class="ri-checkbox-circle-line align-middle text-[14px] text-primary"></i>
                                                </span>
                                                <span class="flex-auto text-nowrap">
                                                    Completed
                                                </span>
                                                <span class="badge bg-primarytint1color/10 text-primarytint1color rounded-full">12</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="flex items-center">
                                                <span class="me-2 leading-none">
                                                    <i class="ri-calendar-line align-middle text-[14px] text-primary"></i>
                                                </span>
                                                <span class="flex-auto text-nowrap">
                                                    Today
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="flex items-center">
                                                <span class="me-2 leading-none">
                                                    <i class="ri-star-line text-primary align-middle text-[14px]"></i>
                                                </span>
                                                <span class="flex-auto text-nowrap">
                                                    Starred
                                                </span>
                                                <span class="badge bg-primarytint3color/10 text-primarytint3color rounded-full">04</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="flex items-center">
                                                <span class="me-2 leading-none">
                                                    <i class="ri-user-line text-primary align-middle text-[14px]"></i>
                                                </span>
                                                <span class="flex-auto text-nowrap">
                                                    Personal
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="flex items-center">
                                                <span class="me-2 leading-none">
                                                    <i class="ri-briefcase-line text-primary align-middle text-[14px]"></i>
                                                </span>
                                                <span class="flex-auto text-nowrap">
                                                    Work
                                                </span>
                                                <span class="badge bg-primarytint1color/10 text-primarytint1color rounded-full">03</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="flex items-center">
                                                <span class="me-2 leading-none">
                                                    <i class="ri-delete-bin-5-line text-primary align-middle text-[14px]"></i>
                                                </span>
                                                <span class="flex-auto text-nowrap">
                                                    Trash
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="list-none task-main-nav mb-0">
                                    <li class="px-0 pt-2 flex justify-between gap-2 items-center">
                                        <span class="text-[11px] text-textmuted dark:text-textmuted/50 opacity-70 font-medium">Work Space</span>
                                    </li>
                                    <li>
                                        <div class="flex items-center flex-wrap gap-2">
                                            <div><input class="form-check-input" type="checkbox" value="" aria-label="..."></div>
                                            <div>
                                                <a href="javascript:void(0);">
                                                    <span class="font-medium"> Project testing ...</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center flex-wrap gap-2">
                                            <div><input class="form-check-input" type="checkbox" value="" aria-label="..."></div>
                                            <div>
                                                <a href="javascript:void(0);">
                                                    <span class="font-medium">Bug Fixes and Issue Tracking..</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center flex-wrap gap-2">
                                            <div><input class="form-check-input" type="checkbox" value="" aria-label="..."></div>
                                            <div>
                                                <a href="javascript:void(0);">
                                                    <span class="font-medium">New Feature Development...</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center flex-wrap gap-2">
                                            <div><input class="form-check-input" type="checkbox" value="" aria-label="..."></div>
                                            <div>
                                                <a href="javascript:void(0);">
                                                    <span class="font-medium">Admin Template review...</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex items-center justify-between m-4 p-4 bg-primary/10 rounded-md border border-defaultborder dark:border-defaultborder/10 overflow-hidden todo-list-card">
                                <div>
                                    <div class="text-[18px] font-bold !text-primary">Tasks</div>
                                    <div class="mb-4 text-[15px] font-medium !text-primary">Today Completed</div>
                                    <h4 class="mb-0">3/28 Tasks</h4>
                                </div>
                                <div class="">
                                    <img src="../assets/images/media/media-66.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-9 col-span-12">
                   <div class="box">
                        <div class="box-header justify-between pb-3 border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                            <div class="grow"> 
                                <input class="form-control w-full" type="text" placeholder="Search Here" aria-label=".form-control-sm example"> 
                            </div> 
                            <div class="flex flex-wrap gap-2"> 
                                <div class="ti-dropdown hs-dropdown"> 
                                    <a href="javascript:void(0);" class="ti-btn bg-light btn-wave" data-bs-toggle="dropdown" aria-expanded="false"> Sort By<i class="ri-arrow-down-s-line align-middle ms-1 inline-block"></i> 
                                    </a> 
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu"> 
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);">New</a></li> 
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);">Popular</a></li> 
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);">Relevant</a></li> 
                                    </ul> 
                                </div> 
                            </div>
                            <button class="ti-btn ti-btn-primary ti-btn-sm ms-auto !m-0" data-hs-overlay="#addtask">
                                <i class="ri-add-circle-line"></i> Add New Task
                            </button>
                        </div>
                        <div class="box-body p-0 relative" id="todo-content">
                            <div>
                                <div class="table-responsive">
                                    <table class="ti-custom-table text-nowrap">
                                        <thead>
                                            <tr class="border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <th>
                                                    <input class="form-check-input check-all" type="checkbox" id="all-tasks" value="" aria-label="...">
                                                </th>
                                                <th class="todolist-handle-drag">

                                                </th>
                                                <th scope="col">Task Title</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Dead Line</th>
                                                <th scope="col">Priority</th>
                                                <th scope="col">Assigner</th>
                                                <th scope="col" class="todolist-progress">Progress</th>
                                                <th scope="col" class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="todo-drag">
                                            <tr class="todo-box border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="task-checkbox"><input class="form-check-input" type="checkbox" value="" aria-label="..."></td>
                                                <td>
                                                    <button class="ti-btn ti-btn-icon ti-btn-sm btn-wave bg-light todo-handle !mb-0">: :</button>
                                                </td>
                                                <td>
                                                    <span class="font-medium">Software Development Tasks</span>
                                                </td>
                                                <td>
                                                    <span class="font-medium text-primary"><i class="ri-circle-line font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>In Progress</span>
                                                </td>
                                                <td>
                                                    15-Jan-2024
                                                </td>
                                                <td>
                                                    <span class="badge bg-primarytint2color/10 text-primarytint2color">Medium</span>
                                                </td>
                                                <td class="text-center flex gap-2 flex-wrap items-center font-medium">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="../assets/images/faces/7.jpg" alt="">
                                                    </span>
                                                    Mehtha
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div class="progress progress-animate progress-xs w-full" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: 32%"></div>
                                                        </div>
                                                        <div class="ms-2">32%</div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="flex gap-2">
                                                        <a href="javascript:void(0);" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10 text-info !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="todo-btn ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="todo-box border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="task-checkbox"><input class="form-check-input" type="checkbox" value="" aria-label="..." checked=""></td>
                                                <td>
                                                    <button class="ti-btn ti-btn-icon ti-btn-sm btn-wave bg-light todo-handle !mb-0">: :</button>
                                                </td>
                                                <td>
                                                    <span class="font-medium">Bug Fixes and Issue Tracking</span>
                                                </td>
                                                <td>
                                                    <span class="font-medium text-primarytint2color"><i class="ri-circle-line font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>Not Started</span>
                                                </td>
                                                <td>
                                                    16-Jan-2024
                                                </td>
                                                <td>
                                                    <span class="badge bg-primarytint3color/10 text-primarytint3color">High</span>
                                                </td>
                                                <td class="text-center flex gap-2 flex-wrap items-center font-medium">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="../assets/images/faces/12.jpg" alt="">
                                                    </span>
                                                    Ranjeeth
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div class="progress progress-animate progress-xs w-full" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" style="width: 80%"></div>
                                                        </div>
                                                        <div class="ms-2">80%</div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="flex gap-2">
                                                        <a href="javascript:void(0);" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10 text-info !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="todo-btn ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="todo-box border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="task-checkbox"><input class="form-check-input" type="checkbox" value="" aria-label="..."></td>
                                                <td>
                                                    <button class="ti-btn ti-btn-icon ti-btn-sm btn-wave bg-light todo-handle !mb-0">: :</button>
                                                </td>
                                                <td>
                                                    <span class="font-medium">IT Infrastructure Upgrades</span>
                                                </td>
                                                <td>
                                                    <span class="font-medium text-primarytint2color"><i class="ri-circle-line font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>Not Started</span>
                                                </td>
                                                <td>
                                                   18-Feb-2024
                                                </td>
                                                <td>
                                                    <span class="badge bg-primarytint1color/10 text-primarytint1color">Low</span>
                                                </td>
                                                <td class="text-center flex gap-2 flex-wrap items-center font-medium">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="../assets/images/faces/8.jpg" alt="">
                                                    </span>
                                                    Vency
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div class="progress progress-animate progress-xs w-full" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-orange" style="width: 90%"></div>
                                                        </div>
                                                        <div class="ms-2">90%</div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="flex gap-2">
                                                        <a href="javascript:void(0);" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10 text-info !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="todo-btn ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="todo-box border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="task-checkbox"><input class="form-check-input" type="checkbox" value="" aria-label="..." checked=""></td>
                                                <td>
                                                    <button class="ti-btn ti-btn-icon ti-btn-sm btn-wave bg-light todo-handle !mb-0">: :</button>
                                                </td>
                                                <td>
                                                    <span class="font-medium">Network Configuration</span>
                                                </td>
                                                <td>
                                                    <span class="font-medium text-warning"><i class="ri-circle-line font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>Pending</span>
                                                </td>
                                                <td>
                                                    19-Feb-2024
                                                </td>
                                                <td>
                                                    <span class="badge bg-primarytint2color/10 text-primarytint2color">Medium</span>
                                                </td>
                                                <td class="text-center flex gap-2 flex-wrap items-center font-medium">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="../assets/images/faces/15.jpg" alt="">
                                                    </span>
                                                    Cimen Sobs
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div class="progress progress-animate progress-xs w-full" role="progressbar" aria-valuenow="69" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width: 69%"></div>
                                                        </div>
                                                        <div class="ms-2">69%</div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="flex gap-2">
                                                        <a href="javascript:void(0);" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10 text-info !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="todo-btn ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="todo-box border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="task-checkbox"><input class="form-check-input" type="checkbox" value="" aria-label="..." checked=""></td>
                                                <td>
                                                    <button class="ti-btn ti-btn-icon ti-btn-sm btn-wave bg-light todo-handle !mb-0">: :</button>
                                                </td>
                                                <td>
                                                    <span class="font-medium">Backup and Recovery Report</span>
                                                </td>
                                                <td>
                                                    <span class="font-medium text-primarytint2color"><i class="ri-circle-line font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>Not Started</span>
                                                </td>
                                                <td>
                                                    21-Feb-2024
                                                </td>
                                                <td>
                                                    <span class="badge bg-primarytint3color/10 text-primarytint3color">High</span>
                                                </td>
                                                <td class="text-center flex gap-2 flex-wrap items-center font-medium">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="../assets/images/faces/14.jpg" alt="">
                                                    </span>
                                                    Dhruv Dany
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div class="progress progress-animate progress-xs w-full" role="progressbar" aria-valuenow="96" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width: 96%"></div>
                                                        </div>
                                                        <div class="ms-2">96%</div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="flex gap-2">
                                                        <a href="javascript:void(0);" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10 text-info !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="todo-btn ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="todo-box border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="task-checkbox"><input class="form-check-input" type="checkbox" value="" aria-label="..."></td>
                                                <td>
                                                    <button class="ti-btn ti-btn-icon ti-btn-sm btn-wave bg-light todo-handle !mb-0">: :</button>
                                                </td>
                                                <td>
                                                    <span class="font-medium">User Account Management</span>
                                                </td>
                                                <td>
                                                    <span class="font-medium text-primary"><i class="ri-circle-line font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>In Progress</span>
                                                </td>
                                                <td>
                                                   24-Feb-2024
                                                </td>
                                                <td>
                                                    <span class="badge bg-primarytint1color/10 text-primarytint1color">Low</span>
                                                </td>
                                                <td class="text-center flex gap-2 flex-wrap items-center font-medium">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="../assets/images/faces/11.jpg" alt="">
                                                    </span>
                                                    Rony Parker
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div class="progress progress-animate progress-xs w-full" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 88%"></div>
                                                        </div>
                                                        <div class="ms-2">88%</div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="flex gap-2">
                                                        <a href="javascript:void(0);" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10 text-info !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="todo-btn ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="todo-box border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="task-checkbox"><input class="form-check-input" type="checkbox" value="" aria-label="..." checked=""></td>
                                                <td>
                                                    <button class="ti-btn ti-btn-icon ti-btn-sm btn-wave bg-light todo-handle !mb-0">: :</button>
                                                </td>
                                                <td>
                                                    <span class="font-medium">Deployment Schedule</span>
                                                </td>
                                                <td>
                                                    <span class="font-medium text-primarytint2color"><i class="ri-circle-line font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>Not Started</span>
                                                </td>
                                                <td>
                                                    27-Feb-2024
                                                </td>
                                                <td>
                                                    <span class="badge bg-primarytint3color/10 text-primarytint3color">High</span>
                                                </td>
                                                <td class="text-center flex gap-2 flex-wrap items-center font-medium">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="../assets/images/faces/4.jpg" alt="">
                                                    </span>
                                                    Monjitha
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div class="progress progress-animate progress-xs w-full" role="progressbar" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-teal" style="width: 36%"></div>
                                                        </div>
                                                        <div class="ms-2">36%</div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="flex gap-2">
                                                        <a href="javascript:void(0);" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10 text-info !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="todo-btn ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="todo-box border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="task-checkbox"><input class="form-check-input" type="checkbox" value="" aria-label="..."></td>
                                                <td>
                                                    <button class="ti-btn ti-btn-icon ti-btn-sm btn-wave bg-light todo-handle !mb-0">: :</button>
                                                </td>
                                                <td>
                                                    <span class="font-medium">Database Management</span>
                                                </td>
                                                <td>
                                                    <span class="font-medium text-primarytint2color"><i class="ri-circle-line font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>Not Started</span>
                                                </td>
                                                <td>
                                                    03-Mar-2024
                                                </td>
                                                <td>
                                                    <span class="badge bg-primarytint2color/10 text-primarytint2color">Medium</span>
                                                </td>
                                                <td class="text-center flex gap-2 flex-wrap items-center font-medium">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="../assets/images/faces/3.jpg" alt="">
                                                    </span>
                                                    Killies
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div class="progress progress-animate progress-xs w-full" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-pink" style="width: 57%"></div>
                                                        </div>
                                                        <div class="ms-2">57%</div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="flex gap-2">
                                                        <a href="javascript:void(0);" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10 text-info !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="todo-btn ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="todo-box border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="task-checkbox"><input class="form-check-input" type="checkbox" value="" aria-label="..."></td>
                                                <td>
                                                    <button class="ti-btn ti-btn-icon ti-btn-sm btn-wave bg-light todo-handle !mb-0">: :</button>
                                                </td>
                                                <td>
                                                    <span class="font-medium">Monitoring and Alert</span>
                                                </td>
                                                <td>
                                                    <span class="font-medium text-primarytint2color"><i class="ri-circle-line font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>Not Started</span>
                                                </td>
                                                <td>
                                                    05-Mar-2024
                                                </td>
                                                <td>
                                                    <span class="badge bg-primarytint1color/10 text-primarytint1color">Low</span>
                                                </td>
                                                <td class="text-center flex gap-2 flex-wrap items-center font-medium">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="../assets/images/faces/13.jpg" alt="">
                                                    </span>
                                                    Tom Cruz
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div class="progress progress-animate progress-xs w-full" role="progressbar" aria-valuenow="79" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" style="width: 79%"></div>
                                                        </div>
                                                        <div class="ms-2">79%</div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="flex gap-2">
                                                        <a href="javascript:void(0);" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10 text-info !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="todo-btn ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="todo-box border-b !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="task-checkbox"><input class="form-check-input" type="checkbox" value="" aria-label="..."></td>
                                                <td>
                                                    <button class="ti-btn ti-btn-icon ti-btn-sm btn-wave bg-light todo-handle !mb-0">: :</button>
                                                </td>
                                                <td>
                                                    <span class="font-medium">Server Maintenance</span>
                                                </td>
                                                <td>
                                                    <span class="font-medium text-success text-xs"><i class="ri-circle-line font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>Completed</span>
                                                </td>
                                                <td>
                                                    17-Jan-2024
                                                </td>
                                                <td>
                                                    <span class="badge bg-primarytint1color/10 text-primarytint1color">Low</span>
                                                </td>
                                                <td class="text-center flex gap-2 flex-wrap items-center font-medium">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="../assets/images/faces/13.jpg" alt="">
                                                    </span>
                                                    Palam Nath
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div class="progress progress-animate progress-xs w-full" role="progressbar" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 58%"></div>
                                                        </div>
                                                        <div class="ms-2">58%</div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="flex gap-2">
                                                        <a href="javascript:void(0);" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10 text-info !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="todo-btn ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger !mb-0 btn-wave waves-effect waves-light">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer"> 
                            <div class="flex items-center justify-between flex-wrap gap-2"> 
                                <div> Showing 10 Entries <i class="bi bi-arrow-right ms-2 font-semibold"></i> </div>
                                <div> 
                                    <nav aria-label="Page navigation" class="pagination-style-4">
                                        <ul class="ti-pagination mb-0 flex-wrap">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="javascript:void(0);">
                                                    Prev
                                                </a>
                                            </li>
                                            <li class="page-item "><a class="page-link active"
                                                    href="javascript:void(0);">1</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                            <li class="page-item">
                                                <a class="page-link !text-primary" href="javascript:void(0);">
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

    <div id="addtask" class="hs-overlay hidden ti-modal">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
          <div class="ti-modal-content">
            <div class="ti-modal-header">
                <h6 class="modal-title text-[1rem] font-semibold" id="staticBackdropLabel2">Create Task
                </h6>
              <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#addtask">
                <span class="sr-only">Close</span>
                <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z" fill="currentColor"/>
                </svg>
              </button>
            </div>
            <div class="ti-modal-body">
                <div class="grid grid-cols-12 gap-x-6 gy-2">
                    <div class="xl:col-span-12 col-span-12">
                        <label for="task-name" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="task-name" placeholder="Task Name">
                    </div>
                    <div class="xl:col-span-12 col-span-12">
                        <label class="form-label">Assigned To</label>
                        <select class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button" multiple>
                            <option value="Choice 1" selected>Angelina May</option>
                            <option value="Choice 2">Sarah Ruth</option>
                            <option value="Choice 3">Hercules Jhon</option>
                            <option value="Choice 4">Mayor Kim</option>
                        </select>
                    </div>
                    <div class="xl:col-span-6 col-span-12">
                        <label class="form-label">Assigned Date</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text text-textmuted dark:text-textmuted/50"> <i class="ri-calendar-line"></i> </div>
                                <input type="text" class="form-control" id="addignedDate" placeholder="Choose date and time">
                            </div>
                        </div>
                    </div>
                    <div class="xl:col-span-6 col-span-12">
                        <label class="form-label">Target Date</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text text-textmuted dark:text-textmuted/50"> <i class="ri-calendar-line"></i></div>
                                <input type="text" class="form-control" id="targetDate" placeholder="Choose date and time">
                            </div>
                        </div>
                    </div>
                    <div class="xl:col-span-6 col-span-12">
                        <label class="form-label">Status</label>
                        <select class="form-control" data-trigger name="choices-single-default1" id="choices-single-default1">
                            <option value="">Select</option>
                            <option value="one">In Progress</option>
                            <option value="two">Not Started</option>
                            <option value="three">Completed</option>
                            <option value="four">Pending</option>
                        </select>
                    </div>
                    <div class="xl:col-span-6 col-span-12">
                        <label class="form-label">Priority</label>
                        <select class="form-control" data-trigger name="choices-single-default" id="choices-single-default">
                            <option value="">Select</option>
                            <option value="Critical">Critical</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="ti-modal-footer">
              <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-secondary" data-hs-overlay="#addtask">
                Cancel
              </button>
              <a class="ti-btn ti-btn-primary" href="javascript:void(0);">
                Create
              </a>
            </div>
          </div>
        </div>
    </div>

    
<div id="responsive-overlay"></div>

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

    <!-- Quill Editor JS -->
    <script src="/assets/libs/quill/quill.js"></script>

    <!-- Filepond JS -->
    <script src="/assets/libs/filepond/filepond.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
    <script src="/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.js"></script>
    <script src="/assets/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
    <script src="/assets/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-transform/filepond-plugin-image-transform.min.js"></script>

    <!-- Flat Picker JS -->
    <script src="/assets/libs/flatpickr/flatpickr.min.js"></script>

    <!-- Create Project JS -->
    <script src="/assets/libs/dragula/dragula.min.js"></script>

    <!-- Internal To-Do-List JS -->
    <script src="/assets/js/todolist.js"></script>

    <!-- Custom JS -->
    <script src="/assets/js/custom.js"></script>
</x-app-layout>
