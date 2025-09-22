{{-- Key Metrics Cards Component --}}
<div class="grid grid-cols-12 gap-x-6 mb-6">
    <div class="xxl:col-span-3 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
        <div class="box overflow-hidden">
            <div class="box-body pb-0 pe-0">
                <div class="mb-4">
                    <div class="flex justify-between flex-wrap">
                        <span class="avatar avatar-rounded bg-primary svg-white">
                            <i class="bx bx-layer text-[22px]"></i>
                        </span>
                        <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Total Projects</span>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div class="pb-3">
                        <span class="text-[20px] font-medium mb-0 flex items-center">{{ $totalProjects }}</span>
                        <div class="text-textmuted dark:text-textmuted/50 text-[13px]">All Time</div>
                        <span class="text-success">{{ $activeProjects }} Active<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                    </div>
                    <div id="project-chart-1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="xxl:col-span-3 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
        <div class="box overflow-hidden">
            <div class="box-body pb-0 pe-0">
                <div class="mb-4">
                    <div class="flex justify-between flex-wrap">
                        <span class="avatar avatar-rounded bg-primarytint1color svg-white">
                            <i class="bx bx-play-circle text-[22px]"></i>
                        </span>
                        <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Active Projects</span>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div class="pb-3">
                        <span class="text-[20px] font-medium mb-0 flex items-center">{{ $activeProjects }}</span>
                        <div class="text-textmuted dark:text-textmuted/50 text-[13px]">In Progress</div>
                        <span class="text-success">{{ $totalProjects > 0 ? round(($activeProjects / $totalProjects) * 100, 1) : 0 }}%<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                    </div>
                    <div id="project-chart-2"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="xxl:col-span-3 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
        <div class="box overflow-hidden">
            <div class="box-body pb-0 pe-0">
                <div class="mb-4">
                    <div class="flex justify-between flex-wrap">
                        <span class="avatar avatar-rounded bg-primarytint2color svg-white"> 
                            <i class="bx bx-group text-[22px]"></i>
                        </span>
                        <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Team Members</span>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div class="pb-3">
                        <span class="text-[20px] font-medium mb-0 flex items-center">{{ $teamMembers }}</span>
                        <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Contributors</div>
                        <span class="text-success">Active<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                    </div>
                    <div id="project-chart-3"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="xxl:col-span-3 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
        <div class="box overflow-hidden">
            <div class="box-body pb-0 pe-0">
                <div class="mb-4">
                    <div class="flex justify-between flex-wrap">
                        <span class="avatar avatar-rounded bg-primarytint3color svg-white">
                            <i class="bx bx-check-circle text-[22px]"></i>
                        </span>
                        <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Completion Rate</span>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div class="pb-3">
                        <span class="text-[20px] font-medium mb-0 flex items-center">{{ $completionRate }}%</span>
                        <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Overall Success</div>
                        <span class="text-success">{{ $completedProjects }} Completed<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                    </div>
                    <div id="project-chart-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
