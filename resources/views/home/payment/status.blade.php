@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['payments']}} - {{ $static_data['site_settings']['site_name'] }}</title>
    <meta charset="UTF-8">
    <meta name="title" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta name="description" content="{{ $static_data['site_settings']['site_description'] }}">
    <meta name="keywords" content="{{ $static_data['site_settings']['site_keywords'] }}">
    <meta name="author" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta property="og:title" content="{{ $static_data['site_settings']['site_name'] }}" />
    <meta property="og:image" content="{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}" />
@endsection
@section('bg')
    {{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}
@endsection
@section('content')
    <div class="row  marginalized justify-content-center">
        <div class="col-sm-12">
            <h1 class="section-title-dark">{{$static_data['strings']['pay_for_your_book']}}</h1>
         @if(Session::has('payment_status')) <?php $status = Session::get('payment_status'); ?>
	        <div class="col-sm-12">
	            <div class="col-sm-12 text-centered">
	                <h5 class="@if(!$status['status']) red-color @else green-color @endif">{{ $status['msg'] }}</h5>
	            </div>
	        </div>
            <script type="text/javascript">
                setTimeout(function(){window.location = '/'}, 4000);
            </script>
         @endif
        </div>
        <p class="primary-color text-centered"><strong>{{ $static_data['strings']['redirected_to_dashboard'] }}</strong></p>
    </div>
@endsection