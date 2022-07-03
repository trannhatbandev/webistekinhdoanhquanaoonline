@include('customer.include.header')
 <!-- Breadcrumb Start -->
 <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="{{url('/home/contact')}}">Liên hệ chúng tôi</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Contact Email Area Start -->
<div class="contact-area ptb-100 ptb-sm-60">
    <div class="container">
        <h3 class="mb-20">Thông tin liên hệ của chúng tôi</h3>
        <p class="mb-20" style="color: blue">Tên cửa hàng: SHOP TNB</p>
        <p class="mb-20" style="color: blue">Địa chỉ: Đường Tiền Lân 20, xã Bà Điểm, huyện Hóc Môn, TP.HCM</p>
        <p class="mb-20" style="color: blue">Số điện thoại: 0978119953</p>
        <p class="mb-20" style="color: blue">Email: trannhatban34@gmail.com</p>
        <div style="display: flex">
            <div style="margin-right: 30px">
                <p class="mb-20" style="font-size: 25px">Fanpage: </p>
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FShop-TNB-B%25C3%25A1n-qu%25E1%25BA%25A7n-%25C3%25A1o-th%25E1%25BB%259Di-trang-cao-c%25E1%25BA%25A5p-100918965976316&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=376696421191315" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
            allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>

            <div style="width: 100%; height:500px;">
                <p class="mb-20" style="font-size: 25px">Bản đồ: </p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.713014065259!2d106.60239881474952!3d10.833260392282975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bca010b1a69%3A0x2ca5b4179bd7fd79!2zxJAuIFRp4buBbiBMw6JuIDIwLCBCw6AgxJBp4buDbSwgSMOzYyBNw7RuLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1654938331451!5m2!1svi!2s"
            width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>

        {{-- <form id="contact-form" class="contact-form" action="mail.php" method="post">
            <div class="address-wrapper row">
                <div class="col-md-12">
                    <div class="address-fname">
                        <input class="form-control" type="text" name="name" placeholder="Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="address-email">
                        <input class="form-control" type="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="address-web">
                        <input class="form-control" type="text" name="website" placeholder="Website">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="address-subject">
                        <input class="form-control" type="text" name="subject" placeholder="Subject">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="address-textarea">
                        <textarea name="message" class="form-control" placeholder="Write your message"></textarea>
                    </div>
                </div>
            </div>
            <p class="form-message">
            <div class="footer-content mail-content clearfix">
                <div class="send-email float-md-right">
                    <input value="Submit" class="return-customer-btn" type="submit">
                </div>
            </div>
        </form> --}}
    </div>
</div>
<!-- Contact Email Area End -->
<!-- Google Map Start -->
<div class="goole-map">
    <div id="map" style="height:400px"></div>
</div>
<!-- Google Map End -->

@include('customer.include.footer')


