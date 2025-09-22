@props([
    'title' => 'Quick Actions',
    'actions' => []
])

<div class="box">
    <div class="box-header">
        <div class="box-title">{{ $title }}</div>
    </div>
    <div class="box-body">
        <div class="grid grid-cols-3 gap-3">
            @foreach($actions as $action)
                <a href="{{ $action['url'] }}" class="bg-white border border-gray-200 rounded-lg p-3 hover:bg-gray-50 transition-colors text-center">
                    <i class="{{ $action['icon'] }} text-lg {{ $action['color'] }} mb-1"></i>
                    <p class="text-xs font-medium text-gray-700">{{ $action['text'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>