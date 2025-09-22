{{-- Navigation Tabs Component --}}
<div class="sm:border-b-2 border-gray-200 dark:border-white/10">
    <nav class="-mb-0.5 sm:flex sm:space-x-6 rtl:space-x-reverse" role="tablist">
        @php
            $tabs = [                                    
                ['id' => 'icon-1', 'icon' => 'bi-info-circle', 'label' => 'Dashboard'],
                ['id' => 'icon-privilege', 'icon' => 'bi-info-square', 'label' => 'Overview'],
                ['id' => 'icon-coin', 'icon' => 'bi-coin', 'label' => 'Financial Summary'],
                ['id' => 'icon-activity', 'icon' => 'bi-activity', 'label' => 'Task Management'],
                ['id' => 'icon-people', 'icon' => 'bi-people', 'label' => 'Assigned Team'],
                ['id' => 'icon-tasks', 'icon' => 'bi-list-task', 'label' => 'My Tasks', 'url' => route('project-management.my-tasks')],
            ];
        @endphp

        @foreach ($tabs as $index => $tab)
            <a class="nav-tab w-full sm:w-auto py-4 px-1 inline-flex items-center gap-2 border-b-[3px] text-sm whitespace-nowrap transition-all duration-200 border-transparent text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50 hover:text-primary hover:border-primary/30 {{ $index === 0 ? 'active' : '' }}"
                href="{{ isset($tab['url']) ? $tab['url'] : 'javascript:void(0);' }}" 
                id="icon-item-{{ $index + 1 }}"
                @if(!isset($tab['url']))
                    data-hs-tab="#{{ $tab['id'] }}" aria-controls="{{ $tab['id'] }}"
                @endif
                onclick="setActiveTab(this)">
                <span class="bi {{ $tab['icon'] }}"></span>
                {{ $tab['label'] }}
            </a>
        @endforeach
    </nav>
</div>

<style>
.nav-tab.active {
    font-weight: 600;
    border-color: var(--primary-color, #3b82f6);
    color: var(--primary-color, #3b82f6);
    background-color: rgba(59, 130, 246, 0.05);
}

.nav-tab.active .bi {
    color: var(--primary-color, #3b82f6);
}
</style>

<script>
function setActiveTab(clickedTab) {
    document.querySelectorAll('.nav-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    clickedTab.classList.add('active');
}
</script>
