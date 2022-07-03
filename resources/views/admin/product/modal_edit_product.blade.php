<div class="row">
    <form action="{{url('/admin/product/update-product/'.$value->product_id)}}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade text-left colored-header colored-header-primary" id="update-modal{{$value->product_id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Cập nhật sản phẩm</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="product_name" id="update-slug" onkeyup="ChangeToUpdateSlug();" value="{{$value->product_name}}" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Slug sản phẩm</label>
                                <input type="text" name="product_slug" id="update_convert_slug" value="{{$value->product_slug}}" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mô tả</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="product_desc" >{{$value->product_description}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label>Giá</label>
                                <input type="text" name="product_price" value="{{$value->product_price}}" class="form-control" >
                            </div>
                            <div class="form-group col-md-2">
                                <label>Nhập phần trăm giảm giá %</label>
                                <input type="text" name="product_percent_discount" value="{{$value->product_percent_discount}}"
                                       class="form-control">
                            </div>
                            {{-- <div class="form-group col-md-2">
                                <label>Giá sale</label>
                                <input type="text" name="product_price_sale" value="{{$value->product_price_sale}}" class="form-control" >
                            </div> --}}
                            <div class="form-group col-md-2">
                                <label>Giá gốc</label>
                                <input type="text" name="product_price_cost" value="{{$value->product_price_cost}}" class="form-control" >
                            </div>
                            <div class="form-group col-md-3">
                                <label>Hình ảnh</label>
                                <input type="file" name="product_image" class="form-control-file">
                                <img src="{{asset('public/uploads/products/'.$value->product_image)}}" height="50px" width="50px">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Trạng thái</label>
                                <select class="form-control" name="product_status">
                                    @if($value->product_status==1)
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    @else
                                        <option value="1">Hiển thị</option>
                                        <option  selected value="0">Ẩn</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label >Danh mục sản phẩm</label>
                                <select class="form-control" name="category">
                                    @foreach($category as $key=> $danhmuc)
                                        <option {{  $danhmuc->category_id == $value->category_id ? 'selected' : ''}} value="{{$danhmuc->category_id}}">{{$danhmuc->category_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <label>Thương hiêu sản phẩm</label>
                                <select class="form-control" name="brand">
                                    @foreach($brand as $key => $brands)
                                        <option {{  $brands->brand_id == $value->brand_id ? 'selected' : ''}} value="{{$brands->brand_id}}">{{$brands->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary modal-" type="submit">Cập nhật</button>
                        <button class="btn btn-secondary modal-close" type="button" data-dismiss="modal" aria-hidden="true">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
