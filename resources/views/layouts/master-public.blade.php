<!DOCTYPE html>
<html lang="en">
{{-- Designed And Developed By Ahsan Danish --}}

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- Dynamic Meta Tags --}}
    



    <link rel="icon" href="{{ asset('/assets/images/logo.png') }}" type="image/png">
    @include('include.head-public')
    @yield('style')
</head>

<body>
    @include('include.navbar-public')
    <div class="print-area">
        @yield('content')
    </div>
    @include('include.footer-public')
    @include('include.foot-public')
    @stack('scripts')
</body>

</html>
