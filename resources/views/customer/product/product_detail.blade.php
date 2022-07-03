@include('customer.include.header')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li><a href="{{url('/home/product/show-all-product')}}">Sản phẩm</a></li>
                <li class="active"><a href="product.html">Chi tiết sản phẩm</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Product Thumbnail Start -->
<div class="main-product-thumbnail ptb-100 ptb-sm-60">
    <div class="container">
        <div class="thumb-bg">
            <input type="hidden" id="viewed-products-id" value="{{$product_detail->product_id}}">
            <input type="hidden" id="viewed-products-name{{$product_detail->product_id}}" value="{{$product_detail->product_name}}">
            <input type="hidden" id="viewed-products-image-ok{{$product_detail->product_id}}" value="{{$product_detail->product_image}}">
            <input type="hidden" id="viewed-products-url{{$product_detail->product_id}}" value="{{url('/home/product-detail/show-product-detail/'.$product_detail->product_slug)}}">
            <input type="hidden" id="viewed-products-price{{$product_detail->product_id}}" value="{{$product_detail->product_price}}">
            <input type="hidden" id="viewed-products-image{{$product_detail->product_id}}" value="{{asset('public/uploads/products/'.$product_detail->product_image)}}">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-lg-5 mb-all-40">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        <div id="thumb1" class="tab-pane fade show active">
                            <a data-fancybox="images" id="wistlist_product_image{{$product_detail->product_id}}" href="{{asset('public/uploads/products/'.$product_detail->product_image)}}"><img src="{{asset('public/uploads/products/'.$product_detail->product_image)}}" alt="product-view"></a>
                        </div>
                        @if($gallery!=null)
                        @foreach($gallery as $key => $value)
                            <div id="{{$key}}" class="tab-pane fade">
                                <a data-fancybox="images" href="{{asset('public/uploads/gallerys/'.$value->gallery_image)}}"><img src="{{asset('public/uploads/gallerys/'.$value->gallery_image)}}" alt="product-view"></a>
                            </div>
                        @endforeach
                        @endif
                    </div>
                    <!-- Thumbnail Large Image End -->
                    <!-- Thumbnail Image End -->
                    <div class="product-thumbnail mt-15">
                        <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                            <a class="active" data-toggle="tab" href="#thumb1"><img src="{{asset('public/uploads/products/'.$product_detail->product_image)}}" alt="product-thumbnail"></a>
                            @if($gallery_2!=null)
                            @foreach($gallery_2 as $key => $value)
                                    <a data-toggle="tab" href="#{{$key}}"><img src="{{asset('public/uploads/gallerys/'.$value->gallery_image)}}" alt="product-thumbnail"></a>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    <!-- Thumbnail image end -->
                </div>

                <!-- Main Thumbnail Image End -->
                <!-- Thumbnail Description Start -->
                <div class="col-lg-7">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$product_detail->product_id}}" class="cart_product_id_{{$product_detail->product_id}}">
                        <a id="wistlist_product_chitiet{{$product_detail->product_id}}" href="{{url('/home/product-detail/show-product-detail/'.$product_detail->product_slug)}}"></a>
                        <input type="hidden" id="wistlist_product_name{{$product_detail->product_id}}" value="{{$product_detail->product_name}}" class="cart_product_name_{{$product_detail->product_id}}">
                        <input type="hidden" id="wistlist_product_image_ok{{$product_detail->product_id}}" value="{{$product_detail->product_image}}" class="cart_product_image_{{$product_detail->product_id}}">
                        <input type="hidden" id="wistlist_product_price{{$product_detail->product_id}}" value="{{$product_detail->product_price}}" class="cart_product_price_{{$product_detail->product_id}}">
                    <div class="thubnail-desc fix">
                        <h3 class="product-header">{{$product_detail->product_name}}</h3>
                        <div class="rating-summary fix mtb-10">
                            <div class="list-inline rating" style="display: flex">
                                @for($i=1 ; $i<=5; $i++)
                                        @if($i <= $starRating && $starRating >0)
                                            <?php
                                                $star = 'color: #ffcc00;';
                                            ?>
                                        @else
                                            <?php
                                                $star= 'color: #ccc;';
                                            ?>
                                        @endif
                                <li
                                    {{-- class="start-rating" --}}
                                    style="cursor: pointer; {{$star}}; font-size: 35px;">
                                       &#9733;
                                </li>
                                @endfor
                            </div>
                            <div class="rating-feedback">
                                <a href="#">({{$countcomment}} đánh giá)</a>
                            </div>
                        </div>
                        <div class="pro-price mtb-30">
                            @if($product_detail->product_percent_discount>0)
                                <p class="d-flex align-items-center"><span class="prev-price">{{number_format($product_detail->product_price,0,',','.')}}đ</span><span class="price">{{number_format($product_detail->product_price_sale,0,',','.')}}đ</span></p>
                            @else
                                <p class="d-flex align-items-center"><span class="price">{{number_format($product_detail->product_price,0,',','.')}}đ</span></p>
                            @endif
                        </div>
                        <p class="mb-20 pro-desc-details">{{$product_detail->product_description}}</p>
                        <form>
                            @csrf
                        <section class="product-detail">
                                <div class="detail">
                                    <div class="options">
                                        <h2>Size</h2>
                                        <div class="capacity btn_grid">
                                            <div class="btn_wrap">
                                                @if(count($arraysize)>0)
                                                <button type="button" data-product_id="{{$product_detail->product_id}}"  value="{{$arraysize[0]}}" class="size selected">{{$arraysize[0]}}</button>
                                                @endif
                                            </div>
                                            @if($arraysize!=null)
                                            @for($i=1; $i<count($arraysize);$i++)
                                                <div class="btn_wrap">
                                                    <button type="button" data-product_id="{{$product_detail->product_id}}"  value="{{$arraysize[$i]}}" class="size">{{$arraysize[$i]}}</button>
                                                </div>
                                            @endfor
                                            @endif
                                        </div>
                                        <h2>Màu</h2>
                                        <div class="colours btn_grid">
                                            <div class="btn_wrap">
                                                @if(count($arraycolorname)>0)
                                                <button type="button" data-product_id="{{$product_detail->product_id}}"  class="colour select" value="{{$arraycolorname[0]}}" style="color: black;">
                                                    {{$arraycolorname[0]}}
                                                </button>
                                                @endif
                                            </div>
                                            @if(count($arraycolorname)>0 && count($arraycolorcode)>0)
                                            @for($i=1; $i<count($arraycolorname);$i++)
                                                @for($j=1; $j<count($arraycolorcode);$j++)
                                                    @if($i==$j)
                                            <div class="btn_wrap">
                                                <button type="button" data-product_id="{{$product_detail->product_id}}" class="colour" value="{{$arraycolorname[$i]}}" style="color: black;" data-colour="{{$arraycolorcode[$i]}}">
                                                    {{$arraycolorname[$i]}}
                                                </button>
                                            </div>
                                                    @endif
                                                @endfor
                                            @endfor
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </form>
                        <div class="box-quantity d-flex hot-product2">
                            <form action="#">
                                <input class="quantity mr-15 cart_product_qty_{{$product_detail->product_id}}" type="number" min="1" value="1">
                            </form>
                            <div class="pro-actions">
                                <div class="actions-primary">
                                    <button class="btn btn-danger icon add-to-cart-detail" data-id_product="{{$product_detail->product_id}}"  type="button" title="" data-original-title="Thêm vào giỏ hàng"> + Thêm vào giỏ hàng</button>
                                </div>
                                <div class="actions-secondary">
                                    @if(session()->get('customer_id'))
                                    <a type="button" style="cursor: pointer" class="add-compare-product" data-id="{{$product_detail->product_id}}" title="So sánh"><i class="lnr lnr-sync"></i> <span>So sánh sản phẩm</span></a>
                                        <a type="button" class="add-whist-list" style="cursor: pointer" data-id="{{$product_detail->product_id}}" title="Yêu thích">
                                            <i class="lnr lnr-heart"></i> <span>Yêu thích</span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div class="pro-ref mt-20">
                                <p><span class="in-stock" style="color: #FF6347" id="in-stock">Còn: {{$quantity}}</span></p>
                            </div>
                        <div class="row">
                            <div class="fb-comments" data-href="http://luanvantotnghiep.com/home/product-detail/show-product-detail/{{$product_detail->product_slug}}" data-width="" data-numposts="5"></div>
                        </div>
                        <div class="socila-sharing mt-25">
                            <ul class="d-flex">
                                <li>Chia sẻ</li>
                                <div class="fb-like" data-href="http://luanvantotnghiep.com/home/product-detail/show-product-detail/{{$product_detail->product_slug}}" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
                                <div class="fb-share-button" data-href="http://luanvantotnghiep.com/home/product-detail/show-product-detail/{{$product_detail->product_slug}}" data-layout="button_count"
                                data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://luanvantotnghiep.com/home/product-detail/show-product-detail/{{$product_detail->product_slug}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                            </ul>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- Thumbnail Description End -->

            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Product Thumbnail End -->
