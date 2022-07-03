@extends('admin.admin_layout')
@section('admin_content')
    <div class="page-head">
        <h2 class="page-head-title">Quản lý bài viết</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý bài viết</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="mt-6 mb-4">
                    <button class="btn btn-space btn-success md-trigger" data-modal="nft-fullWidth">Thêm</button>
                </div>
                <div class="modal-overlay"></div>
            </div>
            <div class="col-lg-3">
                <form action="{{url('/admin/blog/import-excel-blog')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 mb-4" style="display: flex">
                        <input type="file" name="blog_file_import" accept=".xlsx">
                        <button type="submit" class="btn btn-success"><i class="icon mdi mdi-upload"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3">
                <form action="{{url('/admin/blog/export-excel-blog')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 mb-4" style="display: flex">
                        <button type="submit" class="btn btn-success"><i class="icon mdi mdi-download"></i></button>
                    </div>
                </form>
            </div>
            <div class="modal-overlay"></div>
            @include('admin.alert_admin')
        </div>
        @include('admin.blog.modal_create_blog')
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-header">Danh sách bài viết</div>
                    <div class="card-body">
                        <div class="table-responsive noSwipe">
                            <table id="TableBlog" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width:4%;">
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="check1">
                                            <label class="custom-control-label" for="check1"></label>
                                        </div>
                                    </th>
                                    <th>Tên bài viết</th>
                                    <th>Slug bài viết</th>
                                    <th>Mô tả bài viết</th>
                                    <th>Nội dung bài viết</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($blog as $key => $value)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="check2">
                                            <label class="custom-control-label" for="check2"></label>
                                        </div>
                                    </td>
                                    <td class="user-avatar cell-detail user-info"><img
                                            src="{{asset('public/uploads/blogs/'.$value->blog_image)}}"
                                            alt=""><span>{{$value->blog_name}}</span></td>
                                    <td><span>{{$value->blog_slug}}</span></td>
                                    <td><span>{{$value->blog_description}}</span></td>
                                    <td><span>{{$value->blog_content}}</span></td>
                                    <td>
                                        @if($value->blog_status == 1)
                                            <a href="{{url('/admin/blog/update-blog-status-hide/'.$value->blog_id)}}"><span
                                                    class="text text-success">Hiển thị</span></a>
                                        @else
                                            <a href="{{url('/admin/blog/update-blog-status-display/'.$value->blog_id)}}"><span
                                                    class="text text-danger">Ẩn</span></a>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="md-trigger update_blog" data-toggle="modal"
                                           data-target="#update-modal{{$value->blog_id}}"><i
                                                style="color: #0b66bc; font-size: 25px;"
                                                class="icon mdi mdi-edit"></i></a>
                                        <a href="{{url('/admin/blog/delete-blog/'.$value->blog_id)}}"
                                           onclick="return confirm('Bạn muốn xóa bài viết này không?');"><i
                                                style="color: red ; font-size: 25px;"
                                                class="icon mdi mdi-delete"></i></a>
                                    </td>
                                    @include('admin.blog.modal_edit_blog')
                                </tr>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
