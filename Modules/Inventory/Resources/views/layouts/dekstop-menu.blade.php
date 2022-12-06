<li>
    <a href="#" class="side-menu {{ request()->routeIs('inventory*') ? 'side-menu--active': ''}}">
        <div class="side-menu__icon"><i data-lucide="book-open"></i></div>
        <div class="side-menu__title">
            Inventory
            <div class="side-menu__sub-icon "><i data-lucide="chevron-down"></i></div>
        </div>
    </a>
    <ul class="{{ request()->routeIs('inventory*') ? 'side-menu__sub-open': ''}}">
        <li>
            <a href="#"
               class="side-menu {{ request()->routeIs('inventory.category*') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"><i data-lucide="activity"></i></div>
                <div class="side-menu__title"> Category</div>
            </a>
        </li>
        <li>
            <a href="#"
               class="side-menu {{ request()->routeIs('inventory.post*') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"><i data-lucide="activity"></i></div>
                <div class="side-menu__title"> Post</div>
            </a>
        </li>
    </ul>
</li>
