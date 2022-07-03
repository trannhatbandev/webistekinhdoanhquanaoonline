@include('staff.header_staff')
    <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a class="left-sidebar-toggle" href="{{url('/staff')}}">Trang chủ</a>
            <div class="left-sidebar-spacer">
                <div class="left-sidebar-scroll">
                    <div class="left-sidebar-content">
                        <ul class="sidebar-elements">
                            <li class="divider">Quản lý</li>
                            <li class="active"><a href="{{url('/staff')}}"><i class="icon mdi mdi-home"></i><span>Trang chủ</span></a></li>
                            <li class="parent"><a href="#"><i class="icon mdi mdi-face"></i><span>Quản lý</span></a>
                                <ul class="sub-menu">
                                    <li><a href="{{url('/staff/order/manage-order')}}"><i class="icon mdi mdi-settings"></i><span> Quản lý đơn hàng</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="be-content">
        <h1 style="text-align: center;">Chào mừng bạn đến với trang staff của shop TNB</h1>
        @yield('staff_content')
    </div>
@include('staff.footer_staff')
