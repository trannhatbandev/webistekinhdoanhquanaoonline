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
    <link rel="stylesheet" href="{{asset('public/frontend/css/main-cart.css')}}">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/autofill/2.4.0/css/autoFill.dataTables.min.css" rel="stylesheet">
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
                                <li><a href="{{url('/home/cart/show-cart')}}">
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
                                                <span>Yêu thích</span>
                                                <span class="count-whistlist"></span>
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

<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="{{url('/home/cart/show-cart')}}">Giỏ hàng</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
    @php
         $subtotal = 0;
         $total = 0;
         $transport_fee_freeship = 0;
         $totaldiscount = 0;
         $totaltransportfreeship = 0;
    @endphp
</div>
<!-- Breadcrumb End -->
<!-- Cart Main Area Start -->
<div class="cart-main-area ptb-100 ptb-sm-60">
    <div class="container">
        @include('customer.alert_customer')
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <!-- Form Start -->
                <form action="" method="post">
                    @csrf
                    <!-- Table Content Start -->
                    <div class="table-content table-responsive mb-45">
                        <table>
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Hình ảnh</th>
                                <th class="product-name">Sản phẩm</th>
                                <th class="product-price">Giá</th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-subtotal">Tổng</th>
                                <th class="product-remove">Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(session()->get('cart') ==null)
                                <tr><td colspan="6">Giỏ hàng trống</td></tr>
                            @else
                                @foreach(session()->get('cart') as $key => $value)
                                    @php
                                    if (is_numeric($value['product_qty']) && is_numeric($value['product_price'])) {
                                            $subtotal = $value['product_price']*$value['product_qty'];
                                            $total+=$subtotal;
                                            }
                                     @endphp
                                    <input type="hidden" name="cart_session_id" value="{{$value['session_id']}}"/>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href=""><img src="{{asset('public/uploads/products/'.$value['product_image'])}}" alt="cart-image"></a>
                                        </td>
                                        <td class="product-name">
                                            <ul>
                                                <li><a href="#">{{$value['product_name']}}</a></li>

                                                <li>
                                                                <h6>Size:</h6>
                                                                <div class="capacity-cart btn_grid">
                                                                    <div class="btn_wrap">
                                                                        @if($value['size']!=null)
                                                                        <button type="button" value="{{$value['size']}}" data-session_id="{{$value['session_id']}}"
                                                                        class="attributes size selected ok{{$value['session_id']}}">{{$value['size']}}</button>
                                                                        @endif
                                                                    </div>
                                                                    @for($i=0; $i<count($value['arrsize']);$i++)
                                                                        @if($value['size']!=$value['arrsize'][$i])
                                                                            <div class="btn_wrap">
                                                                                <button type="button"  value="{{$value['arrsize'][$i]}}" data-session_id="{{$value['session_id']}}"
                                                                                 class="attributes size ok{{$value['session_id']}}">{{$value['arrsize'][$i]}}</button>
                                                                            </div>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                                <h6>Màu:</h6>
                                                                <div class="colours-cart btn_grid">
                                                                    <div class="btn_wrap">
                                                                        <button type="button" class="attributes colour selected ok{{$value['session_id']}}" data-session_id="{{$value['session_id']}}"
                                                                         value="{{$value['color']}}" style="color: black;">
                                                                            {{$value['color']}}
                                                                        </button>
                                                                    </div>
                                                                    @for($i=0; $i<count($value['arrcolor']);$i++)
                                                                    @if($value['color']!=$value['arrcolor'][$i])
                                                                        <div class="btn_wrap">
                                                                            <button type="button" class="attributes colour ok{{$value['session_id']}}" data-session_id="{{$value['session_id']}}"
                                                                             value="{{$value['arrcolor'][$i]}}" style="color: black;">
                                                                                {{$value['arrcolor'][$i]}}
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                </li>

                                            </ul>
                                        </td>
                                        <td class="product-price"><span class="amount">{{number_format($value['product_price'],0,',','.')}}đ</span></td>
                                        <td class="product-quantity">
                                            <div style="display:flex;align-items: center;">
                                                <button class="btn minus" data-session_id="{{$value['session_id']}}" type="button">-</button>
                                                <input type="text" min="1" name="cart_quantity" value="{{$value['product_qty']}}">
                                                <button class="btn plus" data-session_id="{{$value['session_id']}}" type="button">+</button>
                                            </div>
                                        </td>
{{--                                        <td class="product-quantity"><input type="number" min="1" name="cart_quantity[{{$value['session_id']}}]" value="{{$value['product_qty']}}"></td>--}}
                                        <td class="product-subtotal">{{number_format($subtotal,0,',','.')}}đ</td>
                                        <td class="product-remove"> <a href="{{url('/home/cart/delete-cart/'.$value['session_id'])}}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Content Start -->
                    <div class="row">
                        <!-- Cart Button Start -->
                        <div class="col-md-8 col-sm-12">
                            <div class="buttons-cart">
                                <a href="{{url('/')}}">Tiếp tục mua sắm</a>

                                <a href="{{url('/home/cart/delete-all-cart')}}">Xóa giỏ hàng</a>
                            </div>
                        </div>
                        <!-- Cart Button Start -->
                        <!-- Cart Totals Start -->
                        <div class="col-md-4 col-sm-12">
                            <div class="cart_totals float-md-right text-md-right">
                                <h2>Tổng giỏ hàng</h2>
                                <br>
                                <table class="float-md-right">
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Tổng phụ</th>
                                        <td><span class="amount">{{number_format($total,0,',','.')}}đ</span></td>
                                    </tr>

                                    <tr class="order-total">
                                        <th>Tổng</th>
                                        <td>
                                            <strong><span class="amount">
                                                     @php
                                                             $sum = $total;
                                                             echo number_format($sum,0,',','.').'đ';
                                                     @endphp
                                                </span></strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="wc-proceed-to-checkout">
                                    @if(session()->get('customer_id'))
                                    <a href="{{url('/home/show-checkout')}}" class="btn-primary">Thanh toán</a>
                                    @else
                                    <a href="{{url('/home/show-login-customer')}}" class="btn-primary">Đăng nhập để thanh toán</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Cart Totals End -->
                    </div>
                    <!-- Row End -->
                </form>
                <!-- Form End -->
            </div>
            {{-- <div class="col-md-4 col-sm-12 estimate-ship-tax">
                <form role="form" method="post">
                    @csrf
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                <span class="estimate-title">Vận chuyển</span>
                                <p>Vui lòng hãy chọn địa chỉ giao hàng</p>
                            </th>
                        </tr>
                        </thead><!-- /thead -->
                        <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label class="info-title control-label">Thành phố <span>*</span></label>
                                    <select id="city" name="city" class="form-control select city" >
                                        <option>--Lựa chọn thành phố--</option>
                                        @foreach($city as $key => $value)
                                            <option value="{{$value->matp}}">{{$value->nametp}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="info-title control-label"> Quận huyện <span>*</span></label>
                                    <select id="district1" name="district" class="form-control district select" >
                                        <option>--Lựa chọn quận huyện--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="info-title control-label">Phường xã thị trấn <span>*</span></label>
                                    <select id="ward1" name="ward" class="form-control ward" >
                                        <option>--Lựa chọn phường xã thị trấn--</option>
                                    </select>
                                </div>
                                <div class="pull-right">
                                    <button type="button" class="btn-upper btn btn-primary shipping_charges_apply">Áp dụng phí</button>
                                    @if(session()->get('transport_fee_freeship'))
                                    <a type="button" href="{{url('/home/transport-fee-customer/delete-transport-fee-customer')}}" class="btn-upper btn btn-danger">Xóa phí vận chuyển</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div><!-- /.estimate-ship-tax --> --}}

        </div>
        <!-- Row End -->
    </div>
</div>
<!-- Support Area Start Here -->
<div class="support-area bdr-top">
    <div class="container">
        <div class="d-flex flex-wrap text-center">
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-gift"></i>
                </div>
                <div class="support-desc">
                    <h6>Giá trị lớn</h6>
                    <span>Giá trị đi kèm thương hiệu</span>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-rocket"></i>
                </div>
                <div class="support-desc">
                    <h6>Vận chuyển toàn cầu</h6>
                    <span>Hỗ trợ vận chuyển hầu hết trong nước và ngoài nước</span>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-lock"></i>
                </div>
                <div class="support-desc">
                    <h6>Thanh toán an toàn</h6>
                    <span>Bảo mật là trên hết</span>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-enter-down"></i>
                </div>
                <div class="support-desc">
                    <h6>Tự tin mua sắm</h6>
                    <span>Uy tín đặt lên hàng đầu</span>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-users"></i>
                </div>
                <div class="support-desc">
                    <h6>Trung tâm trợ giúp 24/7</h6>
                    <span>Chăm sóc khách hàng chu đáo nhiệt tình</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Support Area End Here -->
<!-- Footer Area Start Here -->
<footer class="off-white-bg2 pt-95 bdr-top pt-sm-55">
    <!-- Footer Top Start -->
    <div class="footer-top">
        <div class="container">
            <!-- Signup Newsletter Start -->
            <div class="row mb-60">
                <div class="col-xl-7 col-lg-7 ml-auto mr-auto col-md-8">
                    <div class="news-desc text-center mb-30">
                        <h3>Đăng ký để nhận những khuyến mãi mới nhấ</h3>
                        <p>Ngay ngày hôm nay những ưu đãi cực hấp dẫn khi bạn là thành viên của chúng tôi</p>
                    </div>
                    <div class="newsletter-box">
                        <form action="#">
                            <input class="subscribe" placeholder="Địa chỉ email" name="email" id="subscribe" type="text">
                            <button type="submit" class="submit">Đăng ký!</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Signup-Newsletter End -->
            <div class="row">
                <!-- Single Footer Start -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Thông tin</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="about.html">Về chúng tôi</a></li>
                                <li><a href="#">Thông tin giao hàng</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="contact.html">Điều khoản và điều kiện</a></li>
                                <li><a href="login.html">Câu hỏi thường gặp</a></li>
                                <li><a href="login.html">Chính sách hoàn trả</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Dịch vụ khách hàng</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="contact.html">Liên hệ chúng tôi</a></li>
                                <li><a href="#">Lợi nhuận</a></li>
                                <li><a href="#">Lịch sử đơn hàng</a></li>
                                <li><a href="wishlist.html">Danh sách mong muốn</a></li>
                                <li><a href="#">Sơ đồ trang web</a></li>
                                <li><a href="#">Phiếu quà tặng</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Bổ sung</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="#">Tin tức</a></li>
                                <li><a href="#">Thương hiệu</a></li>
                                <li><a href="#">Phiếu quà tặng</a></li>
                                <li><a href="#">Chi nhánh</a></li>
                                <li><a href="#">Đặc biệt</a></li>
                                <li><a href="#">Sơ đồ trang web</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Tài khoản của tôi</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="contact.html">Liên hệ chúng tôi</a></li>
                                <li><a href="#">Lợi nhuận</a></li>
                                <li><a href="#">Tài khoản của tôi</a></li>
                                <li><a href="#">Lịch sử đơn hàng</a></li>
                                <li><a href="wishlist.html">Danh sách mong muốn</a></li>
                                <li><a href="#">Tin tức</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Tài khoản của tôi</h3>
                        <div class="footer-content">
                            <ul class="footer-list address-content">
                                <li><i class="lnr lnr-map-marker"></i> Địa chỉ: Hóc môn, Bà điểm, TP.HCM</li>
                                <li><i class="lnr lnr-envelope"></i><a href="#"> Email kiên hệ: trannhatban34@gmail.com </a></li>
                                <li>
                                    <i class="lnr lnr-phone-handset"></i> Phone: 0978119953
                                </li>
                            </ul>
                            <div class="payment mt-25 bdr-top pt-30">
                                <a href="#"><img class="img" src="{{asset('public/frontend/img/payment/1.png')}}" alt="payment-image"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Top End -->
    <!-- Footer Middle Start -->
    <div class="footer-middle text-center">
        <div class="container">
            <div class="footer-middle-content pt-20 pb-30">
                <ul class="social-footer">
                    <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><img src="{{asset('public/frontend/img/icon/social-img1.png')}}" alt="google play"></a></li>
                    <li><a href="#"><img src=""{{asset('public/frontend/img/icon/social-img2.png')}}" alt="app store"></a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Middle End -->
    <!-- Footer Bottom Start -->
    <div class="footer-bottom pb-30">
        <div class="container">

            {{--                <div class="copyright-text text-center">--}}
            {{--                    <p>Copyright © 2018 <a target="_blank" href="#">Truemart</a> All Rights Reserved.</p>--}}
            {{--                </div>--}}
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Bottom End -->
</footer>
<!-- Footer Area End Here -->
<!-- Quick View Content Start -->
<div class="main-product-thumbnail quick-thumb-content">
    <div class="container">
        <!-- The Modal -->
        <div class="modal fade" id="quick_view">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <!-- Main Thumbnail Image Start -->
                            <div class="col-lg-5 col-md-6 col-sm-5">
                                <!-- Thumbnail Large Image start -->
                                <div id="thumb-1-quick-view" class="tab-content">
                                </div>
                                <!-- Thumbnail Large Image End -->
                                <!-- Thumbnail Image End -->
                                <div class="product-thumbnail mt-20">
                                    <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
{{--                                        <a class="active" data-toggle="tab" href="#thumb-1-quick-view"><img src="{{asset('public/uploads/products/buy-156.png')}}" alt="product-thumbnail"></a>--}}
{{--                                        <a data-toggle="tab" href="#thumb-2"><img src="img\products\13.jpg" alt="product-thumbnail"></a>--}}
{{--                                        <a data-toggle="tab" href="#thumb-3"><img src="img/products/15.jpg" alt="product-thumbnail"></a>--}}
{{--                                        <a data-toggle="tab" href="#thumb-4"><img src="img/products/4.jpg" alt="product-thumbnail"></a>--}}
{{--                                        <a data-toggle="tab" href="#thumb-5"><img src="img/products/5.jpg" alt="product-thumbnail"></a>--}}
                                    </div>
                                </div>
                                <!-- Thumbnail image end -->
                            </div>
                            <!-- Main Thumbnail Image End -->
                            <!-- Thumbnail Description Start -->
                            <form action="" method="POST">
                                @csrf
                                <div id="quick-view-cart"></div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="thubnail-desc fix mt-sm-60">
                                        <h3 id="product_name" class="product-header"></h3>
                                        <div class="pro-price mtb-40">
                                            <p class="d-flex align-items-center"><span id="prev-price-quick-view" class="prev-price"></span><span id="price-quick-view" class="price"></span><span class="saving-price">Giảm 8%</span></p>
                                        </div>
                                        <p id="product_description_quick_view" class="mb-20 pro-desc-details"></p>
                                        <div class="product-size mb-20 clearfix">
                                            <label>Size</label>
                                            <select id="size-quick-view" class=""></select>
                                        </div>
                                        <div class="color mb-20">
                                            <label>Màu:</label>
                                            <ul id="color-quick-view" class="color-list"></ul>
                                        </div>
                                        <div class="box-quantity d-flex">
                                                <input class="quantity mr-40" type="number" min="1" value="1">
                                        </div>
                                        <div id="button-quick-view"></div>
                                        <div class="pro-ref mt-15">
                                            <p><span class="in-stock"><i class="ion-checkmark-round"></i>Còn hàng</span></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Thumbnail Description End -->
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="custom-footer">
                        <div class="socila-sharing">
                            <ul class="d-flex">
                                <li>share</li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View Content End -->
</div>
<!-- Main Wrapper End Here -->

<!-- jquery 3.2.1 -->
<script src="{{asset('public/frontend/js/vendor/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('public/frontend/js/vendor/main-cart.js')}}"></script>
<!-- Countdown js -->
<script src="{{asset('public/frontend/js/jquery.countdown.min.js')}}"></script>
<!-- Mobile menu js -->
<script src="{{asset('public/frontend/js/jquery.meanmenu.min.js')}}"></script>
<!-- ScrollUp js -->
<script src="{{asset('public/frontend/js/jquery.scrollUp.js')}}"></script>
<!-- Nivo slider js -->
<script src="{{asset('public/frontend/js/jquery.nivo.slider.js')}}"></script>
<!-- Fancybox js -->
<script src="{{asset('public/frontend/js/jquery.fancybox.min.js')}}"></script>
<!-- Jquery nice select js -->
<script src="{{asset('public/frontend/js/jquery.nice-select.min.js')}}"></script>
<!-- Jquery ui price slider js -->
<script src="{{asset('public/frontend/js/jquery-ui.min.js')}}"></script>
<!-- Owl carousel -->
<script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
<!-- Bootstrap popper js -->
<script src="{{asset('public/frontend/js/popper.min.js')}}"></script>
<!-- Bootstrap js -->
<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
<!-- Plugin js -->
<script src="{{asset('public/frontend/js/plugins.js')}}"></script>
<script src="{{asset('public/frontend/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/js/bootstrap-hover-dropdown.min.js')}}"></script>
<script src="{{asset('public/frontend/js/bootstrap-slider.min.js')}}"></script>
<!-- Main activaion js -->
<script src="{{asset('public/frontend/js/main.js')}}"></script>
<script src="{{asset('public/frontend/sweetalert/sweetalert.min.js')}}"></script>

<script type="text/javascript">
     $(document).ready(function(){
        countQuantityCart();
        hoverCartProduct();
        function countQuantityCart(){
            $.ajax({
                url: '{{url("/home/cart/count-quantity-cart")}}',
                method: 'GET',
                success:function(data){
                    $('#count-quantity-cart').html(data);
                }
            });
        }
        function hoverCartProduct(){
            $.ajax({
                url: '{{url("/home/cart/hover-cart-product")}}',
                method: 'GET',
                success:function(data){
                    $('.hover-cart-product').html(data);
                }
            });
        }
        function showWistList(){
            if(localStorage.getItem('data')!=null){
                let data_wishlist = JSON.parse(localStorage.getItem('data'));
                $('.count-whistlist').append('danh sách ('+data_wishlist.length+')');
            }
        }
        showWistList();
        function showCompareProduct(){
            if(localStorage.getItem('dataCompare')!=null){
              let dataCompare = JSON.parse(localStorage.getItem('dataCompare'));
                $('.count-compare').append('('+dataCompare.length+')');
            }
        }
        showCompareProduct();
    });
</script>
<script type="text/javascript">
    countOrder()
     function countOrder(){
            $.ajax({
                url: '{{url("/home/count-order")}}',
                method: 'GET',
                success:function(data){
                    $('.count-order').html(data);
                }
            });
        }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.update-cart-quantity').on('click',function(){
             session_id= [];
             cart_quantity= [];
             size = [];
             color = [];
            $('input[name="cart_session_id"]').each(function(){
                session_id.push($(this).val());
            });
            $('input[name="cart_quantity"]').each(function(){
                cart_quantity.push($(this).val());
            });
            for(h=0; h<session_id.length;h++){
                let sel = $('.select_size'+session_id[h]).val();
                size.push(sel);
            }
            $('input[class="color-cart"]').each(function(){
                if($(this).is(':checked')){
                    color.push($(this).val());
                }
            });
            $('')
            list = [];
            let i =0;
            let j =0;
            for(i=0; i<session_id.length; i++){
                for(j=0; j<cart_quantity.length; j++){
                    if(i===j){
                        var element = {session_id: session_id[i],quantity:cart_quantity[j]};

                    }
                }
                list.push(element)
            }

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/home/cart/update-cart')}}',
                method: 'POST',
                data: {size:size,color:color,list:list, session_id:session_id, _token:_token},
                success:function(data) {
                    alert(data);
                    location.reload();
                }
            });
        });
    });
