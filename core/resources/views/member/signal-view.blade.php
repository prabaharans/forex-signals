@extends('layouts.member')
@section('content')

    @if(count($signal))

        <div class="row">


            <div class="col-md-10 col-sm-6 col-md-offset-1">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold font-dark "> {{ $signal->title }}</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="cd-horizontal-timeline mt-timeline-horizontal">

                            <div class="text-center">

                                <label for=""><i class="fa fa-calendar"></i> Date{{ date('d-F-Y',strtotime($signal->created_at)) }}</label>

                            </div>
                            <hr>
                            <!-- .timeline -->
                            <div class="events-content">
                                <div class="mt-content border-grey-steel">
                                    <p>{!! $signal->description !!}</p>
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



