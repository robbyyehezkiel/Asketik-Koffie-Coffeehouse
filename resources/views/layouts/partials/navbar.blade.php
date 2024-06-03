<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="/">
                            <img src="assets/img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- logo -->
                    <nav class="main-menu">
                        <ul>
                            <li class="{{ Request::is('/') ? 'current-list-item' : '' }}"><a href="/">Home</a>
                            </li>
                            @guest
                                <li class="{{ Request::is('about') ? 'current-list-item' : '' }}"><a
                                        href="/about">About</a></li>
                                <li class="{{ Request::is('coffees') ? 'current-list-item' : '' }}"><a
                                        href="/coffees">Shop</a></li>
                                <li class="{{ Request::is('contact') ? 'current-list-item' : '' }}"><a
                                        href="/contact">Contact</a></li>
                            @endguest

                            @auth
                                @if (auth()->user()->usertype === 'admin')
                                    <li class="{{ Request::is('coffees') ? 'current-list-item' : '' }}"><a
                                            href="{{ route('coffees.index') }}">Shop</a></li>
                                    <li class="{{ Request::is('orders') ? 'current-list-item' : '' }}"><a
                                            href="{{ route('orders.index') }}">Orders</a></li>
                                @elseif (auth()->user()->usertype === 'customer')
                                    <li class="{{ Request::is('about') ? 'current-list-item' : '' }}"><a
                                            href="/about">About</a></li>
                                    <li class="{{ Request::is('contact') ? 'current-list-item' : '' }}"><a
                                            href="/contact">Contact</a></li>
                                    <li class="{{ Request::is('coffees') ? 'current-list-item' : '' }}">
                                        <a href="/coffees">Shop</a>
                                        <ul class="sub-menu">
                                            <li class="{{ Request::is('coffees') ? 'current-list-item' : '' }}"><a
                                                    href="/coffees">Shop</a></li>
                                            <li class="{{ Request::is('cart') ? 'current-list-item' : '' }}"><a
                                                    href="/cart">Cart</a></li>
                                        </ul>
                                    </li>
                                @elseif (auth()->user()->usertype === 'superadmin')
                                    <li class="{{ Request::is('coffees') ? 'current-list-item' : '' }}"><a
                                            href="/coffees">Coffee</a></li>
                                    <li class="{{ Request::is('users') ? 'current-list-item' : '' }}"><a
                                            href="{{ route('users.index') }}">User</a></li>
                                @endif
                                <li class="{{ Request::is('profile*') ? 'current-list-item' : '' }}">
                                    <a href="/coffees">{{ Auth::user()->name }}</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                                        <li>
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="route('logout')"
                                                    onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="{{ Request::is('login') ? 'current-list-item' : '' }}">
                                    <a href="{{ route('login') }}">Login</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    </ul>
                                </li>
                            @endauth


                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->

<!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn"><i class="fas fa-window-close"></i></span>
                <div class="search-bar">
                    <div class="search-bar-tablecell">
                        <h3>Search For:</h3>
                        <input type="text" placeholder="Keywords">
                        <button type="submit">Search <i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search arewa -->
