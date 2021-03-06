<script src="{{asset('public/backend/assets/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/js/app.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jquery-flot/jquery.flot.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jquery-flot/jquery.flot.pie.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jquery-flot/jquery.flot.time.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jquery-flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jquery-flot/plugins/curvedLines.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jquery-flot/plugins/jquery.flot.tooltip.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jquery.sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/countup/countUp.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jqvmap/jquery.vmap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/jquery.niftymodals/js/jquery.niftymodals.js')}}" type="text/javascript"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script type="text/javascript">
    $.fn.niftyModal('setDefaults',{
        overlaySelector: '.modal-overlay',
        contentSelector: '.modal-content',
        closeSelector: '.modal-close',
        classAddAfterOpen: 'modal-show'
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //-initialize the javascript
        App.init();
        App.dashboard();
    });
</script>
<script type="text/javascript">
$(document).ready( function () {
    $('#TableProduct').DataTable();
    $('#TableCategory').DataTable();
    $('#TableBrand').DataTable();
    $('#TableSize').DataTable();
    $('#TableColor').DataTable();
    $('#TableAttributes').DataTable();
    $('#TableBlog').DataTable();
    $('#TableDiscountCode').DataTable();
    $('#TableTransportFee').DataTable();
    $('#TableComment').DataTable();
    $('#TableGallery').DataTable();
    $('#TableOrder').DataTable();
    $('#TableOrderDetail').DataTable();
} );
</script>

<script>
    $( function() {
      $( "#datepicker" ).datepicker({
        monthNames: [ "Th??ng 1", "Th??ng 2", "Th??ng 3", "Th??ng 4", "Th??ng 5", "Th??ng 6", "Th??ng 7", "Th??ng 8", "Th??ng 9", "Th??ng 10", "Th??ng 11", "Th??ng 12" ],
        dayNamesMin: [ "Th??? hai", "Th??? ba", "Th??? t??", "Th??? n??m", "Th??? s??u", "Th??? b???y", "Ch??? nh???t" ],
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat: "yy-mm-dd",
      });
    } );
    $( function() {
      $( "#datepicker1" ).datepicker({
        monthNames: [ "Th??ng 1", "Th??ng 2", "Th??ng 3", "Th??ng 4", "Th??ng 5", "Th??ng 6", "Th??ng 7", "Th??ng 8", "Th??ng 9", "Th??ng 10", "Th??ng 11", "Th??ng 12" ],
        dayNamesMin: [ "Th??? hai", "Th??? ba", "Th??? t??", "Th??? n??m", "Th??? s??u", "Th??? b???y", "Ch??? nh???t" ],
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat: "yy-mm-dd"
      });
    } );
</script>
<script>
 $( function() {
      $( "#discount-code-date-start" ).datepicker({
        monthNames: [ "Th??ng 1", "Th??ng 2", "Th??ng 3", "Th??ng 4", "Th??ng 5", "Th??ng 6", "Th??ng 7", "Th??ng 8", "Th??ng 9", "Th??ng 10", "Th??ng 11", "Th??ng 12" ],
        dayNamesMin: [ "Th??? hai", "Th??? ba", "Th??? t??", "Th??? n??m", "Th??? s??u", "Th??? b???y", "Ch??? nh???t" ],
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat: "dd-mm-yy",
        minDate:0,
      });
    });
    $( function() {
      $( "#discount-code-date-end" ).datepicker({
        monthNames: [ "Th??ng 1", "Th??ng 2", "Th??ng 3", "Th??ng 4", "Th??ng 5", "Th??ng 6", "Th??ng 7", "Th??ng 8", "Th??ng 9", "Th??ng 10", "Th??ng 11", "Th??ng 12" ],
        dayNamesMin: [ "Th??? hai", "Th??? ba", "Th??? t??", "Th??? n??m", "Th??? s??u", "Th??? b???y", "Ch??? nh???t" ],
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat: "dd-mm-yy",
        minDate:0,
      });
    });
    $( function() {
      $( "#product_date_sale_start" ).datepicker({
        monthNames: [ "Th??ng 1", "Th??ng 2", "Th??ng 3", "Th??ng 4", "Th??ng 5", "Th??ng 6", "Th??ng 7", "Th??ng 8", "Th??ng 9", "Th??ng 10", "Th??ng 11", "Th??ng 12" ],
        dayNamesMin: [ "Th??? hai", "Th??? ba", "Th??? t??", "Th??? n??m", "Th??? s??u", "Th??? b???y", "Ch??? nh???t" ],
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat: "yy-mm-dd",
        minDate:0,
      });
    });
    $( function() {
      $( "#product_date_sale_end" ).datepicker({
        monthNames: [ "Th??ng 1", "Th??ng 2", "Th??ng 3", "Th??ng 4", "Th??ng 5", "Th??ng 6", "Th??ng 7", "Th??ng 8", "Th??ng 9", "Th??ng 10", "Th??ng 11", "Th??ng 12" ],
        dayNamesMin: [ "Th??? hai", "Th??? ba", "Th??? t??", "Th??? n??m", "Th??? s??u", "Th??? b???y", "Ch??? nh???t" ],
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat: "yy-mm-dd",
        minDate:0,
      });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        showStatistical30days();

        var myfirstchart =  new Morris.Area({
                    // ID of the element in which to draw the chart.
                    element: 'myfirstchart',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    pointFillColors: ['#ffffff'],
                    pointStrokeColors:['black'],
                    parseTime:false,
                    fillOpacity: 0.4,
                    behaveLikeLine: true,
                    hideHover: 'auto',
                    // The name of the data record attribute that contains x-values.
                    xkey: 'orderDate',
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['sales','quantity','profit','totalOrder'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['Doanh s???', 'S??? l?????ng', 'L???i nhu???n', '????n h??ng']
        });
        function showStatistical30days(){
            let _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{url("/admin/statistical/show-statistical-one-year")}}',
                method: 'POST',
                dataType: 'JSON',
                data: {_token:_token},
                success:function(data) {
                    myfirstchart.setData(data);

                }
            });
        }
        $('#filter-date').click(function(){
            let _token = $('input[name="_token"]').val();
            let dateFrom = $('#datepicker').val();
            let dateTo = $('#datepicker1').val();

            $.ajax({
                url: '{{url("/admin/statistical/get-date-filter")}}',
                method: 'POST',
                dataType: 'JSON',
                data: {dateFrom:dateFrom,dateTo:dateTo, _token:_token},
                success:function(data) {
                    myfirstchart.setData(data);

                }
            });
        })

        $('.filter-statistical-profit').change(function(){
            let value = $(this).val();
            let _token = $('input[name="_token"]').val();


            $.ajax({
                url: '{{url("/admin/statistical/filter-statistical-profit")}}',
                method: 'POST',
                dataType: 'JSON',
                data: {value:value, _token:_token},
                success:function(data) {
                    myfirstchart.setData(data);

                }
            });
        });

    });