</script>
<script type="text/javascript">
    window.onload = function () {
    const colour_btn_els = document.querySelectorAll(".colours-cart .colour");
    const capacity_btn_els = document.querySelectorAll(".capacity-cart .size");

    for (let i = 0; i < capacity_btn_els.length; i++) {
        let btn = capacity_btn_els[i];

        $(btn).on("click", function () {
            let session_id = $(this).data("session_id");
            document
                .querySelector(".capacity-cart .size.selected.ok" + session_id)
                .classList.remove("selected");
            this.classList.add("selected");

            let size = this.value;

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/home/cart/update-size-cart")}}',
                method: "POST",
                data: {
                    size: size,
                    session_id: session_id,
                    _token: _token,
                },
                success: function (data) {
                    location.reload();
                },
            });
        });
    }
    for (let i = 0; i < colour_btn_els.length; i++) {
        let btn = colour_btn_els[i];

        $(btn).on("click", function () {
            let session_id = $(this).data("session_id");
            document
                .querySelector(".colours-cart .colour.selected.ok" + session_id)
                .classList.remove("selected");
            this.classList.add("selected");


            let color = this.value;

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/home/cart/update-color-cart")}}',
                method: "POST",
                data: {
                    color: color,
                    session_id: session_id,
                    _token: _token,
                },
                success: function (data) {
                    location.reload();
                },
            });
        });
    }
};
</script>
<script type="text/javascript">
    $('#keyword').keyup(function (){
        var value = $(this).val();
        if(value != ''){
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{url('/autocomplete-search')}}",
                method: "post",
                data:{value:value, _token:_token},
                success: function (data){
                    $('#search').fadeIn();
                    $('#search').html(data);
                }
            });
        }else{
            $('#search').fadeOut();
        }
    });
    $(document).on('click','li', function () {
        $('#keyword').val($(this).text());
        $('#search').fadeOut();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.select').on('change',function(){
            var action_change = $(this).attr('id');
            var ma = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action_change=='city'){
                result = 'district1';
            }else{
                result = 'ward1';
            }
            $.ajax({
                url: '{{url("/home/transport-fee/select-transport-fee")}}',
                method: 'POST',
                data: {action_change:action_change, ma:ma, _token:_token},
                success:function(data) {
                    $('#'+result).html(data);
                }
            });
        });
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.shipping_charges_apply').click(function(){
            var matp = $('.city').val();
            var maqh = $('.district').val();
            var maxptt = $('.ward').val();
            var _token = $('input[name="_token"]').val();
            if(matp == '' && maqh=='' && maxptt==''){
                alert('Chọn thành phố để tính phí vận chuyển')
            }else{
                $.ajax({
                    url: '{{url("/home/transport-fee/shipping_charges_apply")}}',
                    method: 'POST',
                    data: {matp:matp,maqh:maqh,maxptt:maxptt, _token:_token},
                    success:function() {
                        location.reload();
                    }
                });
            }
        });
    })
