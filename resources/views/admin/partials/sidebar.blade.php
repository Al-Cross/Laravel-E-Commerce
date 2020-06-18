<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">John Doe</p>
            <p class="app-sidebar__user-designation">Backend Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item" href="{{ route('admin.dashboard.index') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="{{ route('admin.dashboard.users') }}"><i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">Users</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="/admin/coupons"><i class="app-menu__icon fas fa-percent"></i>
                <span class="app-menu__label">Coupons</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="{{ route('admin.dashboard.categories') }}">
                <i class="app-menu__icon fas fa-clone"></i>
                <span class="app-menu__label ml-2">Categories</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="{{ route('admin.products.create') }}">
                <i class="app-menu__icon fas fa-store"></i>
                <span class="app-menu__label ml-2">Add A Product</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="{{ route('admin.dashboard.orders') }}">
                <i class="app-menu__icon fas fa-truck"></i>
                <span class="app-menu__label ml-2">Orders</span>
            </a>
        </li>
    </ul>
</aside>

<script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>

<script>
   jQuery(function($) {
         var path = window.location.href;
            $('ul a').each(function() {
            if (this.href === path) {
               $(this).addClass('active');
            }
        });
    });
</script>
