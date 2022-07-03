<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="">
    <title>Trang chủ Amin || Shop TNB</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/lib/material-design-icons/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/lib/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/assets/css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css">

    <style>
        a:hover{
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="be-wrapper be-fixed-sidebar">
    <nav class="navbar navbar-expand fixed-top be-top-header">
        <div class="container-fluid">
            <div class="be-navbar-header"><a class="" href="{{url('/staff')}}"><span style="font-size: 24px; color: #ff3b24">SHOP TNB</span></a>
            </div>
            <div class="page-title"><span>Trang quản trị viên</span></div>
            <div class="be-right-navbar">
                <ul class="nav navbar-nav float-right be-user-nav">
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{asset('public/backend/assets/img/avatarfb.jpg')}}" alt="Avatar"><span class="user-name">{{session()->get('staff_name')}}</span></a>
                        <div class="dropdown-menu" role="menu">
                            <div class="user-info">
                                <div class="user-name">{{session()->get('staff_name')}}</div>
                                <div class="user-position online">Quản trị viên</div>
                            </div><a class="dropdown-item" href="pages-profile.html"><span class="icon mdi mdi-face"></span>Tài khoản</a><a class="dropdown-item" href="#"><span class="icon mdi mdi-settings"></span>Cài đặt</a><a class="dropdown-item" href="{{url('/admin/users/logout')}}"><span class="icon mdi mdi-power"></span>Đăng xuất</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
