{{-- Error Handling Component --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm flex items-center mx-3">
        <div>
            <strong class="text-danger">Whoops! Something went wrong:</strong>
            <ul class="list-disc list-inside mt-2 mx-4">
                @foreach ($errors->all() as $error)
                    <li class="text-dark"><i>{{ $error }}</i></li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
