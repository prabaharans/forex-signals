@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    {!! Form::model($article,['route'=>['article-update',$article->id],'method'=>'put','class'=>'form-horizontal']) !!}
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Article Category : </b></label>

                            <div class="col-sm-7">
                                <select name="category_id" id="e1" class="form-control input-lg" required>

                                    @foreach($category as $c)
                                        @if($c->id != $article->id)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @else
                                            <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Article Title : </b></label>

                            <div class="col-sm-7">
                                <input name="title" value="{{ $article->title }}" class="form-control input-lg" type="text" required placeholder="Article Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Article Description :</b> </label>

                            <div class="col-sm-7">
                                <textarea name="description" id="" cols="30" rows="10"
                                          class="wysihtml5 form-control input-lg" required placeholder="Article Description">{{ $article->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-7">
                                    <button type="submit" id="btn-submit" class="btn blue btn-block margin-top-10"><i class="fa fa-paper-plane"></i> Update Article</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div><!---ROW-->


@endsection
@section('scripts')

    <link href="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/components-editors.min.js')}}" type="text/javascript"></script>

@endsection

