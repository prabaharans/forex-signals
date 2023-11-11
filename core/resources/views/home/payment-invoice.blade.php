@extends('layouts.home')

@section('content')

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">


                <div class="row">
                    <div class="col-md-8 col-md-offset-2">


                        <h3 style="text-align: center; text-transform: uppercase;">Register Successfully Completed</h3>
                        <h4 style="text-align: center; text-transform: uppercase;">Payment Here.</h4>

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


                        <div class="row">

                            <div class="col-md-12 text-center">
                                <p><span style="font-weight: bold;font-size: 18px;">Name : </span> <span style="font-weight: bold;font-size: 18px;font-style: italic;">{{ $member->fname }} {{ $member->lname }}</span></p>
                            </div>
                            <div class="col-md-12 text-center">
                                <p><span style="font-weight: bold;font-size: 18px;">Email : </span> <span style="font-weight: bold;font-size: 18px;font-style: italic;">{{ $member->email }}</span></p>
                            </div>
                            <div class="col-md-12 text-center">
                                <p><span style="font-weight: bold;font-size: 18px;">Phone : </span> <span style="font-weight: bold;font-size: 18px;font-style: italic;">{{ $member->phone }}</span></p>
                            </div>
                            <div class="col-md-12 text-center">
                                <p><span style="font-weight: bold;font-size: 18px;">User Name : </span> <span style="font-weight: bold;font-size: 18px;font-style: italic;">{{ $member->username }}</span></p>
                            </div>
                            <div class="col-md-12 text-center">
                                <p><span style="font-weight: bold;font-size: 18px;">Selected Plan : </span> <span style="font-weight: bold;font-size: 18px;font-style: italic;border: 2px solid #000;border-radius: 5px;padding: 5px;">{{ $member->service->name }}</span></p>
                            </div>
                            <div class="col-md-12 text-center" style="margin-bottom: 15px;">
                                <div class="col-sm-2 col-sm-offset-3">
                                    <span style="font-weight: bold;font-size: 18px;">Plan Price: </span>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="" value="{{ $member->service->price }} - {{ $member->service->currency->name }}" id="" readonly>
                                </div>
                            </div>
                            <div class="row">
                                @if($paypal->status == 1)
                                <div class="col-sm-3">
                                    <img src="{{ asset('images') }}/{{ $paypal->image }}" alt="">

                                    <form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="paypal">
                                        <input type="hidden" name="cmd" value="_xclick" />
                                        <input type="hidden" name="business" value="{{ $paypal->val1 }}" />
                                        <input type="hidden" name="cbt" value="{{ $site_title }}" />
                                        <input type="hidden" name="currency_code" value="USD" />
                                        <input type="hidden" name="quantity" value="1" />
                                        <input type="hidden" name="item_name" value="{{ $site_title }} Plan Price" />

                                        <!-- Custom value you want to send and process back in the IPN -->
                                        <input type="hidden" name="custom" value="{{ $log->custom }}" />

                                        <input name="amount" type="hidden" value="{{ $member->service->price  }}">

                                        <input type="hidden" name="return" value="{{ route('home') }}"/>
                                        <input type="hidden" name="cancel_return" value="{{ url()->current() }}" />

                                        <!-- Where to send the PayPal IPN to. -->
                                        <input type="hidden" name="notify_url" value="{{ route('paypal-ipn') }}" />

                                    <button type="submit" class="button button-3d btn-block nomargin" id="register-form-submit"
                                            name="register-form-submit" value="register"><i class="fa fa-send"></i> Pay Now
                                    </button>

                                    </form>


                                </div>
                                @endif
                                @if($perfect->status == 1)
                                <div class="col-sm-3">
                                    <img src="{{ asset('images') }}/{{ $perfect->image }}" alt="">

                                        <form action="https://perfectmoney.is/api/step1.asp" method="POST" id="myform">
                                            <input type="hidden" name="PAYEE_ACCOUNT" value="{{ $perfect->val1 }}">
                                            <input type="hidden" name="PAYEE_NAME" value="{{ $site_title }}">
                                            <input type='hidden' name='PAYMENT_ID' value='{{ $log->custom }}'>
                                            <input type="hidden" name="PAYMENT_AMOUNT"  value="{{ $log->amount  }}">
                                            <input type="hidden" name="PAYMENT_UNITS" value="USD">
                                            <input type="hidden" name="STATUS_URL" value="{{ route('perfect-ipn') }}">
                                            <input type="hidden" name="PAYMENT_URL" value="{{ route('home') }}">
                                            <input type="hidden" name="PAYMENT_URL_METHOD" value="GET">
                                            <input type="hidden" name="NOPAYMENT_URL" value="{{ url()->current() }}">
                                            <input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">
                                            <input type="hidden" name="SUGGESTED_MEMO" value="{{ $site_title }}">
                                            <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT">

                                            <button class="button button-3d btn-block nomargin" id="register-form-submit"
                                                    name="register-form-submit" value="register"><i class="fa fa-send"></i> Pay Now
                                            </button>
                                        </form>

                                </div>
                                @endif
                                    @if($btc->status == 1)
                                <div class="col-sm-3">
                                    <img src="{{ asset('images') }}/{{ $btc->image }}" alt="">

                                    {!! Form::open(['route'=>'btc-preview']) !!}

                                    <input type="hidden" name="amount" value="{{ $log->amount }}">
                                    <input type="hidden" name="custom" value="{{ $log->custom }}">
                                    <input type="hidden" name="member_id" value="{{ $log->member_id }}">
                                    <input type="hidden" name="url" value="{{ url()->current() }}">
                                    <button class="button button-3d btn-block nomargin" id="register-form-submit"
                                            name="register-form-submit" value="register"><i class="fa fa-send"></i> Pay Now
                                    </button>
                                    {{ Form::close() }}

                                </div>
                                    @endif
                                    @if($stripe->status == 1)
                                <div class="col-sm-3">
                                    <img src="{{ asset('images') }}/{{ $stripe->image }}" alt="">


                                    {!! Form::open(['route'=>'stripe-preview']) !!}
                                    <input type="hidden" name="amount" value="{{ $log->amount }}">
                                    <input type="hidden" name="custom" value="{{ $log->custom }}">
                                    <input type="hidden" name="member_id" value="{{ $log->member_id }}">
                                    <input type="hidden" name="url" value="{{ url()->current() }}">
                                    <button class="button button-3d btn-block nomargin" id="register-form-submit"
                                            name="register-form-submit" value="register"><i class="fa fa-send"></i> Pay Now
                                    </button>
                                    {{ Form::close() }}


                                </div>
                                    @endif
                            </div>

                            
                        </div>
                        <br>

                    </div>


                </div><!-- row  -->


            </div>
        </div>
    </section>


@endsection