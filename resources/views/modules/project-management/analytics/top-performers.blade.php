{{-- Top Performing Projects --}}
<div class="box mb-6">
    <div class="box-header justify-between">
        <div class="box-title">
            Top Performers
        </div>
        <div>
            <a href="/project-management/list" class="ti-btn ti-btn-light text-textmuted dark:text-textmuted/50 ti-btn-sm">
                View All
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="space-y-4">
            @forelse($topProjects as $index => $project)
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                    <div class="avatar avatar-sm 
                        @if($index === 0) bg-success/10 text-success
                        @elseif($index === 1) bg-primary/10 text-primary  
                        @else bg-warning/10 text-warning
                        @endif rounded-full">
                        @if($index === 0)
                            <i class="bi bi-trophy"></i>
                        @elseif($index === 1)
                            <i class="bi bi-star"></i>
                        @else
                            <i class="bi bi-award"></i>
                        @endif
                    </div>
                    <div class="flex-auto">
                        <div class="font-medium text-sm">{{ Str::limit($project->name, 25) }}</div>
                        <div class="text-xs text-textmuted">{{ $project->progress ?? 0 }}% complete • Status: {{ ucfirst($project->status) }}</div>
                    </div>
                    <div class="text-end">
                        <div class="w-12 bg-gray-200 rounded-full h-1.5">
                            <div class="@if($project->status === 'completed') bg-success @else bg-primary @endif h-1.5 rounded-full" style="width: {{ $project->progress ?? 0 }}%"></div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-4">
                    <i class="bi bi-inbox text-2xl mb-2"></i>
                    <p>No top performing projects yet</p>
                </div>
            @endforelse
        </div>
    </div>
</div>