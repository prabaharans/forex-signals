@extends('layouts.home')

@section('content')


    <!-- Slider
    ============================================= -->
    <section id="slider" class="swiper_wrapper full-screen clearfix" data-loop="true" data-autoplay="5000">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">

                @foreach($slider as $s)
                <div class="swiper-slide"
                     style="background-image: url('{{ asset('images') }}/{{ $s->image }}')">
                    <div class="container clearfix">
                        <div class="slider-caption" style="max-width: 700px;">
                            <h2 data-caption-animate="flipInX"><span
                                        style="color: #fff;">{{ $s->text }}</span></h2>
                            <p data-caption-animate="flipInX" data-caption-delay="500" style="color: #fff;"></p>


                            <b style="color: #fff;" class="hidden-sm hidden-md hidden-lg"></b>
                        </div>
                    </div>
                </div>
                @endforeach



            </div>

        </div>

    </section><!-- #slider end -->


    <!-- Content
    ============================================= -->
    <section id="content" style="color:#{{ $site_color }}">
        <div class="content-wrap">
            <div class="container clearfix">


                <div class="row text-center">
                    <div align="center">
                        <h3 style="text-align: center; text-transform: uppercase; margin-top: 0px;">
                            <span style="color:#{{ $site_color }}"> What We Do</span></h3>
                    </div>
                    <br>
                    <div align="center">
                        <p style="font-size: 18px">{!! $top_text !!}</p>
                    </div>
                </div>


            </div>
        </div>


        <div class="row clearfix bottommargin-lg common-height">


            <div class="col-md-3 col-sm-12 dark center col-padding"
                 style="background-color: #{{ $site_color }}; opacity: 0.9; height: 326px;">
                <div>
                    <div class="counter counter-lined"><span data-from="100" data-to="{{ $total_user }}" data-refresh-interval="50"
                                                             data-speed="2000">1</span></div>
                    <h5>USERS</h5>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 dark center col-padding" style="background-color: #{{ $site_color }}; height: 326px;">
                <div>
                    <div class="counter counter-lined"><span data-from="3000" data-to="{{ $total_package }}" data-refresh-interval="100"
                                                             data-speed="2500">{{ $total_package }}</span></div>
                    <h5>TOTAL PACKAGE</h5>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 dark center col-padding"
                 style="background-color: #{{ $site_color }}; opacity: 0.9; height: 326px;">
                <div>
                    <div class="counter counter-lined"><span data-from="3000" data-to="{{ $total_article }}" data-refresh-interval="100"
                                                             data-speed="2500">{{ $total_article }}</span></div>
                    <h5>TOTAL ARTICLE</h5>
                </div>
            </div>


            <div class="col-md-3 col-sm-12 dark center col-padding" style="background-color: #{{ $site_color }}; height: 326px;">
                <div>
                    <div class="counter counter-lined"><span data-from="100" data-to="{{ $total_signal }}" data-refresh-interval="95"
                                                              data-speed="3500"></span></div>
                    <h5>TOTAL SIGNAL</h5>
                </div>
            </div>


        </div>


        <div class="content-wrap">
            <div class="container clearfix">


                <h3 style="text-align: center; text-transform: uppercase; margin-top: -40px;">
                    <span style="color:#{{ $site_color }}"> Select a package below</span></h3>

                <div class="pricing bottommargin clearfix">

                    @foreach($package as $p)
                    <div class="col-md-4">
                        <div class="pricing-box"
                             style="border-radius: 8px !important;">
                            <div class="pricing-title">
                                <h3>{{ $p->name }}</h3>
                            </div>
                            <div class="pricing-price">
                                <span class="price-unit"><span style="font-size: 19px">{{ $p->currency->name }}</span>-{{ $p->price }}</span>
                            </div>
                            <div class="pricing-features">
                                <ul>
                                    <li>
                                        <p><i class="fa fa-check"></i> {{ $p->description1 }}</p>
                                    </li>
                                    <li>
                                        <p><i class="fa fa-check"></i> {{ $p->description2 }}</p>
                                    </li>
                                    <li>
                                        <p><i class="fa fa-check"></i> {{ $p->description3 }}</p>
                                    </li>
                                    <li>
                                        <p><i class="fa fa-check"></i> {{ $p->description4 }}</p>
                                    </li>
                                    <li>
                                        <p><i class="fa fa-check"></i> {{ $p->description5 }}</p>
                                    </li>
                                    <li>
                                        <p><i class="fa fa-check"></i> {{ $p->description6 }}</p>
                                    </li>
                                    <li>
                                        <p><i class="fa fa-check"></i>
                                            @if($p->description7 != null)
                                                {{ $p->description7 }}
                                            @else
                                                {{ "-"}}
                                            @endif
                                        </p>
                                    </li>
                                    <li>
                                        <p><i class="fa fa-check"></i>
                                            @if($p->description8 != null)
                                                {{ $p->description8 }}
                                            @else
                                                <i class="fa fa-minus"></i>
                                            @endif
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            @if($p->description9 != null)
                                                <i class="fa fa-check"></i>
                                                {{ $p->description9 }}
                                            @else
                                                <i class="fa fa-minus"></i>
                                            @endif
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            @if($p->description10 != null)
                                            	<i class="fa fa-check"></i>
                                                {{ $p->description10 }}
                                            @else
                                                <i class="fa fa-minus"></i>
                                            @endif
                                        </p>
                                    </li>

                                </ul>
                            </div>

                            <div class="pricing-action">
                                <strong style="color: #{{ $site_color }}; text-transform: uppercase;">


                                    <div id="wc1"></div>

                                    <a href="{{ route('user-registration') }}" class="btn btn-block btn-lg"
                                       style="color: #fff; background: #{{ $site_color }}">Sign Up</a> </strong>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


                <h3 style="text-align: center; text-transform: uppercase; margin-top: 40px;">
                    <span style="color:#{{ $site_color }}"> TESTIMONIALS </span></h3>

                <ul class="testimonials-grid grid-3 clearfix">

                    @foreach($test as $t)
                    <li style="height: 198px;">
                        <div class="testimonial" style="color:#{{ $site_color }}">
                            <div class="testi-content">
                                <p style="text-transform: lowercase; font-weight: normal;">{{ $t->description }}</p>
                                <div class="testi-meta">
                                    {{ $t->name }}
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach


                </ul>


            </div>
        </div>
    </section><!-- #content end -->


@endsection