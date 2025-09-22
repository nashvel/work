@php
    $path = public_path('terms-of-service.html');

    if (file_exists($path)) {
        echo file_get_contents($path);
    } else {
        echo '<p>Error: Terms file not found.</p>';
    }
@endphp
