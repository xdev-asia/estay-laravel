@extends('layouts.admin')

@section('title')
    <title>{{get_string('site_settings') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('site_settings')}}</h3>
@endsection
<div class="panel col s12">
    <div class="row">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a data-toggle="tab" href="#general_settings">{{get_string('general')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#location">{{get_string('location')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#contact">{{get_string('contact')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#social">{{get_string('social')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#google_settings">{{get_string('google')}}</a></li>
                <!-- <li class="tab"><a data-toggle="tab" href="#email_settings">{{get_string('email')}}</a></li> -->
            </ul>
        </div>
        {!! Form::open(['url' => route('admin_site_settings_update'), 'method' => 'post', 'id' => "site_settings", 'class' => 'table-responsive', 'files' => 'true']) !!}
        <div class="panel-body">
            <div class="tab-content">
                <div id="general_settings" class="tab-pane active">
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('site_name') ? 'has-error' : ''}}">
                            {{Form::text('site_name', get_setting('site_name', 'site'), ['class' => 'form-control', 'placeholder' => get_string('site_name')])}}
                            {{Form::label('site_name', get_string('site_name'))}}
                            @if($errors->has('site_name'))
                                <span class="wrong-error">* {{$errors->first('site_name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l12 m12 s12">
                        <div class="form-group  {{$errors->has('site_description') ? 'has-error' : ''}}">
                            {{Form::textarea('site_description', get_setting('site_description', 'site'), ['class' => 'form-control', 'rows' => '5', 'placeholder' => get_string('site_description')])}}
                            {{Form::label('site_description', get_string('site_description'))}}
                            @if($errors->has('site_description'))
                                <span class="wrong-error">* {{$errors->first('site_description')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l12 m12 s12">
                        <div class="form-group  {{$errors->has('site_keywords') ? 'has-error' : ''}}">
                            {{Form::textarea('site_keywords', get_setting('site_keywords', 'site'), ['class' => 'form-control', 'rows' => '2', 'placeholder' => get_string('site_keywords_description')])}}
                            {{Form::label('site_keywords', get_string('site_keywords'))}}
                            @if($errors->has('site_keywords'))
                                <span class="wrong-error">* {{$errors->first('site_keywords')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12 mbot20">
                        <div class="input-group clearfix {{$errors->has('logo') ? 'has-error' : ''}}">
                            <label class="input-group-btn">
                                <span class="btn btn-primary waves-effect">{{get_string('select_file')}}
                                    {!! Form::file('logo', ['class' => 'hidden']) !!}
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <div class="field-info">{{ get_string('upload_your_logo') }}  {{get_setting('site_logo', 'site')}}</div>
                    </div>
                    <div class="col s12 mbot20">
                        <div class="input-group clearfix {{$errors->has('favicon') ? 'has-error' : ''}}">
                            <label class="input-group-btn">
                                <span class="btn btn-primary waves-effect">{{ get_string('select_file') }}
                                    {!! Form::file('favicon', ['class' => 'hidden']) !!}
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <div class="field-info">Favicon (.ico)</div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('dateformat') ? 'has-error' : ''}}">
                            {{Form::select('dateformat', ['d.m.Y' => 'dd/mm/YYYY', 'm.d.Y' => 'mm/dd/YYYY'], get_setting('dateformat', 'site'), ['class' => 'form-control'])}}
                            {{Form::label('dateformat', get_string('dateformat'))}}
                            @if($errors->has('dateformat'))
                                <span class="wrong-error">* {{$errors->first('dateformat')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('measurement_unit') ? 'has-error' : ''}}">
                            {{Form::select('measurement_unit', ['m2' => 'm2', 'ft' => 'ft'], get_setting('measurement_unit', 'site'), ['class' => 'form-control'])}}
                            {{Form::label('measurement_unit', get_string('measurement_unit'))}}
                            @if($errors->has('measurement_unit'))
                                <span class="wrong-error">* {{$errors->first('measurement_unit')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12 clearfix">
                        <div class="form-group  {{$errors->has('allow_blog') ? 'has-error' : ''}}">
                            {{Form::select('allow_blog', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('allow_blog', 'site'), ['class' => 'form-control'])}}
                            {{Form::label('allow_blog', get_string('allow_blog'))}}
                            @if($errors->has('allow_blog'))
                                <span class="wrong-error">* {{$errors->first('allow_blog')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="location" class="tab-pane">
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('location_address') ? 'has-error' : ''}}">
                            {{Form::text('location_address', get_setting('location_address', 'site'), ['class' => 'form-control', 'placeholder' => get_string('address')])}}
                            {{Form::label('location_address', get_string('address'))}}
                            @if($errors->has('location_address'))
                                <span class="wrong-error">* {{$errors->first('location_address')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('location_city') ? 'has-error' : ''}}">
                            {{Form::text('location_city', get_setting('location_city', 'site'), ['class' => 'form-control', 'placeholder' => get_string('city')])}}
                            {{Form::label('location_city', get_string('city'))}}
                            @if($errors->has('location_city'))
                                <span class="wrong-error">* {{$errors->first('location_city')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('location_state') ? 'has-error' : ''}}">
                            {{Form::text('location_state', get_setting('location_state', 'site'), ['class' => 'form-control', 'placeholder' => get_string('state')])}}
                            {{Form::label('location_state', get_string('state'))}}
                            @if($errors->has('location_state'))
                                <span class="wrong-error">* {{$errors->first('location_state')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('location_country') ? 'has-error' : ''}}">
                            {{Form::text('location_country', get_setting('location_country', 'site'), ['class' => 'form-control', 'placeholder' => get_string('country')])}}
                            {{Form::label('location_country', get_string('country'))}}
                            @if($errors->has('location_country'))
                                <span class="wrong-error">* {{$errors->first('location_country')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('location_zip') ? 'has-error' : ''}}">
                            {{Form::text('location_zip', get_setting('location_zip', 'site'), ['class' => 'form-control', 'placeholder' => get_string('zip')])}}
                            {{Form::label('location_zip', get_string('zip'))}}
                            @if($errors->has('location_zip'))
                                <span class="wrong-error">* {{$errors->first('location_zip')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="contact" class="tab-pane">
                    <div class="col l4 m6 s12">
                        <div class="form-group  {{$errors->has('contact_tel1') ? 'has-error' : ''}}">
                            {{Form::text('contact_tel1', get_setting('contact_tel1', 'site'), ['class' => 'form-control', 'placeholder' => get_string('contact_tel1')])}}
                            {{Form::label('contact_tel1', get_string('contact_tel1'))}}
                            @if($errors->has('contact_tel1'))
                                <span class="wrong-error">* {{$errors->first('contact_tel1')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l4 m6 s12">
                        <div class="form-group  {{$errors->has('contact_tel2') ? 'has-error' : ''}}">
                            {{Form::text('contact_tel2', get_setting('contact_tel2', 'site'), ['class' => 'form-control', 'placeholder' => get_string('contact_tel2')])}}
                            {{Form::label('contact_tel2', get_string('contact_tel2'))}}
                            @if($errors->has('contact_tel2'))
                                <span class="wrong-error">* {{$errors->first('contact_tel2')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l4 m6 s12">
                        <div class="form-group  {{$errors->has('contact_fax') ? 'has-error' : ''}}">
                            {{Form::text('contact_fax', get_setting('contact_fax', 'site'), ['class' => 'form-control', 'placeholder' => get_string('fax')])}}
                            {{Form::label('contact_fax', get_string('fax'))}}
                            @if($errors->has('contact_fax'))
                                <span class="wrong-error">* {{$errors->first('contact_fax')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('contact_email') ? 'has-error' : ''}}">
                            {{Form::text('contact_email', get_setting('contact_email', 'site'), ['class' => 'form-control', 'placeholder' => get_string('email')])}}
                            {{Form::label('contact_email', get_string('email'))}}
                            @if($errors->has('contact_email'))
                                <span class="wrong-error">* {{$errors->first('contact_email')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('contact_web') ? 'has-error' : ''}}">
                            {{Form::text('contact_web', get_setting('contact_web', 'site'), ['class' => 'form-control', 'placeholder' => get_string('website')])}}
                            {{Form::label('contact_web', get_string('website'))}}
                            @if($errors->has('contact_web'))
                                <span class="wrong-error">* {{$errors->first('contact_web')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12 clearfix">
                        <div class="form-group  {{$errors->has('contact_map_lat') ? 'has-error' : ''}}">
                            {{Form::text('contact_map_lat', get_setting('contact_map_lat', 'site'), ['class' => 'form-control', 'placeholder' => get_string('geo_lat')])}}
                            {{Form::label('contact_map_lat', get_string('geo_lat'))}}
                            @if($errors->has('contact_map_lat'))
                                <span class="wrong-error">* {{$errors->first('contact_map_lat')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('contact_map_lon') ? 'has-error' : ''}}">
                            {{Form::text('contact_map_lon', get_setting('contact_map_lon', 'site'), ['class' => 'form-control', 'placeholder' => get_string('geo_lon')])}}
                            {{Form::label('contact_map_lon', get_string('geo_lon'))}}
                            @if($errors->has('contact_map_lon'))
                                <span class="wrong-error">* {{$errors->first('contact_map_lon')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="social" class="tab-pane">
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('social_facebook') ? 'has-error' : ''}}">
                            {{Form::text('social_facebook', get_setting('social_facebook', 'site'), ['class' => 'form-control', 'placeholder' => get_string('facebook')])}}
                            {{Form::label('social_facebook', get_string('facebook'))}}
                            @if($errors->has('social_facebook'))
                                <span class="wrong-error">* {{$errors->first('social_facebook')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('social_twitter') ? 'has-error' : ''}}">
                            {{Form::text('social_twitter', get_setting('social_twitter', 'site'), ['class' => 'form-control', 'placeholder' => get_string('twitter')])}}
                            {{Form::label('social_twitter', get_string('twitter'))}}
                            @if($errors->has('social_twitter'))
                                <span class="wrong-error">* {{$errors->first('social_twitter')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('social_google_plus') ? 'has-error' : ''}}">
                            {{Form::text('social_google_plus', get_setting('social_google_plus', 'site'), ['class' => 'form-control', 'placeholder' => get_string('google_plus')])}}
                            {{Form::label('social_google_plus', get_string('google_plus'))}}
                            @if($errors->has('social_google_plus'))
                                <span class="wrong-error">* {{$errors->first('social_google_plus')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('social_youtube') ? 'has-error' : ''}}">
                            {{Form::text('social_youtube', get_setting('social_youtube', 'site'), ['class' => 'form-control', 'placeholder' => get_string('youtube')])}}
                            {{Form::label('social_youtube', get_string('youtube'))}}
                            @if($errors->has('social_youtube'))
                                <span class="wrong-error">* {{$errors->first('social_youtube')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('social_instagram') ? 'has-error' : ''}}">
                            {{Form::text('social_instagram', get_setting('social_instagram', 'site'), ['class' => 'form-control', 'placeholder' => get_string('instagram')])}}
                            {{Form::label('social_instagram', get_string('instagram'))}}
                            @if($errors->has('social_instagram'))
                                <span class="wrong-error">* {{$errors->first('social_instagram')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('social_pinterest') ? 'has-error' : ''}}">
                            {{Form::text('social_pinterest', get_setting('social_pinterest', 'site'), ['class' => 'form-control', 'placeholder' => get_string('pinterest')])}}
                            {{Form::label('social_pinterest', get_string('pinterest'))}}
                            @if($errors->has('social_pinterest'))
                                <span class="wrong-error">* {{$errors->first('social_pinterest')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('social_linkedin') ? 'has-error' : ''}}">
                            {{Form::text('social_linkedin', get_setting('social_linkedin', 'site'), ['class' => 'form-control', 'placeholder' => get_string('linkedin')])}}
                            {{Form::label('social_linkedin', get_string('linkedin'))}}
                            @if($errors->has('social_linkedin'))
                                <span class="wrong-error">* {{$errors->first('social_linkedin')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('social_tripadvisor') ? 'has-error' : ''}}">
                            {{Form::text('social_tripadvisor', get_setting('social_tripadvisor', 'site'), ['class' => 'form-control', 'placeholder' => get_string('tripadvisor')])}}
                            {{Form::label('social_tripadvisor', get_string('tripadvisor'))}}
                            @if($errors->has('social_tripadvisor'))
                                <span class="wrong-error">* {{$errors->first('social_tripadvisor')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="google_settings" class="tab-pane">
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('google_map_key') ? 'has-error' : ''}}">
                            {{Form::text('google_map_key', get_setting('google_map_key', 'site'), ['class' => 'form-control', 'placeholder' => get_string('google_maps_api')])}}
                            {{Form::label('google_map_key', get_string('google_maps_api'))}}
                            @if($errors->has('google_map_key'))
                                <span class="wrong-error">* {{$errors->first('google_map_key')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('google_map_zoom') ? 'has-error' : ''}}">
                            {{Form::text('google_map_zoom', get_setting('google_map_zoom', 'site'), ['class' => 'form-control', 'placeholder' => get_string('google_maps_zoom')])}}
                            {{Form::label('google_map_zoom', get_string('google_maps_zoom_label'))}}
                            @if($errors->has('google_map_zoom'))
                                <span class="wrong-error">* {{$errors->first('google_map_key')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l12 m12 s12">
                        <div class="form-group  {{$errors->has('google_analytics') ? 'has-error' : ''}}">
                            {{Form::text('google_analytics', get_setting('google_analytics', 'site'), ['class' => 'form-control', 'placeholder' => get_string('google_analytics_description')])}}
                            {{Form::label('google_analytics', get_string('google_analytics'))}}
                            @if($errors->has('google_analytics'))
                                <span class="wrong-error">* {{$errors->first('google_analytics')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12 clearfix">
                        <div class="form-group  {{$errors->has('reCaptcha') ? 'has-error' : ''}}">
                            {{Form::select('reCaptcha', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('reCaptcha', 'site'), ['class' => 'form-control'])}}
                            {{Form::label('reCaptcha', get_string('reCaptcha_label'))}}
                            @if($errors->has('reCaptcha'))
                                <span class="wrong-error">* {{$errors->first('reCaptcha_label')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('reCaptcha_api') ? 'has-error' : ''}}">
                            {{Form::text('reCaptcha_api', get_setting('reCaptcha_api', 'site'), ['class' => 'form-control', 'placeholder' => get_string('reCaptcha_api')])}}
                            {{Form::label('reCaptcha_api', get_string('reCaptcha_api'))}}
                            @if($errors->has('reCaptcha_api'))
                                <span class="wrong-error">* {{$errors->first('reCaptcha_api')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('reCaptcha_api_secret') ? 'has-error' : ''}}">
                            {{Form::text('reCaptcha_api_secret', get_setting('reCaptcha_api_secret', 'site'), ['class' => 'form-control', 'placeholder' => get_string('reCaptcha_api_secret')])}}
                            {{Form::label('reCaptcha_api_secret', get_string('reCaptcha_api_secret'))}}
                            @if($errors->has('reCaptcha_api_secret'))
                                <span class="wrong-error">* {{$errors->first('reCaptcha_api_secret')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="card-panel">
                            <span class="primary-color">*{{get_string('note_for_apiGoogleMap')}}</span>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="card-panel">
                            <span class="primary-color">*{{get_string('note_for_reCaptcha')}}</span>
                        </div>
                    </div>
                    <!-- <div class="col l12 m12 s12">
                        <div class="form-group  {{$errors->has('google_map_styles') ? 'has-error' : ''}}">
                            {{Form::textarea('google_map_styles', get_setting('google_map_styles', 'site'), ['class' => 'form-control', 'placeholder' => get_string('google_map_styles')])}}
                            {{Form::label('google_map_styles', get_string('google_map_styles_label'))}}
                            @if($errors->has('google_analytics'))
                                <span class="wrong-error">* {{$errors->first('google_map_styles')}}</span>
                            @endif
                        </div>
                    </div> -->
                </div>
                <div id="email_settings" class="tab-pane"></div>
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
