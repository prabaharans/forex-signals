@extends('layouts.dashboard')
@section('title', 'All Currency')
@section('content')


    @if(count($currency))

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
                                <th>Currency Name</th>
                                <th>Conversion Rate</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($currency as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->rate }} {{ $p->name }} = 1 USD</td>
                                    <td>

                                        <a href="{{ route('currency_edit',$p->id) }}" class="btn purple btn-sm"><i class="fa fa-edit"></i> EDIT</a>

                                        <button type="button" class="btn btn-danger btn-sm delete_button"
                                                data-toggle="modal" data-target="#DelModal"
                                                data-id="{{ $p->id }}">
                                            <i class='fa fa-times'></i> DELETE
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
            {!! $currency->render() !!}
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
                        <form method="post" action="{{ route('currency_delete') }}" class="form-inline">
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

