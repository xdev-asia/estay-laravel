@extends('layouts.admin')

@section('title')
    <title>{{get_string('owner_settings') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('owner_settings')}}</h3>
@endsection
<div class="panel col s12">
    <div class="row">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a data-toggle="tab" href="#general_settings">{{get_string('general')}}</a></li>
            </ul>
        </div>
        {!! Form::open(['url' => route('admin_owner_settings_update'), 'method' => 'post', 'id' => "site_settings", 'class' => 'table-responsive', 'files' => 'true']) !!}
        <div class="panel-body">
            <div class="tab-content">
                <div id="general_settings" class="tab-pane active">
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('allow_user_requests') ? 'has-error' : ''}}">
                            {{Form::select('allow_user_requests', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('allow_user_requests', 'owner'), ['class' => 'form-control'])}}
                            {{Form::label('allow_user_requests', get_string('allow_user_requests_label'))}}
                            @if($errors->has('allow_user_requests'))
                                <span class="wrong-error">* {{$errors->first('allow_user_requests')}}</span>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('approve_requests_automatically') ? 'has-error' : ''}}">
                            {{Form::select('approve_requests_automatically', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('approve_requests_automatically', 'owner'), ['class' => 'form-control'])}}
                            {{Form::label('approve_requests_automatically', get_string('approve_requests_auto_label'))}}
                            @if($errors->has('approve_requests_automatically'))
                                <span class="wrong-error">* {{$errors->first('approve_requests_automatically')}}</span>
                            @endif
                        </div>
                    </div> -->
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('allow_owners_services') ? 'has-error' : ''}}">
                            {{Form::select('allow_owners_services', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('allow_owners_services', 'owner'), ['class' => 'form-control'])}}
                            {{Form::label('allow_owners_services', get_string('allow_owners_services_label'))}}
                            @if($errors->has('allow_owners_services'))
                                <span class="wrong-error">* {{$errors->first('allow_owners_services')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('register_owner_directly') ? 'has-error' : ''}}">
                            {{Form::select('register_owner_directly', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('register_owner_directly', 'owner'), ['class' => 'form-control'])}}
                            {{Form::label('register_owner_directly', get_string('register_owner_directly'))}}
                            @if($errors->has('register_owner_directly'))
                                <span class="wrong-error">* {{$errors->first('register_owner_directly')}}</span>
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
