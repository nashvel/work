@props([
    'title' => 'Quick Actions',
    'actions' => []
])

<div class="box">
    <div class="box-header">
        <div class="box-title">{{ $title }}</div>
    </div>
    <div class="box-body">
        <div class="grid grid-cols-3 gap-4">
            @foreach($actions as $action)
                <a href="{{ $action['url'] }}" class="bg-white border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors text-center">
                    <i class="{{ $action['icon'] }} text-2xl {{ $action['color'] }} mb-2"></i>
                    <p class="text-sm font-medium text-gray-700">{{ $action['text'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>