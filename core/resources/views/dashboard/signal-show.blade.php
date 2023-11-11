@extends('layouts.dashboard')
@section('content')

    @if(count($signal))

        <div class="row">
            <div class="col-md-12">
                @foreach($signal as $s)
                    <div class="col-md-6">
                        <div class="portlet light portlet-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-directions font-green hide"></i>
                                    <span class="caption-subject bold font-dark "> {{ $s->title }}</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="cd-horizontal-timeline mt-timeline-horizontal">

                                    <div class="text-center">
                                        @foreach($s->services as $p)
                                            <label for=""
                                                   class="label control-label label-primary">{{ $p->name }}</label>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <!-- .timeline -->
                                    <div class="events-content">
                                        <div class="mt-content border-grey-steel">
                                            <p>{!! $s->description !!}</p>
                                        </div>
                                    </div>
                                    <!-- .events-content -->
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                <div class="text-center">
                    {!!  $signal->links() !!}
                </div>
            </div>
        </div>


        <div class="text-center">
            {!! $signal->render() !!}
        </div>
    @else

        <div class="text-center">
            <h3>No Data available</h3>
        </div>
    @endif


@endsection



