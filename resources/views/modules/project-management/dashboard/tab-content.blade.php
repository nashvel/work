{{-- Tab Content Component --}}
<div class="mt-3">
    @php
        $tabs = [                                    
            ['id' => 'icon-1', 'icon' => 'bi-info-circle', 'label' => 'Dashboard'],
            ['id' => 'icon-privilege', 'icon' => 'bi-info-square', 'label' => 'Overview'],
            ['id' => 'icon-coin', 'icon' => 'bi-coin', 'label' => 'Financial Summary'],
            ['id' => 'icon-activity', 'icon' => 'bi-activity', 'label' => 'Task Management'],
            ['id' => 'icon-people', 'icon' => 'bi-people', 'label' => 'Assigned Team'],
        ];
    @endphp

    @foreach ($tabs as $index => $tab)
        <div id="{{ $tab['id'] }}" class="{{ $index === 0 ? '' : 'hidden' }}" role="tabpanel"
            aria-labelledby="icon-item-{{ $index + 1 }}">
            <div class="text-gray-500 dark:text-[#8c9097] dark:text-white/50 p-5 border rounded-sm dark:border-white/10 border-gray-200">
                @if($tab['label'] === 'Assigned Team')
                    @php
                        $facesPath = public_path('assets/images/faces');
                        $availableFaces = [];
                        
                        if (is_dir($facesPath)) {
                            $files = glob($facesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                            $availableFaces = array_map(function($file) {
                                return '/assets/images/faces/' . basename($file);
                            }, $files);
                        }
                        
                        if (empty($availableFaces)) {
                            for ($i = 1; $i <= 16; $i++) {
                                $availableFaces[] = '/assets/images/faces/' . $i . '.jpg';
                            }
                        }
                        
                        $users = \App\Models\User::where('role', '<>', 'Sub-Client')
                            ->select('id', 'name', 'email', 'profile_photo_path')
                            ->get()
                            ->map(function ($user) use ($availableFaces) {
                                $avatarUrl = '';
                                
                                if ($user->profile_photo_path) {
                                    $profilePath = public_path('storage/' . $user->profile_photo_path);
                                    if (file_exists($profilePath) && is_readable($profilePath)) {
                                        $avatarUrl = '/storage/' . $user->profile_photo_path;
                                    }
                                }
                                
                                if (!$avatarUrl) {
                                    $faceIndex = abs(crc32($user->name)) % count($availableFaces);
                                    $avatarUrl = $availableFaces[$faceIndex];
                                }
                                
                                return [
                                    'id' => $user->id,
                                    'name' => $user->name,
                                    'email' => $user->email,
                                    'avatar' => $avatarUrl,
                                ];
                            });
                    @endphp
                    @include('modules.project-management.forms.assigned_team_v2', ['project' => $project, 'users' => $users])
                @else
                    @includeIf(
                        'modules.project-management.forms.' .
                            \Illuminate\Support\Str::slug($tab['label'], '_'))
                @endif
            </div>
        </div>
    @endforeach
</div>
