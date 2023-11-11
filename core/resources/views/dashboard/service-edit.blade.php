@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">

                <div class="portlet-body form">
                    {!! Form::model($service,['route'=>['service-update',$service->id],'method'=>'PUT','class'=>'form-horizontal']) !!}
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Plan Name : </label>

                            <div class="col-sm-6">
                                <input name="name" value="{{ $service->name }}" class="form-control input-lg" type="text" required placeholder="Plan Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Plan Price : </label>
                            <div class="col-sm-2">
                                <select name="currency_id" id="" class="form-control input-lg" required>

                                    @foreach($currency as $c)
                                        @if($c->id == $service->currency_id)
                                            <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                        @else
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input name="price" value="{{ $service->price }}" class="form-control input-lg" type="number" required placeholder="Plan Price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Plan Description : </label>

                            <div class="col-md-6">
                                <div class="description" style="width: 100%;border: 1px solid #ddd;padding: 10px;border-radius: 5px" >
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input name="description1" value="{{ $service->description1 }}" class="form-control margin-top-10" type="text" required placeholder="Plan Description">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input name="description2" value="{{ $service->description2 }}" class="form-control margin-top-10" type="text" required placeholder="Plan Description">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input name="description3" value="{{ $service->description3 }}" class="form-control margin-top-10" type="text" required placeholder="Plan Description">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input name="description4" value="{{ $service->description4 }}" class="form-control margin-top-10" type="text" required placeholder="Plan Description">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input name="description5" value="{{ $service->description5 }}" class="form-control margin-top-10" type="text" required placeholder="Plan Description">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input name="description6" value="{{ $service->description6 }}" class="form-control margin-top-10" type="text" required placeholder="Plan Description">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input name="description7" value="{{ $service->description7 }}" class="form-control margin-top-10" type="text" placeholder="Plan Description">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input name="description8" value="{{ $service->description8 }}" class="form-control margin-top-10" type="text" placeholder="Plan Description">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input name="description9" value="{{ $service->description9 }}" class="form-control margin-top-10" type="text" placeholder="Plan Description">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input name="description10" value="{{ $service->description10 }}" class="form-control margin-top-10" type="text" placeholder="Plan Description">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn blue btn-block margin-top-10"> <i class="fa fa-send"></i> Update Plan</button>
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

