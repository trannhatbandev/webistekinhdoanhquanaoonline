<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Trang chủ || Shop Quần Áo TNB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicons -->
    <link rel="shortcut icon" href="{{asset('public/frontend/img/favicon.ico')}}">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/main.css')}}">
    <!-- Ionicons css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/ionicons.min.css')}}">
    <!-- linearicons css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/linearicons.css')}}">
    <!-- Nice select css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/nice-select.css')}}">
    <!-- Jquery fancybox css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/jquery.fancybox.css')}}">
    <!-- Jquery ui price slider css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/jquery-ui.min.css')}}">
    <!-- Meanmenu css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/meanmenu.min.css')}}">
    <!-- Nivo slider css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/nivo-slider.css')}}">
    <!-- Owl carousel css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.css')}}">
    <!-- Custom css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/default.css')}}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/responsive.css')}}">
    <link href="{{asset('public/frontend/sweetalert/sweetalert.css')}}" rel='stylesheet' type='text/css'>
    <link href="https://cdn.datatables.net/autofill/2.4.0/css/autoFill.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Modernizer js -->
    <script src="{{asset('public/frontend/js/vendor/modernizr-3.5.0.min.js')}}"></script>
</head>

<body>
<!-- Main Wrapper Start Here -->
<div class="wrapper">
    <!-- Banner Popup Start -->
    <div class="popup_banner">
        <span class="popup_off_banner">×</span>
        <div class="banner_popup_area">
            <img src="{{asset('public/frontend/img/banner/pop-banner.jpg')}}" alt="">
        </div>
    </div>
    <!-- Banner Popup End -->
    <!-- Newsletter Popup Start -->
    <div class="popup_wrapper">
        <div class="test">
            <span class="popup_off">Close</span>
            <div class="subscribe_area text-center mt-60">
                <h2>Đăng ký</h2>
                <p>Đăng ký ngay với website của chúng tôi để được nhận những thông tin khuyến mãi về fashion mới nhất</p>
                <div class="subscribe-form-group">
                    <form action="#">
                        <input autocomplete="off" type="text" name="message" id="message" placeholder="Enter your email address">
                        <button type="submit">Đăng ký</button>
                    </form>
                </div>
                <div class="subscribe-bottom mt-15">
                    <input type="checkbox" id="newsletter-permission">
                    <label for="newsletter-permission">Không muốn hiển thị popup này</label>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter Popup End -->

    <!-- Main Header Area Start Here -->
    <header>
        <!-- Header Top Start Here -->
        <div class="header-top-area">
            <div class="container">
                <!-- Header Top Start -->
                <div class="header-top">
                    <ul>
                        <li><a href="#">Free Shipping cho những đơn hàng 200.000đ trở lên</a></li>
                        <li><a href="#">Mua sắm</a></li>
                        <li><a href="checkout.html">Thanh toán</a></li>
                    </ul>
                    <ul>
                        <li><span style="color: #0f6cb2">Xin chào! {{session()->get('customer_name')}}</span></li>
                    </ul>
                    <ul>
                        <li><a href="#">Tài khoản của tôi<i class="lnr lnr-chevron-down"></i></a>
                            <!-- Dropdown Start -->
                            <ul class="ht-dropdown">
                                @if(session()->get('customer_id'))
                                    <li><a href="{{url('home/logout-customer')}}">Đăng xuất</a></li>
                                @else
                                    <li><a href="{{url('home/show-login-customer')}}">Đăng nhập</a></li>
                                    <li><a href="{{url('home/show-register-customer')}}">Đăng ký</a></li>
                                @endif
                            </ul>
                            <!-- Dropdown End -->
                        </li>
                    </ul>
                </div>
                <!-- Header Top End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Header Top End Here -->
        <!-- Header Middle Start Here -->
        <div class="header-middle ptb-15">
            <div class="container">
                <div class="row align-items-center no-gutters">
                    <div class="col-lg-3 col-md-12">
                        <div class="logo mb-all-30">
                            <a href="{{url('/')}}" style="color: #0d0d0d"><span style="font-size: 35px; color: rgba(46, 138, 138, 1);">SHOP TNB</span></a>
                        </div>
                    </div>
                    <!-- Categorie Search Box Start Here -->
                    <div class="col-lg-5 col-md-8 ml-auto mr-auto col-10">
                        <div class="categorie-search-box">
                            <form action="{{url('/home/search-product')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <select class="bootstrap-select" name="poscats">
                                        <option value="0">Tất cả danh mục</option>
                                    </select>
                                </div>
                                <input type="text" autocomplete="off" name="keyword" id="keyword" placeholder="Tìm kiếm tại đây">
                                <div id="search"></div>
                                <button type="submit"><i class="lnr lnr-magnifier"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Categorie Search Box End Here -->
                    <!-- Cart Box Start Here -->
                    <div class="col-lg-4 col-md-12">
                        <div class="cart-box mt-all-30">
                            <ul class="d-flex justify-content-lg-end justify-content-center align-items-center">
                                <li>
                                    <a href="{{url('/home/cart/show-cart')}}">
                                        <i class="lnr lnr-cart"></i>
                                        <span class="my-cart">
                                            <span class="total-pro" id="count-quantity-cart"></span>
                                            <span>giỏ hàng</span>
                                        </span>
                                        </a>
                                    <ul class="ht-dropdown cart-box-width">
                                        <li class="hover-cart-product"></li>
                                    </ul>
                                </li>
                                @if(session()->get('customer_id'))
                                    <li>
                                        <a href="{{url('/home/wistList')}}">
                                            <i class="lnr lnr-heart"></i>
                                            <span class="my-cart">
                                                <span class="count-whistlist">Yêu thích </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/home/personal-information')}}">
                                            <i class="fas fa-user"></i>
                                            <span class="my-cart">
                                                <span class="">Thông tin cá nhân</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/home/product/show-product-compare')}}">
                                            <i class="lnr lnr-sync"></i>
                                            <span class="my-cart">
                                                <span class="count-compare">So sánh</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/home/history/history-order')}}">
                                            <i class="lnr lnr-envelope"></i>
                                            <span class="count-order">
                                                <span>Đơn hàng</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li><a href="{{url('home/logout-customer')}}"><i class="lnr lnr-user"></i><span class="my-cart"><span><strong>Đăng xuất</strong></span></span></a></li>
                                @else
                                    <li><a href="{{url('home/show-login-customer')}}"><i class="lnr lnr-user"></i><span class="my-cart"><span> <strong>Đăng nhập</strong></span></span></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- Cart Box End Here -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Header Middle End Here -->
        <!-- Header Bottom Start Here -->
        <div class="header-bottom  header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4 col-md-6 vertical-menu d-none d-lg-block">
                        <span class="categorie-title">Danh mục mua sắm</span>
                    </div>
                    <div class="col-xl-9 col-lg-8 col-md-12 ">
                        <nav class="d-none d-lg-block">
                            <ul class="header-bottom-list d-flex">
                                <li class="active"><a href="{{url('/')}}">Trang chủ</a></li>
                                <li><a href="{{url('/home/product/show-all-product')}}">Sản phẩm</a></li>
                                <li><a href="{{url('/home/all-blog')}}">Bài viết</a></li>
                                <li><a href="about.html">Thông tin về chúng tôi</a></li>
                                <li><a href="{{url('/home/contact')}}">Liên hệ</a></li>
                            </ul>
                        </nav>
                        <div class="mobile-menu d-block d-lg-none">
                            <nav>
                                <ul>
                                    <li><a href="{{url('/')}}">Trang chủ</a></li>
                                    <li><a href="{{url('/home/product/show-all-product')}}">Sản phẩm</a></li>
                                    <li><a href="{{url('/home/all-blog')}}">Bài viết</a></li>
                                    <li><a href="about.html">Thông tin về chúng tôi</a></li>
                                    <li><a href="{{url('/home/contact')}}">Liên hệ</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Header Bottom End Here -->
        <!-- Mobile Vertical Menu Start Here -->
        <div class="container d-block d-lg-none">
            <div class="vertical-menu mt-30">
                <span class="categorie-title mobile-categorei-menu">Danh mục mua sắm</span>
                <nav>
                    <div id="cate-mobile-toggle" class="category-menu sidebar-menu sidbar-style mobile-categorei-menu-list menu-hidden ">
                        <ul>
                            @foreach($allcategoryparent1 as $key => $value)
                                @if($value->category_parent == 0)
                                    <li class="has-sub"><a href="#">{{$value->category_name}}</a>
                                        <ul class="category-sub">
                                            @foreach($allcategoryparent1 as $key => $categorychild )
                                                @if($categorychild->category_parent == $value->category_id)
                                                    <li><a href="{{url('/home/category/show-product-with-category/'.$categorychild->category_slug)}}">{{$categorychild->category_name}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <!-- category submenu end-->
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- category-menu-end -->
                </nav>
            </div>
        </div>
        <!-- Mobile Vertical Menu Start End -->
    </header>
    <!-- Main Header Area End Here -->
    <!-- Categorie Menu & Slider Area Start Here -->
    <div class="main-page-banner pb-50 off-white-bg home-3">
        <div class="container">
            <div class="row">
                <!-- Vertical Menu Start Here -->
                <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                    <div class="vertical-menu mb-all-30">
                        <nav>
                            <ul class="vertical-menu-list">
                                <li><a href="{{url('/home/product/show-all-product')}}"><span><img src="{{asset('public/frontend/img/vertical-menu/6.png')}}" alt="menu-icon"></span>Thời trang<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <!-- Vertical Mega-Menu Start -->
                                    <ul class="ht-dropdown megamenu megamenu-two">
                                        @foreach($allcategoryparent1 as $key => $value)
                                            @if($value->category_parent == 0)
                                                <!-- Single Column Start -->
                                                <li class="single-megamenu">
                                                    <ul>
                                                        <li class="menu-tile">{{$value->category_name}}</li>
                                                        @foreach($allcategoryparent1 as $key => $categorychild )
                                                            @if($categorychild->category_parent == $value->category_id)
                                                                <li><a href="{{url('/home/category/show-product-with-category/'.$categorychild->category_slug)}}">{{$categorychild->category_name}}</a></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <!-- Single Column End -->
                                            @endif
                                        @endforeach
                                    </ul>
                                    <!-- Vertical Mega-Menu End -->
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Vertical Menu End Here -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Categorie Menu & Slider Area End Here -->
