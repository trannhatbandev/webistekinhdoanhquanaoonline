@include('customer.include.header')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="{{url('/home/all-blog')}}">Blog</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Blog Page Start Here -->
<div class="blog ptb-100  ptb-sm-60">
    <div class="container">
        <div class="main-blog">
            <div class="row">
                <!-- Single Blog Start -->
                @foreach($blog as $value)
                    <div class="col-lg-6 col-sm-12">
                    <div class="single-latest-blog">
                        <div class="blog-img">
                            <a href="{{url('/home/detail-blog/'.$value->blog_slug)}}"><img src="{{asset('public/uploads/blogs/'.$value->blog_image)}}" alt="blog-image"></a>
                        </div>
                        <div class="blog-desc">
                            <h4><a href="{{url('/home/detail-blog/'.$value->blog_slug)}}">{{$value->blog_title}}</a></h4>
                                {{-- <ul class="meta-box d-flex">
                                    <li><a href="#">By Truemart</a></li>
                                </ul> --}}
                                <p>{{$value->blog_description}}</p>
                                <a class="readmore" href="{{url('/home/detail-blog/'.$value->blog_slug)}}">Xem thêm</a>
                        </div>
                        <div class="blog-date">
                                <span>28</span>
                                June
                            </div>
                    </div>
                    </div>
                @endforeach
                <!-- Single Blog End -->
            </div>
            <!-- Row End -->
            <div class="row">
                <div class="col-sm-12">
                        <div class="pro-pagination">
                            <ul class="blog-pagination">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                            <div class="product-pagination">
                                <span class="grid-item-list">Showing 1 to 12 of 51 (5 Pages)</span>
                            </div>
                        </div>
                        <!-- Product Pagination Info -->
                </div>
            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Blog Page End Here -->

@include('customer.include.footer')


