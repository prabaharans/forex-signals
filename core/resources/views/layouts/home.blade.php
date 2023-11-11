<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content=""/>
    <meta name="description" content="{{ $site_title }}">
    <meta name="keywords" content="{{ $site_title }}">
    

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">


    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Montserrat:400,700|Crete+Round:400italic"
          rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/colors.php?color') }}={{ $site_color }}" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>{{ $site_title }} - {{ $page_title }}</title>


    <style>

        .panel > .panel-heading {
            background: #{{ $site_color }};
            color: white;
        }

        .panel-primary {
            border: 3px solid #{{ $site_color }};
        }

        .panel-warning {
            border: 3px solid #{{ $site_color }};
        }

        .panel-danger {
            border: 3px solid #{{ $site_color }};
        }

        .panel-info {
            border: 3px solid #{{ $site_color }};
        }

        .panel-success {
            border: 3px solid #{{ $site_color }};
        }

        .pricing-title {
            padding: 15px 0;
            background-color: #{{ $site_color }};
            border-radius: 3px 3px 0 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            color: #fff;
        }

        .pricing-box {
            position: relative;
            border: 3px solid #{{ $site_color }};
            border-radius: 3px;
            text-align: center;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);

            margin: 10px;
        }
        #content{
            background-image: url("{{ asset('images/gplaypattern.png') }}") !important;
        }
        .clients-grid li:before, .testimonials-grid li:before{
            border-left: 1px dashed #{{ $site_color }} !important;
        }
        .clients-grid li:after, .testimonials-grid li:after{
            border-bottom: 1px dashed #{{ $site_color }} !important;
        }
        .pricing-features ul li p{
            margin-bottom:0px !important;
        }
        .pricing-price{
            padding: 15px 0px !important;
        }
        .feature-box,.fbox-icon,.fancy-title h3{
            background: none !important;
        }

    </style>
    @yield('style')

</head>
<body class="stretched" style="background-image: url('images/footer_lodyas.png')">
<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">


    <header id="header" class="full-header dark">

        <div id="header-wrap" class="">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="fa fa-reorder"></i></div>

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="{{ route('home') }}" class="standard-logo"><img
                                src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                    <a href="{{ route('home') }}" class="retina-logo"><img
                                src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                </div><!-- #logo end -->

                <!-- Primary Navigation
                ============================================= -->
                <nav id="primary-menu" class="style-3">

                    <ul class="sf-js-enabled">

                        <li><a href="{{ route('home') }}">
                                <div>Home</div>
                            </a>
                        </li>
                        @foreach($menu as $m)
                            <li class="hidden-sm">
                                <a href="{{url('menu/')}}/{{$m->id}}/{{urlencode(strtolower($m->name))}}">
                                    <div>{{ $m->name }}</div>
                                </a>
                            </li>
                        @endforeach
			<li><a href="{{ route('contact-us') }}">
                                <div>Contact Us</div>
                            </a>
                        </li>

                        @if(Auth::guard('member')->check())
                            <li><a href="#">
                                    <div><i class="fa fa-user" style="margin-top: 5px;"></i> {{ Auth::guard('member')->user()->fname }} {{ Auth::guard('member')->user()->lname }} <i style="padding-top: 2px;" class="fa fa-sort-down"></i></div>
                                </a>
                                <ul>
                                    @if(Auth::guard('member')->user()->payment_status == 0)
                                        @php $id = Auth::guard('member')->user()->id @endphp
                                    <li><a href="{{ route('payment-invoice',$id) }}">
                                            <div><i class="fa fa-money"></i> Complete Payment</div></a>
                                    </li>
                                    @else
                                        <li><a href="{{ route('user-dashboard') }}">
                                                <div><i class="fa fa-dashboard"></i> Dashboard</div></a>
                                        </li>
                                    @endif
                                    <li><a href="{{ route('user-logout') }}"><div><i class="fa fa-sign-out"></i> Log Out</div></a></li>
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ route('user-login') }}">
                                    <div><i class="fa fa-sign-in" style="margin-top: 5px;"></i> LOGIN</div>
                                </a></li>
                            <li><a href="{{ route('user-registration') }}">
                                    <div><i class="fa fa-edit" style="margin-top: 5px;"></i> REGISTER</div>
                                </a></li>
                        @endif


                    </ul>


                </nav><!-- #primary-menu end -->

            </div>

        </div>

    </header>


    @yield('content')


    <footer id="footer" class="dark"
            style="background: url('{{ asset('images/footer-bg.jpg') }}') repeat fixed; background-size: 100% 100%;">

        <div class="container">


            <div class="footer-widgets-wrap clearfix">
                <div class="row">

                    <div class="col-md-3 col-sm-12">
                        <img src="{{ asset('images/logo.png') }}" alt="" class="alignleft"
                             style="width: 100%; padding-right: 18px; border-right: 1px solid #4A4A4A; filter: brightness(0) invert(1);">
                    </div>

                    <div class="col-md-9 col-sm-12">
                        <p style="text-align: justify;">
                        {!! $footer_text !!}
                        </p>
                    </div>


                </div><!-- row -->
            </div><!-- .footer-widgets-wrap end -->


        </div><!-- container -->


        <!-- Copyrights ============================================= -->
        <div id="copyrights">
            <div class="container clearfix">


                <div class="col-md-6 col-md-offset-3">
                    <div class="text-center">
                        {!! $footer_bottom_text !!}
                    </div>

                </div>

                <!--
                <div class="col-md-6">

                <div class="pull-right" style="text-transform: uppercase; color: #fff;">
                TECHNOLOGY BY <a href="http://thesoftking.com/donation" target="_blank"> THESOFTKING </a>
                </div>

                </div>-->
            </div>
            <!-- Copyrights ============================================= -->


    </footer>


</div><!-- #wrapper end -->

<div id="gotoTop" class="fa fa-angle-up"></div>

<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('js/jquery.countdown.js') }}"></script>



</body>
</html>