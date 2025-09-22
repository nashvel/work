@foreach ($files as $file)
@if ($file->is_folder)
    <div class="xxl:col-span-4 xl:col-span-6 lg:col-span-6 md:col-span-6 col-span-12">
        <div class="box !shadow-none border border-defaultborder dark:border-defaultborder/10">
            <div class="box-body">
                <div class="mb-3 folder-svg-container flex flex-wrap justify-between items-top">
                    <div class="relative">
                        <a href="/bid/projects/{{ $id }}?f={{ $file->id }}&{{ md5($file->id) }}">
                        <img src="/assets/images/media/file-manager/1.png" style="height: 80px" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
                <p class="text-[14px] font-medium mb-1 leading-none">
                    <a href="/bid/projects/{{ $id }}?f={{ $file->id }}&{{ md5($file->id) }}">{{ $file->name }}</a>
                </p>
                @php
                    $files_count = App\Models\FileManager::where('parent_id', $file->id)
                        ->where('user_id', auth()->id())
                        ->count();

                    $files_sum = App\Models\FileManager::where('parent_id', $file->id)
                        ->where('user_id', auth()->id())
                        ->sum('size');
                @endphp
                <div class="flex items-center justify-between flex-wrap">
                    <div>
                        <span class="text-textmuted dark:text-textmuted/50 text-xs">
                            {{ number_format($files_count, 0) }} Files
                        </span>
                    </div>
                    <div>
                        <span class="text-defaulttextcolor font-medium">
                            <?php
                            $size = $files_sum;
                            if ($size >= 1073741824) {
                                echo number_format($size / 1073741824, 2) . ' GB';
                            } elseif ($size >= 1048576) {
                                echo number_format($size / 1048576, 2) . ' MB';
                            } elseif ($size >= 1024) {
                                echo number_format($size / 1024, 2) . ' KB';
                            } elseif ($size > 1) {
                                echo $size . ' bytes';
                            } elseif ($size == 1) {
                                echo $size . ' byte';
                            } else {
                                echo '0 bytes';
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach
