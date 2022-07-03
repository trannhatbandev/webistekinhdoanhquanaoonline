<div class="row">
    <form action="{{url('/admin/blog/update-blog/'.$value->blog_id)}}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="full-width modal fade text-left colored-header colored-header-primary" id="update-modal{{$value->blog_id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Cập nhật bài viết</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Tên bài viết</label>
                                <input type="text" name="blog_title" id="slug" onkeyup="ChangeToSlug();"  value="{{$value->blog_title}}" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Slug bài viết</label>
                                <input type="text" name="blog_slug" id="convert_slug" value="{{$value->blog_slug}}" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Hình ảnh</label>
                                <input type="file" name="blog_image">
                                <img src="{{asset('public/uploads/blogs/'.$value->blog_image)}}" height="50px" width="50px">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Mô tả bài viết</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="blog_description">{{$value->blog_description}}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nội dung bài viết</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="blog_content">{{$value->blog_content}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Trạng thái</label>
                                <select class="form-control" name="blog_status">
                                    @if($value->blog_status==1)
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
