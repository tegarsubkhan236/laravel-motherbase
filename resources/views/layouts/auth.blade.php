<!DOCTYPE html>
<html lang="en" class="{{ session()->get('theme') ?: 'light' }}">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('motherbase-logo-picture.png') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Motherbase</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{asset('dashboardAsset/dist/css/app.css')}}"/>
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="logo" class="w-6" src="{{asset('dashboardAsset/dist/images/logo.svg')}}">
                    <span class="text-white text-lg ml-3"> Motherbase </span>
                </a>
                <div class="my-auto">
                    <img alt="illustration" class="-intro-x w-1/2 -mt-16"
                         src="{{asset('dashboardAsset/dist/images/illustration.svg')}}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A few more clicks to<br>sign in to your account.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
                        Manage all your e-commerce accounts in one place
                    </div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white {{ session()->get('theme') == 'dark' ? 'dark:bg-darkmode-600' : 'light' }} xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    @yield('content')
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
    <!-- BEGIN: Dark Mode Switcher-->
    <div data-url="/toggle-theme" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
        <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
        <div id="toggle_theme" type="checkbox" class="dark-mode-switcher__toggle dark-mode-switcher__toggle--{{ session()->get('theme') == 'dark' ? 'active' : '' }} border"></div>
    </div>
    <!-- END: Dark Mode Switcher-->

    <!-- BEGIN: JS Assets-->
    <script src="{{asset("dashboardAsset/dist/js/app.js")}}"></script>
    <!-- END: JS Assets-->
</body>
</html>
