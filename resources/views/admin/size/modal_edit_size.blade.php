<div class="row">
    <form action="{{url('/admin/size/update-size/'.$value->size_id)}}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade text-left sizeed-header sizeed-header-primary" id="update-modal{{$value->size_id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Cập nhật size</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Tên size</label>
                                <input type="text" name="size_name" id="slug" onkeyup="ChangeToSlug();" value="{{$value->size_name}}" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Slug size</label>
                                <input type="text" name="size_slug" id="convert_slug" value="{{$value->size_slug}}" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mô tả</label>
                                <textarea style="resize:none" rows="8" class="form-control" id="ckeditor3" name="size_desc">{{$value->size_description}}</textarea>
                            </div>
                        </div>
                        <div class="row"><div class="form-group col-md-3">
                                <label>Trạng thái</label>
                                <select class="form-control" name="size_status">
                                    @if($value->size_status==1)
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    @else
                                        <option value="1">Hiển thị</option>
                                        <option  selected value="0">Ẩn</option>
                                    @endif
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
