@extends('layouts.owner_auth')

@section('title')
    <title>{{get_string('owner') .' - '. get_setting('site_name', 'site')}}</title>
@endsection
@section('content')

                    {!! Form::open(['method' => 'post', 'class' => 'form-material', 'url' => route('login')]) !!}
                        <div class="input-field">
                            {!! Form::email('email', null, ['id' => 'email', 'class' => $errors->has('email') ? 'invalid' : '']) !!}
                            {!! Form::label('email', get_string('email_address'))!!}
                        @if($errors->has('email'))
                                <span class="wrong-error">* {{$errors->first('email')}}</span>
                        @endif
                        </div>
                        <div class="input-field">
                            {!! Form::password('password', ['id' => 'password', 'class' => $errors->has('password') ? 'invalid' : '']) !!}
                            {!! Form::label('password', get_string('password'))!!}
                            @if($errors->has('password'))
                                <span class="wrong-error">* {{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <div class="input-field input-checkbox">
                            {!! Form::checkbox('remember', null, false, ['id' => 'remember']) !!}
                            {!! Form::label('remember', get_string('remember_me'))!!}
                        </div>
                    <div class="input-field input-button">
                        <button class="btn waves-effect waves-light" type="submit" name="action">{{get_string('login')}}</button>
                        <a class="forgot" href="{{ route('reset_password') }}">{{get_string('forgot_password')}}</a>
                    </div>
                    {!! Form::close() !!}
@endsection
