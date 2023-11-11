@extends('layouts.dashboard')
@section('title', 'Keyword Manger')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">

                <div class="portlet-body form">
                    {!! Form::open(['class'=>'form-horizontal']) !!}
                    <div class="form-body">


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Author Name :</label>

                            <div class="col-sm-6">
                                <input name="name" value="" class="form-control input-lg" type="text" required placeholder="Author Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Testimonial Description :</label>

                            <div class="col-sm-6">
                                <textarea name="description" id="" cols="30" rows="5"
                                          class="form-control input-lg" placeholder="Testimonial Description" required></textarea>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn blue btn-block margin-top-10"><i class="fa fa-send"></i> Save New Testimonial</button>
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
        @foreach($test as $s)
            <div class="col-md-4">
                <div class="images margin-top-10" style="border: 1px solid #ddd;border-radius: 5px;padding: 5px">
                    <h4 class="text-center">{{ $s->name }}</h4>
                    <hr>
                    <p class="text-center">{!! substr($s->description,0,180)   !!} {{ strlen($s->description) > 180 ? "..." : "" }}</p>
                    <hr>
                    <div class="hasan" style="width:240px;margin: 0 auto">
                        <a href="{{ route('testimonial-edit',$s->id) }}" class="btn btn-primary btn-sm text-center"><i class="fa fa-edit"></i> Edit Keyword</a>
                        <button type="button" class="btn btn-danger btn-sm delete_button pull-right"
                                data-toggle="modal" data-target="#DelModal"
                                data-id="{{ $s->id }}">
                            <i class='fa fa-trash'></i> Delete Keyword
                        </button>
                    </div>
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
                    <form method="post" action="{{ route('testimonial-delete') }}" class="form-inline">
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
    <link href="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/pages/scripts/components-editors.min.js')}}" type="text/javascript"></script>


@endsection

