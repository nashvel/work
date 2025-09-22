{{-- Key Performance Metrics --}}
<div class="grid grid-cols-12 gap-x-6 mb-6">
    <div class="xxl:col-span-3 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
        <div class="box overflow-hidden">
            <div class="box-body pb-0 pe-0">
                <div class="mb-4">
                    <div class="flex justify-between flex-wrap">
                        <span class="avatar avatar-rounded bg-primary svg-white">
                            <i class="bx bx-speedometer text-[22px]"></i>
                        </span>
                        <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Avg. Completion Time</span>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div class="pb-3">
                        <span class="text-[20px] font-medium mb-0 flex items-center">{{ $avgCompletionDays ?: 'N/A' }} days</span>
                        <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Project Duration</div>
                        <span class="text-success">12% faster<i class="ti ti-arrow-narrow-down text-[16px]"></i></span>
                    </div>
                    <div id="completion-chart"></div>
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
                            <i class="bx bx-target-lock text-[22px]"></i>
                        </span>
                        <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">On-Time Delivery</span>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div class="pb-3">
                        <span class="text-[20px] font-medium mb-0 flex items-center">{{ $onTimeDeliveryRate }}%</span>
                        <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Delivery Rate</div>
                        <span class="text-success">+5%<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                    </div>
                    <div id="delivery-chart"></div>
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
                        <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Team Utilization</span>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div class="pb-3">
                        <span class="text-[20px] font-medium mb-0 flex items-center">{{ $teamUtilization }}%</span>
                        <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Resource Usage</div>
                        <span class="text-success">+3%<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                    </div>
                    <div id="utilization-chart"></div>
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
                            <i class="bx bx-dollar text-[22px]"></i>
                        </span>
                        <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Budget Efficiency</span>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div class="pb-3">
                        <span class="text-[20px] font-medium mb-0 flex items-center">{{ $budgetEfficiency }}%</span>
                        <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Budget Usage</div>
                        <span class="text-success">Efficient<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                    </div>
                    <div id="budget-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>