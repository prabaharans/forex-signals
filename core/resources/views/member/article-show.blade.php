@extends('layouts.member')
@section('content')


    @if(count($article))

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
                                <th>Article Date</th>
                                <th>Article Title</th>
                                <th>Article Category</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php $i=0; @endphp
                            @foreach($article as $p)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ date('d-F-Y', strtotime($p->created_at)) }}</td>
                                    <td>{{ substr($p->title,0,55) }}{{ strlen($p->title) > 55 ? "..." : ""}} </td>
                                    <td>{{ $p->category->name }} </td>
                                    <td>

                                        <a href="{{ route('user-article-view',$p->id) }}" class="btn green btn-sm"><i class="fa fa-eye"></i> View Article</a>

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
            {!! $article->render() !!}
        </div>
    @else

        <div class="text-center">
            <h3>No Data available</h3>
        </div>
    @endif



@endsection


