@extends('admin.admin_layout')
@section('admin_content')
    <div class="page-head">
        <h2 class="page-head-title">Quản lý bình luận</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý bình luận</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
        <div class="row">
            <div class="modal-overlay"></div>
            @include('admin.alert_admin')
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-header">Danh sách bình luận</div>
                    <div class="card-body">
                        <div class="table-responsive noSwipe">
                            <table id="TableComment" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width:4%;">
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="check1">
                                            <label class="custom-control-label" for="check1"></label>
                                        </div>
                                    </th>
                                    <th>Ngày bình luận</th>
                                    <th>Tên khách hàng</th>
                                    <th>Bình luận</th>
                                    <th>Sản phẩm được bình luận</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comment as $key => $value)
                                @if($value->rep_comment == 0)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="check2">
                                                <label class="custom-control-label" for="check2"></label>
                                            </div>
                                        </td>
                                        <td><span>{{$value->comment_date}}</span></td>
                                        <td><span>{{$value->comment_name}}</span></td>
                                        <td>
                                            <span>
                                                {{$value->comment}}<br>
                                                @if($value->rep_comment == 0)
                                                    Admin:
                                                    @foreach($comment as $commentReply)
                                                        @if($commentReply->rep_comment == $value->comment_id)
                                                             <br><span style="margin-left: 10px;">{{$commentReply->comment}}</span>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </span>
                                            <br>
                                            @if($value->rep_comment != 0)
                                                Bình luận của admin
                                            @else
                                                <form>
                                                    @csrf
                                                    <textarea rows="3" class="rep_comment_area_{{$value->comment_id}}"></textarea>
                                                    <br>
                                                    <button type="button" id="{{$value->product_id}}" class="btn btn-secondary rep_comment" data-comment_id="{{$value->comment_id}}">Trả lời</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->rep_comment != 0)
                                            Bình luận của admin
                                            @else
                                            <span>{{$value->product->product_name}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/admin/comment/delete-comment/'.$value->comment_id)}}"
                                               onclick="return confirm('Bạn muốn xóa bình luận này không?');"><i
                                                    style="color: red ; font-size: 25px;"
                                                    class="icon mdi mdi-delete"></i></a>
                                            @if($value->rep_comment != 0)
                                                <span style="margin-left: 10px;">Bình luận của admin</span>
                                            @else
                                            @if($value->comment_status == 1)
                                            <a style="margin-left: 10px;" href="{{url('/admin/comment/no-accept-comments/'.$value->comment_id)}}">Không duyệt</a>
                                            @else
                                            <a style="margin-left: 10px;" href="{{url('/admin/comment/accept-comments/'.$value->comment_id)}}">Duyệt</a>
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
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
