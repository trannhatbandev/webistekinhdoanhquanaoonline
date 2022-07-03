<div class="row">
    <div class="full-width modal-container modal-effect-1 colored-header colored-header-primary "
         data-backdrop="static"
         data-keyboard="false" id="nft-fullWidth">
        <div class="modal-content full-width">
            <div class="modal-header modal-header-colored text-center">
                <h3 class="modal-title">Thêm danh mục sản phẩm</h3>
                <button class="close modal-close" type="button" data-dismiss="modal" aria-hidden="true"><span
                        class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{url('/admin/category/create-category')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Tên danh mục</label>
                            <input type="text" name="category_name" id="slug" onkeyup="ChangeToSlug();"  value="{{old('category_name')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Slug danh mục</label>
                            <input type="text" name="category_slug" id="convert_slug" value="{{old('category_slug')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mô tả</label>
                            <textarea style="resize:none" rows="8" class="form-control" id="ckeditor3" name="category_description">{{old('category_description')}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Trạng thái</label>
                            <select class="form-control" name="category_status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Thuộc danh mục</label>
                            <select class="form-control" name="category">
                                <option value="0">Danh mục cha</option>
                                @foreach($category as $key => $value)
                                    @if($value->category_parent==0)
                                        <option value="{{$value->category_id}}">{{$value->category_name}}</option>
                                    @endif
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