</script>
<script>
    $(document).ready(function(){
        $('select').niceSelect('destroy');
    })
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var minus = document.getElementsByClassName("minus");
        var plus = document.getElementsByClassName("plus");
        var valueNew = 0;
        var click = '';
        for(var i=0 ; i<plus.length; i++){
            var buttonplus = plus[i];
            $(buttonplus).on('click',function (event) {
                click='plus';
                let session_id = $(this).data('session_id');


                var buttonClick = event.target;
                var input = buttonClick.parentElement.children[1];
                var inputValue = input.value;

                valueNew = parseInt(inputValue) +1;

                input.value = valueNew;

                const colour_btn_els = document.querySelectorAll(".colours-cart .colour.ok"+session_id);
                const capacity_btn_els = document.querySelectorAll(".capacity-cart .size.ok"+session_id);

                let size = "";

                for (let i = 0; i <= capacity_btn_els.length; i++) {
                    let btn = capacity_btn_els[i];
                    if($(btn).hasClass('selected')){
                        size =btn.value;
                    }
                }
                let color = "";
                for (let i = 0; i < colour_btn_els.length; i++) {
                    let btn = colour_btn_els[i];

                    if($(btn).hasClass('selected')){
                        color =btn.value;
                    }

                }
                var _token = $('input[name="_token"]').val();
                $.ajax({
                        url: '{{url("/home/cart/update-quantity-product")}}',
                        method: 'POST',
                        data: {click:click,size:size,color:color,session_id:session_id,valueNew:valueNew, _token:_token},
                        success:function(data) {
                            alert(data);
                            location.reload();
                        }
                });
            });
        }
        for(var i=0 ; i<minus.length; i++){
            var buttonminus = minus[i];

            buttonminus.addEventListener('click',function (event) {
                click = 'minus';
                let session_id = $(this).data('session_id');

                var buttonClick = event.target;
                var input = buttonClick.parentElement.children[1];
                var inputValue = input.value;
                var valueNew = parseInt(inputValue) -1;

                if(valueNew >= 1){
                    input.value = valueNew;
                }else{
                    alert('Bạn không thể giảm số lượng xuống 0');
                }
                const colour_btn_els = document.querySelectorAll(".colours-cart .colour.ok"+session_id);
                const capacity_btn_els = document.querySelectorAll(".capacity-cart .size.ok"+session_id);

                let size = "";

                for (let i = 0; i <= capacity_btn_els.length; i++) {
                    let btn = capacity_btn_els[i];
                    if($(btn).hasClass('selected')){
                        size =btn.value;
                    }
                }
                let color = "";
                for (let i = 0; i < colour_btn_els.length; i++) {
                    let btn = colour_btn_els[i];

                    if($(btn).hasClass('selected')){
                        color =btn.value;
                    }

                }
                var _token = $('input[name="_token"]').val();
                $.ajax({
                        url: '{{url("/home/cart/update-quantity-product")}}',
                        method: 'POST',
                        data: {click:click,size:size,color:color,session_id:session_id,valueNew:valueNew, _token:_token},
                        success:function(data) {
                            alert(data);
                            location.reload();
                        }
                });
            })
        }
    })
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.checkout-cart').click(function () {
            var list = new Array();
            var _token = $('input[name="_token"]').val();
                    $("table tbody tr td ").each(function () {
                    $(this).find("input").each(function () {
                    var id = $(this).data("id");
                    var ele = document.getElementsByName('color-'+id);
                    for(i = 0; i < ele.length; i++) {
                            if(ele[i].checked && ele[i] !== undefined)
                            {
                                var element = { key : id, value: ele[i].value};
                            }

                    }
                    list.push(element);
                });
                });
                $.ajax({
                url: '{{url("/home/cart/select-attributes")}}',
                method: 'POST',
                data: {list:list, _token:_token},
                success:function(data) {
                            swal({
                                title: "Đã hoàn tất giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới trang thanh toán để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến trang thanh toán",
                                closeOnConfirm: false
                            },function(data) {
                                window.location.href = "{{url('/home/show-checkout')}}";
                            }
                            );
                }, error: function(xhr, status, error) {
                    alert('Bạn chưa thêm size và màu cho sản phẩm nên không thể đến trang thanh toán');
                }
            });

        });
    });
</script>
</body>

</html>


