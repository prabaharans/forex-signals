@extends('layouts.dashboard')
@section('title', 'All Services')
@section('style')

    <style>

    .col-md-3:hover > .price-table { -webkit-animation-name: swing; -moz-animation-name: swing; -o-animation-name: swing; animation-name: swing; }

    .col-md-4:hover > .price-table { -webkit-animation-name: swing; -moz-animation-name: swing; -o-animation-name: swing; animation-name: swing; }

    .angled { margin:4px auto; position: relative; height: 40px; line-height: 40px; width: 130px; background: #e43a00; color:#FFFFFF; z-index:1001; text-align: center; }
    .angled:before { content:''; line-height: 0; font-size: 0; width: 0; height: 0; border-top: 40px solid #e43a00; border-bottom: 0px solid transparent; border-left: 0px solid transparent; border-right: 40px solid transparent; position: absolute; top: 0; right: -40px; }
    .angled:after { content:''; line-height: 0; font-size: 0; width: 0; height: 0; border-top: 0px solid transparent; border-bottom: 40px solid #e43a00; border-left: 40px solid transparent; border-right: 0px solid #e43a00; position: absolute; top: 0px; left: -40px; }
    .price-table { text-align: center; padding-top: 20px; font-family: Arial, Helvetica, sans-serif; }
    h1.heading { text-align: center; font-weight: bold; }
    .price-table > ul li.price-circle div { width: 120px; height: 120px; -webkit-border-radius: 50%; -moz-border-radius: 50%; -o-border-radius: 50%; border-radius: 50%; margin: 12px auto 0px; background: #fff; padding-top: 30px; transition: all 0.17s ease-in-out; -moz-transition: all 0.17s ease-in-out; -webkit-transition: all 0.17s ease-in-out; -o-transition: all 0.17s ease-in-out; position: relative; }
    .price-table > ul li.price-circle div p { -webkit-font-smoothing: antialiased; line-height: 20px; margin: 0 0 20px; margin: 0; transition: all 0.17s ease-in-out; -moz-transition: all 0.17s ease-in-out; -webkit-transition: all 0.17s ease-in-out; -o-transition: all 0.17s ease-in-out; color: #000; font-weight: bold; }
    .price-table > ul li.price-circle div p span.doller { top: 42px; left: 15px; font-size:16px; position: absolute; top: 40px; }
    .price-table > ul li.price-circle div p span.month { font-size: 15px; }
    .price-table > ul li.price-circle div p span { display: block; font-size:28px; line-height:28px; transition: all 0.17s ease-in-out; -moz-transition: all 0.17s ease-in-out; -webkit-transition: all 0.17s ease-in-out; -o-transition: all 0.17s ease-in-out; }
    .price-table h2 { font-size: 20px; text-transform: uppercase; font-weight: 700; margin: 0 auto 0px auto; font-size: 16px; transition: all 0.17s ease-in-out; -moz-transition: all 0.17s ease-in-out; -webkit-transition: all 0.17s ease-in-out; -o-transition: all 0.17s ease-in-out; width: 100%; border-top: 5px solid #e43a00; }
    .price-table > ul { margin: 0; padding: 0; }
    .price-table > ul li { list-style: none; }
    .price-table > ul li.price-circle { padding-top: 8px; padding-bottom: 20px; background: #e43a00; }
    .price-table > ul li p { font-size: 14px; color: #08c0b4; font-weight: 300; -webkit-font-smoothing: antialiased; line-height: 24px; margin: 0 0 20px; padding: 0 20px; margin: 0; }
    .price-table > ul li ul.description-range { margin: 0; padding: 0; margin-bottom: 0px; overflow: hidden; }
    .price-table > ul li ul.description-range li.gray { background: #f4f4f4; }
    .price-table > ul li ul.description-range li { padding: 6px 0 6px 0; border-top: 1px solid #fff; border-bottom: 1px solid #d2d2d2; text-shadow: 0 1px rgba(255, 255, 255, 0.9); }
    .price-table > ul li ul.description-range li p { color: #666; }
    .price-table > ul li ul.description-range li p span { font-weight: 600; }
    .price-table > ul li ul.description-range.dark { background: #525150; }
    .price-table > ul li ul.description-range.dark li { border-top: 1px solid #3e3d3d; border-bottom: 1px solid #555454; text-shadow: 0 0px rgba(255, 255, 255, 0.9); }
    .price-table > ul li ul.description-range.dark li p { color: #d0d0d0; }
    .price-table > ul li ul.description-range.dark li p span { font-weight: normal; }
    .price-table > ul li.buy-button { padding-bottom: 12px; padding-top: 12px; background: #000; }
    .price-table > ul li.buy-button a { color: #fff; text-transform: uppercase; font-weight: bold; font-size: 12px; }
    .price-table.orange > ul li.buy-button { background:#3FC35F; }
    .price-table:hover > ul li.buy-button a { text-decoration: none; }
    .price-table:hover h2 { color: #e43a00; }
    .price-table:hover > ul li.price-circle div { background: #f7470b; }
    .price-table:hover > ul li.price-circle div p { color: #ffffff; }
    .no-space .col-xs-1, .no-space .col-sm-1, .no-space .col-md-1, .no-space .col-lg-1, .no-space .col-xs-2, .no-space .col-sm-2, .no-space .col-md-2, .no-space .col-lg-2, .no-space .col-xs-3, .no-space .col-sm-3, .no-space .col-md-3, .no-space .col-lg-3, .no-space .col-xs-4, .no-space .col-sm-4, .no-space .col-md-4, .no-space .col-lg-4, .no-space .col-xs-5, .no-space .col-sm-5, .no-space .col-md-5, .no-space .col-lg-5, .no-space .col-xs-6, .no-space .col-sm-6, .no-space .col-md-6, .no-space .col-lg-6, .no-space .col-xs-7, .no-space .col-sm-7, .no-space .col-md-7, .no-space .col-lg-7, .no-space .col-xs-8, .no-space .col-sm-8, .no-space .col-md-8, .no-space .col-lg-8, .no-space .col-xs-9, .no-space .col-sm-9, .no-space .col-md-9, .no-space .col-lg-9, .no-space .col-xs-10, .no-space .col-sm-10, .no-space .col-md-10, .no-space .col-lg-10, .no-space .col-xs-11, .no-space .col-sm-11, .no-space .col-md-11, .no-space .col-lg-11, .no-space .col-xs-12, .no-space .col-sm-12, .no-space .col-md-12, .no-space .col-lg-12 { min-height: 1px; padding-left: 0px; padding-right: 0px; position: relative; }
    .price-table.orange > ul li.price-circle { background: #3FC35F; }
    .price-table.orange h2 { border-top: 5px solid #3FC35F; }
    .price-table.orange:hover h2 { color: #3FC35F; }
    .price-table.orange:hover > ul li.price-circle div { background:#2BA94A; }
    .price-table.orange:hover > ul li.price-circle div p { color: #ffffff; }
    .price-table.orange:hover > ul li.buy-button a { text-decoration: none; }
    .price-table.orange .angled { background:#3FC35F; }
    .price-table.orange .angled:before { border-top: 40px solid #3FC35F; }
    .price-table.orange .angled:after { border-bottom: 40px solid #3FC35F; }
    .price-table.black > ul li.price-circle { background: #303030; }
    .price-table.black h2 { border-top: 5px solid #303030; }
    .price-table.black:hover h2 { color: #303030; }
    .price-table.black:hover > ul li.price-circle div { background: #505151; }
    .price-table.black:hover > ul li.price-circle div p { color: #ffffff; }
    .price-table.black:hover > ul li.buy-button a { text-decoration: none; }
    .price-table.black .angled { background: #303030; }
    .price-table.black .angled:before { border-top: 40px solid #303030; }
    .price-table.black .angled:after { border-bottom: 40px solid #303030; }

    </style>
@endsection
@section('content')


    @if(count($service))

        <div class="row">
            <div class="col-md-12">


                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            @foreach($service as $p)
                            <!--********************plan1 ********************-->
                            <div class="col-md-4 col-sm-6">
                                <div class="price-table orange animated zoomIn">
                                    <ul>
                                        <li>
                                            <h2>
                                                <div class="angled">{{ $p->name }}</div>
                                            </h2>
                                        </li>
                                        <li class="price-circle">
                                            <div>
                                                <p><span class="doller">{{ $p->currency->name }}</span><span style="padding-left: 10px;">{{ $p->price }}</span><span class="month">monthly</span></p>
                                            </div>
                                        </li>
                                        <li>
                                            <ul class="description-range">

                                                <li>
                                                    <p>{{ $p->description1 }}</p>
                                                </li>
                                                <li>
                                                    <p>{{ $p->description2 }}</p>
                                                </li>
                                                <li>
                                                    <p>{{ $p->description3 }}</p>
                                                </li>
                                                <li>
                                                    <p>{{ $p->description4 }}</p>
                                                </li>
                                                <li>
                                                    <p>{{ $p->description5 }}</p>
                                                </li>
                                                <li>
                                                    <p>{{ $p->description6 }}</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        @if($p->description7 != null)
                                                            {{ $p->description7 }}
                                                        @else
                                                            {{ "-"}}
                                                        @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    <p>
                                                        @if($p->description8 != null)
                                                            {{ $p->description8 }}
                                                        @else
                                                            {{ "-"}}
                                                        @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    <p>
                                                        @if($p->description9 != null)
                                                            {{ $p->description9 }}
                                                        @else
                                                            {{ "-"}}
                                                        @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    <p>
                                                        @if($p->description10 != null)
                                                            {{ $p->description10 }}
                                                        @else
                                                            {{ "-"}}
                                                        @endif
                                                    </p>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="buy-button">
                                            <a href="{{ route('service-edit',$p->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm delete_button"
                                                    data-toggle="modal" data-target="#DelModal"
                                                    data-id="{{ $p->id }}">
                                                <i class='fa fa-times'></i> DELETE
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                                @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div><!-- ROW-->


        <div class="text-center">
            {!! $service->render() !!}
        </div>
    @else

        <div class="text-center">
            <h3>No Service Available</h3>
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

                    <form method="post" action="{{ route('service-delete') }}" class="form-inline">
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

