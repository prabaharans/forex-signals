@extends('layouts.home')

@section('content')

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">


                <div class="row">
                    <div class="col-md-10 col-md-offset-1">


                        <h3 style="text-align: center; text-transform: uppercase;">Register Your Account Now</h3>
                        <h4 style="text-align: center; font-weight: bold;">
                            Already Have An Account? <a href="{{ route('user-login') }}"> Login Now </a>
                        </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <!--  ==================================SESSION MESSAGES==================================  -->
                                @if (session()->has('message'))
                                    <div class="alert alert-{!! session()->get('type')  !!} alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {!! session()->get('message')  !!}
                                    </div>
                                @endif
                            <!--  ==================================SESSION MESSAGES==================================  -->


                                <!--  ==================================VALIDATION ERRORS==================================  -->
                                @if($errors->any())
                                    @foreach ($errors->all() as $error)

                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            {!!  $error !!}
                                        </div>

                                @endforeach
                            @endif
                            <!--  ==================================SESSION MESSAGES==================================  -->

                            </div>
                        </div>
                        <hr>


                            {!! Form::open(['route'=>'registration-post','method'=>'post','method'=>'post']) !!}


                            <div class="row">

                                <div class="col-md-6">
                                    <label>First Name:</label>
                                    <input name="fname" class="form-control input-lg" type="text" required="">
                                </div>

                                <div class="col-md-6">
                                    <label>Last Name:</label>
                                    <input name="lname" class="form-control input-lg" type="text" required="">
                                </div>

                            </div>
                            <br>


                            <div class="row">

                                <div class="col-md-6">
                                    <label>Email Address:</label>
                                    <input id="email" name="email" class="form-control input-lg" type="email"
                                           required="">
                                    <div id="emailerr"></div>
                                </div>

                                <div class="col-md-6">
                                    <label>Phone Number:</label>
                                    <input id="phone" name="phone" class="form-control input-lg" type="text" required=""
                                           maxlength="11">
                                    <div id="phoneerr"></div>
                                </div>

                            </div>
                            <br>

                            <div class="row">

                                <div class="col-md-12">
                                    <label>Choose a Username:</label>
                                    <input type="text" name="username" id="username" class="form-control input-lg"
                                           required="">
                                    <div id="usernaameerr"></div>
                                </div>

                            </div>

                            <br>


                            <div class="row">

                                <div class="col-md-6">
                                    <label>Choose Password:</label>
                                    <input name="password" class="form-control input-lg" type="password" required="">
                                </div>
                                <div class="col-md-6">
                                    <label>Re-enter Password:</label>
                                    <input name="password_confirmation" class="form-control input-lg" type="password" required="">
                                </div>


                            </div>
                            <br><br><br>

                            <div class="row">

                                <div class="col-md-12">
                                    <label>SELECT A PLAN:</label>

                                    <select name="service_id" class="form-control input-lg" required="">
                                        <option value="">Please Select A Plan</option>
                                        @foreach($plan as $p)
                                        <option value='{{ $p->id }}'>{{ $p->name }} - {{ $p->price }} {{ $p->currency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <br><br>

                            <p style="font-size: 18px;">


                                <label class="checkbox margin-bottom-20">
                                    <input type="checkbox" name="terms" required="">
                                    <i></i>
                                    I have read agreed with the <a href="#">Terms of Use</a> ,
                                    <a href="#">Privacy Policy</a>
                                </label>

                            </p>

                            <div class="col_full nobottommargin">
                                <button class="button button-3d btn-block nomargin" id="register-form-submit"
                                        name="register-form-submit" value="register">Register & Next Step
                                </button>
                            </div>

                        {!! Form::close() !!}

                    </div>


                </div><!-- row  -->


            </div>
        </div>
    </section>


@endsection