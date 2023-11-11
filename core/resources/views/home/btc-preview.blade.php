@extends('layouts.home')
@section('style')
    <style>
        .credit-card-box .panel-title {
            display: inline;
            font-weight: bold;
        }
        .credit-card-box .form-control.error {
            border-color: red;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
        }
        .credit-card-box label.error {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }
        .credit-card-box .payment-errors {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }
        .credit-card-box label {
            display: block;
        }
        /* The old "center div vertically" hack */
        .credit-card-box .display-table {

        }
        .credit-card-box .display-tr {
            display: table-row;
        }
        .credit-card-box .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 60%;
        }
        /* Just looks nicer */
        .credit-card-box .panel-heading img {
            min-width: 180px;
        }
    </style>
@endsection
@section('content')

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">


                <div class="row">
                    <div class="col-md-8 col-md-offset-2">


                        
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
                            <div class="col-md-8 col-md-offset-2 col-sm-12">
                                <div class="panel panel-default credit-card-box">
                                    <div class="panel-heading display-table" >
                                        <div class="row display-tr" >
                                            <h3 class="panel-title display-td" >Payment Details</h3>
                                        </div>
                                    </div>
                                    <div class="panel-body">

                                        <div class="row">
                                            <h4 style="text-align: center; text-transform: uppercase;"> SEND EXACTLY <strong>{{ $btc }} BTC </strong> TO <strong>{{ $add }}</strong><br>
                                                {!! $code !!} <br>
                                                <strong>SCAN TO SEND</strong> <br><br>
                                                <strong style="color: red;">NB: 3 Confirmation required to Credited your Account</strong>
                                            </h4>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>


                </div><!-- row  -->


            </div>
        </div>
    </section>


@endsection