@extends('staff.staff_layout')
@section('staff_content')
    <div class="page-head">
        <h2 class="page-head-title">Quản lý đơn hàng</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/staff')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý đơn hàng</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
            @include('staff.alert_staff')
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-header">Danh sách đơn hàng</div>
                    <div class="card-body">
                        <div class="table-responsive noSwipe">
                            <table id="TableOrder" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width:4%;">
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="check1">
                                            <label class="custom-control-label" for="check1"></label>
                                        </div>
                                    </th>
                                    <th>Mã code</th>
                                    <th>Tình trạng đơn hàng</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Ngày</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $key => $value)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="check2">
                                                <label class="custom-control-label" for="check2"></label>
                                            </div>
                                        </td>
                                        <td><span>{{$value->order_code}}</span></td>
                                        <td><span>
                                            @if($value->order_status == 1)
                                                Đơn hàng mới
                                            @elseif($value->order_status == 2)
                                                Đã giao hàng
                                            @elseif($value->order_status == 3)
                                                Đã hủy đơn hàng
                                            @endif
                                        </span></td>
                                        <td><span>{{$value->payment->payment_method}}</span></td>
                                        <td><span>{{$value->created_at}}</span></td>
                                        <td>
                                            <a class="md-trigger" href="{{url('/staff/order/show-order-detail/'.$value->order_code)}}"><i
                                                    style="color: #0b66bc; font-size: 25px;"
                                                    class="icon mdi mdi-eye"></i></a>
                                            <a href="{{url('/staff/order/delete-order/'.$value->order_code)}}"
                                               onclick="return confirm('Bạn muốn xóa đơn hàng này không?');"><i
                                                    style="color: red ; font-size: 25px;"
                                                    class="icon mdi mdi-delete"></i></a>
                                        </td>
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
