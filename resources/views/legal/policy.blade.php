@php
    $path = public_path('privacy-policy.html');

    if (file_exists($path)) {
        echo file_get_contents($path);
    } else {
        echo '<p>Error: Policy file not found.</p>';
    }
@endphp
