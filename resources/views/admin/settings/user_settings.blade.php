@extends('layouts.admin')

@section('title')
    <title>{{get_string('user_settings') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('user_settings')}}</h3>
@endsection
<div class="panel col s12">
    <div class="row">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a data-toggle="tab" href="#general_settings">{{get_string('general')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#facebook">{{get_string('facebook')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#google">{{get_string('google')}}</a></li>
            </ul>
        </div>
        {!! Form::open(['url' => route('admin_user_settings_update'), 'method' => 'post', 'id' => "site_settings", 'class' => 'table-responsive', 'files' => 'true']) !!}
        <div class="panel-body">
            <div class="tab-content">
                <div id="general_settings" class="tab-pane active">
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('guest_booking') ? 'has-error' : ''}}">
                            {{Form::select('guest_booking', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('guest_booking', 'user'), ['class' => 'form-control'])}}
                            {{Form::label('guest_booking', get_string('guest_booking_label'))}}
                            @if($errors->has('guest_booking'))
                                <span class="wrong-error">* {{$errors->first('guest_booking')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('send_welcome_email') ? 'has-error' : ''}}">
                            {{Form::select('send_welcome_email', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('send_welcome_email', 'user'), ['class' => 'form-control'])}}
                            {{Form::label('send_welcome_email', get_string('send_welcome_email'))}}
                            @if($errors->has('send_welcome_email'))
                                <span class="wrong-error">* {{$errors->first('send_welcome_email')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('enable_messages') ? 'has-error' : ''}}">
                            {{Form::select('enable_messages', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('enable_messages', 'user'), ['class' => 'form-control'])}}
                            {{Form::label('enable_messages', get_string('enable_messages'))}}
                            @if($errors->has('enable_messages'))
                                <span class="wrong-error">* {{$errors->first('enable_messages')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="facebook" class="tab-pane">
                    <div class="col s12">
                        <div class="form-group  {{$errors->has('login_with_facebook') ? 'has-error' : ''}}">
                            {{Form::select('login_with_facebook', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('login_with_facebook', 'user'), ['class' => 'form-control'])}}
                            {{Form::label('login_with_facebook', get_string('login_with_facebook_label'))}}
                            @if($errors->has('login_with_facebook'))
                                <span class="wrong-error">* {{$errors->first('login_with_facebook')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="form-group  {{$errors->has('facebook_api_id') ? 'has-error' : ''}}">
                            {{ Form::text('facebook_api_id', get_setting('facebook_api_id', 'user'), ['class' => 'form-control', 'placeholder' => get_string('facebook_api_id')])}}
                            {{ Form::label('facebook_api_id', get_string('facebook_client_id')) }}
                            @if($errors->has('facebook_api_id'))
                                <span class="wrong-error">* {{$errors->first('facebook_api_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s12">
                         <div class="form-group  {{$errors->has('facebook_api_secret') ? 'has-error' : ''}}">
                            {{ Form::text('facebook_api_secret', get_setting('facebook_api_secret', 'user'), ['class' => 'form-control', 'placeholder' => get_string('facebook_api_secret')])}}
                            {{ Form::label('facebook_api_secret', get_string('facebook_client_secret')) }}
                            @if($errors->has('facebook_api_secret'))
                                <span class="wrong-error">* {{$errors->first('facebook_api_secret')}}</span>
                            @endif
                         </div>
                    </div>
                </div>
                <div id="google" class="tab-pane">
                    <div class="col s12">
                        <div class="form-group  {{$errors->has('login_with_google_plus') ? 'has-error' : ''}}">
                            {{Form::select('login_with_google_plus', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('login_with_google_plus', 'user'), ['class' => 'form-control'])}}
                            {{Form::label('login_with_google_plus', get_string('login_with_google_plus_label'))}}
                            @if($errors->has('login_with_google_plus'))
                                <span class="wrong-error">* {{$errors->first('guest_booking')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="form-group  {{$errors->has('google_api_id') ? 'has-error' : ''}}">
                            {{ Form::text('google_api_id', get_setting('google_api_id', 'user'), ['class' => 'form-control', 'placeholder' => get_string('google_api_id')])}}
                            {{ Form::label('google_api_id', get_string('google_client_id')) }}
                            @if($errors->has('google_api_id'))
                                <span class="wrong-error">* {{$errors->first('google_api_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s12">
                         <div class="form-group  {{$errors->has('google_api_secret') ? 'has-error' : ''}}">
                            {{ Form::text('google_api_secret', get_setting('google_api_secret', 'user'), ['class' => 'form-control', 'placeholder' => get_string('google_api_secret')])}}
                            {{ Form::label('google_api_secret', get_string('google_client_secret')) }}
                            @if($errors->has('google_api_secret'))
                                <span class="wrong-error">* {{$errors->first('google_api_secret')}}</span>
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
