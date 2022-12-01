<nav class="side-nav">
    <ul>
        <li>
            <a href="{{ route('home') }}" class="side-menu {{ url()->current() == route('home') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                <div class="side-menu__title">
                    Dashboard
                </div>
            </a>
        </li>
        @can("ms_view_role")
        <li>
            <a href="#" class="side-menu {{ request()->routeIs('user_management*') ? 'side-menu--active': ''}}">
                <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                <div class="side-menu__title">
                    Users Management
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="{{ request()->routeIs('user_management*') ? 'side-menu__sub-open': ''}}">
                @can("ms_view_permission")
                <li>
                    <a href="{{ route('user_management.permission.index') }}"
                       class="side-menu {{ request()->routeIs('user_management.permission*') ? 'side-menu--active' : ''}}">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Permission </div>
                    </a>
                </li>
                @endcan
                @can("ms_view_role")
                <li>
                    <a href="{{ route('user_management.role.index') }}"
                       class="side-menu {{ request()->routeIs('user_management.role*') ? 'side-menu--active' : ''}}">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Role </div>
                    </a>
                </li>
                @endcan
                @can("ms_view_user")
                <li>
                    <a href="{{ route('user_management.user.index') }}"
                       class="side-menu {{ request()->routeIs('user_management.user*') ? 'side-menu--active' : ''}}">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> User </div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
    </ul>
</nav>
