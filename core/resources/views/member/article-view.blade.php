@extends('layouts.member')
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
                    </div>

                </div>
            </div>


        </div>


    @else

        <div class="text-center">
            <h3>No Data available</h3>
        </div>
    @endif


@endsection



