{{-- Twitter Meta Tags --}}
<meta name="twitter:card" content="{{ request()->is('/') ? 'summary_large_image' : 'summary' }}">
<meta name="twitter:site" content="@{{ config('site.twitter') }}">
<meta name="twitter:creator" content="@{{ config('site.twitter') }}">
<meta name="twitter:title" content="{{ $title ?? '' }}">
<meta name="twitter:description" content="{{ ($pageDescription ?? config('site.description')) }}">
<meta name="twitter:image" content="{{ request()->is('/') ? asset(config('site.social_logo_path')) : asset(config('site.social_image_path')) }}">

{{-- Facebook Meta Tags --}}
<meta property="og:url" content="{{ request()->url() }}">
<meta property="og:title" content="{{ $title ?? '' }}">
<meta property="og:description" content="{{ ($pageDescription ?? config('site.description')) }}">
<meta property="og:type" content="{{ request()->is('/page') ? 'article' : 'website' }}">
<meta property="og:image" content="{{ asset(config('site.social_image_path')) }}">
<meta property="og:image:type" content="image/png">
