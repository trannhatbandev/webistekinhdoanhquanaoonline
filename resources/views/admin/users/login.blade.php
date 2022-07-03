<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Trang đăng nhập quản trị viên || SHOP TNB</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/lib/material-design-icons/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/assets/css/app.css')}}" type="text/css">
</head>
<body class="be-splash-screen">
<div class="be-wrapper be-login">
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="splash-container">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header"><span style="color: #0b66bc">SHOP TNB</span></div>
                    <div class="card-body">
                        @include('admin.alert_admin')
                        <form method="post" action="{{url('/admin/users/login-admin')}}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" name="admin_email" type="text" placeholder="Điền email" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="admin_password" type="password" placeholder="Điền mật khẩu">
                            </div>
                            <div class="form-group row login-tools">
                                <div class="col-6 login-remember">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="checkbox1">
                                        <label class="custom-control-label" for="checkbox1">Nhớ mật khẩu</label>
                                    </div>
                                </div>
                                <div class="col-6 login-forgot-password"><a href="pages-forgot-password.html">Quên mật khẩu?</a></div>
                            </div>
                            <div class="form-group login-submit"><button type="submit" class="btn btn-primary btn-xl" data-dismiss="modal">Đăng nhập</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('public/backend/assets/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/backend/assets/js/app.js')}}" type="text/javascript"></script>
{{-- <script type="text/javascript">
    $(document).ready(function(){
        //-initialize the javascript
        App.init();
    });
</script> --}}
</body>
</html>
