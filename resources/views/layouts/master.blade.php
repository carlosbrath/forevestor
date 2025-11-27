<!DOCTYPE html>
<html lang="en">
{{-- Designed And Developed By Ahsan Danish --}}

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- Dynamic Meta Tags --}}

    <title>{{ $title ?? 'Forevestor' }}</title>
    <meta name="description" content="{{ $meta_description ?? 'Forevestor' }}">



    <link rel="icon" href="{{ asset('/assets/images/favicon.png') }}" type="image/png">
    @include('include.head')
    @stack('style')
</head>

<body>
    <!-- Mobile Menu Toggle -->
    <button class="menu-toggle" id="menuToggle">
        <i class="bi bi-list"></i>
    </button>
    @include('include.sidebar')
    @yield('content')
    @include('include.foot')
    @stack('scripts')
</body>

</html>