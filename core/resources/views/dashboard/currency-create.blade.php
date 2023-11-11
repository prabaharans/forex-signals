@extends('layouts.dashboard')
@section('title', 'Currency Create')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">

                <div class="portlet-body form">
                    {!! Form::open(['method'=>'post','class'=>'form-horizontal']) !!}
                    <div class="form-body">


                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Currency Name : </b></label>

                            <div class="col-sm-6">
                                <input name="name" value="" class="form-control input-lg" type="text" required placeholder="Currency Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Conversion Rate : </b></label>

                            <div class="col-sm-6">
                                <input name="rate" value="" class="form-control input-lg" type="number" required placeholder="1 USD = How Much?">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn blue btn-block margin-top-10"><i class="fa fa-paper-plane"></i> Create Currency</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div><!---ROW-->


@endsection

