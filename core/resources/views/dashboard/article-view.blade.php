@extends('layouts.dashboard')
@section('content')

    @if(count($article))

        <div class="row">


            <div class="col-md-10 col-md-offset-1">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption" style="text-align: center;width: 100%">
                            <i class="icon-directions font-green hide"></i>
                            <span class="bold font-dark" style="text-align: center"> {{ $article->title }}</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="cd-horizontal-timeline mt-timeline-horizontal">

                            <div class="text-center">
                                <span><i class="fa fa-calendar" aria-hidden="true"></i> Date : {{ date('d-F-Y',strtotime($article->created_at))  }}</span>
                                <span><i class="fa fa-folder"></i> Category : {{ $article->category->name }}</span>
                            </div>
                            <hr>
                            <!-- .timeline -->
                            <div class="events-content">
                                <div class="mt-content border-grey-steel">
                                    <p>{!! $article->description !!}</p>
                                </div>
                            </div>
                            <!-- .events-content -->
                        </div>
                        <hr>
                        <div class="text-center">
                            <a href="{{ route('article-edit',$article->id) }}" class="btn purple btn-sm"><i class="fa fa-edit"></i> Edit Article</a>

                            <button type="button" class="btn btn-danger btn-sm delete_button"
                                    data-toggle="modal" data-target="#DelModal"
                                    data-id="{{ $article->id}}">
                                <i class='fa fa-times'></i> Delete Article
                            </button>
                        </div>
                    </div>

                </div>
            </div>


        </div>


    @else

        <div class="text-center">
            <h3>No Data available</h3>
        </div>
    @endif

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
                    <form method="post" action="{{ route('article-delete') }}" class="form-inline">
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


