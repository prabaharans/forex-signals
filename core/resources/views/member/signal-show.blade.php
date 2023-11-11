

@extends('layouts.member')
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
                                        <label for=""><i class="fa fa-calendar"></i>
                                            Date : {{ date('d-F-Y',strtotime($s->created_at)) }}</label>
                                    </div>
                                    <hr>
                                    <!-- .timeline -->
                                    <div class="events-content">
                                        <div class="mt-content border-grey-steel">
                                            <p>{{ strip_tags(substr($s->description,0,410))  }}{{ strlen($s->description) > 410 ? "..." : ""}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <a href="{{ route('user-signal-show',$s->id) }}" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> View Signal</a>
                                    <!-- .events-content -->
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
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





