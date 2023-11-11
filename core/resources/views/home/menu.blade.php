@extends('layouts.home')
@section('title', "$menu_name" )
@section('content')


<!-- =-=-=-=-=-=-= About Us =-=-=-=-=-=-= -->
<section class="padding-top-70 white" id="content">
    <div class="container">
        <div class="row">
            <div class="about">
                <!-- end col-md-6 -->
                <div class="col-md-12 col-sm-12">
                    <p>{!! $menu_description !!}</p>
                </div>
                <!-- end col-md-5 -->
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- =-=-=-=-=-=-= About Us END =-=-=-=-=-=-= -->


@endsection