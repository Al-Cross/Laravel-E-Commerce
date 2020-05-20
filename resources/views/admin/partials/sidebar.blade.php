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
            <a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="{{ route('admin.dashboard.categories') }}">
                <i class="app-menu__icon fas fa-clone"></i>
                <span class="app-menu__label">Categories</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="{{ route('admin.products.create') }}">
                <i class="app-menu__icon fas fa-store"></i>
                <span class="app-menu__label">Add A Product</span>
            </a>
        </li>
    </ul>
</aside>

<script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>

<script>
   jQuery(function($) {
         var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
            $('ul a').each(function() {
            if (this.href === path) {
               $(this).addClass('active');
            }
        });
    });
</script>
