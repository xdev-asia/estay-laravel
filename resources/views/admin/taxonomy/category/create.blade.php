@extends('layouts.admin')

@section('title')
    <title>{{get_string('create_category') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('create_category')}}</h3>
@endsection
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
        {!! Form::open(['method' => 'post', 'url' => route('admin.taxonomy.category.store'), 'files' => true]) !!}
    <div class="panel">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a href="#content-panel" data-toggle="tab">{{get_string('content')}}</a></li>
                <li class="tab"><a href="#data-panel" data-toggle="tab">{{get_string('data')}}</a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div id="content-panel" class="tab-pane active">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                @foreach($languages as $language)
                                    <li class="tab {{$language->default ? 'active' : ''}}"><a href="#lang{{$language->id}}" data-parent="#content" data-toggle="tab"><img src="{{$language->flag}}"/><span>{{$language->language}}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                @foreach($languages as $language)
                                    <div id="lang{{$language->id}}" class="tab-pane {{$language->default ? 'active' : ''}}">
                                        <div class="col s12">
                                            <div class="form-group  {{$errors->has('name.'.$language->id.'') ? 'has-error' : ''}}">
                                                {{Form::text('name['.$language->id.']', null, ['class' => 'form-control', 'placeholder' => get_string('enter_category_name')])}}
                                                {{Form::label('name['.$language->id.']', get_string('category_name'))}}
                                                @if($errors->has('name.'.$language->id.''))
                                                    <span class="wrong-error">* {{$errors->first('name.'.$language->id.'')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            {{Form::textarea('description['.$language->id.']', null, ['class' => 'hidden desc-content'])}}
                                            @if($errors->has('description.'.$language->id.''))
                                                <span class="wrong-error">{{$errors->first('description.'.$language->id.'')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="data-panel" class="tab-pane">
                    <div class="col s12">
                        <p>*{{get_string('note_for_is')}}</p>
                        <div class="form-group  {{$errors->has('map_icon') ? 'has-error' : ''}}">
                            {{Form::text('map_icon', null, ['class' => 'form-control', 'placeholder' => get_string('map_icon')])}}
                            {{Form::label('map_icon', get_string('map_icon'))}}
                            @if($errors->has('map_icon'))
                                <span class="wrong-error">* {{$errors->first('map_icon')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="form-group">
                            {{Form::number('order', null, ['class' => 'form-control', 'min' => '0', 'step' => 1, 'placeholder' => get_string('order')])}}
                            {{Form::label('order', get_string('order'))}}
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-group {{$errors->has('featured_image') ? 'has-error' : ''}}">
                            <label class="input-group-btn">
                            <span class="btn btn-primary waves-effect">{{get_string('upload_featured_image')}} <i class="material-icons small">add_circle</i>
                                {!! Form::file('featured_image', ['id' => 'featured_image', 'class' => 'hidden']) !!}
                            </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        @if($errors->has('featured_image'))
                            <span class="wrong-error">* {{$errors->first('featured_image')}}</span>
                        @endif
                        <span class="field-info">{{get_string('min_dimension_featured')}}</span>
                    </div>
                </div>
            </div>
            <div class="col clearfix s12 mtop10">
                <div class="form-group">
                    <button class="btn waves-effect" type="submit" name="action">{{get_string('create_category')}}</button>
                    <a href="{{route('admin.taxonomy.category.index')}}" class="btn waves-effect">{{get_string('category_all')}}</a>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $(document).ready(function(){
            $('.desc-content').summernote({
             height: 200,
             maxwidth: false,
             minwidth: false,
             placeholder: '{{get_string('enter_category_content')}}',
             disableDragAndDrop: true,
             toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]]
             ],callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
        });
    </script>
@endsection