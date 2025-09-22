@props([
    'title' => '',
    'value' => '',
    'subtitle' => '',
    'trend' => '',
    'icon' => 'bx-layer',
    'bgColor' => 'bg-primary',
    'chartId' => ''
])

<div class="xxl:col-span-3 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
    <div class="box overflow-hidden">
        <div class="box-body pb-0 pe-0">
            <div class="mb-4">
                <div class="flex justify-between flex-wrap">
                    <span class="avatar avatar-rounded {{ $bgColor }} svg-white">
                        <i class="{{ $icon }} text-[22px]"></i>
                    </span>
                    <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">{{ $title }}</span>
                </div>
            </div>
            <div class="flex items-end justify-between">
                <div class="pb-3">
                    <span class="text-[20px] font-medium mb-0 flex items-center">{{ $value }}</span>
                    <div class="text-textmuted dark:text-textmuted/50 text-[13px]">{{ $subtitle }}</div>
                    <span class="text-success">{{ $trend }}<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                </div>
                @if($chartId)
                    <div id="{{ $chartId }}"></div>
                @endif
            </div>
        </div>
    </div>
</div>