@extends('layouts.admin')

@section('title')
    <title>{{get_string('style_settings') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('style_settings')}}</h3>
@endsection
<div class="panel col s12">
    <div class="row">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a data-toggle="tab" href="#general_settings">{{get_string('general')}}</a></li>
            </ul>
        </div>
        {!! Form::open(['url' => route('admin_style_settings_update'), 'method' => 'post', 'id' => "style_settings", 'class' => 'table-responsive', 'files' => 'true']) !!}
        <div class="panel-body">
            <div class="tab-content">
                <div id="general_settings" class="tab-pane active">
                    <div class="col s12">
                        <div class="card-panel">
                            <span class="primary-color">*{{get_string('note_for_style')}}</span>
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="form-group  {{$errors->has('primary_color') ? 'has-error' : ''}}">
                            {{Form::text('primary_color', get_setting('primary_color', 'style'), ['class' => 'form-control colorpicker-primary', 'required', 'placeholder' => get_string('primary_color')])}}
                            {{Form::label('primary_color', get_string('primary_color'))}}
                            @if($errors->has('primary_color'))
                                <span class="wrong-error">* {{$errors->first('primary_color')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="form-group  {{$errors->has('primary_color_hover') ? 'has-error' : ''}}">
                            {{Form::text('primary_color_hover', get_setting('primary_color_hover', 'style'), ['class' => 'form-control colorpicker-hover', 'required', 'placeholder' => get_string('primary_color_hover')])}}
                            {{Form::label('primary_color_hover', get_string('primary_color_hover'))}}
                            @if($errors->has('primary_color_hover'))
                                <span class="wrong-error">* {{$errors->first('primary_color_hover')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col clearfix l4 m4 s12 mtop10">
                <div class="form-group">
                    <button class="btn waves-effect" type="submit" name="action">{{get_string('update')}}</button></div>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('footer')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.colorpicker-primary').ColorPicker({
                color: '{{ get_setting('primary_color', 'style') }}',
                onShow: function (colpkr) {
                    $(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function (colpkr) {
                    $(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    $('.colorpicker-primary').val('#'+hex);
                }
            });
            $('.colorpicker-hover').ColorPicker({
                color: '{{ get_setting('primary_color_hover', 'style') }}',
                onShow: function (colpkr) {
                    $(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function (colpkr) {
                    $(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    $('.colorpicker-hover').val('#'+hex);
                }
            });
        });
    </script>

@endsection