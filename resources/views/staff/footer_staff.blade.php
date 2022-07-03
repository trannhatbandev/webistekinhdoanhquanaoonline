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
    $('#TableOrder').DataTable();
    $('#TableOrderDetail').DataTable();
} );
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
                        alert('Số lượng sản phẩm trong kho không đủ');
                        $('.quantity_color_'+productIdWashouse[i]).css('background','#000');
                    }
                }
            }
            if(j==0){
                $.ajax({
                    url: '{{url("/staff/order/update-order-status")}}',
                    method: 'POST',
                    data: {color:color,size:size,productIdWashouse:productIdWashouse,quantity:quantity,orderStatus:orderStatus, orderId:orderId,_token:_token},
                    success:function(data){
                        alert('Thành công');
                        location.reload();
                    }
                });
            }

        });
</script>
</body>
</html>
