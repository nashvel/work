{{-- Project Status Distribution Chart --}}
<div class="box mb-6">
    <div class="box-header justify-between">
        <div class="box-title">
            Project Status Distribution
        </div>
        <div>
            <button type="button" class="ti-btn ti-btn-soft-primary text-xs px-2 py-[0.26rem]"><i class="ri-refresh-line align-middle inline-block"></i>Refresh</button>
        </div>
    </div>
    <div class="box-body">
        <div class="grid grid-cols-2 gap-6">
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-success/10 rounded-lg">
                    <div class="flex items-center gap-3">
                        <span class="avatar avatar-sm bg-success text-white rounded-full">
                            <i class="bi bi-check-circle"></i>
                        </span>
                        <span class="font-medium">Completed</span>
                    </div>
                    <div class="text-end">
                        <span class="text-lg font-bold text-success">{{ $statusDistribution['completed']['count'] }}</span>
                        <div class="text-xs text-textmuted">({{ $statusDistribution['completed']['percentage'] }}%)</div>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-primary/10 rounded-lg">
                    <div class="flex items-center gap-3">
                        <span class="avatar avatar-sm bg-primary text-white rounded-full">
                            <i class="bi bi-play-circle"></i>
                        </span>
                        <span class="font-medium">In Progress</span>
                    </div>
                    <div class="text-end">
                        <span class="text-lg font-bold text-primary">{{ $statusDistribution['active']['count'] }}</span>
                        <div class="text-xs text-textmuted">({{ $statusDistribution['active']['percentage'] }}%)</div>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-warning/10 rounded-lg">
                    <div class="flex items-center gap-3">
                        <span class="avatar avatar-sm bg-warning text-white rounded-full">
                            <i class="bi bi-hourglass-split"></i>
                        </span>
                        <span class="font-medium">Planning</span>
                    </div>
                    <div class="text-end">
                        <span class="text-lg font-bold text-warning">{{ $statusDistribution['planning']['count'] }}</span>
                        <div class="text-xs text-textmuted">({{ $statusDistribution['planning']['percentage'] }}%)</div>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-danger/10 rounded-lg">
                    <div class="flex items-center gap-3">
                        <span class="avatar avatar-sm bg-danger text-white rounded-full">
                            <i class="bi bi-pause-circle"></i>
                        </span>
                        <span class="font-medium">On Hold</span>
                    </div>
                    <div class="text-end">
                        <span class="text-lg font-bold text-danger">{{ $statusDistribution['on_hold']['count'] }}</span>
                        <div class="text-xs text-textmuted">({{ $statusDistribution['on_hold']['percentage'] }}%)</div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <div class="w-full">
                    <h4 class="font-medium text-center mb-4">Quick Actions</h4>
                    <div class="space-y-3">
                        <a href="/project-management/list" class="flex items-center gap-3 p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="bi bi-list-ul text-xl text-blue-600"></i>
                            <span class="font-medium text-gray-700">View All Projects</span>
                        </a>
                        <a href="/project-management/analytics" class="flex items-center gap-3 p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="bi bi-graph-up text-xl text-green-600"></i>
                            <span class="font-medium text-gray-700">Analytics</span>
                        </a>
                        <a href="/project-management/reports" class="flex items-center gap-3 p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="bi bi-file-earmark-bar-graph text-xl text-orange-600"></i>
                            <span class="font-medium text-gray-700">Reports</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>