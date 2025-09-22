@if ($user_info->role == 'Developer')
    <li class="slide__category" style="color: #09139c !important;">
        <span class="category-name">Development</span>
    </li>
    <li class="slide">
        <a href="/developer/dashboard" class="side-menu__item">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" style="color: #5D66F7" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="side-menu__label">Auto Builder</span>
        </a>
    </li>
    <li class="slide">
        <a href="/developer/routes" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-receipt-cutoff" style="color: #5D66F7"></i>
            <span class="side-menu__label">Routes & Privilege</span>
        </a>
    </li>
    <li class="slide__category"><span class="category-name">Applications</span></li>
    <li class="slide">
        <a href="/chats/message" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-chat-dots" style="color: #5D66F7"></i>
            <span class="side-menu__label">Messages</span>
        </a>
    </li>
    <li class="slide">
        <a href="/file-manager/list" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-folder-symlink" style="color: #5D66F7"></i>
            <span class="side-menu__label">File Manager</span>
        </a>
    </li>
    
    <li class="slide__category"><span class="category-name">Account Management</span></li>   
    <li class="slide">
        <a href="/users/manage" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-person-gear" style="color: #5D66F7"></i>
            <span class="side-menu__label">Manage Users</span>
        </a>
    </li>
    <li class="slide">
        <a href="/users/manage" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-robot" style="color: #5D66F7"></i>
            <span class="side-menu__label">Virtual Assistant</span>
        </a>
    </li>
    @auth
        @php
            // Pull allowed + active routes for the user
            $userRoutes = auth()
                ->user()
                ->permissions()
                ->where('is_allowed', true)
                ->with('route')
                ->get()
                ->pluck('route')
                ->filter(fn($r) => $r && $r->is_active);

            // Group label fallback
            $labelFor = fn($r) => trim($r->group_label ?? '') ?: 'General';

            // Group, sort groups by label, and sort items inside by sort_order then title
            $grouped = $userRoutes
                ->groupBy($labelFor)
                ->sortKeys() // sort groups alphabetically; remove if you prefer original order
                ->map(fn($items) => $items->sortBy([['sort_order', 'asc'], ['title', 'asc']]));
        @endphp

        @foreach ($grouped as $groupLabel => $routesInGroup)
            {{-- Group header --}}
            <li class="slide__category">
                <span class="category-name">{{ $groupLabel }}</span>
            </li>

            {{-- Group items --}}
            @foreach ($routesInGroup as $route)
                @php
                    // Mark active link (simple matcher; tweak to your routing)
                    $isActive = request()->is(ltrim($route->path, '/') . '*');
                @endphp
                <li class="slide">
                    <a href="{{ $route->path }}" class="side-menu__item">
                        <i class="w-6 h-4 side-menu__icon bi {{ $route->icon }}" style="color:#5D66F7"></i>
                        <span class="side-menu__label">{{ $route->title }}</span>
                    </a>
                </li>
            @endforeach
        @endforeach
    @endauth
@endif

<style>
    .sidemenu-slide {
        padding-left: 60px !important;
    }
</style>
