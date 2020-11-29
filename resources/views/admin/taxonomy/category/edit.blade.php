@extends('layouts.admin')

@section('title')
    <title>{{get_string('edit_category') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('edit_category')}}</h3>
@endsection
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
        {!! Form::open(['method' => 'patch', 'url' => route('admin.taxonomy.category.update', $category->id), 'files' => 'true']) !!}
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
                                                {{Form::text('name['.$language->id.']', $category->content($language->id)->name, ['class' => 'form-control', 'placeholder' => get_string('enter_category_name')])}}
                                                {{Form::label('name['.$language->id.']', get_string('category_name'))}}
                                                @if($errors->has('name.'.$language->id.''))
                                                    <span class="wrong-error">* {{$errors->first('name.'.$language->id.'')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            {{Form::textarea('description['.$language->id.']', $category->content($language->id)->description, ['class' => 'hidden desc-content'])}}
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
                         <div class="form-group  {{$errors->has('alias') ? 'has-error' : ''}}">
                            {{Form::text('alias', $category->alias, ['class' => 'form-control', 'placeholder' => get_string('alias')])}}
                            {{Form::label('alias', get_string('alias'))}}
                            @if($errors->has('alias'))
                                <span class="wrong-error">* {{$errors->first('alias')}}</span>
                            @endif
                         </div>    
                    </div>
                    <div class="col s12">
                        <div class="form-group">
                            {{Form::number('order', $category->order, ['class' => 'form-control', 'min' => '0', 'step' => 1, 'placeholder' => get_string('order')])}}
                            {{Form::label('order', get_string('order'))}}
                        </div>
                    </div>
                    <div class="col s12">
                        <p>*{{get_string('note_for_is')}}</p>
                        <div class="form-group  {{$errors->has('map_icon') ? 'has-error' : ''}}">
                            {{Form::text('map_icon', $category->map_icon, ['class' => 'form-control', 'placeholder' => get_string('map_icon')])}}
                            {{Form::label('map_icon', get_string('map_icon'))}}
                            @if($errors->has('map_icon'))
                                <span class="wrong-error">* {{$errors->first('map_icon')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l8 m8 s8">
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
                    @if($category->featured_image)
                    <div class="col l4 m4 s4">
                        <a href="#!" class="delete-featured-image btn waves-effect btn-red" data-id="{{$category->id}}"><i class="material-icons color-white">delete</i>{{ get_string('delete_image') }}</a>
                    </div>
                        <img id="featured-image" class="img-responsive mtop10" src="{{$category->featured_image}}"/>
                    @endif
                </div>
            </div>
            <div class="col clearfix s12 mtop10">
                <div class="form-group">
                    <button class="btn waves-effect" type="submit" name="action">{{get_string('edit_category')}}</button>
                    <a href="{{route('admin.taxonomy.category.index')}}" class="btn waves-effect">{{get_string('category_all')}}</a>
                    <a href="#!" class="delete-button btn waves-effect btn-red" data-id="{{$category->id}}"><i class="material-icons color-white">delete</i></a>
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

            $('.delete-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var token = $('[name="_token"]').val();
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('delete_confirm')}}',
                    onEscape: true,
                    backdrop: true,
                    buttons: {
                        cancel: {
                            label: '{{get_string('no')}}',
                            className: 'btn waves-effect'
                        },
                        confirm: {
                            label: '{{get_string('yes')}}',
                            className: 'btn waves-effect'
                        }
                    },
                    callback: function (result) {
                        if(result){
                            $.ajax({
                                url: '{{ url('/admin/taxonomy/category/') }}'+id,
                                type: 'post',
                                data: {_method: 'delete', _token :token},
                                success:function(msg) {
                                    window.location = "/admin/taxonomy/category";
                                }
                            });
                        }
                    }
                });
            });

            $('.delete-featured-image').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var token = $('[name="_token"]').val();
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('delete_featured_image')}}',
                    onEscape: true,
                    backdrop: true,
                    buttons: {
                        cancel: {
                            label: '{{get_string('no')}}',
                            className: 'btn waves-effect'
                        },
                        confirm: {
                            label: '{{get_string('yes')}}',
                            className: 'btn waves-effect'
                        }
                    },
                    callback: function (result) {
                        if(result){
                            $.ajax({
                                url: '{{ url('/admin/taxonomy/category/deleteImage') }}/'+id,
                                type: 'post',
                                data: {_token :token},
                                success:function(msg) {
                                    $('#featured-image').remove();
                                    toastr.success(msg);
                                },
                                error:function(msg){
                                    toastr.error(msg.responseJSON);
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection