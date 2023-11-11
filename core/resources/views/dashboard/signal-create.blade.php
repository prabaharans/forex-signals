@extends('layouts.dashboard')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    {!! Form::open(['method'=>'post','class'=>'form-horizontal']) !!}
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Signal Plan : </b></label>

                            <div class="col-sm-7">
                                <input type="checkbox" id="checkbox" >Select All
                                <select name="service_id[]" id="e1" class="form-control input-lg select2-multi" multiple="multiple" required>
                                    @foreach($service as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Signal Title : </b></label>

                            <div class="col-sm-7">
                                <input name="title" value="" class="form-control input-lg" type="text" required placeholder="Signal Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Signal Description :</b> </label>

                            <div class="col-sm-7">
                                <textarea name="description" id="" cols="30" rows="10"
                                          class="wysihtml5 form-control input-lg" required placeholder="signal Description"></textarea>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-7">
                                    <button type="submit" id="btn-submit" class="btn blue btn-block margin-top-10"><i class="fa fa-paper-plane"></i> Create New Signal</button>
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
@section('scripts')

    <script src="{{asset('js/select2.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $('.select2-multi').select2();

        $("#checkbox").click(function(){
            if($("#checkbox").is(':checked') ){
                $("#e1 > option").prop("selected","selected");// Select All Options
                $("#e1").trigger("change");// Trigger change to select 2
            }else{
                $("#e1 > option").removeAttr("selected");
                $("#e1").trigger("change");// Trigger change to select 2
            }
        });

    </script>
    <script>

        $('#btn-submit').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: "Are you Ready to Send?",
                text: "Signal will be Send Selected Plan Members.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes. Send !",
                cancelButtonText: "No. Cancel !",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm){
                    form.submit();
                } else {
                    swal("Cancelled", "Your Attendance Not Taken.", "error");
                }
            });

        });

    </script>

    <link href="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/components-editors.min.js')}}" type="text/javascript"></script>

@endsection

