@extends('layouts.dashboard')
@section('title', 'Slider')
@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">

                <div class="portlet-body form">
                    {!! Form::open(['route'=>'post_slider','method'=>'post','files'=>true,'class'=>'form-horizontal']) !!}
                        <div class="form-body">


                            <div class="form-group">
                                <label class="col-sm-3 control-label">Slider Text</label>

                                <div class="col-sm-6">
                                    <input name="text" value="" class="form-control input-lg" type="text" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Slider IMAGE</label>

                                    <div class="col-sm-2"><input name="image" type="file" class="form-control" required /></div>
                                    <div class="col-sm-4"><b style="color:red; font-weight: bold; float: right;margin-right: 10px">ONE IMAGE ONLY | Will Resized to 1920 x 750 </b></div>
                                </div>
                                <br><br>

                                <div class="row">
                                    <div class="col-md-offset-3 col-md-6">
                                        <button type="submit" class="btn blue btn-block margin-top-10">Save Slider</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div><!---ROW-->
    <hr>
    <div class="row">
        @foreach($slider as $s)
        <div class="col-md-6">
            <div class="images">
                <img src="{{ asset('images') }}/{{ $s->image }}" alt="" style="width: 520px;height: 300px; margin-top: 20px;margin-bottom: 10px">
                <button type="button" class="btn btn-danger btn-block btn-lg delete_button"
                        data-toggle="modal" data-target="#DelModal"
                        data-id="{{ $s->id }}">
                    <i class='fa fa-trash'></i> Delete Slider
                </button>

            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal for DELETE -->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Delete !</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('slider-delete') }}" class="form-inline">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>

@endsection

