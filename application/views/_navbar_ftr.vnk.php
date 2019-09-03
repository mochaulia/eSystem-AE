<header id="header">
    <div id="center-header">
        <div class="container">
            <div class="header-logo">
                <a href="{{ site_url() }}" class="logo"><img src="{{ images('icon/logo_esystem_title.png') }}" alt="logo-esystem-ae"></a>
            </div>
        </div>
    </div>
    <div id="nav-header">
        <div class="container">
            <nav id="main-nav">
                <div class="nav-logo">
                    <a href="{{ site_url() }}" class="logo"><img src="{{ images('icon/logo_esystem_title.png') }}" alt="logo-esystem-ae"></a>
                </div>
                <ul class="main-nav nav navbar-nav">
                    @if (is_user())
                        <li>
                            <a href="{{ site_url('dashboard') }}">Dashboard</a>
                        </li>
                    @endif
                    <li class="{{ ($this->navbar_active == 'news') ? 'active' : '' }}">
                        <a href="{{ site_url('features/news') }}">News</a>
                    </li>
                    <li class="{{ ($this->navbar_active == 'products') ? 'active' : '' }}">
                        <a href="{{ site_url('features/products') }}">Products</a>
                    </li>
                    <li class="{{ ($this->navbar_active == 'rooms') ? 'active' : '' }}">
                        <a href="{{ site_url('features/rooms') }}">Rooms</a>
                    </li>
                    <li class="{{ ($this->navbar_active == 'rooms_usage') ? 'active' : '' }}">
                        <a href="{{ site_url('features/rooms-usage') }}">Rooms Usage</a>
                    </li>
                </ul>
            </nav>
            <div class="button-nav">
                <button class="search-collapse-btn"><i class="fa fa-search"></i></button>
                <button class="nav-collapse-btn"><i class="fa fa-bars"></i></button>
                @if ($this->navbar_active != 'booking_rooms')
                    <div class="search-form">
                        <form action="{{ site_url('features/' . $this->navbar_active . '/search') }}">
                            <input class="input" type="text" name="v" required placeholder="Search">
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>