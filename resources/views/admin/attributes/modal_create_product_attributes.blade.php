<div class="row">
    <div class="full-width modal-container modal-effect-1 colored-header colored-header-primary "
         data-backdrop="static"
         data-keyboard="false" id="nft-fullWidth">
        <div class="modal-content full-width">
            <div class="modal-header modal-header-colored text-center">
                <h3 class="modal-title">Thêm thương hiệu sản phẩm</h3>
                <button class="close modal-close" type="button" data-dismiss="modal" aria-hidden="true"><span
                        class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{url('/admin/attributes-product/create-attributes-product')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Sản phẩm</label>
                            <select class="form-control input-lg m-bot15" name="product">
                                <option value="0">--Lựa chọn sản phẩm--</option>
                                @foreach($product as $key => $value)
                                    <option value="{{$value->product_id}}">{{$value->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Size sản phẩm</label>
                                <select class="form-control input-lg m-bot15" name="size">
                                    <option value="0">--Lựa chọn size--</option>
                                    @foreach($size as $key => $value)
                                        <option value="{{$value->size_id}}">{{$value->size_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputPassword1">Màu sản phẩm</label>
                            <select class="form-control input-lg m-bot15" name="color">
                                <option value="0">--Lựa chọn màu--</option>
                                @foreach($color as $key => $value)
                                    <option value="{{$value->color_id}}">{{$value->color_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputPassword1">Số lượng</label> <br>
                            <input type="text" name="quantity" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary modal-close" type="button" data-dismiss="modal"
                                aria-hidden="true">Hủy
                        </button>
                        <button class="btn btn-primary" type="submit">Thêm</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


