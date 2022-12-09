<!DOCTYPE html>
<html lang="en" class="{{ session()->get('theme') ?: 'light' }}">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('motherbase-logo-picture.png') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Motherbase</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dashboardAsset/dist/css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('plugins/waitme/waitMe.css') }}">
    @stack('css')
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="py-5 md:py-0">
<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    @include('components.mobile-menu')
</div>
<!-- END: Mobile Menu -->
<!-- BEGIN: Top Bar -->
<div
    class="top-bar-boxed h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] mt-12 md:mt-0 -mx-3 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700">
    @include('components.header')
</div>
<!-- END: Top Bar -->
<div class="flex overflow-hidden">
    <!-- BEGIN: Side Menu -->
    @include('components.desktop-menu')
    <!-- END: Side Menu -->
    <!-- BEGIN: Content -->
    <div class="content">
        @yield('content')
    </div>
    <!-- END: Content -->
</div>
<!-- BEGIN: JS Assets-->
<script type="text/javascript" src="{{ asset('dashboardAsset/dist/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery-3.6.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/waitme/waitMe.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/sweetalert2.all.min.js') }}"></script>
<script>
    function run_waitMe(el, num, effect) {
        let text = 'Please wait...';
        let fontSize = '';
        let maxSize = '50';
        let textPos = 'vertical';
        el.waitMe({
            effect: effect,
            text: text,
            bg: '{{ session()->get('theme') == 'dark' ? 'rgba(77,88,111,1.000)' : 'rgba(255,255,255,0.7)' }}',
            color: '{{ session()->get('theme') == 'dark' ? '#fefefe' : '#B71C1C' }}',
            maxSize: maxSize,
            waitTime: -1,
            source: 'img.svg',
            textPos: textPos,
            fontSize: fontSize,
            onClose: function (el) {
            }
        });
    }

    function delay(callback, ms) {
        let timer = 0;
        return function () {
            let context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }
</script>
@stack('js')
<!-- END: JS Assets-->
</body>
</html>
