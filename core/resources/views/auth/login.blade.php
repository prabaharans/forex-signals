<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Admin | Log In</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/css/components-rounded.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END STYLES -->

    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />

</head>

<body class=" login">
<div class="menu-toggler sidebar-toggler"></div>
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="#"><img src="{{asset('images/logo.png')}}" alt="-" style="filter: brightness(0) invert(1);"/> </a>
</div>
<!-- END LOGO -->

<div class="content">
    {!! Form::open(['route'=>'admin-login','class'=>'login-form']) !!}
        <h3 class="form-title font-green">Sign In</h3>

        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password. </span>
        </div>


        @if (session()->has('message'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('message') }}
            </div>
        @endif


        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
        <div class="form-actions">
            {!! csrf_field() !!}
            <button type="submit" class="btn green uppercase btn-block">Login</button>
        </div>


    {!! Form::close() !!}
    <!-- END LOGIN FORM -->

</div>
<div class="copyright"><?php echo date("Y");?> &copy; All Copyright Reserved{{--{{ $yy }} � {{$general->sitename}}. --}}</div>

<!-- BEGIN SCRIPTS -->
<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/login.min.js')}}" type="text/javascript"></script>
<!-- END SCRIPTS -->

</body>
</html>