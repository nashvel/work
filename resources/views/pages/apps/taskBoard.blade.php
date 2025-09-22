<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css">

    <link rel="stylesheet" href="/assets/libs/dragula/dragula.min.css">



            <div class="row">
                <div class="col-xl-12">
                    <div class="box">
                        <div class="box-body p-4">
                            <div class="flex items-center justify-between flex-wrap gap-4">
                                <div class="flex items-center flex-wrap gap-2 xxl:flex-nowrap" role="search">
                                    <span class="font-medium text-[15px] text-nowrap flex-nowrap me-2">WorkSpace :</span>
                                    <input class="form-control me-1" type="search" placeholder="Search Tasks" aria-label="Search">
                                    <button class="ti-btn ti-btn-soft-secondary" type="submit">Search</button>
                                </div>
                                <div class="ms-auto flex gap-4 items-center flex-wrap">
                                    <div class="avatar-list-stacked">
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
                                        <span class="avatar avatar-sm avatar-rounded">
                                            <img src="/assets/images/faces/4.jpg" alt="img">
                                        </span>
                                        <span class="avatar avatar-sm avatar-rounded">
                                            <img src="/assets/images/faces/13.jpg" alt="img">
                                        </span>
                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-white" href="javascript:void(0);">
                                            +8
                                        </a>
                                    </div>
                                    <div class="flex gap-2 kanban-board">
                                        <button class="ti-btn bg-primary text-white btn-w-lg !m-0" data-hs-overlay="#add-board"><i class="ri-add-line me-1 font-medium align-middle"></i>New Board</button>
                                        <div class="flex-auto">
                                            <select class="form-control kanban-sortby" data-trigger name="choices-single-default" id="choices-single-default">
                                                <option value="">Sort By</option>
                                                <option value="Newest">Newest</option>
                                                <option value="Date Added">Date Added</option>
                                                <option value="Type">Type</option>
                                                <option value="A - Z">A - Z</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: row-1 -->

            <!-- Start::row-2 -->
            <div class="TASK-kanban-board">
                <div class="kanban-tasks-type new">
                    <div class="pe-3 mb-3">
                        <div class="flex justify-between items-center px-3 py-2 bg-primary text-white rounded-md">
                            <span class="block font-medium text-[15px]">NEW </span>
                            <div>
                               <span class="badge badge-task text-white">18</span>
                            </div>
                        </div>
                    </div>
                    <div class="kanban-tasks" id="new-tasks">
                        <div id="new-tasks-draggable" data-view-btn="new-tasks">
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-primarytint1color/10 text-primarytint1color">#SHG - 01</span>
                                        <span class="badge bg-info/10 text-info">Development</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right] rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">Update Website Content</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-primary">High Priority</span>
                                        <span class="badge bg-success">In Progress</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/1.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/2.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/3.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/4.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">11</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">02</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-primarytint1color/10 text-primarytint1color">#SHG - 02</span>
                                        <span class="badge bg-info/10 text-info">Development</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton01" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton01">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">Implement new feature for Karban app.</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-warning">Low</span>
                                        <span class="badge bg-success">In Progress</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/1.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/2.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/3.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/4.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">15</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">03</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-primarytint1color/10 text-primarytint1color">#SHG - 03</span>
                                        <span class="badge bg-primarytint3color/10 text-primarytint3color">Development</span>
                                        <span class="bg-primarytint2color/10">UI/UX</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton02" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton02">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">Develop new feature for Karban app</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-warning">Low</span>
                                        <span class="badge bg-success">In Progress</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/5.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/9.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">25</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">05</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-primarytint1color/10 text-primarytint1color">#SHG - 04</span>
                                        <span class="badge bg-info/10 text-info">Development</span>
                                        <span class="badge bg-primarytint3color/10 text-primarytint3color">Designing</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton03" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton03">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">Design multi-usage landing page.</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-warning">Low</span>
                                        <span class="badge bg-success">In Progress</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/5.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/9.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">25</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">05</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex view-more-button mt-3 gap-2 items-center">
                        <a href="javascript:void(0);" class="ti-btn ti-btn-soft-primary btn-wave flex-auto">View More</a>
                        <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-soft-secondary border btn-wave flex-auto" data-hs-overlay="#add-task">
                            <i class="ri-add-line align-middle me-1 font-medium"></i>Add Task
                        </a>
                    </div>
                </div>
                <div class="kanban-tasks-type todo">
                    <div class="pe-3 mb-3">
                        <div class="flex justify-between items-center px-3 py-2 bg-primarytint1color text-white rounded-md">
                            <span class="block font-medium text-[15px]">TODO </span>
                            <div>
                               <span class="badge badge-task text-white">12</span>
                            </div>
                        </div>
                    </div>
                    <div class="kanban-tasks" id="todo-tasks">
                        <div id="todo-tasks-draggable" data-view-btn="todo-tasks">
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-info/10 text-info">#SHG - 05</span>
                                        <span class="badge bg-primarytint2color/10 text-primarytint2color">Authentication</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton04" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton04">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">Adding Authentication Pages.</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-warning">Low</span>
                                        <span class="badge bg-success">In Progress</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/4.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/13.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/5.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">08</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">04</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-info/10 text-info">#SHG - 06</span>
                                        <span class="badge bg-primarytint3color/10 text-primarytint3color">Marketing</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton05" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton05">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">New Marketing Campaign Strategy</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-primary">High</span>
                                        <span class="badge bg-success">In Progress</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/4.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/13.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/5.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">23</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">12</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex view-more-button mt-3 gap-2 items-center">
                        <a href="javascript:void(0);" class="ti-btn ti-btn-soft-primary btn-wave flex-auto">View More</a>
                        <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-soft-secondary border btn-wave flex-auto" data-hs-overlay="#add-task">
                            <i class="ri-add-line align-middle me-1 font-medium"></i>Add Task
                        </a>
                    </div>
                </div>
                <div class="kanban-tasks-type in-progress">
                    <div class="pe-3 mb-3">
                        <div class="flex justify-between items-center px-3 py-2 bg-primarytint2color text-white rounded-md">
                            <span class="block font-medium text-[15px]">ON GOING </span>
                            <div>
                               <span class="badge badge-task text-white">26</span>
                            </div>
                        </div>
                    </div>
                    <div class="kanban-tasks" id="inprogress-tasks">
                        <div id="inprogress-tasks-draggable" data-view-btn="inprogress-tasks">
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-primarytint1color/10 text-primarytint1color">#SHG - 07</span>
                                        <span class="badge bg-primary/10 text-primary">UI Design</span>
                                        <span class="badge bg-primarytint3color/10 text-primarytint3color">Development</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton06" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton06">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">Developing Calendar & Mail pages.</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-info">Medium</span>
                                        <span class="badge bg-success">In Progress</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/7.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/10.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/11.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">10</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">18</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-primarytint1color/10 text-primarytint1color">#SHG - 08</span>
                                        <span class="badge bg-primarytint3color/10 text-primarytint3color">Design</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton07" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton07">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">Project Design in Figma and Sketch</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-info">Medium</span>
                                        <span class="badge bg-success">In Progress</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/13.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/6.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">05</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">02</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex view-more-button mt-3 gap-2 items-center">
                        <a href="javascript:void(0);" class="ti-btn ti-btn-soft-primary btn-wave flex-auto">View More</a>
                        <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-soft-secondary border btn-wave flex-auto" data-hs-overlay="#add-task">
                            <i class="ri-add-line align-middle me-1 font-medium"></i>Add Task
                        </a>
                    </div>
                </div>
                <div class="kanban-tasks-type inreview">
                    <div class="pe-3 mb-3">
                        <div class="flex justify-between items-center px-3 py-2 bg-primarytint3color text-white rounded-md">
                            <span class="block font-medium text-[15px]">IN REVIEW </span>
                            <div>
                               <span class="badge badge-task text-white">30</span>
                            </div>
                        </div>
                    </div>
                    <div class="kanban-tasks" id="inreview-tasks">
                        <div id="inreview-tasks-draggable" data-view-btn="inreview-tasks">
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-primarytint1color/10 text-primarytint1color">#SHG - 10</span>
                                        <span class="badge bg-primarytint3color/10 text-primarytint3color">Review</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton08" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton08">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">Design Architecture Strategy</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-info">Medium</span>
                                        <span class="badge bg-success">In Progress</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/3.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/5.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/7.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">09</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">35</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex view-more-button mt-3 gap-2 items-center">
                        <a href="javascript:void(0);" class="ti-btn ti-btn-soft-primary btn-wave flex-auto">View More</a>
                        <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-soft-secondary border btn-wave flex-auto" data-hs-overlay="#add-task">
                            <i class="ri-add-line align-middle me-1 font-medium"></i>Add Task
                        </a>
                    </div>
                </div>
                <div class="kanban-tasks-type completed">
                    <div class="pe-3 mb-3">
                        <div class="flex justify-between items-center px-3 py-2 bg-secondary text-white rounded-md">
                            <span class="block font-medium text-[15px]">COMPLETED </span>
                            <div>
                               <span class="badge badge-task text-white">36</span>
                            </div>
                        </div>
                    </div>
                    <div class="kanban-tasks" id="completed-tasks">
                        <div id="completed-tasks-draggable" data-view-btn="completed-tasks">
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-primarytint1color/10 text-primarytint1color">#SHG - 11</span>
                                        <span class="badge bg-primarytint3color/10 text-primarytint3color">Review</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton09" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton09">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">New Project Update</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-primary">High</span>
                                        <span class="badge bg-success">Completed</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/6.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/13.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">09</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">35</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-primarytint1color/10 text-primarytint1color">#SHG - 12</span>
                                        <span class="badge bg-primarytint3color/10 text-primarytint3color">Development</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton10" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton10">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">React JS New Version Update</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-primary">High</span>
                                        <span class="badge bg-success">Completed</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/10.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/11.jpg" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/1.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">22</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">12</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="task-badges">
                                        <span class="badge bg-primarytint1color/10 text-primarytint1color">#SHG - 13</span>
                                        <span class="badge bg-primarytint3color/10 text-primarytint3color">Discussion</span>
                                    </div>
                                    <div class="ti-dropdown hs-dropdown [--placement:bottom-right]  rtl:[--placement:bottom-left]">
                                        <button class="ti-btn ti-btn-sm bg-light" type="button" id="dropdownMenuButton11" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" aria-labelledby="dropdownMenuButton11">
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">View</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Edit</a></li>
                                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h6 class="font-medium mb-1 text-[15px]">Project Discussion with Client</h6>
                                    <p class="kanban-task-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <div class="kanban-box-footer">
                                        <span class="badge bg-primary">High</span>
                                        <span class="badge bg-success">Completed</span>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-dashed dark:border-defaultborder/10">
                                    <div class="flex items-center justify-between">
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/images/faces/4.jpg" alt="img">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="me-2 text-secondary">
                                                <span class="me-1"><i class="ri-thumb-up-fill align-middle font-normal"></i></span><span class="font-medium text-xs">11</span>
                                            </a>
                                            <a href="javascript:void(0);" class="text-info">
                                                <span class="me-1"><i class="ri-message-2-line align-middle font-normal"></i></span><span class="font-medium text-xs">12</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex view-more-button mt-3 gap-2 items-center">
                        <a href="javascript:void(0);" class="ti-btn ti-btn-soft-primary btn-wave flex-auto">View More</a>
                        <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-soft-secondary border btn-wave flex-auto" data-hs-overlay="#add-task">
                            <i class="ri-add-line align-middle me-1 font-medium"></i>Add Task
                        </a>
                    </div>
                </div>
            </div>
            <!--End::row-2 -->

            <!-- Start::add board modal -->
            <div id="add-board" class="hs-overlay hidden ti-modal">
                <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                  <div class="ti-modal-content">
                    <div class="ti-modal-header">
                        <h6 class="modal-title text-[1rem] font-semibold" id="staticBackdropLabel2">Add Board
                        </h6>
                      <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#add-board">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z" fill="currentColor"/>
                        </svg>
                      </button>
                    </div>
                    <div class="ti-modal-body">
                        <div class="grid grid-cols-12">
                            <div class="xl:col-span-12 col-span-12">
                                <label for="board-title" class="form-label">Task Board Title</label>
                                <input type="text" class="form-control" id="board-title" placeholder="Board Title">
                            </div>
                        </div>
                    </div>
                    <div class="ti-modal-footer">
                      <button type="button" class="hs-dropdown-toggle ti-btn  btn-wave ti-btn-light" data-hs-overlay="#add-board">
                      Cancel
                      </button>
                      <a class="ti-btn  btn-wave ti-btn-primary" href="javascript:void(0);">
                        Add Board
                      </a>
                    </div>
                  </div>
                </div>
            </div>
            <!-- End::add board modal -->

            <!-- Start::add task modal -->
            <div id="add-task" class="hs-overlay hidden ti-modal">  
                <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                  <div class="ti-modal-content">
                    <div class="ti-modal-header">
                        <h6 class="modal-title text-[1rem] font-semibold" id="mail-ComposeLabel">Add Task</h6>
                          <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#add-task">
                            <span class="sr-only">Close</span>
                            <i class="ri-close-line"></i>
                          </button>
                    </div>
                    <div class="ti-modal-body px-4">
                        <div class="grid grid-cols-12 gap-x-4 gap-y-2">
                            <div class="xl:col-span-6 col-span-12">
                                <label for="task-name" class="form-label">Task Name</label>
                                <input type="text" class="form-control" id="task-name" placeholder="Task Name">
                            </div>
                            <div class="xl:col-span-6 col-span-12">
                                <label for="task-id" class="form-label">Task ID</label>
                                <input type="text" class="form-control" id="task-id" placeholder="Task ID">
                            </div>
                            <div class="xl:col-span-12 col-span-12">
                                <label for="text-area" class="form-label">Task Description</label>
                                <textarea class="form-control" id="text-area" rows="2" placeholder="Write Description"></textarea>
                            </div>
                            <div class="xl:col-span-12 col-span-12">
                                <label for="text-area" class="form-label">Task Images</label>
                                <input type="file" class="multiple-filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="6">
                            </div>
                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Assigned To</label>
                                <select class="form-control" name="choices-multiple-remove-button1" id="choices-multiple-remove-button1" multiple>
                                    <option value="Choice 1">Angelina May</option>
                                    <option value="Choice 2">Sarah Ruth</option>
                                    <option value="Choice 3">Hercules Jhon</option>
                                    <option value="Choice 4">Mayor Kim</option>
                                </select>
                            </div>
                            <div class="xl:col-span-6 col-span-12">
                                <label class="form-label">Target Date</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text text-textmuted dark:text-textmuted/50"> <i class="ri-calendar-line"></i> </div>
                                        <input type="text" class="form-control" id="targetDate" placeholder="Choose date and time">
                                    </div>
                                </div>
                            </div>
                            <div class="xl:col-span-6 col-span-12">
                                <label class="form-label">Tags</label>
                                <select class="form-control" name="choices-multiple-remove-button2" id="choices-multiple-remove-button2" multiple>
                                    <option value="">Select Tag</option>
                                    <option value="UI/UX">UI/UX</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Designing">Designing</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Authentication">Authentication</option>
                                    <option value="Product">Product</option>
                                    <option value="Development">Development</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="ti-modal-footer">
                        <button type="button"
                        class="hs-dropdown-toggle ti-btn  ti-btn-secondary align-middle"
                        data-hs-overlay="#add-task">
                        Close
                      </button>
                        <button type="button" class="ti-btn bg-primary text-white !font-medium">Add Task</button>
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

    <!-- Filepond JS -->
    <script src="/assets/libs/filepond/filepond.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
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

    <!-- Dragula JS -->
    <script src="/assets/libs/dragula/dragula.min.js"></script>

    <!-- Internal Task  JS -->
    <script src="/assets/js/task-kanban-board.js"></script>

    <!-- Custom JS -->
    <script src="/assets/js/custom.js"></script>


</x-app-layout>
