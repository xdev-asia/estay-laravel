@extends('layouts.admin')

@section('title')
    <title>{{get_string('my_account') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('my_account')}}</h3>
@endsection
 @if(Session::has('account_updated'))
    <div class="col s12">
        <div class="col s12 text-centered">
            <h5 class="color-primary">{{ get_string('account_updated') }}</h5>
        </div>
    </div>
 @endif
<div class="col s12 mtop10">
    {!! Form::open(['method' => 'put', 'url' => route('admin_my_account_update', Auth::user()->id), 'files' => 'true']) !!}
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
            {!! Form::text('username', $user->username, ['id' => 'username', 'class' => 'form-control', 'placeholder' => get_string('username')]) !!}
            {!! Form::label('username', get_string('username'))!!}
            @if($errors->has('username'))
                <span class="wrong-error">* {{$errors->first('username')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group  {{$errors->has('first_name') ? 'has-error' : ''}}">
            {!! Form::text('first_name', $user->admin->first_name, ['id' => 'first_name', 'class' => 'form-control', 'placeholder' => get_string('first_name')]) !!}
            {!! Form::label('first_name', get_string('first_name'))!!}
            @if($errors->has('first_name'))
                <span class="wrong-error">* {{$errors->first('first_name')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
            {!! Form::text('last_name', $user->admin->last_name, ['id' => 'last_name', 'class' => 'form-control', 'placeholder' => get_string('last_name')]) !!}
            {!! Form::label('last_name', get_string('last_name'))!!}
            @if($errors->has('last_name'))
                <span class="wrong-error">* {{$errors->first('last_name')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
            {!! Form::text('company', $user->admin->company, ['id' => 'company', 'class' => 'form-control', 'placeholder' => get_string('company')]) !!}
            {!! Form::label('company', get_string('company'))!!}
            @if($errors->has('company'))
                <span class="wrong-error">* {{$errors->first('last_name')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
            {!! Form::email('email', $user->email, ['id' => 'email', 'class' => 'form-control', 'placeholder' => get_string('email_address')]) !!}
            {!! Form::label('email', get_string('email_address'))!!}
            @if($errors->has('email'))
                <span class="wrong-error">* {{$errors->first('email')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
            {!! Form::text('address', $user->admin->address, ['id' => 'address', 'class' => 'form-control', 'placeholder' => get_string('address')]) !!}
            {!! Form::label('address', get_string('address'))!!}
            @if($errors->has('address'))
                <span class="wrong-error">* {{$errors->first('address')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('city') ? 'has-error' : ''}}">
            {!! Form::text('city', $user->admin->city, ['id' => 'city', 'class' => 'form-control', 'placeholder' => get_string('city')]) !!}
            {!! Form::label('city', get_string('city'))!!}
            @if($errors->has('city'))
                <span class="wrong-error">* {{$errors->first('city')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('state') ? 'has-error' : ''}}">
            {!! Form::text('state', $user->admin->state, ['id' => 'state', 'class' => 'form-control', 'placeholder' => get_string('state')]) !!}
            {!! Form::label('state', get_string('state'))!!}
            @if($errors->has('state'))
                <span class="wrong-error">* {{$errors->first('state')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('country') ? 'has-error' : ''}}"">
            {!! Form::text('country', $user->admin->country, ['id' => 'country', 'class' => 'form-control', 'placeholder' => get_string('country')]) !!}
            {!! Form::label('country', get_string('country'))!!}
            @if($errors->has('country'))
                <span class="wrong-error">* {{$errors->first('country')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('zip') ? 'has-error' : ''}}">
            {!! Form::text('zip', $user->admin->zip, ['id' => 'zip', 'class' => 'form-control', 'placeholder' => get_string('zip')]) !!}
            {!! Form::label('zip', get_string('zip'))!!}
            @if($errors->has('zip'))
                <span class="wrong-error">* {{$errors->first('zip')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
            {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => get_string('password')]) !!}
            {!! Form::label('password', get_string('password'))!!}
            @if($errors->has('password'))
                <span class="wrong-error">* {{$errors->first('password')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
            {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => get_string('password_confirmation')]) !!}
            {!! Form::label('password_confirmation', get_string('password_confirmation'))!!}
            @if($errors->has('password'))
                <span class="wrong-error">* {{$errors->first('password')}}</span>
            @endif
        </div>
    </div>
    <div class="col s12">
        <div class="input-group">
            <label class="input-group-btn">
                    <span class="btn btn-primary waves-effect">{{get_string('profile_picture')}} <i class="material-icons small">add_circle</i>
                {!! Form::file('avatar', ['id' => 'avatar', 'class' => 'hidden']) !!}
                    </span>
            </label>
            <input type="text" class="form-control" readonly>
        </div>
        @if($errors->has('avatar'))
            <span class="wrong-error">* {{$errors->first('avatar')}}</span>
        @endif
    </div>
    <div class="col clearfix l4 m4 s6 mtop10">
        <div class="form-group">
            <button class="btn waves-effect" type="submit" name="action">{{get_string('update_profile')}}</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
