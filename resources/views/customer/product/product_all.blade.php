@include('customer.include.header')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="{{url('/home/product/show-all-product')}}">Sản phẩm</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Shop Page Start -->
<div class="main-shop-page pt-100 pb-100 ptb-sm-60">
    <div class="container">
        <!-- Row End -->
        <div class="row">
            <!-- Sidebar Shopping Option Start -->
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="sidebar">
                    <!-- Sidebar Electronics Categorie Start -->
                    <div class="electronics mb-40">
                        <h3 class="sidebar-title">Quần áo</h3>
                        <div id="shop-cate-toggle" class="category-menu sidebar-menu sidbar-style">
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
                    </div>
                    <!-- Sidebar Electronics Categorie End -->
                    <!-- Price Filter Options Start -->
                    <div class="search-filter mb-40">
                        <h3 class="sidebar-title">Lọc theo giá</h3>
                        <form action="" method="GET" class="sidbar-style">
                            <div id="slider-range"></div>
                            <input type="hidden" id="price-start" name="price-start">
                            <input type="hidden" id="price-end" name="price-end">
                            <input type="text" id="amount" class="amount-range" readonly="">
                            <input type="submit" class="btn btn-danger" value="Lọc">
                        </form>
                    </div>
                    <div class="search-filter mb-40">
                        <h3 class="sidebar-title">Sản phẩm đã xem</h3>
                        <div id="viewed-products-hidden"></div>
                        <div id="viewed-products"></div>
                    </div>
                    <!-- Price Filter Options End -->
                    <!-- Sidebar Categorie Start -->
                    {{-- <div class="sidebar-categorie mb-40">
                        <h3 class="sidebar-title">Lọc danh mục</h3>
                        <ul class="sidbar-style">

                            @foreach($allcategory1 as $filterCate)
                            <li class="form-check">
                                <input id="{{$filterCate->category_name}}" class="form-check-input filter-category" name="filter-category"
                                value="{{$filterCate->category_id}}" data-filterCate="category" type="checkbox">
                                <label class="form-check-label" for="{{$filterCate->category_name}}">{{$filterCate->category_name}}</label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Sidebar Categorie Start -->
                    <!-- Product Size Start -->
                    <div class="size mb-40">
                        <h3 class="sidebar-title">Lọc size</h3>
                        <ul class="size-list sidbar-style">
                            <li class="form-check">
                                <input class="form-check-input" value="" id="small" type="checkbox">
                                <label class="form-check-label" for="small">S (6)</label>
                            </li>
                            <li class="form-check">
                                <input class="form-check-input" value="" id="medium" type="checkbox">
                                <label class="form-check-label" for="medium">M (9)</label>
                            </li>
                            <li class="form-check">
                                <input class="form-check-input" value="" id="large" type="checkbox">
                                <label class="form-check-label" for="large">L (8)</label>
                            </li>
                        </ul>
                    </div>
                    <!-- Product Size End -->
                    <!-- Product Color Start -->
                    <div class="color mb-40">
                        <h3 class="sidebar-title">Lọc màu</h3>
                        <ul class="color-option sidbar-style">
                            <li>
                                <span class="white"></span>
                                <a href="#">white (4)</a>
                            </li>
                            <li>
                                <span class="orange"></span>
                                <a href="#">Orange (2)</a>
                            </li>
                            <li>
                                <span class="blue"></span>
                                <a href="#">Blue (6)</a>
                            </li>
                            <li>
                                <span class="yellow"></span>
                                <a href="#">Yellow (8)</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Product Color End --> --}}
                </div>
            </div>
            <!-- Sidebar Shopping Option End -->
            <!-- Product Categorie List Start -->
            <div class="col-lg-9 order-1 order-lg-2">
                <!-- Grid & List View Start -->
                <div class="grid-list-top border-default universal-padding d-md-flex justify-content-md-between align-items-center mb-30">
                    <div class="grid-list-view  mb-sm-15">
                        <ul class="nav tabs-area d-flex align-items-center">
                            <li><a class="active" data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                            <li><a data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
                        </ul>
                    </div>
                    <!-- Toolbar Short Area Start -->
                    <div class="main-toolbar-sorter clearfix">
                        <div class="toolbar-sorter d-flex align-items-center">
                            <label>Sắp xếp:</label>
                            <form>
                                @csrf
                                <select class="sorter wide" id="sort-product">
                                    <option value="{{Request::url()}}?sort-by=all">Tất cả</option>
                                    <option value="{{Request::url()}}?sort-by=az">Từ A tới Z</option>
                                    <option value="{{Request::url()}}?sort-by=za">Từ Z tới A</option>
                                    <option value="{{Request::url()}}?sort-by=lowtohight">Từ thấp đến cao</option>
                                    <option value="{{Request::url()}}?sort-by=highttolow" >Từ cao đến thấp</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <!-- Toolbar Short Area End -->
                    <!-- Toolbar Short Area Start -->
                    <div class="main-toolbar-sorter clearfix">
                        <div class="toolbar-sorter d-flex align-items-center">
                            <label>Hiển thị:</label>
                            <select class="sorter wide">
                                <option value="12">12</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <!-- Toolbar Short Area End -->
                </div>
                <!-- Grid & List View End -->
                <div class="main-categorie mb-all-40">
                    <!-- Grid & List Main Area End -->
                    <div class="tab-content fix">
                        <div id="grid-view" class="tab-pane fade show active">
                            <div class="row">
                                @foreach($products as $key => $value)
                                <!-- Single Product Start -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                    <form>
                                        @csrf
                                        <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                        <input type="hidden" id="wistlist_product_name{{$value->product_id}}" value="{{$value->product_name}}"
                                        class="cart_product_name_{{$value->product_id}}">
                                        <input type="hidden" id="wistlist_product_image_ok{{$value->product_id}}" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                        @if($value->product_percent_discount==0)
                                                <input type="hidden" id="wistlist_product_price{{$value->product_id}}" value="{{$value->product_price}}"
                                                class="cart_product_price_{{$value->product_id}}">
                                        @elseif($value->product_percent_discount>0)
                                                <input type="hidden" id="wistlist_product_price{{$value->product_id}}" value="{{$value->product_price_sale}}"
                                                class="cart_product_price_{{$value->product_id}}">
                                        @endif
                                        <input type="hidden" value="1" class="cart_product_qty_{{$value->product_id}}">
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">
                                                <img class="primary-img" id="wistlist_product_image{{$value->product_id}}" style="height: 225px" src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="single-product">
                                                <img class="secondary-img" style="height: 225px" src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="single-product">
                                            </a>
                                            <a class="quick_view" data-product_id="{{$value->product_id}}" data-toggle="modal" data-target="#quick_view" title="Xem nhanh"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a id="wistlist_product_chitiet{{$value->product_id}}" href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">{{$value->product_name}}</a></h4>
                                                <p><span class="price">{{number_format($value->product_price_sale,0,',','.')}}đ</span><del class="prev-price">{{number_format($value->product_price,0,',','.')}}đ</del></p>
                                                <div class="label-product l_sale">30<span class="symbol-percent">%</span></div>
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <button class="btn btn-secondary icon add-to-cart" data-id_product="{{$value->product_id}}"  type="button" title="Thêm vào giỏ hàng"> + Thêm vào giỏ hàng</button>
                                                </div>
                                                @if(session()->get('customer_id'))
                                                <div class="actions-secondary">
                                                    <a type="button" style="cursor: pointer" class="add-compare-product" data-id="{{$value->product_id}}" title="So sánh"><i class="lnr lnr-sync"></i> <span>So sánh sản phẩm</span></a>
                                                    <a type="button" class="add-whist-list" style="cursor: pointer" data-id="{{$value->product_id}}" title="Yêu thích">
                                                        <i class="lnr lnr-heart"></i> <span>Yêu thích</span></a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    </form>
                                </div>
                                <!-- Single Product End -->
                                @endforeach
                            </div>
                            <!-- Row End -->
                        </div>
                        <!-- #grid view End -->
                        <div id="list-view" class="tab-pane fade">
                            <!-- Single Product Start -->
                            <div class="single-product">
                                <div class="row">
                                    @foreach($productList as $key => $value)
                                    <!-- Product Image Start -->
                                    <div class="col-lg-4 col-md-5 col-sm-12">
                                        <form>
                                            @csrf
                                            <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                            <input type="hidden" id="wistlist_product_name{{$value->product_id}}" value="{{$value->product_name}}"
                                            class="cart_product_name_{{$value->product_id}}">
                                            <input type="hidden" id="wistlist_product_image_ok{{$value->product_id}}" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                            @if($value->product_percent_discount==0)
                                                <input type="hidden" id="wistlist_product_price{{$value->product_id}}" value="{{$value->product_price}}"
                                                class="cart_product_price_{{$value->product_id}}">
                                            @else
                                                <input type="hidden" id="wistlist_product_price{{$value->product_id}}" value="{{$value->product_price_sale}}"
                                                class="cart_product_price_{{$value->product_id}}">
                                            @endif
                                            <input type="hidden" value="1" class="cart_product_qty_{{$value->product_id}}">
                                        <div class="pro-img">
                                            <a href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">
                                                <img style="height: 225px" id="wistlist_product_image{{$value->product_id}}" class="primary-img" src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="single-product">
                                                <img style="height: 225px" class="secondary-img" src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="single-product">
                                            </a>
                                            <a class="quick_view" data-product_id="{{$value->product_id}}" data-toggle="modal" data-target="#quick_view" title="Xem nhanh"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="col-lg-8 col-md-7 col-sm-12">
                                        <div class="pro-content hot-product2">
                                            <h4><a id="wistlist_product_chitiet{{$value->product_id}}" href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">{{$value->product_name}}</a></h4>
                                            <p><span class="price">{{number_format($value->product_price_sale,0,',','.')}}đ</span></p>
                                            <p>{{$value->product_description}}</p>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <button class="btn btn-secondary icon add-to-cart" data-id_product="{{$value->product_id}}"  type="button" title="Thêm vào giỏ hàng"> + Thêm vào giỏ hàng</button>
                                                </div>
                                                @if(session()->get('customer_id'))
                                                <div class="actions-secondary">
                                                    <a type="button" style="cursor: pointer" class="add-compare-product" data-id="{{$value->product_id}}" title="So sánh"><i class="lnr lnr-sync"></i> <span>So sánh sản phẩm</span></a>
                                                    <a type="button" class="add-whist-list" style="cursor: pointer" data-id="{{$value->product_id}}" title="Yêu thích">
                                                        <i class="lnr lnr-heart"></i> <span>Yêu thích</span></a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Content End -->
                                    @endforeach
                                </div>
                            </div>
                            <!-- Single Product End -->
                        </div>
                        <!-- #list view End -->
                        {{-- <div class="pro-pagination">
                            <ul class="blog-pagination">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                            <div class="product-pagination">
                                <span class="grid-item-list">Showing 1 to 12 of 51 (5 Pages)</span>
                            </div>
                        </div> --}}
                        <!-- Product Pagination Info -->
                    </div>
                    <!-- Grid & List Main Area End -->
                </div>
            </div>
            <!-- product Categorie List End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Shop Page End -->

@include('customer.include.footer')


