<div class="row">
    <form action="{{url('/admin/category/update-category/'.$value->category_id)}}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade text-left colored-header colored-header-primary" id="update-modal{{$value->category_id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Cập nhật danh mục sản phẩm</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Tên danh mục sản phẩm</label>
                                <input type="text" name="category_name" id="slug" onkeyup="ChangeToSlug();" value="{{$value->category_name}}" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Slug danh mục sản phẩm</label>
                                <input type="text" name="category_slug" id="convert_slug" value="{{$value->category_slug}}" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mô tả</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="category_description" >{{$value->category_description}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Trạng thái</label>
                                <select class="form-control" name="category_status">
                                    @if($value->category_status==1)
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    @else
                                        <option value="1">Hiển thị</option>
                                        <option  selected value="0">Ẩn</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label >Danh mục sản phẩm</label>
                                <select class="form-control" name="category">
                                    <option value="0">Danh mục cha</option>
                                    @foreach($category as $key => $category)
                                        @if($category->category_parent==0)
                                            <option {{  $value->category_parent == $category->category_id ? 'selected' : ''}}  value="{{$category->category_id}}">{{$category->category_name}}</option>
                                        @endif
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
