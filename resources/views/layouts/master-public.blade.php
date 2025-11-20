<!DOCTYPE html>
<html lang="en">
{{-- Designed And Developed By Ahsan Danish --}}

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- Dynamic Meta Tags --}}

    <title>{{ $title ?? 'Forevestor' }}</title>
    <meta name="description" content="{{ $meta_description ?? 'Forevestor' }}">



    <link rel="icon" href="{{ asset('/assets/images/logo.png') }}" type="image/png">
    @include('include.head-public')
    @stack('style')
</head>

<body>
    @include('include.navbar-public')
    @yield('content')
    @include('include.footer-public')
    @include('include.foot-public')
    @stack('scripts')
</body>

</html>