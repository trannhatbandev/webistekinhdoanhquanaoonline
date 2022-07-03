@include('admin.header_admin')
    <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a class="left-sidebar-toggle" href="{{url('/admin')}}">Trang chủ</a>
            <div class="left-sidebar-spacer">
                <div class="left-sidebar-scroll">
                    <div class="left-sidebar-content">
                        <ul class="sidebar-elements">
                            <li class="divider">Quản lý</li>
                            <li class="active"><a href="{{url('/admin/dashboard')}}"><i class="icon mdi mdi-home"></i><span>Trang chủ</span></a></li>
                            <li class="parent"><a href="#"><i class="icon mdi mdi-face"></i><span>Quản lý</span></a>
                                <ul class="sub-menu">
                                    <li><a href="{{url('/admin/product/show-product')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý sản phẩm</span></a></li>
                                    <li><a href="{{url('/admin/category/show-category')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý danh mục</span></a></li>
                                    <li><a href="{{url('/admin/brand/show-brand')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý thương hiệu</span></a></li>
                                    <li><a href="{{url('/admin/color/show-color')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý màu sắc</span></a></li>
                                    <li><a href="{{url('/admin/size/show-size')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý size</span></a></li>
                                    <li><a href="{{url('/admin/attributes-product/show-attributes-product')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý thuộc tính</span></a></li>
                                    <li><a href="{{url('/admin/transport-fee/show-transport-fee')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý vận chuyển</span></a></li>
                                    <li><a href="{{url('/admin/discount-code/show-discount-code')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý mã khuyến mãi</span></a></li>
                                    <li><a href="{{url('/admin/order/manage-order')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý đơn hàng</span></a></li>
                                    <li><a href="{{url('/admin/comment/manage-comment')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý bình luận</span></a></li>
                                    <li><a href="{{url('/admin/blog/show-list-blog')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý bài viết</span></a></li>
                                    <li><a href="{{url('/admin/statistical/show-statistical')}}"><i class="icon mdi mdi-settings"></i><span> Thống kê</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="be-content">
        <h1 style="text-align: center;">Chào mừng bạn đến với trang admin của shop TNB</h1>
        @yield('admin_content')
    </div>
@include('admin.footer_admin')
