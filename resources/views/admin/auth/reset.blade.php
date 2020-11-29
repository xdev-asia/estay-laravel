@extends('layouts.admin_auth')
@section('title')
    <title>{{get_string('reset_password_title') .' - '. get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
                    {!! Form::open(['method' => 'post', 'class' => 'form-material', 'url' => route('login')]) !!}
                    <div class="input-field">
                        {!! Form::label('email', get_string('email_address'), ['data-error' => 'wrong', 'data-success' => 'right'])!!}
                        {!! Form::email('email', null, ['id' => 'email', 'class' => 'validate']) !!}
                    </div>
                    <div class="input-field">
                        <button class="btn waves-effect waves-light" type="submit" name="action">{{get_string('reset')}}</button>
                        <a class="forgot" href="{{ route('admin_login') }}">{{get_string('back_to_login')}}</a>
                    </div>
                    {!! Form::close() !!}
@endsection