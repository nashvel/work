@php
    use Illuminate\Support\Str;
@endphp

@if (isset($message))
    <div class="alert alert-info">
        {{ $message }}
        @isset($download_link)
            <a href="{{ $download_link }}" class="btn btn-primary">Download</a>
        @endisset
    </div>
@elseif (isset($url) && isset($mimeType))
    @if (Str::startsWith($mimeType, 'image/'))
        <img src="{{ $url }}" width="100%" class="rounded shadow-sm" alt="Image Preview" />
    @elseif (Str::startsWith($mimeType, 'video/'))
        <video controls width="100%">
            <source src="{{ $url }}" type="{{ $mimeType }}">
            Your browser does not support the video tag.
        </video>
    @elseif ($mimeType === 'application/pdf')
        <iframe src="{{ $url }}" width="100%" height="600px" style="border: none;"></iframe>
    @elseif (Str::contains($url, 'docs.google.com') || Str::contains($url, 'view.officeapps.live.com'))
        <iframe src="{{ $url }}" width="100%" height="600px" style="border: none;"></iframe>
    @else
        <p class="text-muted">File preview not available for this file type.</p>
    @endif

    <a href="{{ url('/download-file/' . $id) }}" class="btn btn-primary mt-3">Download</a>
@else
    <p class="text-muted">No file to preview.</p>
@endif
