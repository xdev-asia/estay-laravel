@extends('layouts.admin')

@section('title')
    <title>{{get_string('design_settings') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('design_settings')}}</h3>
@endsection
<div class="panel col s12">
    <div class="row">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a data-toggle="tab" href="#general_settings">{{get_string('general')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#home_settings">{{get_string('home')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#strings">{{get_string('string')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#footer_settings">{{get_string('footer')}}</a></li>
            </ul>
        </div>
        {!! Form::open(['url' => route('admin_design_settings_update'), 'method' => 'post', 'id' => "design_settings", 'class' => 'table-responsive', 'files' => 'true']) !!}
        <div class="panel-body">
            <div class="tab-content">
                <div id="general_settings" class="tab-pane active">
                    <div class="col m6 s12">
                        <div class="form-group  {{$errors->has('show_social_top_bar') ? 'has-error' : ''}}">
                            {{Form::select('show_social_top_bar', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_social_top_bar', 'design'), ['class' => 'form-control'])}}
                            {{Form::label('show_social_top_bar', get_string('show_social_top_bar'))}}
                            @if($errors->has('show_social_top_bar'))
                                <span class="wrong-error">* {{$errors->first('show_social_top_bar')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="form-group  {{$errors->has('allow_add_property_button') ? 'has-error' : ''}}">
                            {{Form::select('allow_add_property_button', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('allow_add_property_button', 'design'), ['class' => 'form-control'])}}
                            {{Form::label('allow_add_property_button', get_string('allow_add_property_button'))}}
                            @if($errors->has('allow_add_property_button'))
                                <span class="wrong-error">* {{$errors->first('allow_add_property_button')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="home_settings" class="tab-pane">
                    <div class="col s12 mbot20">
                        <div class="input-group clearfix {{$errors->has('slider_background') ? 'has-error' : ''}}">
                            <label class="input-group-btn">
                                <span class="btn btn-primary waves-effect">{{get_string('upload')}}
                                    {!! Form::file('files[slider_background]', ['class' => 'hidden']) !!}
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <div class="field-info">{{ get_string('slider_background') }}{{get_setting('slider_background', 'design')}}</div>
                    </div>
                    <div class="col l4 m4 s6">
                        <div class="form-group  {{$errors->has('show_featured_locations') ? 'has-error' : ''}}">
                            {{Form::select('show_featured_locations', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_featured_locations', 'design'), ['class' => 'form-control'])}}
                            {{Form::label('show_featured_locations', get_string('show_featured_locations'))}}
                            @if($errors->has('show_featured_locations'))
                                <span class="wrong-error">* {{$errors->first('show_featured_locations')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l4 m4 s6">
                        <div class="form-group  {{$errors->has('show_featured_properties') ? 'has-error' : ''}}">
                            {{Form::select('show_featured_properties', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_featured_properties', 'design'), ['class' => 'form-control'])}}
                            {{Form::label('show_featured_properties', get_string('show_featured_properties'))}}
                            @if($errors->has('show_featured_properties'))
                                <span class="wrong-error">* {{$errors->first('show_featured_properties')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l4 m4 s6">
                        <div class="form-group  {{$errors->has('show_quick_boxes') ? 'has-error' : ''}}">
                            {{Form::select('show_quick_boxes', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_quick_boxes', 'design'), ['class' => 'form-control'])}}
                            {{Form::label('show_quick_boxes', get_string('show_quick_boxes'))}}
                            @if($errors->has('show_quick_boxes'))
                                <span class="wrong-error">* {{$errors->first('show_quick_boxes')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l4 m4 s6">
                        <div class="form-group  {{$errors->has('show_blog_section') ? 'has-error' : ''}}">
                            {{Form::select('show_blog_section', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_blog_section', 'design'), ['class' => 'form-control'])}}
                            {{Form::label('show_blog_section', get_string('show_blog_section'))}}
                            @if($errors->has('show_blog_section'))
                                <span class="wrong-error">* {{$errors->first('show_blog_section')}}</span>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="col l4 m4 s6">
                        <div class="form-group  {{$errors->has('show_icons_section') ? 'has-error' : ''}}">
                            {{Form::select('show_icons_section', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_icons_section', 'design'), ['class' => 'form-control'])}}
                            {{Form::label('show_icons_section', get_string('show_icons_section'))}}
                            @if($errors->has('show_icons_section'))
                                <span class="wrong-error">* {{$errors->first('show_icons_section')}}</span>
                            @endif
                        </div>
                    </div> -->
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header">
                                <span>{{get_string('featured_properties_section')}}</span>
                                <i class="material-icons small accordion-active">remove_circle</i>
                                <i class="material-icons small accordion-disabled">add_circle</i>
                                <i class="material-icons small color-red hidden">report_problem</i>
                            </div>
                            <div class="collapsible-body">
                                @if(get_setting('show_featured_properties', 'design'))
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="col m6 s12">
                                                <div class="form-group  {{$errors->has('fp_properties_count') ? 'has-error' : ''}}">
                                                    {{Form::text('fp_properties_count', get_setting('fp_properties_count', 'design'), ['class' => 'form-control', 'placeholder' => get_string('fp_properties_count')])}}
                                                    {{Form::label('fp_properties_count', get_string('fp_properties_count'))}}
                                                    @if($errors->has('fp_properties_count'))
                                                        <span class="wrong-error">* {{$errors->first('fp_properties_count')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col m6 s12">
                                                <div class="form-group  {{$errors->has('fp_show_featured_only') ? 'has-error' : ''}}">
                                                    {{Form::select('fp_show_featured_only', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('fp_show_featured_only', 'design'), ['class' => 'form-control'])}}
                                                    {{Form::label('fp_show_featured_only', get_string('fp_show_featured_only'))}}
                                                    @if($errors->has('fp_show_featured_only'))
                                                        <span class="wrong-error">* {{$errors->first('fp_show_featured_only')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span>{{ get_string('enable_this_section_first') }}</span>
                                @endif
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                <span>{{get_string('quick_boxes_section')}}</span>
                                <i class="material-icons small accordion-active">remove_circle</i>
                                <i class="material-icons small accordion-disabled">add_circle</i>
                                <i class="material-icons small color-red hidden">report_problem</i>
                            </div>
                            <div class="collapsible-body">
                                @if(get_setting('show_quick_boxes', 'design'))
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="col s12 mbot20">
                                                <div class="input-group clearfix {{$errors->has('qs_background') ? 'has-error' : ''}}">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-primary waves-effect">{{get_string('upload')}}
                                                            {!! Form::file('files[qs_background]', ['class' => 'hidden']) !!}
                                                        </span>
                                                    </label>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                                <div class="field-info">{{ get_string('qs_background') }}{{get_setting('qs_background', 'design')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span>{{ get_string('enable_this_section_first') }}</span>
                                @endif
                            </div>
                        </li>
                        <!-- <li>
                            <div class="collapsible-header">
                                <span>{{get_string('icons_section')}}</span>
                                <i class="material-icons small accordion-active">remove_circle</i>
                                <i class="material-icons small accordion-disabled">add_circle</i>
                                <i class="material-icons small color-red hidden">report_problem</i>
                            </div>
                            <div class="collapsible-body">
                                @if(get_setting('show_icons_section', 'design'))
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="card-panel">
                                                <span class="primary-color">*{{get_string('note_for_is')}}</span>
                                            </div>
                                        </div>
                                        <div class="col m6 s12">
                                            <div class="form-group  {{$errors->has('is_icon1_head') ? 'has-error' : ''}}">
                                                {{Form::text('is_icon1_head', get_setting('is_icon1_head', 'design'), ['class' => 'form-control', 'placeholder' => '1 '.get_string('is_icon_head')])}}
                                                {{Form::label('is_icon1_head', '1 '.get_string('is_icon_head'))}}
                                                @if($errors->has('is_icon1_head'))
                                                    <span class="wrong-error">* {{$errors->first('is_icon1_head')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group  {{$errors->has('is_icon1_text') ? 'has-error' : ''}}">
                                                {{Form::text('is_icon1_text', get_setting('is_icon1_text', 'design'), ['class' => 'form-control', 'placeholder' => '1 '.get_string('is_icon_text')])}}
                                                {{Form::label('is_icon1_text', '1 '.get_string('is_icon_text'))}}
                                                @if($errors->has('is_icon1_text'))
                                                    <span class="wrong-error">* {{$errors->first('is_icon1_text')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group  {{$errors->has('is_icon1_icon') ? 'has-error' : ''}}">
                                                {{Form::text('is_icon1_icon', get_setting('is_icon1_icon', 'design'), ['class' => 'form-control', 'placeholder' => '1 '.get_string('is_icon_icon')])}}
                                                {{Form::label('is_icon1_icon', '1 '.get_string('is_icon_icon'))}}
                                                @if($errors->has('is_icon1_icon'))
                                                    <span class="wrong-error">* {{$errors->first('is_icon1_icon')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col m6 s12">
                                            <div class="form-group  {{$errors->has('is_icon2_head') ? 'has-error' : ''}}">
                                                {{Form::text('is_icon2_head', get_setting('is_icon2_head', 'design'), ['class' => 'form-control', 'placeholder' => '2 '.get_string('is_icon_head')])}}
                                                {{Form::label('is_icon2_head', '2 '.get_string('is_icon_head'))}}
                                                @if($errors->has('is_icon2_head'))
                                                    <span class="wrong-error">* {{$errors->first('is_icon2_head')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group  {{$errors->has('is_icon2_text') ? 'has-error' : ''}}">
                                                {{Form::text('is_icon2_text', get_setting('is_icon2_text', 'design'), ['class' => 'form-control', 'placeholder' => '2 '.get_string('is_icon_text')])}}
                                                {{Form::label('is_icon2_text', '2 '.get_string('is_icon_text'))}}
                                                @if($errors->has('is_icon2_text'))
                                                    <span class="wrong-error">* {{$errors->first('is_icon2_text')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group  {{$errors->has('is_icon2_icon') ? 'has-error' : ''}}">
                                                {{Form::text('is_icon2_icon', get_setting('is_icon2_icon', 'design'), ['class' => 'form-control', 'placeholder' => '2 '.get_string('is_icon_icon')])}}
                                                {{Form::label('is_icon2_icon', '2 '.get_string('is_icon_icon'))}}
                                                @if($errors->has('is_icon2_icon'))
                                                    <span class="wrong-error">* {{$errors->first('is_icon2_icon')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col m6 s12 mtop20">
                                            <div class="form-group  {{$errors->has('is_icon3_head') ? 'has-error' : ''}}">
                                                {{Form::text('is_icon3_head', get_setting('is_icon3_head', 'design'), ['class' => 'form-control', 'placeholder' => '3 '.get_string('is_icon_head')])}}
                                                {{Form::label('is_icon3_head', '3 '.get_string('is_icon_head'))}}
                                                @if($errors->has('is_icon3_head'))
                                                    <span class="wrong-error">* {{$errors->first('is_icon3_head')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group  {{$errors->has('is_icon3_text') ? 'has-error' : ''}}">
                                                {{Form::text('is_icon3_text', get_setting('is_icon3_text', 'design'), ['class' => 'form-control', 'placeholder' => '3 '.get_string('is_icon_text')])}}
                                                {{Form::label('is_icon3_text', '3 '.get_string('is_icon_text'))}}
                                                @if($errors->has('is_icon3_text'))
                                                    <span class="wrong-error">* {{$errors->first('is_icon3_text')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group  {{$errors->has('is_icon3_icon') ? 'has-error' : ''}}">
                                                {{Form::text('is_icon3_icon', get_setting('is_icon3_icon', 'design'), ['class' => 'form-control', 'placeholder' => '3 '.get_string('is_icon_icon')])}}
                                                {{Form::label('is_icon3_icon', '3 '.get_string('is_icon_icon'))}}
                                                @if($errors->has('is_icon3_icon'))
                                                    <span class="wrong-error">* {{$errors->first('is_icon3_icon')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span>{{ get_string('enable_this_section_first') }}</span>
                                @endif
                            </div>
                        </li> -->
                    </ul>
                </div>
                <div id="strings" class="tab-pane">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            @foreach($languages as $language)
                                <li class="tab {{$language->default ? 'active' : ''}}"><a href="#lang{{$language->id}}" data-toggle="tab"><img src="{{$language->flag}}"/><span>{{$language->language}}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            @foreach($languages as $language)
                                <div id="lang{{$language->id}}" class="tab-pane {{$language->default ? 'active' : ''}}">
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('welcome_text') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_site_description][' . $language->code .']' , get_opt_string('opt_site_description', $language->code), ['class' => 'form-control', 'placeholder' => get_string('site_description')])}}
                                            {{Form::label('opt_site_description', get_string('site_description'))}}
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('welcome_text') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_welcome_text][' . $language->code .']' , get_opt_string('opt_welcome_text', $language->code), ['class' => 'form-control', 'placeholder' => get_string('welcome_text')])}}
                                            {{Form::label('welcome_text', get_string('welcome_text'))}}
                                        </div>
                                    </div>
                                    <div class="col l6 m6 s12 clearfix">
                                        <div class="form-group  {{$errors->has('slider_heading') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_slider_heading][' . $language->code .']', get_opt_string('opt_slider_heading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('slider_heading')])}}
                                            {{Form::label('slider_heading', get_string('slider_heading'))}}
                                            @if($errors->has('slider_heading'))
                                                <span class="wrong-error">* {{$errors->first('slider_heading')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l6 m6 s12">
                                        <div class="form-group  {{$errors->has('slider_subheading') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_slider_subheading][' . $language->code .']', get_opt_string('opt_slider_subheading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('slider_subheading')])}}
                                            {{Form::label('slider_subheading', get_string('slider_subheading'))}}
                                            @if($errors->has('slider_subheading'))
                                                <span class="wrong-error">* {{$errors->first('slider_subheading')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <div class="form-group  {{$errors->has('fl_heading') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_fl_heading][' . $language->code .']', get_opt_string('opt_fl_heading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('fl_heading')])}}
                                            {{Form::label('strings[opt_fl_heading', get_string('fl_heading'))}}
                                            @if($errors->has('fl_heading'))
                                                <span class="wrong-error">* {{$errors->first('fl_heading')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('fl_subheading') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_fl_subheading][' . $language->code .']', get_opt_string('opt_fl_subheading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('fl_subheading')])}}
                                            {{Form::label('strings[opt_fl_subheading', get_string('fl_subheading'))}}
                                            @if($errors->has('fl_subheading'))
                                                <span class="wrong-error">* {{$errors->first('fl_subheading')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <div class="form-group  {{$errors->has('fp_heading') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_fp_heading][' . $language->code .']', get_opt_string('opt_fp_heading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('fp_heading')])}}
                                            {{Form::label('strings[opt_fp_heading][' . $language->code .']', get_string('fp_heading'))}}
                                            @if($errors->has('fp_heading'))
                                                <span class="wrong-error">* {{$errors->first('fp_heading')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('fp_subheading') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_fp_subheading][' . $language->code .']', get_opt_string('opt_fp_subheading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('fp_subheading')])}}
                                            {{Form::label('strings[opt_fp_subheading][' . $language->code .']', get_string('fp_subheading'))}}
                                            @if($errors->has('fp_subheading'))
                                                <span class="wrong-error">* {{$errors->first('fp_subheading')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <div class="form-group  {{$errors->has('qs_heading') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_heading][' . $language->code .']', get_opt_string('opt_qs_heading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('qs_heading')])}}
                                            {{Form::label('strings[opt_qs_heading][' . $language->code .']', get_string('qs_heading'))}}
                                            @if($errors->has('qs_heading'))
                                                <span class="wrong-error">* {{$errors->first('qs_heading')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('qs_subheading') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_subheading][' . $language->code .']', get_opt_string('opt_qs_subheading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('qs_subheading')])}}
                                            {{Form::label('strings[opt_qs_subheading][' . $language->code .']', get_string('qs_subheading'))}}
                                            @if($errors->has('qs_subheading'))
                                                <span class="wrong-error">* {{$errors->first('qs_subheading')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <div class="form-group  {{$errors->has('qs_box1_head') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_box1_head][' . $language->code .']', get_opt_string('opt_qs_box1_head', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('qs_box_head')])}}
                                            {{Form::label('strings[opt_qs_box1_head][' . $language->code .']', '1 '.get_string('qs_box_head'))}}
                                            @if($errors->has('qs_box1_head'))
                                                <span class="wrong-error">* {{$errors->first('qs_box1_head')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('qs_box1_sub') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_box1_sub][' . $language->code .']', get_opt_string('opt_qs_box1_sub', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('qs_box_sub')])}}
                                            {{Form::label('strings[opt_qs_box1_sub][' . $language->code .']', '1 '.get_string('qs_box_sub'))}}
                                            @if($errors->has('qs_box1_sub'))
                                                <span class="wrong-error">* {{$errors->first('qs_box1_sub')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('qs_box1_text') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_box1_text][' . $language->code .']', get_opt_string('opt_qs_box1_text', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('qs_box_text')])}}
                                            {{Form::label('strings[opt_qs_box1_text][' . $language->code .']', '1 '.get_string('qs_box_text'))}}
                                            @if($errors->has('qs_box1_text'))
                                                <span class="wrong-error">* {{$errors->first('qs_box1_text')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('qs_box1_head') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_box2_head][' . $language->code .']', get_opt_string('opt_qs_box2_head', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('qs_box_head')])}}
                                            {{Form::label('strings[opt_qs_box2_head][' . $language->code .']', '2 '.get_string('qs_box_head'))}}
                                            @if($errors->has('qs_box1_head'))
                                                <span class="wrong-error">* {{$errors->first('qs_box1_head')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('qs_box1_sub') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_box2_sub][' . $language->code .']', get_opt_string('opt_qs_box2_sub', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('qs_box_sub')])}}
                                            {{Form::label('strings[opt_qs_box2_sub][' . $language->code .']', '2 '.get_string('qs_box_sub'))}}
                                            @if($errors->has('qs_box1_sub'))
                                                <span class="wrong-error">* {{$errors->first('qs_box1_sub')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('qs_box1_text') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_box2_text][' . $language->code .']', get_opt_string('opt_qs_box2_text', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('qs_box_text')])}}
                                            {{Form::label('strings[opt_qs_box2_text][' . $language->code .']', '2 '.get_string('qs_box_text'))}}
                                            @if($errors->has('qs_box1_text'))
                                                <span class="wrong-error">* {{$errors->first('qs_box1_text')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('qs_box1_head') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_box3_head][' . $language->code .']', get_opt_string('opt_qs_box3_head', $language->code), ['class' => 'form-control', 'placeholder' => '3 '.get_string('qs_box_head')])}}
                                            {{Form::label('strings[opt_qs_box3_head][' . $language->code .']', '3 '.get_string('qs_box_head'))}}
                                            @if($errors->has('qs_box1_head'))
                                                <span class="wrong-error">* {{$errors->first('qs_box1_head')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('qs_box1_sub') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_box3_sub][' . $language->code .']', get_opt_string('opt_qs_box3_sub', $language->code), ['class' => 'form-control', 'placeholder' => '3 '.get_string('qs_box_sub')])}}
                                            {{Form::label('strings[opt_qs_box3_sub][' . $language->code .']', '3 '.get_string('qs_box_sub'))}}
                                            @if($errors->has('qs_box1_sub'))
                                                <span class="wrong-error">* {{$errors->first('qs_box1_sub')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('qs_box1_text') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_qs_box3_text][' . $language->code .']', get_opt_string('opt_qs_box3_text', $language->code), ['class' => 'form-control', 'placeholder' => '3 '.get_string('qs_box_text')])}}
                                            {{Form::label('strings[opt_qs_box3_text][' . $language->code .']', '3 '.get_string('qs_box_text'))}}
                                            @if($errors->has('qs_box1_text'))
                                                <span class="wrong-error">* {{$errors->first('qs_box1_text')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <div class="form-group  {{$errors->has('lb_heading') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_lb_heading][' . $language->code .']', get_opt_string('opt_lb_heading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('lb_heading')])}}
                                            {{Form::label('strings[opt_lb_heading][' . $language->code .']', get_string('lb_heading'))}}
                                            @if($errors->has('lb_heading'))
                                                <span class="wrong-error">* {{$errors->first('lb_heading')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  {{$errors->has('lb_subheading') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_lb_subheading][' . $language->code .']', get_opt_string('opt_lb_subheading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('lb_subheading')])}}
                                            {{Form::label('strings[opt_lb_subheading][' . $language->code .']', get_string('lb_subheading'))}}
                                            @if($errors->has('lb_subheading'))
                                                <span class="wrong-error">* {{$errors->first('lb_subheading')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <h5 class="section-title">{{'2 '.get_string('footer_menu')}}</h5>
                                        <div class="form-group  {{$errors->has('footer_menu1_head') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu1_head][' . $language->code .']', get_opt_string('opt_footer_menu1_head', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('footer_menu_head')])}}
                                            {{Form::label('footer_menu1_head', '2 '.get_string('footer_menu_head'))}}
                                            @if($errors->has('footer_menu1_head'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu1_head')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  {{$errors->has('footer_menu_text1') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu1_text1][' . $language->code .']', get_opt_string('opt_footer_menu1_text1', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('text')])}}
                                            {{Form::label('footer_menu1_text1', '1 '.get_string('text'))}}
                                            @if($errors->has('footer_menu1_text1'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu1_text1')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  {{$errors->has('footer_menu_text1') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu1_text2][' . $language->code .']', get_opt_string('opt_footer_menu1_text2', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('text')])}}
                                            {{Form::label('footer_menu1_text1', '2 '.get_string('text'))}}
                                            @if($errors->has('footer_menu1_text1'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu1_text1')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  {{$errors->has('footer_menu_text1') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu1_text3][' . $language->code .']', get_opt_string('opt_footer_menu1_text3', $language->code), ['class' => 'form-control', 'placeholder' => '3 '.get_string('text')])}}
                                            {{Form::label('footer_menu1_text1', '3 '.get_string('text'))}}
                                            @if($errors->has('footer_menu1_text1'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu1_text1')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  {{$errors->has('footer_menu_text1') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu1_text4][' . $language->code .']', get_opt_string('opt_footer_menu1_text4', $language->code), ['class' => 'form-control', 'placeholder' => '4 '.get_string('text')])}}
                                            {{Form::label('footer_menu1_text1', '4 '.get_string('text'))}}
                                            @if($errors->has('footer_menu1_text1'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu1_text1')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  {{$errors->has('footer_menu_text1') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu1_text5][' . $language->code .']', get_opt_string('opt_footer_menu1_text5', $language->code), ['class' => 'form-control', 'placeholder' => '5 '.get_string('text')])}}
                                            {{Form::label('footer_menu1_text1', '5 '.get_string('text'))}}
                                            @if($errors->has('footer_menu1_text1'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu1_text1')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <h5 class="section-title">{{'3 '.get_string('footer_menu')}}</h5>
                                        <div class="form-group  {{$errors->has('footer_menu1_head') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu2_head][' . $language->code .']', get_opt_string('opt_footer_menu2_head', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('footer_menu_head')])}}
                                            {{Form::label('footer_menu1_head', '3 '.get_string('footer_menu_head'))}}
                                            @if($errors->has('footer_menu1_head'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu1_head')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  {{$errors->has('footer_menu_text1') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu2_text1][' . $language->code .']', get_opt_string('opt_footer_menu2_text1', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('text')])}}
                                            {{Form::label('footer_menu2_text1', '1 '.get_string('text'))}}
                                            @if($errors->has('footer_menu2_text1'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu2_text1')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  {{$errors->has('footer_menu_text1') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu2_text2][' . $language->code .']', get_opt_string('opt_footer_menu2_text2', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('text')])}}
                                            {{Form::label('footer_menu2_text1', '2 '.get_string('text'))}}
                                            @if($errors->has('footer_menu2_text1'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu2_text1')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  {{$errors->has('footer_menu_text1') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu2_text3][' . $language->code .']', get_opt_string('opt_footer_menu2_text3', $language->code), ['class' => 'form-control', 'placeholder' => '3 '.get_string('text')])}}
                                            {{Form::label('footer_menu2_text1', '3 '.get_string('text'))}}
                                            @if($errors->has('footer_menu2_text1'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu2_text1')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  {{$errors->has('footer_menu_text1') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu2_text4][' . $language->code .']', get_opt_string('opt_footer_menu2_text4', $language->code), ['class' => 'form-control', 'placeholder' => '4 '.get_string('text')])}}
                                            {{Form::label('footer_menu2_text1', '4 '.get_string('text'))}}
                                            @if($errors->has('footer_menu2_text1'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu2_text1')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  {{$errors->has('footer_menu_text1') ? 'has-error' : ''}}">
                                            {{Form::text('strings[opt_footer_menu2_text5][' . $language->code .']', get_opt_string('opt_footer_menu2_text5', $language->code), ['class' => 'form-control', 'placeholder' => '5 '.get_string('text')])}}
                                            {{Form::label('footer_menu2_text1', '5 '.get_string('text'))}}
                                            @if($errors->has('footer_menu2_text1'))
                                                <span class="wrong-error">* {{$errors->first('footer_menu2_text1')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="footer_settings" class="tab-pane">
                    <div class="col m6 s12">
                        <div class="form-group  {{$errors->has('footer_social') ? 'has-error' : ''}}">
                            {{Form::select('footer_social', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('footer_social', 'design'), ['class' => 'form-control'])}}
                            {{Form::label('footer_social', get_string('footer_social'))}}
                            @if($errors->has('footer_social'))
                                <span class="wrong-error">* {{$errors->first('footer_social')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s12 mtop20 clearfix">
                        <h5 class="section-title">{{'2 '.get_string('footer_menu')}}</h5>
                        <div class="form-group  {{$errors->has('footer_menu_link1') ? 'has-error' : ''}}">
                            {{Form::text('footer_menu1_link1', get_setting('footer_menu1_link1', 'design'), ['class' => 'form-control', 'placeholder' => '1 '.get_string('link')])}}
                            {{Form::label('footer_menu1_link1', '1 '.get_string('link'))}}
                            @if($errors->has('footer_menu1_link1'))
                                <span class="wrong-error">* {{$errors->first('footer_menu1_link')}}</span>
                            @endif
                        </div>
                        <div class="form-group  {{$errors->has('footer_menu_link2') ? 'has-error' : ''}}">
                            {{Form::text('footer_menu1_link2', get_setting('footer_menu1_link2', 'design'), ['class' => 'form-control', 'placeholder' => '2 '.get_string('link')])}}
                            {{Form::label('footer_menu1_link2', '2 '.get_string('link'))}}
                            @if($errors->has('footer_menu1_link2'))
                                <span class="wrong-error">* {{$errors->first('footer_menu1_link2')}}</span>
                            @endif
                        </div>
                        <div class="form-group  {{$errors->has('footer_menu_link3') ? 'has-error' : ''}}">
                            {{Form::text('footer_menu1_link3', get_setting('footer_menu1_link3', 'design'), ['class' => 'form-control', 'placeholder' => '3 '.get_string('link')])}}
                            {{Form::label('footer_menu1_link3', '3 '.get_string('link'))}}
                            @if($errors->has('footer_menu1_link3'))
                                <span class="wrong-error">* {{$errors->first('footer_menu1_link3')}}</span>
                            @endif
                        </div>
                        <div class="form-group  {{$errors->has('footer_menu_link4') ? 'has-error' : ''}}">
                            {{Form::text('footer_menu1_link4', get_setting('footer_menu1_link4', 'design'), ['class' => 'form-control', 'placeholder' => '4 '.get_string('link')])}}
                            {{Form::label('footer_menu1_link4', '4 '.get_string('link'))}}
                            @if($errors->has('footer_menu1_link4'))
                                <span class="wrong-error">* {{$errors->first('footer_menu1_link4')}}</span>
                            @endif
                        </div>
                        <div class="form-group  {{$errors->has('footer_menu_link5') ? 'has-error' : ''}}">
                            {{Form::text('footer_menu1_link5', get_setting('footer_menu1_link5', 'design'), ['class' => 'form-control', 'placeholder' => '5 '.get_string('link')])}}
                            {{Form::label('footer_menu1_link5', '5 '.get_string('link'))}}
                            @if($errors->has('footer_menu1_link5'))
                                <span class="wrong-error">* {{$errors->first('footer_menu1_link5')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s12 mtop20">
                        <h5 class="section-title">{{'3 '.get_string('footer_menu')}}</h5>
                        <div class="form-group  {{$errors->has('footer_menu_link1') ? 'has-error' : ''}}">
                            {{Form::text('footer_menu2_link1', get_setting('footer_menu2_link1', 'design'), ['class' => 'form-control', 'placeholder' => '1 '.get_string('link')])}}
                            {{Form::label('footer_menu2_link1', '1 '.get_string('link'))}}
                            @if($errors->has('footer_menu2_link1'))
                                <span class="wrong-error">* {{$errors->first('footer_menu2_link')}}</span>
                            @endif
                        </div>
                        <div class="form-group  {{$errors->has('footer_menu_link2') ? 'has-error' : ''}}">
                            {{Form::text('footer_menu2_link2', get_setting('footer_menu2_link2', 'design'), ['class' => 'form-control', 'placeholder' => '2 '.get_string('link')])}}
                            {{Form::label('footer_menu2_link2', '2 '.get_string('link'))}}
                            @if($errors->has('footer_menu2_link2'))
                                <span class="wrong-error">* {{$errors->first('footer_menu2_link2')}}</span>
                            @endif
                        </div>
                        <div class="form-group  {{$errors->has('footer_menu_link3') ? 'has-error' : ''}}">
                            {{Form::text('footer_menu2_link3', get_setting('footer_menu2_link3', 'design'), ['class' => 'form-control', 'placeholder' => '3 '.get_string('link')])}}
                            {{Form::label('footer_menu2_link3', '3 '.get_string('link'))}}
                            @if($errors->has('footer_menu2_link3'))
                                <span class="wrong-error">* {{$errors->first('footer_menu2_link3')}}</span>
                            @endif
                        </div>
                        <div class="form-group  {{$errors->has('footer_menu_link4') ? 'has-error' : ''}}">
                            {{Form::text('footer_menu2_link4', get_setting('footer_menu2_link4', 'design'), ['class' => 'form-control', 'placeholder' => '4 '.get_string('link')])}}
                            {{Form::label('footer_menu2_link4', '4 '.get_string('link'))}}
                            @if($errors->has('footer_menu2_link4'))
                                <span class="wrong-error">* {{$errors->first('footer_menu2_link4')}}</span>
                            @endif
                        </div>
                        <div class="form-group  {{$errors->has('footer_menu_link5') ? 'has-error' : ''}}">
                            {{Form::text('footer_menu2_link5', get_setting('footer_menu2_link5', 'design'), ['class' => 'form-control', 'placeholder' => '5 '.get_string('link')])}}
                            {{Form::label('footer_menu2_link5', '5 '.get_string('link'))}}
                            @if($errors->has('footer_menu2_link5'))
                                <span class="wrong-error">* {{$errors->first('footer_menu2_link5')}}</span>
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