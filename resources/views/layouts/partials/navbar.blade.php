<!-- Header -->
<header id="wn__header" class="oth-page header__area header__absolute sticky__header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-7 col-lg-2">
                <div class="logo">
                    <a href="{{ route('posts.index') }}">
                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo images">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex justify-content-start">
                        <li class="drop with--one--item"><a href="{{ route('posts.index') }}">Home</a></li>
                        <li class="drop with--one--item"><a href="{{ route('page','about-us') }}">about us</a></li>
                        <li class="drop with--one--item"><a href="{{ route('page','our-vision') }}">our vision</a></li>
                        <li class="drop"><a href="javascript:void(0)">Blog</a>
                            <div class="megamenu dropdown">
                                <ul class="item item01">
                                    @forelse ($global_categories as $category)
                                    <li><a href="{{ route('posts.category', $category->slug) }}">{{ $category->name }}</a></li>
                                    @empty
                                    <li><a href="javascript:void(0)">no categories found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-8 col-sm-8 col-5 col-lg-2">
                <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                    <li class="shop_search"><a class="search__active" href="#"></a></li>
                    {{-- <li class="wishlist"><a href="#"></a></li> --}}
                    <li class="shopcart"><a class="cartbox_active" href="#"><span class="product_qun">3</span></a>
                        <!-- Start Shopping Cart -->
                        <div class="block-minicart minicart__active">
                            <div class="minicart-content-wrapper">
                                <div class="micart__close">
                                    <span>close</span>
                                </div>
                                <div class="single__items">
                                    <div class="miniproduct">
                                        <div class="item01 d-flex">
                                            <div class="thumb">
                                                <a href="product-details.html"><img src="{{ asset('assets/images/blog/sm-img/1.jpg') }} " alt="product images"></a>
                                            </div>
                                            <div class="content">

                                                <a>you have new comment on your post : post title</a>

                                                {{-- <h6><a href="product-details.html">Compete Track Tote</a></h6>
                                                <span class="prize">$40.00</span>
                                                <div class="product_prize d-flex justify-content-between">
                                                    <span class="qun">Qty: 03</span>
                                                    <ul class="d-flex justify-content-end">
                                                        <li><a href="#"><i class="zmdi zmdi-settings"></i></a></li>
                                                        <li><a href="#"><i class="zmdi zmdi-delete"></i></a></li>
                                                    </ul>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Shopping Cart -->
                    </li>

                    <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                        <div class="searchbar__content setting__block">
                            <div class="content-inner">
                                <div class="switcher-currency">
                                    <strong class="label switcher-label">
                                        <span>My Account</span>
                                    </strong>
                                    <div class="switcher-options">
                                        <div class="switcher-currency-trigger">
                                            <div class="setting__menu">
                                                @auth
                                                    <span><a href="#">My Account</a></span>
                                                    <span><a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                            Logout
                                                        </a>
                                                    </span>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                @else
                                                    <span><a href="{{ route('login') }}">Login </a></span>
                                                    <span><a href="{{ route('register') }}">Register</a></span>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Start Mobile Menu -->
        <div class="row d-none">
            <div class="col-lg-12 d-none">
                <nav class="mobilemenu__nav">
                    <ul class="meninmenu">
                        <li><a href="{{ route('posts.index') }}">Home</a></li>
                        <li><a href="{{ route('page','about-us') }}">about us</a></li>
                        <li><a href="{{ route('page','our-vision') }}">our vision</a></li>
                        <li><a href="javascript:void(0)">Blog</a>
                            <div class="megamenu dropdown">
                                <ul class="item item01">
                                    @forelse ($global_categories as $category)
                                    <li><a href="{{ route('posts.category', $category->slug) }}">{{ $category->name }}</a></li>
                                    @empty
                                    <li><a href="javascript:void(0)">no categories found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Mobile Menu -->
        <div class="mobile-menu d-block d-lg-none">
        </div>
        <!-- Mobile Menu -->
    </div>
</header>
<!-- //Header -->
<!-- Start Search Popup -->
<div class="box-search-content search_active block-bg close__top">
    <form id="search_mini_form" class="minisearch" action="{{ route('posts.search') }}" method="get">
        <div class="field__search">
            <input type="text" placeholder="Search entire blog here..." name="search" value="{{ old('search',request()->search) }}">
            <div class="action">
                <a href="javascript:void(0)"><i class="zmdi zmdi-search"></i></a>
            </div>
        </div>
    </form>
    <div class="close__wrap">
        <span>close</span>
    </div>
</div>
<!-- End Search Popup -->
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area bg-image--4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">Blog Page</h2>
                    <nav class="bradcaump-content">
                    <a class="breadcrumb_item" href="{{ route('posts.index') }}">Home</a>
                    <span class="brd-separetor">/</span>
                    <span class="breadcrumb_item active">Blog</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
