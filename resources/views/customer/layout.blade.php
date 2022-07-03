@include('customer.include.header')
@include('customer.include.slide')
    <!-- Trending Products End Here -->
    <div class="trendig-product pb-10 off-white-bg">
        <div class="container">
            <div class="trending-box">
                <div class="title-box">
                    <h2>Sản phẩm mới</h2>
                </div>
                <div class="product-list-box">
                    <!-- Arrivals Product Activation Start Here -->
                    <div class="trending-pro-active owl-carousel">
                        <!-- Single Product Start -->
                        @foreach($allnewproduct as $key => $value)
                            <form>
                                @csrf
                                <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                <input type="hidden" id="wistlist_product_name{{$value->product_id}}" value="{{$value->product_name}}"
                                class="cart_product_name_{{$value->product_id}}">
                                <input type="hidden" id="wistlist_product_image_ok{{$value->product_id}}" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                <input type="hidden" id="wistlist_product_price{{$value->product_id}}" value="{{$value->product_price}}"
                                class="cart_product_price_{{$value->product_id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$value->product_id}}">
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">
                                    <img id="wistlist_product_image{{$value->product_id}}" class="primary-img" style="height: 225px" src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="single-product">
                                    <img class="secondary-img" style="height: 225px" src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="single-product">
                                </a>
                                <a class="quick_view" data-product_id="{{$value->product_id}}" data-toggle="modal" data-target="#quick_view" title="Xem nhanh"><i class="lnr lnr-magnifier"></i></a>
                                <span class="sticker-new">Mới</span>
                            </div>
                            <!-- Product Image End -->
                            <!-- Product Content Start -->
                            <div class="pro-content">
                                <div class="pro-info">
                                    <h4><a id="wistlist_product_chitiet{{$value->product_id}}" href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">{{$value->product_name}}</a></h4>
                                    <p><span class="price">{{$value->product_price}}</span></p>
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

                        @endforeach
                        <!-- Single Product End -->
                    </div>
                    <!-- Arrivals Product Activation End Here -->

                </div>
                <!-- main-product-tab-area-->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Trending Products End Here -->
     <!-- Trending Products End Here -->
     <div class="trendig-product pb-100 off-white-bg pb-sm-60">
        <div class="container">
            <div class="trending-box">
            <div class="title-box">
                <h2>Sản phẩm khuyến mãi</h2>
            </div>
            <div class="product-list-box">
                <!-- Arrivals Product Activation Start Here -->
                <div class="trending-pro-active owl-carousel">
                    <!-- Single Product Start -->
                    @foreach($allsaleproduct as $key => $value)
                    <form>
                        @csrf
                        <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                        <input type="hidden" id="wistlist_product_name_sale{{$value->product_id}}" value="{{$value->product_name}}"
                        class="cart_product_name_{{$value->product_id}}">
                        <input type="hidden" id="wistlist_product_image_sale_ok{{$value->product_id}}" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                        <input type="hidden" id="wistlist_product_price_sale{{$value->product_id}}" value="{{$value->product_price_sale}}"
                        class="cart_product_price_{{$value->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$value->product_id}}">
                   <!-- Single Product Start -->
                   <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                        <a href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">
                            <img class="primary-img" id="wistlist_product_image_sale{{$value->product_id}}" style="height: 225px" src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="single-product">
                            <img class="secondary-img" style="height: 225px" src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="single-product">
                        </a>
                        <a class="quick_view" data-product_id="{{$value->product_id}}" data-toggle="modal" data-target="#quick_view" title="Xem nhanh"><i class="lnr lnr-magnifier"></i></a>
                        <span class="sticker-new">{{$value->product_percent_discount}}%</span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                        <div class="pro-info">
                            <h4><a id="wistlist_product_chitiet_sale{{$value->product_id}}" href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">{{$value->product_name}}</a></h4>
                            <p><span class="price">{{number_format($value->product_price_sale,0,',','.')}}đ</span> <del class="prev-price">{{number_format($value->product_price,0,',','.')}}đ</del></p>
                            <div class="label-product l_sale">{{$value->product_percent_discount}}<span class="symbol-percent">%</span></div>
                        </div>
                        <div class="pro-actions">
                            <div class="actions-primary">
                                <button class="btn btn-secondary icon add-to-cart" data-id_product="{{$value->product_id}}"  type="button" title="Thêm vào giỏ hàng"> + Thêm vào giỏ hàng</button>
                            </div>
                            @if(session()->get('customer_id'))
                            <div class="actions-secondary">
                                <a type="button" style="cursor: pointer" class="add-compare-product-sale" data-id="{{$value->product_id}}" title="So sánh"><i class="lnr lnr-sync"></i> <span>So sánh sản phẩm</span></a>
                                <a type="button" class="add-whist-list" style="cursor: pointer" data-id="{{$value->product_id}}" title="Yêu thích">
                                    <i class="lnr lnr-heart"></i> <span>Yêu thích</span></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- Product Content End -->
                </div>
                <!-- Single Product End -->
                </form>

                @endforeach
                    <!-- Single Product End -->
                </div>
                <!-- Arrivals Product Activation End Here -->
            </div>
            <!-- main-product-tab-area-->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Trending Products End Here -->
     <!-- Hot Deal Products Start Here -->
     <div class="hot-deal-products pt-100 pt-sm-60">
        <div class="container">
            <div class="all-border">
               <!-- Product Title Start -->
               <div class="section-ttitle mb-30">
                    <h2>Sản phẩm hot</h2>
               </div>
               <!-- Product Title End -->
                <!-- Hot Deal Product Activation Start -->
                <div class="hot-deal-active3 owl-carousel">
                    @foreach($allsaleproduct as $value)
                    @if(strtotime($value->product_date_sale_end)>strtotime($date) || strtotime($value->product_date_sale_start)==strtotime($date))
                    <form>
                        @csrf
                        <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                        <input type="hidden" id="wistlist_product_name{{$value->product_id}}" value="{{$value->product_name}}"
                        class="cart_product_name_{{$value->product_id}}">
                        <input type="hidden" id="wistlist_product_image_ok{{$value->product_id}}" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                        <input type="hidden" id="wistlist_product_price{{$value->product_id}}" value="{{$value->product_price}}"
                        class="cart_product_price_{{$value->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$value->product_id}}">
                    <div class="row">
                        <!-- Main Thumbnail Image Start -->
                        <div class="col-lg-6 mb-all-40 hot-product2 ">
                            <!-- Thumbnail Large Image start -->
                            <div class="tab-content">
                                <div id="thumb1" class="tab-pane fade show active">
                                    <a data-fancybox="images" id="wistlist_product_image{{$value->product_id}}" href="{{asset('public/uploads/products/'.$value->product_image)}}"><img src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="product-view"></a>
                                </div>
                                @if($galleryarr!=null)
                                @for($i = 0; $i<count($galleryarr); $i++)
                                    @for($j = 0; $j<count($galleryarr[$i]); $j++)
                                        <div id="{{$i}}" class="tab-pane fade">
                                            <a data-fancybox="images" href="{{asset('public/uploads/gallerys/'.$galleryarr[$i][$j]->gallery_image)}}"><img src="{{asset('public/uploads/gallerys/'.$galleryarr[$i][$j]->gallery_image)}}" alt="product-view"></a>
                                        </div>
                                    @endfor
                                @endfor
                                @endif
                            </div>
                            <!-- Thumbnail Large Image End -->
                            <!-- Thumbnail Image End -->
                            <div class="product-thumbnail">
                                <div class="pro-tab-menu nav tabs-area" role="tablist">
                                    <a class="active" data-toggle="tab" href="#thumb1"><img src="{{asset('public/uploads/products/'.$value->product_image)}}" alt="product-thumbnail"></a>
                                    @if($galleryarr2!=null)
                                    @for($i = 0; $i<count($galleryarr2); $i++)
                                        @for($j = 0; $j<count($galleryarr2[$i]); $j++)
                                            <div id="{{$i}}" class="tab-pane fade">
                                                <a data-toggle="tab" href="{{$j}}"><img src="{{asset('public/uploads/gallerys/'.$galleryarr2[$i][$j]->gallery_image)}}" alt="product-thumbnail"></a>
                                            </div>
                                        @endfor
                                    @endfor
                                    @endif
                                </div>
                            </div>
                            <!-- Thumbnail image end -->
                        </div>
                        <!-- Main Thumbnail Image End -->
                        <!-- Thumbnail Description Start -->
                        <div class="col-lg-6 hot-product2">
                            <div class="thubnail-desc fix">
                                <div class="countdown" data-countdown="{{$value->product_date_sale_end}}"></div>
                                <h3><a id="wistlist_product_chitiet{{$value->product_id}}" href="{{url('/home/product-detail/show-product-detail/'.$value->product_slug)}}">{{$value->product_name}}</a></h3>
                                <div class="pro-price mtb-30">
                                    <p><span class="price">{{$value->product_price_sale}}</span><del class="prev-price">{{$value->product_price}}</del></p>
                                    <div class="label-product l_sale">{{$value->product_percent_discount}}<span class="symbol-percent">%</span></div>
                                </div>
                                <p class="mb-30 pro-desc-details">{{$value->product_description}}</p>
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
                        <!-- Thumbnail Description End -->
                    </div>
                    </form>
                    @endif
                    @endforeach
                </div>
                <!-- Hot Deal Product Active End -->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Hot Deal Products End Here -->

   @include('customer.include.footer')