</script>
<script>
    $(document).ready(function(){
            Morris.Donut({
            element: 'statisticalTotal',
            data: [
                {label: "S???n ph???m", value: <?php echo $productAll?>},
                {label: "????n h??ng", value: <?php echo $orderAll?>},
                {label: "B??i vi???t", value: <?php echo $blogAll?>},
                {label: "Kh??ch h??ng", value: <?php echo $customerAll?>}
            ]
            });
    });
</script>

<script type="text/javascript">

 function ChangeToSlug()
     {
         var slug;

         //L???y text t??? th??? input title
         slug = document.getElementById("slug").value;
         slug = slug.toLowerCase();
         //?????i k?? t??? c?? d???u th??nh kh??ng d???u
             slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
             slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
             slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
             slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
             slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
             slug = slug.replace(/??|???|???|???|???/gi, 'y');
             slug = slug.replace(/??/gi, 'd');
             //X??a c??c k?? t??? ?????t bi???t
             slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
             //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
             slug = slug.replace(/ /gi, "-");
             //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
             //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
             slug = slug.replace(/\-\-\-\-\-/gi, '-');
             slug = slug.replace(/\-\-\-\-/gi, '-');
             slug = slug.replace(/\-\-\-/gi, '-');
             slug = slug.replace(/\-\-/gi, '-');
             //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
             slug = '@' + slug + '@';
             slug = slug.replace(/\@\-|\-\@|\@/gi, '');
             //In slug ra textbox c?? id ???slug???
         document.getElementById('convert_slug').value = slug;
     }
     function ChangeToUpdateSlug()
     {
         var slug;

         //L???y text t??? th??? input title
         slug = document.getElementById("update-slug").value;
         slug = slug.toLowerCase();
         //?????i k?? t??? c?? d???u th??nh kh??ng d???u
             slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
             slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
             slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
             slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
             slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
             slug = slug.replace(/??|???|???|???|???/gi, 'y');
             slug = slug.replace(/??/gi, 'd');
             //X??a c??c k?? t??? ?????t bi???t
             slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
             //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
             slug = slug.replace(/ /gi, "-");
             //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
             //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
             slug = slug.replace(/\-\-\-\-\-/gi, '-');
             slug = slug.replace(/\-\-\-\-/gi, '-');
             slug = slug.replace(/\-\-\-/gi, '-');
             slug = slug.replace(/\-\-/gi, '-');
             //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
             slug = '@' + slug + '@';
             slug = slug.replace(/\@\-|\-\@|\@/gi, '');
             //In slug ra textbox c?? id ???slug???
         document.getElementById('update_convert_slug').value = slug;
     }

</script>


