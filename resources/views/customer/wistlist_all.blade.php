 @include('customer.include.header')
 <!-- Breadcrumb Start -->
 <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="{{url('/honme/wistList')}}">Danh sách yêu thích</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Wish List Start -->
<div class="cart-main-area wish-list ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- Form Start -->
                    <!-- Table Content Start -->
                    <div class="table-content table-responsive">
                        <form action="" method="POST">
                            @csrf
                        <table id="whist-list-hidden">
                            <thead>
                                <tr>
                                    <th class="product-remove">Xóa</th>
                                    <th class="product-thumbnail">Hình ảnh</th>
                                    <th class="product-name">Sản phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Trạng thái</th>
                                    <th class="product-subtotal">Thêm giỏ hàng</th>
                                </tr>
                            </thead>
                            <tbody id="wist-list-table">
                            </tbody>
                        </table>
                        </form>
                    </div>
                    <!-- Table Content Start -->
                <!-- Form End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
</div>
<!-- Wish List End -->
@include('customer.include.footer')