<!-- Product Thumbnail Description Start -->
<div class="thumnail-desc pb-100 pb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="main-thumb-desc nav tabs-area" role="tablist">
                    <li><a class="active" data-toggle="tab" href="#dtail">Mô tả sản phẩm</a></li>
                    @if(session()->get('customer_id'))
                    <li><a data-toggle="tab" href="#review">Nhận xét đánh giá</a></li>
                    @endif
                </ul>
                <!-- Product Thumbnail Tab Content Start -->
                <div class="tab-content thumb-content border-default">
                    <div id="dtail" class="tab-pane fade show active    ">
                        <p>{{$product_detail->product_description}}</p>
                    </div>
                    @if(session()->get('customer_id'))
                    <div id="review" class="tab-pane fade ">
                        <!-- Reviews Start -->
                        <div class="review border-default universal-padding">
                            <div class="group-title">
                                <h2>Khách hàng đánh giá</h2>
                            </div>
                        </div>
                        <!-- Reviews End -->
                        <!-- Reviews Start -->
                        <div class="review border-default universal-padding mt-30">
                            <h2 class="review-title mb-30">Nhận xét của bạn: <br><span>{{$product_detail->product_name}}</span></h2>
                            <p class="review-mini-title">Đánh giá của bạn</p>
                            <ul class="list-inline rating" style="display: flex">
                                <!-- Single Review List Start -->
                                @for($i=1 ; $i<=5; $i++)
                                        @if($i <= $starRating && $starRating >0)
                                            <?php
                                                $star = 'color: #ffcc00;';
                                            ?>
                                        @else
                                            <?php
                                                $star= 'color: #ccc;';
                                            ?>
                                        @endif
                                <li id="{{$product_detail->product_id}}-{{$i}}" data-position="{{$i}}"
                                    data-product_id="{{$product_detail->product_id}}" data-start_rating="{{$starRating}}"
                                    class="start-rating"
                                    style="cursor: pointer; {{$star}}; font-size: 35px;">
                                       &#9733;
                                </li>
                                @endfor
                                <!-- Single Review List End -->
                            </ul>
                            <form method="POST">
                                @csrf
                                <input type="hidden" name="comment" class="comment_id" value="{{$product_detail->product_id}}">
                                <div class="product-reviews mt-5">
                                    <h4 class="title">Nhận xét của khách hàng</h4>

                                    <div class="reviews mt-3">
                                        <div class="review" id="comment"></div>
                                    </div><!-- /.reviews -->
                                </div><!-- /.product-reviews -->
                            </form>
                            <!-- Reviews Field Start -->
                            <div class="riview-field mt-40">
                                <form action="#" method="POST">
                                    @csrf
                                    <input type="hidden" class="comment_id" value="{{$product_detail->product_id}}">
                                    <div class="form-group">
                                        <label >Nhận xét</label>
                                        <textarea class="form-control comment_area" rows="5"></textarea>
                                    </div>
                                    <button type="button" class="customer-btn comment_add">Thêm nhận xét</button>
                                </form>
                            </div>
                            <!-- Reviews Field Start -->
                        </div>
                        <!-- Reviews End -->
                    </div>
                    @endif
                </div>
                <!-- Product Thumbnail Tab Content End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Product Thumbnail Description End -->
