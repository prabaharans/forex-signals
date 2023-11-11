@extends('layouts.dashboard')
@section('content')


    @if(count($signal))

        <div class="row">
            <div class="col-md-12">


                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">

                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Signal Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php $i=0; @endphp
                            @foreach($signal as $p)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ date('d-F-Y',strtotime($p->created_at)) }} </td>
                                    <td>

                                        <a href="{{ route('signal-show',date('Y-m-d',strtotime($p->created_at))) }}" class="btn purple btn-sm"><i class="fa fa-eye"></i> View Signal</a>

                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div><!-- ROW-->


        <div class="text-center">
            {!! $signal->render() !!}
        </div>
    @else

        <div class="text-center">
            <h3>No Data available</h3>
        </div>
    @endif


@endsection



