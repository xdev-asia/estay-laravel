@extends('layouts.admin')

@section('title')
    <title>{{get_string('edit_owner') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('edit_owner')}}</h3>
@endsection
<div class="col s12 mtop10">
    {!! Form::open(['method' => 'post', 'url' => route('admin_owner_update', $owner->id), 'files' => 'true']) !!}
    {!! Form::hidden('user_id', $owner->user_id) !!}
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
            {!! Form::text('username', $owner->user->username, ['id' => 'username', 'class' => 'form-control', 'placeholder' => get_string('username')]) !!}
            {!! Form::label('username', get_string('username'))!!}
            @if($errors->has('username'))
                <span class="wrong-error">* {{$errors->first('username')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group  {{$errors->has('first_name') ? 'has-error' : ''}}">
            {!! Form::text('first_name', $owner->first_name, ['id' => 'first_name', 'class' => 'form-control', 'placeholder' => get_string('first_name')]) !!}
            {!! Form::label('first_name', get_string('first_name'))!!}
            @if($errors->has('first_name'))
                <span class="wrong-error">* {{$errors->first('first_name')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
            {!! Form::text('last_name', $owner->last_name, ['id' => 'last_name', 'class' => 'form-control', 'placeholder' => get_string('last_name')]) !!}
            {!! Form::label('last_name', get_string('last_name'))!!}
            @if($errors->has('last_name'))
                <span class="wrong-error">* {{$errors->first('last_name')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
            {!! Form::text('company', $owner->last_name, ['id' => 'company', 'class' => 'form-control', 'placeholder' => get_string('company')]) !!}
            {!! Form::label('company', get_string('company'))!!}
            @if($errors->has('company'))
                <span class="wrong-error">* {{$errors->first('last_name')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
            {!! Form::text('phone', $owner->phone, ['id' => 'phone', 'class' => 'form-control', 'placeholder' => get_string('phone')]) !!}
            {!! Form::label('phone', get_string('phone'))!!}
            @if($errors->has('phone'))
                <span class="wrong-error">* {{$errors->first('phone')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
            {!! Form::email('email', $owner->user->email, ['id' => 'email', 'class' => 'form-control', 'placeholder' => get_string('email_address')]) !!}
            {!! Form::label('email', get_string('email_address'))!!}
            @if($errors->has('email'))
                <span class="wrong-error">* {{$errors->first('email')}}</span>
            @endif
        </div>
    </div>

    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
            {!! Form::text('address', $owner->address, ['id' => 'address', 'class' => 'form-control', 'placeholder' => get_string('address')]) !!}
            {!! Form::label('address', get_string('address'))!!}
            @if($errors->has('address'))
                <span class="wrong-error">* {{$errors->first('address')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('city') ? 'has-error' : ''}}">
            {!! Form::text('city', $owner->city, ['id' => 'city', 'class' => 'form-control', 'placeholder' => get_string('city')]) !!}
            {!! Form::label('city', get_string('city'))!!}
            @if($errors->has('city'))
                <span class="wrong-error">* {{$errors->first('city')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('state') ? 'has-error' : ''}}">
            {!! Form::text('state', $owner->state, ['id' => 'state', 'class' => 'form-control', 'placeholder' => get_string('state')]) !!}
            {!! Form::label('state', get_string('state'))!!}
            @if($errors->has('state'))
                <span class="wrong-error">* {{$errors->first('state')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('country') ? 'has-error' : ''}}"">
            {!! Form::text('country', $owner->country, ['id' => 'country', 'class' => 'form-control', 'placeholder' => get_string('country')]) !!}
            {!! Form::label('country', get_string('country'))!!}
            @if($errors->has('country'))
                <span class="wrong-error">* {{$errors->first('country')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('zip') ? 'has-error' : ''}}">
            {!! Form::text('zip', $owner->zip, ['id' => 'zip', 'class' => 'form-control', 'placeholder' => get_string('zip')]) !!}
            {!! Form::label('zip', get_string('zip'))!!}
            @if($errors->has('zip'))
                <span class="wrong-error">* {{$errors->first('zip')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('points') ? 'has-error' : ''}}">
            {!! Form::text('points', $owner->points, ['id' => 'points', 'class' => 'form-control', 'placeholder' => get_string('points')]) !!}
            {!! Form::label('points', get_string('points'))!!}
            @if($errors->has('points'))
                <span class="wrong-error">* {{$errors->first('points')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('active_balance') ? 'has-error' : ''}}">
            {!! Form::text('active_balance', $owner->active_balance, ['id' => 'active_balance', 'class' => 'form-control', 'placeholder' => get_string('active_balance')]) !!}
            {!! Form::label('active_balance', get_string('active_balance'))!!}
            @if($errors->has('active_balance'))
                <span class="wrong-error">* {{$errors->first('active_balance')}}</span>
            @endif
        </div>
    </div>
    <div class="col l4 m4 s6">
        <div class="form-group {{$errors->has('pending_balance') ? 'has-error' : ''}}">
            {!! Form::text('pending_balance', $owner->pending_balance, ['id' => 'pending_balance', 'class' => 'form-control', 'placeholder' => get_string('pending_balance')]) !!}
            {!! Form::label('pending_balance', get_string('pending_balance'))!!}
            @if($errors->has('pending_balance'))
                <span class="wrong-error">* {{$errors->first('pending_balance')}}</span>
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
    <div class="clearfix col m6 s6">
        <img class="responsive-img featured-img" src="{{ $owner->logo }}"  style="display: block"/>
        <a href="#!" class="delete-featured-image btn waves-effect btn-red mtop10 mbot10" data-id="2"><i class="material-icons color-white">delete</i>{{ get_string('delete_image') }}</a>
        <div class="clearfix input-group">
                <label class="input-group-btn">
                            <span class="btn btn-primary waves-effect">{{get_string('profile_picture')}} <i class="material-icons small">add_circle</i>
                                {!! Form::file('logo', ['id' => 'logo', 'class' => 'hidden']) !!}
                            </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div>
        @if($errors->has('logo'))
                <span class="wrong-error">* {{$errors->first('logo')}}</span>
            @endif
            <span class="field-info">{{get_string('max_dimension_300')}}</span>
    </div>
    <div class="col clearfix  s12">
        <div class="form-group">
            <button class="btn waves-effect" type="submit" name="action">{{get_string('update_profile')}}</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection

@section('footer')
    <script type="text/javascript">
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
                            url: '{{ url('/admin/owner/deleteImage') }}/'+id,
                            type: 'post',
                            data: {_token :token},
                            success:function(msg) {
                                $('.featured-img').attr('src', '{{ URL::asset('images/owner/no_image.jpg')}}');
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
    </script>
@endsection