<!-- Realted Products Start Here -->
<div class="hot-deal-products off-white-bg pt-100 pb-90 pt-sm-60 pb-sm-50">
    <div class="container">
        <!-- Product Title Start -->
        <div class="post-title pb-30">
            <h2>Sản phẩm liên quan</h2>
        </div>
        <!-- Product Title End -->
        <!-- Hot Deal Product Activation Start -->
        <div class="hot-deal-active owl-carousel">
            @foreach($product_relate as $key => $value)
            <!-- Single Product Start -->
            <div class="single-product">
                <!-- Product Image Start -->
                <div class="pro-img">
                    <a href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">
                        <img class="primary-img" style="height: 250px" src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="single-product">
                        <img class="secondary-img" style="height: 250px" src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="single-product">
                    </a>
                    <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                </div>
                <!-- Product Image End -->
                <!-- Product Content Start -->
                <div class="pro-content">
                    <div class="pro-info">
                        <h4><a href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">{{$value->product_name}}</a></h4>
                        <p><span class="price">{{$value->product_price}}</span></p>
                    </div>
                    <div class="pro-actions">
                        <div class="actions-primary">
                            <a href="cart.html" title="Add to Cart"> + Thêm vào giỏ hàng</a>
                        </div>
                        <div class="actions-secondary">
                            <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>So sánh sản phẩm</span></a>
                            <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Thêm vào sản phẩm yêu thích</span></a>
                        </div>
                    </div>
                </div>
                <!-- Product Content End -->
                <span class="sticker-new">Mới</span>
            </div>
            <!-- Single Product End -->
            @endforeach
        </div>
        <!-- Hot Deal Product Active End -->

    </div>
    <!-- Container End -->
</div>
<!-- Realated Products End Here -->

@include('customer.include.footer')
