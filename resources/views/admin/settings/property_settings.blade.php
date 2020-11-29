@extends('layouts.admin')

@section('title')
    <title>{{get_string('properties_settings') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('properties_settings')}}</h3>
@endsection
<div class="panel col s12">
    <div class="row">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a data-toggle="tab" href="#general_settings">{{get_string('general')}}</a></li>
            </ul>
        </div>
        {!! Form::open(['url' => route('admin_property_settings_update'), 'method' => 'post', 'id' => "property_settings", 'class' => 'table-responsive', 'files' => 'true']) !!}
        <div class="panel-body">
            <div class="tab-content">
                <div id="general_settings" class="tab-pane active">
                    <!-- <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('show_property_categories_0') ? 'has-error' : ''}}">
                            {{Form::select('show_property_categories_0', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_property_categories_0', 'property'), ['class' => 'form-control'])}}
                            {{Form::label('show_property_categories_0', get_string('show_property_categories_0'))}}
                            @if($errors->has('show_property_categories_0'))
                                <span class="wrong-error">* {{$errors->first('show_property_categories_0')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('show_property_types_0') ? 'has-error' : ''}}">
                            {{Form::select('show_property_types_0', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_property_types_0', 'property'), ['class' => 'form-control'])}}
                            {{Form::label('show_property_types_0', get_string('show_property_types_0'))}}
                            @if($errors->has('show_property_types_0'))
                                <span class="wrong-error">* {{$errors->first('show_property_types_0')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('show_property_locations_0') ? 'has-error' : ''}}">
                            {{Form::select('show_property_locations_0', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_property_locations_0', 'property'), ['class' => 'form-control'])}}
                            {{Form::label('show_property_locations_0', get_string('show_property_locations_0'))}}
                            @if($errors->has('show_property_locations_0'))
                                <span class="wrong-error">* {{$errors->first('show_property_locations_0')}}</span>
                            @endif
                        </div>
                    </div> -->
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('properties_approved_by_admin') ? 'has-error' : ''}}">
                            {{Form::select('properties_approved_by_admin', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('properties_approved_by_admin', 'property'), ['class' => 'form-control'])}}
                            {{Form::label('properties_approved_by_admin', get_string('properties_approved_by_admin'))}}
                            @if($errors->has('properties_approved_by_admin'))
                                <span class="wrong-error">* {{$errors->first('properties_approved_by_admin')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('allow_featured_properties') ? 'has-error' : ''}}">
                            {{Form::select('allow_featured_properties', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('allow_featured_properties', 'property'), ['class' => 'form-control'])}}
                            {{Form::label('allow_featured_properties', get_string('allow_featured_properties'))}}
                            @if($errors->has('allow_featured_properties'))
                                <span class="wrong-error">* {{$errors->first('allow_featured_properties')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('show_available_amenities_only') ? 'has-error' : ''}}">
                            {{Form::select('show_available_amenities_only', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_available_amenities_only', 'property'), ['class' => 'form-control'])}}
                            {{Form::label('show_available_amenities_only', get_string('show_available_amenities_only'))}}
                            @if($errors->has('show_available_amenities_only'))
                                <span class="wrong-error">* {{$errors->first('show_available_amenities_only')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('autoapprove_booking') ? 'has-error' : ''}}">
                            {{Form::select('autoapprove_booking', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('autoapprove_booking', 'property'), ['class' => 'form-control'])}}
                            {{Form::label('autoapprove_booking', get_string('autoapprove_booking'))}}
                            @if($errors->has('autoapprove_booking'))
                                <span class="wrong-error">* {{$errors->first('autoapprove_booking')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('show_first_image') ? 'has-error' : ''}}">
                            {{Form::select('show_first_image', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_first_image', 'property'), ['class' => 'form-control'])}}
                            {{Form::label('show_first_image', get_string('show_first_image'))}}
                            @if($errors->has('show_first_image'))
                                <span class="wrong-error">* {{$errors->first('show_first_image')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('filter_by_features') ? 'has-error' : ''}}">
                            {{Form::select('filter_by_features', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('filter_by_features', 'property'), ['class' => 'form-control'])}}
                            {{Form::label('filter_by_features', get_string('filter_by_features'))}}
                            @if($errors->has('filter_by_features'))
                                <span class="wrong-error">* {{$errors->first('filter_by_features')}}</span>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="col l6 m6 s6">
                        <div class="form-group  {{$errors->has('autoapprove_booking') ? 'has-error' : ''}}">
                            {{Form::select('phone_required_booking', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('phone_required_booking', 'property'), ['class' => 'form-control'])}}
                            {{Form::label('phone_required_booking', get_string('phone_required_booking'))}}
                            @if($errors->has('phone_required_booking'))
                                <span class="wrong-error">* {{$errors->first('phone_required_booking')}}</span>
                            @endif
                        </div>
                    </div> -->
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('guest_number_max') ? 'has-error' : ''}}">
                            {{Form::number('guest_number_max', get_setting('guest_number_max', 'property'), ['class' => 'form-control', 'min' => 1, 'placeholder' => get_string('guest_number_max')])}}
                            {{Form::label('guest_number_max', get_string('guest_number_max'))}}
                            @if($errors->has('guest_number_max'))
                                <span class="wrong-error">* {{$errors->first('guest_number_max')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('rooms_number_max') ? 'has-error' : ''}}">
                            {{Form::number('rooms_number_max', get_setting('rooms_number_max', 'property'), ['class' => 'form-control', 'min' => 1, 'placeholder' => get_string('rooms_number_max')])}}
                            {{Form::label('rooms_number_max', get_string('rooms_number_max'))}}
                            @if($errors->has('rooms_number_max'))
                                <span class="wrong-error">* {{$errors->first('rooms_number_max')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('price_range_max') ? 'has-error' : ''}}">
                            {{Form::number('price_range_max', get_setting('price_range_max', 'property'), ['class' => 'form-control', 'min' => 1, 'placeholder' => get_string('price_range_max')])}}
                            {{Form::label('price_range_max', get_string('price_range_max'))}}
                            @if($errors->has('price_range_max'))
                                <span class="wrong-error">* {{$errors->first('price_range_max')}}</span>
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
