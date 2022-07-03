@include('customer.include.header')
      <!-- Breadcrumb Start -->
      <div class="breadcrumb-area mt-30">
        <div class="container">
            <div class="breadcrumb">
                <ul class="d-flex align-items-center">
                    <li><a href="{{url('/')}}">Trang chủ</a></li>
                    <li><a href="{{url('/home/all-blog')}}">Blog</a></li>
                    <li class="active"><a href="single-blog.html">Single Blog</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- Single Blog Page Start Here -->
    <div class="single-blog ptb-100  ptb-sm-60">
        <div class="container">
            <div class="row">
                <!-- Single Blog Sidebar Start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside>
                        {{-- <div class="single-sidebar latest-pro mb-30">
                            <h3 class="sidebar-title">latest Posts</h3>
                            <ul class="sidbar-style">
                                <li><a href="shop.html">cameras</a></li>
                                <li><a href="shop.html">gamepad</a></li>
                                <li><a href="shop.html">digital cameras</a></li>
                                <li><a href="shop.html">virtual reality</a></li>
                            </ul>
                        </div> --}}
                        <div class="col-img mb-30">
                            <a href="shop.html"><img src="{{asset('public/frontend/img/banner/banner-sidebar.jpg')}}" alt="slider-banner"></a>
                        </div>
                        {{-- <div class="single-sidebar mb-30">
                             <h3 class="sidebar-title">others</h3>
                             <ul class="sidbar-style">
                                 <li><a href="login.html">Log in</a></li>
                                 <li><a href="#">Entries <abbr title="Really Simple Syndication">RSS</abbr></a></li>
                                 <li><a href="#">Comments <abbr title="Really Simple Syndication">RSS</abbr></a></li>
                                 <li><a href="#">Others link</a></li>
                             </ul>
                        </div>
                        <div class="tags">
                             <h3 class="sidebar-title">Tags</h3>
                             <div class="sidbar-style">
                                <ul class="tag-list">
                                    <li><a href="#">Branding</a></li>
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">design</a></li>
                                    <li><a href="#">Latest</a></li>
                                    <li><a href="#">Male</a></li>
                                    <li><a href="#">Female</a></li>
                                </ul>
                             </div>
                        </div> --}}
                    </aside>
                </div>
                <!-- Single Blog Sidebar End -->
                <!-- Single Blog Sidebar Description Start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="single-sidebar-desc mb-all-40">
                        <div class="sidebar-img">
                            <img src="{{url('public/uploads/blogs/'.$blog->blog_image)}}" alt="single-blog-img">
                        </div>
                        <div class="sidebar-post-content">
                            <h3 class="sidebar-lg-title">{{$blog->blog_title}}</h3>
                            <ul class="post-meta d-sm-inline-flex">
                                <li><span>được đăng</span> bởi SHOP TNB</li>
                                <li><span> {{$blog->created_at}}</span></li>
                            </ul>
                        </div>
                        <div class="sidebar-desc mb-50">
                            <p>{{$blog->blog_description}}<</p>
                            {{-- <blockquote class="mtb-30"> <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms with righteous indignation and dislike.</p><span>Christine Rios</span></blockquote> --}}
                            <p>{{$blog->blog_content}}<</p>
                        </div>
                        {{-- <!-- Contact Email Area Start -->
                        <div class="blog-detail-contact">
                            <h3 class="mb-15 leave-reply">Leave a Reply</h3>
                            <div class="submit-review">
                                <form>
                                    <div class="form-group">
                                        <label for="usr">Your Name:</label>
                                        <input type="text" class="form-control" id="usr">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">your email:</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="web-address">Website Url:</label>
                                        <input type="text" class="form-control" id="web-address">
                                    </div>
                                    <div class="form-group">
                                        <label for="sub">Subject:</label>
                                        <input type="text" class="form-control" id="sub">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Comment:</label>
                                        <textarea class="form-control" rows="5" id="comment"></textarea>
                                    </div>
                                    <div class="sbumit-reveiew">
                                        <input value="Submit" class="return-customer-btn" type="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Contact Email Area End --> --}}
                    </div>
                </div>
                <!-- Single Blog Sidebar Description End -->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Single Blog Page End Here -->

@include('customer.include.footer')