<script type="text/javascript">
    $(document).ready(function(){
        {{--getTransportFee();--}}
        {{--function getTransportFee() {--}}
        {{--    var _token = $('input[name="_token"]').val();--}}
        {{--    $.ajax({--}}
        {{--        url: '{{url("/admin/transport-fee/get-all-transport-fee")}}',--}}
        {{--        method: 'POST',--}}
        {{--        data: {_token:_token},--}}
        {{--        success:function(data) {--}}
        {{--            $('#list_transport_fee').html(data);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
        {{--$('.add_transport_fee').click(function(){--}}
        {{--    var city = $('.city').val();--}}
        {{--    var district = $('.district').val();--}}
        {{--    var _token = $('input[name="_token"]').val();--}}
        {{--    var ward = $('.ward').val();--}}
        {{--    var transport_fee_freeship= $('.transport_fee_freeship').val();--}}
        {{--    $.ajax({--}}
        {{--        url: '{{url("/admin/transport-fee/add-transport-fee")}}',--}}
        {{--        method: 'POST',--}}
        {{--        data: {city:city, district:district, ward:ward, transport_fee_freeship:transport_fee_freeship,_token:_token},--}}
        {{--        success:function(data) {--}}
        {{--           alert('Th??m ph?? v???n chuy???n th??nh c??ng');--}}
        {{--           getTransportFee();--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        $(document).on('blur','.transport_fee_freeship_edit',function(){
            var transport_fee_id = $(this).data('transport_fee_freeship');
            var transport_fee_freeship = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/admin/transport-fee/update-transport-fee-freeship")}}',
                method: 'POST',
                data: {transport_fee_id:transport_fee_id, transport_fee_freeship:transport_fee_freeship,_token:_token},
                success:function(data){
                    alert('C???p nh???t s??? l?????ng th??nh c??ng');
                    location.reload();
                }
            });
        });
        $('.select').on('change',function(){
            var action_change = $(this).attr('id');
            var ma = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action_change=='city'){
                result = 'district';
            }else{
                result = 'ward';
            }
            $.ajax({
                url: '{{url("/admin/transport-fee/select-transport-fee")}}',
                method: 'POST',
                data: {action_change:action_change, ma:ma, _token:_token},
                success:function(data) {
                    $('#'+result).html(data);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
            $(document).on('blur','.attributes_product_quantity_edit',function(){
            var attributes_id = $(this).data('attributes_product_quantity');
            var attributes_quantity = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/admin/attributes-product/update-attributes-product-quantity")}}',
                method: 'POST',
                data: {attributes_id:attributes_id, attributes_quantity:attributes_quantity,_token:_token},
                success:function(data){
                    alert('C???p nh???t s??? l?????ng th??nh c??ng');
                    location.reload();
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $('.rep_comment').click(function(){
            var comment_id = $(this).data('comment_id');
            var comment = $('.rep_comment_area_'+comment_id).val();

            var product_id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/admin/comment/reply-comment")}}',
                method: 'POST',
                data: {comment:comment, comment_id:comment_id,product_id:product_id,_token:_token},
                success:function(data){
                    $('.rep_comment_area_'+comment_id).val();
                    alert('Tr??? l???i b??nh lu???n th??nh c??ng');
                    location.reload();
                }
            });
        });
</script>
<script type="text/javascript">
        $('.order-status').change(function(){
            let orderStatus = $(this).val();
            let orderId = $(this).children(":selected").attr('id');

            let _token = $('input[name="_token"]').val();

            quantity = [];

            $('input[name="product_quantity_wasehouse"]').each(function(){
                quantity.push($(this).val());
            })

            productIdWashouse = [];

            $('input[name="product_id_wasehouse"]').each(function(){
                productIdWashouse.push($(this).val());
            })
            color = [];

            $('input[name="color_wasehouse"]').each(function(){
                color.push($(this).val());
            })

            size = [];

            $('input[name="size_wasehouse"]').each(function(){
                size.push($(this).val());
            })
            j = 0;
            for(i=0;i<productIdWashouse.length; i++){
                let quantity = $('.product_quantity_wasehouse_'+ productIdWashouse[i]).val();

                let quantityWareHouse = $('.quantity_wasehouse_'+ productIdWashouse[i]).val();

                if(parseInt(quantity)>parseInt(quantityWareHouse)){
                    j = j +1 ;
                    if(j==1){
                        alert('S??? l?????ng s???n ph???m trong kho kh??ng ?????');
                        $('.quantity_color_'+productIdWashouse[i]).css('background','#000');
                    }
                }
            }
            if(j==0){
                $.ajax({
                    url: '{{url("/admin/order/update-order-status")}}',
                    method: 'POST',
                    data: {color:color,size:size,productIdWashouse:productIdWashouse,quantity:quantity,orderStatus:orderStatus, orderId:orderId,_token:_token},
                    success:function(data){
                        alert('Th??nh c??ng');
                        location.reload();
                    }
                });
            }

        });
</script>
</body>
</html>
