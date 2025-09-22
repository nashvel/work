{{-- Recent Activity Component --}}
<div class="box">
    <div class="box-header justify-between">
        <div class="box-title">Recent Activity</div>
        <div>
            <button type="button" class="ti-btn ti-btn-soft-primary text-xs px-2 py-[0.26rem]"><i class="ri-history-line align-middle inline-block"></i>View All</button>
        </div>
    </div>
    <div class="box-body">
        <div class="space-y-4">
            @forelse($recentProjects as $project)
                <a href="/project-management/{{ $project->id }}/dashboard" 
                   class="block hover:no-underline" 
                   style="cursor: pointer !important;"
                   onclick="console.log('Link clicked:', this.href); return true;">
                    <div class="flex items-start gap-3 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors" style="cursor: pointer !important;">
                        <div class="avatar avatar-sm avatar-rounded 
                            @if($project->status === 'completed') bg-success/10 !text-success
                            @elseif($project->status === 'active') bg-primary/10 !text-primary
                            @elseif($project->status === 'on_hold') bg-warning/10 !text-warning
                            @else bg-info/10 !text-info
                            @endif flex-shrink-0 mt-1">
                            @if($project->status === 'completed')
                                <i class="bi bi-check-circle text-[14px]"></i>
                            @elseif($project->status === 'active')
                                <i class="bi bi-play-circle text-[14px]"></i>
                            @elseif($project->status === 'on_hold')
                                <i class="bi bi-pause-circle text-[14px]"></i>
                            @else
                                <i class="bi bi-plus-circle text-[14px]"></i>
                            @endif
                        </div>
                        <div class="flex-auto">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-medium text-sm text-primary hover:text-primary/80">{{ $project->name }}</span>
                                <span class="text-xs text-textmuted">{{ $project->created_at->diffForHumans() }}</span>
                            </div>
                            <span class="text-xs text-textmuted">
                                Created by {{ $project->creator->name ?? 'Unknown' }} • 
                                Status: {{ ucfirst($project->status) }} • 
                                Tasks: {{ $project->tasks->count() }}
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-4 text-textmuted">
                    <i class="bi bi-inbox text-2xl mb-2"></i>
                    <p class="text-sm">No recent activity</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
