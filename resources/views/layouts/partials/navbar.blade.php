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
                            <li class="current-list-item"><a href="/">Home</a></li>
                            <li><a href="/about">About</a></li>
                            <li><a href="#">Event</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Event</a></li>
                                    <li><a href="#">Single Event</a></li>
                                </ul>
                            </li>
                            <li><a href="/contact">Contact</a></li>
                            @guest
                                <li><a href="/shop">Shop</a>
                                </li>
                            @endguest

                            @auth
                                @if (auth()->user()->usertype === 'admin')
                                    <li><a href="/shop">Shop</a></li>
                                    <li><a href="#">Data</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">User</a></li>
                                            <li><a href="#">Product</a></li>
                                        </ul>
                                    </li>
                                @elseif (auth()->user()->usertype === 'customer')
                                    <li><a href="/shop">Shop</a>
                                        <ul class="sub-menu">
                                            <li><a href="/shop">Shop</a></li>
                                            <li><a href="/checkout">Check Out</a></li>
                                            <li><a href="/single-product">Single Product</a></li>
                                            <li><a href="/cart">Cart</a></li>
                                        </ul>
                                    </li>
                                @endif
                                <li><a href="/shop">{{ Auth::user()->name }}</a>
                                    <ul class="sub-menu">

                                        <li><a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                                        <li>
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="route('logout')"
                                                    onclick="event.preventDefault();this.closest('form').submit();">
                                                    Logout
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}">Login</a>
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
