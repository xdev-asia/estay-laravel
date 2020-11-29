@extends('layouts.admin')

@section('title')
    <title>{{get_string('create_location') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('create_location')}}</h3>
@endsection
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
        {!! Form::open(['method' => 'post', 'url' => route('admin.taxonomy.location.store'), 'files' => true]) !!}
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
                                                {{Form::text('name['.$language->id.']', null, ['class' => 'form-control', 'placeholder' => get_string('enter_location_name')])}}
                                                {{Form::label('name['.$language->id.']', get_string('location_name'))}}
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
                    <div class="col m8 s6 left left-align mbot0">
                        <div class="form-group">
                            {{Form::number('order', 0, ['class' => 'form-control', 'min' => '0', 'step' => 1, 'placeholder' => get_string('order')])}}
                            {{Form::label('order', get_string('order'))}}
                        </div>
                    </div>
                    <div class="col m4 s6 right right-align mbot0">
                        <div class="form-group">
                            <div class="switch">
                                <label>
                                    {{get_string('standard')}}{{ Form::checkbox('featured', 0, false, ['value' => '0', 'id' => 'activeSwitch', 'class' => 'form-control'])}}<span class="lever"></span>{{get_string('featured')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col m6 c12">
                            <div class="col l12 m12 s12">
                                <div class="input-group {{$errors->has('home_image') ? 'has-error' : ''}}">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary waves-effect">{{get_string('upload_home_image')}} <i class="material-icons small">add_circle</i>
                                            {!! Form::file('home_image', ['id' => 'home_image', 'class' => 'hidden']) !!}
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col m6 c12">
                            <div class="col l12 m12 s12">
                                <div class="input-group {{$errors->has('featured_image') ? 'has-error' : ''}}">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary waves-effect">{{get_string('upload_featured_image')}} <i class="material-icons small">add_circle</i>
                                            {!! Form::file('featured_image', ['id' => 'featured_image', 'class' => 'hidden']) !!}
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <span class="field-info">{{get_string('min_dimension_featured')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col clearfix s12 mtop10">
                <div class="form-group">
                    <button class="btn waves-effect" type="submit" name="action">{{get_string('create_location')}}</button>
                    <a href="{{route('admin.taxonomy.location.index')}}" class="btn waves-effect">{{get_string('location_all')}}</a>
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
             placeholder: '{{get_string('enter_location_content')}}',
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