<div>
    <div class="mobile-menu-bar">
        <a href="{{ route('home') }}" class="flex mr-auto">
            <img alt="logo" class="w-6" src="{{ asset('dashboardAsset/dist/images/logo.svg') }}">
        </a>
        <a href="#" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <div class="scrollable">
        <a href="#" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        <ul class="scrollable__content py-2">
            <li>
                <a href="{{ route('home') }}" class="menu {{ url()->current() == route('home') ? 'menu--active' : ''}}">
                    <div class="menu__icon"> <i data-lucide="home"></i> </div>
                    <div class="menu__title"> Dashboard </div>
                </a>
            </li>
            <li>
                <a href="#" class="menu {{ request()->routeIs('user_management*') ? 'menu--active' : ''}}">
                    <div class="menu__icon"> <i data-lucide="users"></i> </div>
                    <div class="menu__title"> User Management <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('user_management.permission.index') }}" class="menu {{ request()->routeIs('user_management.permission*') ? 'menu--active' : ''}}">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Permission </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user_management.role.index') }}" class="menu {{ request()->routeIs('user_management.role*') ? 'menu--active' : ''}}">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Role </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user_management.user.index') }}" class="menu {{ request()->routeIs('user_management.user*') ? 'menu--active' : ''}}">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> User </div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
