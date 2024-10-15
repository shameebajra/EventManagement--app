<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Title --}}
    <title>{{ $title }}</title> {{-- Replace $title with the appropriate variable or value --}}

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ $canonicalUrl }}"> {{-- Replace $canonicalUrl with the appropriate variable or value --}}
    
    {{-- Robots Meta Tag --}}
    <meta name="robots" content="noindex">

    {{-- Redirect --}}
    <meta http-equiv="refresh" content="0; url={{ $redirectUrl }}"> {{-- Replace $redirectUrl with the appropriate variable or value --}}
</head>
<body>
    {{-- Optionally add body content or leave it empty for a redirect --}}
</body>
</html>
