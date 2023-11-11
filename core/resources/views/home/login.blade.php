@extends('layouts.home')

@section('content')

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="row">


                    <div class="col-md-6 col-md-offset-3">

                        <div class="well well-lg nobottommargin">
                            <form id="login-form" name="login-form" class="nobottommargin" action="#" method="post">

                                <h3>Login to your Account</h3>
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
                                    <label for="login-form-username">Username:</label>
                                    <input id="username" name="username" class="form-control input-lg" type="text">
                                </div>

                                <div class="col_full">
                                    <label for="login-form-password">Password:</label>
                                    <input id="password" name="password" class="form-control input-lg" type="password">
                                </div>

                                {!! csrf_field() !!}

                                <div class="col_full nobottommargin">
                                    <button class="button button-3d btn-block nomargin" id="login-form-submit"
                                            name="login-form-submit" value="login">Login
                                    </button>
                                </div>

                            </form>
                            <div id="working"></div>
                            <div id="error">
                            </div>


                        </div>


                        <p style="text-align: center; font-weight: bold;">
                            Don't Have An Account? <a href="{{ route('user-registration') }}"> Register Now </a> | Or<a href="{{ route('user-forget-password') }}"> Forget Your Pasword </a>
                        </p>


                    </div><!-- row -->


                </div>
            </div>
    </section>

@endsection