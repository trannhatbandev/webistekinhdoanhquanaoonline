<div class="row">
    <div class="full-width modal-container modal-effect-1 colored-header colored-header-primary "
         data-backdrop="static"
         data-keyboard="false" id="nft-fullWidth">
        <div class="modal-content full-width">
            <div class="modal-header modal-header-colored text-center">
                <h3 class="modal-title">Thêm sản phẩm</h3>
                <button class="close modal-close" type="button" data-dismiss="modal" aria-hidden="true"><span
                        class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{url('/admin/product/create-product')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="product_name" id="slug" onkeyup="ChangeToSlug();"
                                   value="{{old('product_name')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Slug sản phẩm</label>
                            <input type="text" name="product_slug" id="convert_slug"
                                   value="{{old('product_slug')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mô tả</label>
                            <textarea style="resize:none" rows="8" class="form-control"
                                      value="{{old('product_desc')}}" name="product_desc"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label>Giá</label>
                            <input type="text" name="product_price" value="{{old('product_price')}}"
                                   class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Nhập phần trăm giảm giá %</label>
                            <input type="text" name="product_percent_discount" value="{{old('product_percent_discount')}}"
                                   class="form-control">
                        </div>
                        {{-- <div class="form-group col-md-2">
                            <label>Giá sale</label>
                            <input type="text" name="product_price_sale" value="{{old('product_price_sale')}}"
                                   class="form-control">
                        </div> --}}
                        <div class="form-group col-md-2">
                            <label>Giá gốc</label>
                            <input type="text" name="product_price_cost" value="{{old('product_price_cost')}}"
                                   class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Hình ảnh</label>
                            <input type="file" name="product_image" class="form-control-file">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Trạng thái</label>
                            <select class="form-control" name="product_status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Ngày bắt đầu khuyến mãi</label>
                            <input type="text" value="{{old('product_date_sale_start')}}"
                            name="product_date_sale_start" id="product_date_sale_start" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Ngày kết thúc khuyến mãi</label>
                            <input type="text" value="{{old('product_date_sale_end')}}"
                            name="product_date_sale_end" id="product_date_sale_end" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Danh mục sản phẩm</label>
                            <select class="form-control" name="category">
                                @foreach($category as $key => $value)
                                    @if($value->category_parent!=0)
                                        <option
                                            value="{{$value->category_id}}">{{$value->category_name}}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Thương hiêu sản phẩm</label>
                            <select class="form-control" name="brand">
                                @foreach($brand as $key => $value)
                                    <option value="{{$value->brand_id}}">{{$value->brand_name}}</option>
                                @endforeach
                            </select>
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
