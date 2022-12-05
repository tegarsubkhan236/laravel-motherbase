<li>
    <a href="#" class="side-menu {{ request()->routeIs('blog*') ? 'side-menu--active': ''}}">
        <div class="side-menu__icon"><i data-lucide="book-open"></i></div>
        <div class="side-menu__title">
            Blog
            <div class="side-menu__sub-icon "><i data-lucide="chevron-down"></i></div>
        </div>
    </a>
    <ul class="{{ request()->routeIs('blog*') ? 'side-menu__sub-open': ''}}">
        @can("view_blog_post")
            <li>
                <a href="{{ route('blog.category.index') }}"
                   class="side-menu {{ request()->routeIs('blog.category*') ? 'side-menu--active' : ''}}">
                    <div class="side-menu__icon"><i data-lucide="activity"></i></div>
                    <div class="side-menu__title"> Category</div>
                </a>
            </li>
            <li>
                <a href="{{ route('blog.post.index') }}"
                   class="side-menu {{ request()->routeIs('blog.post*') ? 'side-menu--active' : ''}}">
                    <div class="side-menu__icon"><i data-lucide="activity"></i></div>
                    <div class="side-menu__title"> Post</div>
                </a>
            </li>
        @endcan
    </ul>
</li>
