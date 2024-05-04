<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Fresh & Aromatic</p>
                        <h1>Elevate Your Mood</h1>
                        <div class="hero-btns">
                            @guest
                                <a href="{{ route('coffees.index') }}" class="boxed-btn">Coffee Collection</a>
                                <a href="/contact" class="bordered-btn">Contact Us</a>
                            @endguest
                            @auth

                                @if (auth()->user()->usertype === 'admin')
                                    <a href="{{ route('coffees.index') }}" class="boxed-btn">Coffee Collection</a>
                                    <a href="{{ route('orders.index') }}" class="bordered-btn">Order Data</a>
                                @elseif (auth()->user()->usertype === 'superadmin')
                                    <a href="{{ route('coffees.index') }}" class="boxed-btn">Coffee Collection</a>
                                    <a href="{{ route('users.index') }}" class="bordered-btn">User Data</a>
                                @else
                                    <a href="{{ route('coffees.index') }}" class="boxed-btn">Coffee Collection</a>
                                    <a href="/contact" class="bordered-btn">Contact Us</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->
