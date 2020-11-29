@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>404! - {{ $static_data['site_settings']['site_name'] }}</title>
@endsection
@section('bg')
        {{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}
@endsection
@section('content')
    <div class="row  marginalized">
        <div class="col-sm-12">
            <h1 class="section-title-dark">404! <br>{{ $static_data['strings']['you_broke_internet'] }}</h1>
        </div>
    </div>
@endsection