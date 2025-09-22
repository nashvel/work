@php
    $versionFile = public_path('version.txt');
    $version = file_exists($versionFile) ? trim(file_get_contents($versionFile)) : '0.0.0';
@endphp

Current Version : {{ $version }} (Beta)