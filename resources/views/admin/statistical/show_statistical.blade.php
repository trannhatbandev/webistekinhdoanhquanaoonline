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
                                    <li><a href="{{url('/admin/blog/show-dashboard')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý bài viết</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Thống kê</h2>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Thống kê</li>
              </ol>
            </nav>
          </div>
          <div class="main-content container-fluid">
            <form>
                @csrf
                <div class="row">
                    <div class="col-lg-3">
                        <p>Từ ngày: <input type="text" id="datepicker"></p>
                        <div><button type="button" id="filter-date" class="btn btn-danger">Lọc</button></div>
                    </div>
                    <div class="col-lg-3">
                        <p>Đến ngày: <input type="text" id="datepicker1"></p>
                    </div>
                    <div class="col-lg-3">
                        <p>Lọc theo:
                            <select class="filter-statistical-profit">
                                <option>-- Chọn lọc theo --</option>
                                <option value="sevenDay">7 ngày qua</option>
                                <option value="monthPrev">Tháng trước</option>
                                <option value="monthNext">Tháng này</option>
                                <option value="oneYear">1 năm qua</option>
                            </select>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="myfirstchart" style="height: 250px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                       <p style="text-align: center; font-size:30px; margin-top:20px">Thống kê số lượng người truy cập</p>
                       <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Số người đang online</th>
                            <th scope="col">Số người truy cập tháng này</th>
                            <th scope="col">Số người truy cập tháng trước</th>
                            <th scope="col">Số người truy cập năm này</th>
                            <th scope="col">Tổng số người truy cập</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{$count}}</td>
                            <td>{{$countVisitorThisMonth}}</td>
                            <td>{{$countVisitorLastMonth}}</td>
                            <td>{{$countVisitorThisYear}}</td>
                            <td>{{$visitorAll}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div id="statisticalTotal"></div>
                    </div>
                    <div class="col-lg-4">
                        <h2>Sản phẩm xem nhiều</h2>
                        <ol>
                            @foreach ($product_customer_view as $item)
                            <li>
                                <a target="_blank" style="color: blueviolet" href="{{url('/home/product-detail/show-product-detail/'.$item->product_slug)}}">{{$item->product_name}}|({{$item->product_customer_views}})</a>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </form>
          </div>
        </div>
    </div>
@include('admin.footer_admin')
