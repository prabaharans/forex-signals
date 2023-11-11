@extends('layouts.home')

@section('content')

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="row">


                    <div class="col-md-6 col-md-offset-3">

                        <div class="well well-lg nobottommargin">
                            <form class="nobottommargin" action="{{ route('user-forget-password-submit') }}" method="post">

                                <h3>Reset Your Log In Password </h3>
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

                                <div class="col_full">
                                    <label for="login-form-username">Email:</label>
                                    <input id="email" name="email" class="form-control input-lg" type="email" required placeholder="Enter Your Email ID">
                                </div>


                                {!! csrf_field() !!}

                                <div class="col_full nobottommargin">
                                    <button class="button button-3d btn-block nomargin" id="login-form-submit"
                                            name="login-form-submit" value="login">Reset Password
                                    </button>
                                </div>

                            </form>
                            <div id="working"></div>
                            <div id="error">
                            </div>


                        </div>


                        <p style="text-align: center; font-weight: bold;">
                            Have An Account? <a href="{{ route('user-login') }}"> Log In Now </a>
                        </p>


                    </div><!-- row -->
                </div>
            </div>
        </div>
    </section>

@endsection