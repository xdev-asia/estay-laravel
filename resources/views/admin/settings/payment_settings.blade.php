@extends('layouts.admin')

@section('title')
    <title>{{get_string('payment_settings') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('payment_settings')}}</h3>
@endsection
<div class="panel col s12">
    <div class="row">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a data-toggle="tab" href="#general_settings">{{get_string('general_and_packages')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#paypal">{{get_string('paypal')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#stripe">{{get_string('stripe')}}</a></li>
                <li class="tab"><a data-toggle="tab" href="#withdrawal">{{get_string('withdrawal')}}</a></li>
            </ul>
        </div>
        {!! Form::open(['url' => route('admin_payment_settings_update'), 'method' => 'post', 'id' => "payment_settings", 'class' => 'table-responsive', 'files' => 'true']) !!}
        <div class="panel-body">
            <div class="tab-content">
                <div id="general_settings" class="tab-pane active">
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('show_price_menu') ? 'has-error' : ''}}">
                            {{Form::select('show_price_menu', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_price_menu', 'payment'), ['class' => 'form-control'])}}
                            {{Form::label('show_price_menu', get_string('show_price_menu'))}}
                            @if($errors->has('show_price_menu'))
                                <span class="wrong-error">* {{$errors->first('show_price_menu')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('show_add_points_menu') ? 'has-error' : ''}}">
                            {{Form::select('show_add_points_menu', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_add_points_menu', 'payment'), ['class' => 'form-control'])}}
                            {{Form::label('show_add_points_menu', get_string('show_add_points_menu'))}}
                            @if($errors->has('show_add_points_menu'))
                                <span class="wrong-error">* {{$errors->first('show_add_points_menu')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('booking_by_payment') ? 'has-error' : ''}}">
                            {{Form::select('booking_by_payment', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('booking_by_payment', 'payment'), ['class' => 'form-control'])}}
                            {{Form::label('booking_by_payment', get_string('booking_by_payment'))}}
                            @if($errors->has('booking_by_payment'))
                                <span class="wrong-error">* {{$errors->first('booking_by_payment')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('days_after_check_in') ? 'has-error' : ''}}">
                            {{Form::number('days_after_check_in', get_setting('days_after_check_in', 'payment'), ['class' => 'form-control', 'min' => 0, 'placeholder' => get_string('days_after_check_in')])}}
                            {{Form::label('days_after_check_in', get_string('days_after_check_in'))}}
                            @if($errors->has('days_after_check_in'))
                                <span class="wrong-error">* {{$errors->first('days_after_check_in')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12">
                        <h3 class="page-title clearfix">{{ get_string('host_commission') }} %</h3>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('host_commission') ? 'has-error' : ''}}">
                            {{Form::number('host_commission', get_setting('host_commission', 'payment'), ['class' => 'form-control', 'min' => 0, 'placeholder' => get_string('host_commission')])}}
                            {{Form::label('host_commission', get_string('host_commission'))}}
                            @if($errors->has('host_commission'))
                                <span class="wrong-error">* {{$errors->first('host_commission')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12">
                        <h3 class="page-title clearfix">{{ get_string('packages') }} ({{ $currency }})</h3>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('package_10') ? 'has-error' : ''}}">
                            {{Form::number('package_10', get_setting('package_10', 'payment'), ['class' => 'form-control', 'min' => 0, 'placeholder' => '10 '.get_string('points')])}}
                            {{Form::label('package_10', '10 '.get_string('points'))}}
                            @if($errors->has('package_10'))
                                <span class="wrong-error">* {{$errors->first('package_10')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('package_30') ? 'has-error' : ''}}">
                            {{Form::number('package_30', get_setting('package_30', 'payment'), ['class' => 'form-control', 'min' => 0, 'placeholder' => '30 '.get_string('points')])}}
                            {{Form::label('package_30', '30 '.get_string('points'))}}
                            @if($errors->has('package_30'))
                                <span class="wrong-error">* {{$errors->first('package_30')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('package_50') ? 'has-error' : ''}}">
                            {{Form::number('package_50', get_setting('package_50', 'payment'), ['class' => 'form-control', 'min' => 0, 'placeholder' => '50 '.get_string('points')])}}
                            {{Form::label('package_50', '50 '.get_string('points'))}}
                            @if($errors->has('package_50'))
                                <span class="wrong-error">* {{$errors->first('package_50')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('package_100') ? 'has-error' : ''}}">
                            {{Form::number('package_100', get_setting('package_100', 'payment'), ['class' => 'form-control', 'min' => 0, 'placeholder' => '100 '.get_string('points')])}}
                            {{Form::label('package_100', '100 '.get_string('points'))}}
                            @if($errors->has('package_100'))
                                <span class="wrong-error">* {{$errors->first('package_100')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('package_200') ? 'has-error' : ''}}">
                            {{Form::number('package_200', get_setting('package_200', 'payment'), ['class' => 'form-control', 'min' => 0, 'placeholder' => '200 '.get_string('points')])}}
                            {{Form::label('package_200', '200 '.get_string('points'))}}
                            @if($errors->has('package_200'))
                                <span class="wrong-error">* {{$errors->first('package_200')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12">
                        <h3 class="page-title clearfix">{{ get_string('featured_items') }} ({{ get_string('points') }})</h3>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('points_featured_week') ? 'has-error' : ''}}">
                            {{Form::number('points_featured_week', get_setting('points_featured_week', 'payment'), ['class' => 'form-control', 'min' => 0, 'placeholder' => get_string('week_featured')])}}
                            {{Form::label('points_featured_week', get_string('week_featured'))}}
                            @if($errors->has('points_featured_week'))
                                <span class="wrong-error">* {{$errors->first('points_featured_week')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('points_featured_month') ? 'has-error' : ''}}">
                            {{Form::number('points_featured_month', get_setting('points_featured_month', 'payment'), ['class' => 'form-control', 'min' => 0, 'placeholder' => get_string('month_featured')])}}
                            {{Form::label('points_featured_month', get_string('month_featured'))}}
                            @if($errors->has('points_featured_month'))
                                <span class="wrong-error">* {{$errors->first('points_featured_month')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('points_featured_3months') ? 'has-error' : ''}}">
                            {{Form::number('points_featured_3months', get_setting('points_featured_3months', 'payment'), ['class' => 'form-control', 'min' => 0, 'placeholder' => get_string('3months_featured')])}}
                            {{Form::label('points_featured_3months', get_string('3months_featured'))}}
                            @if($errors->has('points_featured_3months'))
                                <span class="wrong-error">* {{$errors->first('points_featured_month')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="paypal" class="tab-pane">
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('allow_paypal') ? 'has-error' : ''}}">
                            {{Form::select('allow_paypal', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('allow_paypal', 'payment'), ['class' => 'form-control'])}}
                            {{Form::label('allow_paypal', get_string('allow_paypal'))}}
                            @if($errors->has('allow_paypal'))
                                <span class="wrong-error">* {{$errors->first('allow_paypal')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('paypal_username') ? 'has-error' : ''}}">
                            {{Form::text('paypal_username', get_setting('paypal_username', 'payment'), ['class' => 'form-control', 'placeholder' => get_string('paypal_username')])}}
                            {{Form::label('paypal_username', get_string('paypal_username'))}}
                            @if($errors->has('paypal_username'))
                                <span class="wrong-error">* {{$errors->first('paypal_username')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('paypal_password') ? 'has-error' : ''}}">
                            {{Form::text('paypal_password', get_setting('paypal_password', 'payment'), ['class' => 'form-control', 'placeholder' => get_string('paypal_password')])}}
                            {{Form::label('paypal_password', get_string('paypal_password'))}}
                            @if($errors->has('paypal_password'))
                                <span class="wrong-error">* {{$errors->first('paypal_password')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('paypal_signature') ? 'has-error' : ''}}">
                            {{Form::text('paypal_signature', get_setting('paypal_signature', 'payment'), ['class' => 'form-control', 'placeholder' => get_string('paypal_signature')])}}
                            {{Form::label('paypal_signature', get_string('paypal_signature'))}}
                            @if($errors->has('paypal_signature'))
                                <span class="wrong-error">* {{$errors->first('paypal_signature')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('paypal_sandbox') ? 'has-error' : ''}}">
                            {{Form::select('paypal_sandbox', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('paypal_sandbox', 'payment'), ['class' => 'form-control'])}}
                            {{Form::label('paypal_sandbox', get_string('paypal_sandbox'))}}
                            @if($errors->has('paypal_sandbox'))
                                <span class="wrong-error">* {{$errors->first('paypal_sandbox')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="card-panel">
                            <span class="primary-color">*{{get_string('note_for_paypal')}}</span>
                        </div>
                    </div>
                </div>
                <div id="stripe" class="tab-pane">
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('allow_stripe') ? 'has-error' : ''}}">
                            {{Form::select('allow_stripe', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('allow_stripe', 'payment'), ['class' => 'form-control'])}}
                            {{Form::label('allow_stripe', get_string('allow_stripe'))}}
                            @if($errors->has('allow_stripe'))
                                <span class="wrong-error">* {{$errors->first('allow_stripe')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('stripe_secret_api_key') ? 'has-error' : ''}}">
                            {{Form::text('stripe_secret_api_key', get_setting('stripe_secret_api_key', 'payment'), ['class' => 'form-control', 'placeholder' => get_string('stripe_secret_api_key')])}}
                            {{Form::label('stripe_secret_api_key', get_string('stripe_secret_api_key'))}}
                            @if($errors->has('stripe_secret_api_key'))
                                <span class="wrong-error">* {{$errors->first('stripe_secret_api_key')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('stripe_public_api_key') ? 'has-error' : ''}}">
                            {{Form::text('stripe_public_api_key', get_setting('stripe_public_api_key', 'payment'), ['class' => 'form-control', 'placeholder' => get_string('stripe_public_api_key')])}}
                            {{Form::label('stripe_public_api_key', get_string('stripe_public_api_key'))}}
                            @if($errors->has('stripe_public_api_key'))
                                <span class="wrong-error">* {{$errors->first('stripe_public_api_key')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="card-panel">
                            <span class="primary-color">*{{get_string('note_for_stripe')}}</span>
                        </div>
                    </div>
                </div>
                <div id="withdrawal" class="tab-pane">
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('bank_withdrawal') ? 'has-error' : ''}}">
                            {{Form::select('bank_withdrawal', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('bank_withdrawal', 'payment'), ['class' => 'form-control'])}}
                            {{Form::label('bank_withdrawal', get_string('bank_withdrawal'))}}
                            @if($errors->has('bank_withdrawal'))
                                <span class="wrong-error">* {{$errors->first('bank_withdrawal')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('paypal_withdrawal') ? 'has-error' : ''}}">
                            {{Form::select('paypal_withdrawal', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('paypal_withdrawal', 'payment'), ['class' => 'form-control'])}}
                            {{Form::label('paypal_withdrawal', get_string('paypal_withdrawal'))}}
                            @if($errors->has('paypal_withdrawal'))
                                <span class="wrong-error">* {{$errors->first('paypal_withdrawal')}}</span>
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
