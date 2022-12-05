<div class="h-full flex items-center">
    <!-- BEGIN: Logo -->
    <a href="" class="logo -intro-x hidden md:flex xl:w-[180px] block">
        <img alt="loho" class="logo__image w-6" src="{{ asset('motherbase-logo-picture.png') }}">
        <span class="logo__text text-white text-lg ml-3"> Motherbase </span>
    </a>
    <!-- END: Logo -->
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x h-[45px] mr-auto">
{{--        <ol class="breadcrumb breadcrumb-light">--}}
{{--            <li class="breadcrumb-item"><a href="#">Application</a></li>--}}
{{--            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>--}}
{{--        </ol>--}}
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    <div class="intro-x relative mr-3 sm:mr-6">
        <div class="search hidden sm:block">
            <input type="search" class="search__input form-control border-transparent" placeholder="Search...">
            <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
        </div>
        <a class="notification notification--light sm:hidden" href=""> <i data-lucide="search" class="notification__icon dark:text-slate-500"></i> </a>
        <div class="search-result">
            <div class="search-result__content">
                <div class="search-result__content__title">Pages</div>
                <div class="mb-5">
                    <a href="" class="flex items-center">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="inbox"></i> </div>
                        <div class="ml-3">Mail Settings</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="users"></i> </div>
                        <div class="ml-3">Users & Permissions</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="credit-card"></i> </div>
                        <div class="ml-3">Transactions Report</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Search -->
    <!-- BEGIN: Dark Mode Switcher-->
    <div class="intro-x relative mr-4 sm:mr-6">
        <div data-url="/toggle-theme" class="dark-mode-switcher cursor-pointer shadow-md custom-box dark:bg-dark-2 border rounded-full w-40 h-10 flex items-center justify-center">
            <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
            <div id="toggle_theme" type="checkbox" class="dark-mode-switcher__toggle dark-mode-switcher__toggle--{{ session()->get('theme') == 'dark' ? 'active' : '' }} border"></div>
        </div>
    </div>
    <!-- END: Dark Mode Switcher-->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <img alt="profile" src="{{ asset('dashboardAsset/dist/images/woman-illustration.svg') }}">
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                <li class="p-2">
                    <div class="font-medium">{{ strtoupper(auth()->user()->name)  }}</div>
                    <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">
                        @foreach(auth()->user()->roles()->pluck('name') as $item)
                            {{ $item." |" }}
                        @endforeach
                    </div>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a href="{{ route('profile.personal_info') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile </a>
                </li>
                <li>
                    <a href="{{ route('profile.reset_password') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
