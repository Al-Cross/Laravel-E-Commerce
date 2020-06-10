<header class="section-header">
    <section class="navbar-light border-bottom">
        <div class="container">
          <nav class="d-flex align-items-end flex-column">
            <ul class="nav">
                @guest
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">
                        <div class="icon-wrap icon-xs bg-primary round text-white"><i class="fas fa-user"></i></div>
                        <div class="text-wrap"><span>Login</span></div>
                    </a></li>

                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">
                        <div class="icon-wrap icon-xs bg-success round text-white"><i class="fa fa-user"></i></div>
                        <div class="text-wrap"><span>Register</span></div>
                    </a></li>
                     <li  class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link d-flex">
                            <div class="round text-sm-left"><i class="fa fa-shopping-cart"></i> My Cart</div>
                            <span class="badge badge-pill badge-danger">{{ $cartCount }}</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                             <i class="fa fa-user-circle"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->isAdmin())
                                <a class="dropdown-item" href="{{ route('admin.dashboard.index') }}">
                                    Admin Panel
                                </a>
                            @endif
                             <a class="dropdown-item" href="{{ route('profile') }}">
                                My Account
                            </a>
                            <a class="dropdown-item" href="{{ route('wishlist', Auth::user()->id) }}">
                                My Wishlist
                                <span class="badge badge-pill badge-danger">{{ $wishlistCount }}</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li  class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link d-flex">
                            <div class="round text-sm-left"><i class="fa fa-shopping-cart"></i> My Cart</div>
                            <span class="badge badge-pill badge-danger">{{ $cartCount }}</span>
                        </a>
                    </li>
                @endguest
            </ul>
          </nav>
        </div>
    </section>

    <section class="header-main">
        <div class="container">
            <div class="row ">
                <div class="col-lg-3">
                    <div class="brand-wrap">
                        <a href="{{ url('/') }}">
                            <img class="logo" src="{{ asset('frontend/images/logo.png') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <nav class="navbar navbar-main  navbar-expand-lg navbar-light">
                    <ul class="navbar-nav mr-auto">
                        <a class="nav-link" href="/products">Home </a>

                        @foreach ($categories as $category)
                            <li class="nav-item">
                              <a class="nav-link" href="{{ route('category', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <form action="/search" method="GET" class="form-inline my-2 my-lg-0">
                        <div class="input-group">
                          <input type="text"
                                name="query"
                                value="{{ request()->input('query') }}"
                                class="form-control"
                                placeholder="Search">
                          <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                              <i class="fa fa-search"></i>
                            </button>
                          </div>
                        </div>
                    </form>

                    <ul class="nav">
                        <li class="nav-item dropdown">
                                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Sort Products <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href="{{ Request::path() }}?price=desc">
                                        Price Descending
                                    </a>
                                    <a class="dropdown-item" href="{{ Request::path() }}?price=asc">
                                        Price Ascending
                                    </a>
                                     <a class="dropdown-item" href="{{ Request::path() }}?demand=1">
                                        Hottest
                                    </a>
                                </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</header>
