@include('customer.include.header')
 <!-- Breadcrumb Start -->
 <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="#">So sánh sản phẩm</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
 <!-- Compare Page Start -->
<div class="compare-product ptb-100 ptb-sm-60">
    <div class="container">
        <div class="table-responsive-sm">
            <form action="" method="POST">
                @csrf
                <table class="table text-center compare-content" id="compare-product-hidden">
                    <tbody>
                        <tr id="show-product-name-compare">
                            <td class="product-title">Sản phẩm</td>
                        </tr>
                        <tr id="show-product-description-compare">
                            <td class="product-title">Mô tả sản phẩm</td>
                        </tr>
                        <tr id="show-product-price-compare">
                            <td class="product-title">Giá</td>
                        </tr>
                        <tr id="show-product-add-to-cart-compare">
                            <td class="product-title">Thêm vào giỏ hàng</td>
                        </tr>
                        <tr id="delete-product-compare">
                            <td class="product-title">Xóa</td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Compare Page End -->
@include('customer.include.footer')
