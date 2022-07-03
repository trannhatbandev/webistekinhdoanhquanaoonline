@extends('admin.admin_layout')
@section('admin_content')
    <div class="page-head">
        <h2 class="page-head-title">Quản lý mã khuyến mãi</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý mã khuyến mãi</li>
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
            {{-- <div class="col-lg-3">
                <div class="mt-6 mb-4">

                </div>
                <div class="modal-overlay"></div>
            </div> --}}
            <div class="col-lg-3">
                <form action="{{url('/admin/discount-code/import-excel-discount-code')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 mb-4" style="display: flex">
                        <input type="file" name="discount_code_file_import" accept=".xlsx">
                        <button type="submit" class="btn btn-success"><i class="icon mdi mdi-upload"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3">
                <form action="{{url('/admin/discount-code/export-excel-discount-code')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 mb-4" style="display: flex">
                        <button type="submit" class="btn btn-success"><i class="icon mdi mdi-download"></i></button>
                    </div>
                </form>
            </div>
            @include('admin.alert_admin')
        </div>
        @include('admin.discountcode.modal_create_discount_code')
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-header">Danh sách mã khuyến mãi</div>
                    <div class="card-body">
                        <div class="table-responsive noSwipe">
                            <table id="TableDiscountCode" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width:4%;">
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="check1">
                                            <label class="custom-control-label" for="check1"></label>
                                        </div>
                                    </th>
                                    <th>Tên mã</th>
                                    <th>Mã code</th>
                                    <th>Số lượng mã</th>
                                    <th>Điều kiện giảm giá</th>
                                    <th>Giá giảm</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dicountCodeAll as $key => $value)
                                    <tr>
                                        <td>
                                            @if(strtotime($value->discount_code_date_end)>strtotime($date))
                                                Còn hạn
                                            @else
                                                Hết hạn
                                            @endif
                                        </td>

                                        <td>{{$value->discount_code_name}}</td>
                                        <td>{{$value->discount_code_code}}</td>
                                        <td>{{$value->discount_code_quantity}}</td>
                                        <td>
                                            @if($value->discount_code_condition==1)
                                                Giảm theo tiền (đ)
                                            @elseif($value->discount_code_condition==2)
                                                Giảm theo phần trăm (%)
                                            @endif
                                        </td>
                                        <td>{{$value->discount_code_price}}</td>
                                        <td>{{$value->discount_code_date_start}}</td>
                                        <td>{{$value->discount_code_date_end}}</td>
                                        <td>
                                            <a class="md-trigger update_brand" data-toggle="modal"
                                               data-target="#update-modal{{$value->discount_code_id}}"><i
                                                    style="color: #0b66bc; font-size: 25px;"
                                                    class="icon mdi mdi-edit"></i></a>
                                            <a href="{{url('/admin/brand/delete-brand/'.$value->discount_code_id)}}"
                                               onclick="return confirm('Bạn muốn xóa mã khuyến mãi này không?');"><i
                                                    style="color: red ; font-size: 25px;"
                                                    class="icon mdi mdi-delete"></i></a>
                                                @if(strtotime($value->discount_code_date_end)>strtotime($date))
                                                     <a href="{{url('/admin/discount-code/send-discount-code/'.$value->discount_code_id)}}"
                                                    class="btn btn-primary">Gửi mã khuyến mãi</a>
                                                @endif

                                        </td>
                                        @include('admin.discountcode.modal_edit_discount_code')
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






