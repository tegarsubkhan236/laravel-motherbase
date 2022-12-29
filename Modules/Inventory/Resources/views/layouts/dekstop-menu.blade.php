<li>
    <a href="#" class="side-menu {{ request()->routeIs('inventory*') ? 'side-menu--active': ''}}">
        <div class="side-menu__icon"><i data-lucide="cpu"></i></div>
        <div class="side-menu__title">
            Inventory
            <div class="side-menu__sub-icon "><i data-lucide="chevron-down"></i></div>
        </div>
    </a>
    <ul class="{{ request()->routeIs('inventory*') ? 'side-menu__sub-open': ''}}">
        <li>
            <a href="#" class="side-menu {{ request()->routeIs('inventory.master*') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"><i data-lucide="database"></i></div>
                <div class="side-menu__title">
                    Master
                    <div class="side-menu__sub-icon "><i data-lucide="chevron-down"></i></div>
                </div>
            </a>
            <ul class="{{ request()->routeIs('inventory.master*') ? 'side-menu__sub-open': ''}}">
                <li>
                    <a href="{{ route('inventory.master.supplier.index') }}"
                       class="side-menu {{ request()->routeIs('inventory.master.supplier*') ? 'side-menu--active' : ''}}">
                        <div class="side-menu__icon"><i data-lucide="zap"></i></div>
                        <div class="side-menu__title">Supplier</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('inventory.master.item.index') }}"
                       class="side-menu {{ request()->routeIs('inventory.master.item*') ? 'side-menu--active' : ''}}">
                        <div class="side-menu__icon"><i data-lucide="zap"></i></div>
                        <div class="side-menu__title">Items</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('inventory.master.stock.index') }}"
                       class="side-menu {{ request()->routeIs('inventory.master.stock*') ? 'side-menu--active' : ''}}">
                        <div class="side-menu__icon"><i data-lucide="zap"></i></div>
                        <div class="side-menu__title">Stocks</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
        <li>
            <a href="#" class="side-menu">
                <div class="side-menu__icon"><i data-lucide="plus-circle"></i></div>
                <div class="side-menu__title">
                    Stock In
                    <div class="side-menu__sub-icon "><i data-lucide="chevron-down"></i></div>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="side-menu">
                <div class="side-menu__icon"><i data-lucide="minus-circle"></i></div>
                <div class="side-menu__title">
                    Stock Out
                    <div class="side-menu__sub-icon "><i data-lucide="chevron-down"></i></div>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('inventory.po.index') }}"
               class="side-menu {{ request()->routeIs('inventory.po*') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"><i data-lucide="package-search"></i></div>
                <div class="side-menu__title"> Purchase Order</div>
            </a>
        </li>
        <li>
            <a href="{{ route('inventory.receive.index') }}"
               class="side-menu {{ request()->routeIs('inventory.receive*') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"><i data-lucide="package-plus"></i></div>
                <div class="side-menu__title"> Receiving Order</div>
            </a>
        </li>
        <li>
            <a href="{{ route('inventory.sales.index') }}"
               class="side-menu {{ request()->routeIs('inventory.sales*') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"><i data-lucide="package-minus"></i></div>
                <div class="side-menu__title"> Sales</div>
            </a>
        </li>
    </ul>
</li>
