@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{  $static_data['strings']['please_activate_account_first'] }}</title>
@endsection
@section('bg')
    {{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}
@endsection
@section('content')
    <div class="row  marginalized">
        <div class="col-sm-12">
            <h1 class="section-title-dark">{{ $static_data['strings']['please_activate_account_first'] }}</h1>
        </div>
    </div>
@endsection