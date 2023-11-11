@extends('layouts.dashboard')
@section('title', 'All Currency')
@section('content')


    @if(count($member))

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
                                <th>Member Name</th>
                                <th>Member Email</th>
                                <th>Member Plan</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($member as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $p->fname }} {{ $p->lname }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ $p->service->name }}</td>
                                    <td>
                                        @if($p->payment_status == 1)
                                            <span style="padding: 5px;border: 2px solid black; border-radius: 5px">Paid</span>
                                        @else
                                            <span style="padding: 5px;border: 2px solid red; border-radius: 5px">UnPaid</span>
                                        @endif
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-danger btn-sm delete_button"
                                                data-toggle="modal" data-target="#DelModal"
                                                data-id="{{ $p->id }}">
                                            <i class='fa fa-send'></i> Send Message
                                        </button>

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
            {!! $member->render() !!}
        </div>
    @else

        <div class="text-center">
            <h3>No Data available</h3>
        </div>
    @endif

    <!-- Modal for DELETE -->
    <div class="row">
        <div class="col-md-12">
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-envelope'></i> Send Message !</h4>
                </div>

                <div class="modal-body">
                    <strong>Send Message To User.</strong>
                </div>

                <div class="modal-footer">

                    <form method="post" action="{{ route('user-message') }}" class="form-horizontal">
                        {!! csrf_field() !!}

                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-sm-4 control-label"><b>Message Title : </b></label>

                                <div class="col-sm-7">
                                    <input name="title" value="" class="form-control input-lg" type="text" required placeholder="Message Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><b>Message Description : </b></label>

                                <div class="col-sm-7">
                                    <textarea name="message" id="" cols="30" rows="5"
                                              class="form-control input-lg" required placeholder="Message Description"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id" class="abir_id" value="0">
                            <div class="form-group">

                                <div class="col-sm-7 col-sm-offset-4">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-send"></i> Send Message</button>
                                </div>
                            </div>


                        </div>

                    </form>

                </div>

            </div>
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

