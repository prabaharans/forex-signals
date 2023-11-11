@extends('layouts.dashboard')
@section('title', 'All Currency')
@section('content')


    @if(count($payment))

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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Plan</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Remaining Day</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($payment as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $p->member->fname }} {{ $p->member->lname }}</td>
                                    <td>{{ $p->member->email }}</td>
                                    <td>{{ $p->member->service->name }}</td>
                                    <td>{{ date('d-F-Y',strtotime($p->start_date)) }}</td>
                                    <td>{{ date('d-F-Y',strtotime($p->expiry_date)) }}</td>
                                    <td>
                                        @php
                                            $startTime = \Carbon\Carbon::now();
                                            $finishTime = \Carbon\Carbon::parse($p->expiry_date);

                                            $totalDuration = $finishTime->diffInDays($startTime);
                                        @endphp

                                        {{ $totalDuration  }} - Days
                                    </td>
                                    <td>
                                        @if($totalDuration > 3)
                                            <span style="padding: 5px;border: 2px solid black; border-radius: 5px">Paid</span>
                                        @else
                                            <span style="padding: 5px;border: 2px solid red; border-radius: 5px">Invoice Send</span>
                                        @endif
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
            {!! $payment->render() !!}
        </div>
    @else

        <div class="text-center">
            <h3>No Data available</h3>
        </div>
    @endif



@endsection


