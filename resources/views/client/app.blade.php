<!DOCTYPE html>
<html lang="vi" data-theme="light">
<head>
    @include('client.partials.head')
    @stack('styles')
</head>
<body class="gradient-bg ">
    @include('client.partials.header')
    @yield('content')
    @include('client.partials.footer')
    @stack('scripts')
</body>
</html>
