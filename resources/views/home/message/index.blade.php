@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['messages']}} - {{ $static_data['site_settings']['site_name'] }}</title>
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
    <div class="row  marginalized">
        <div class="col-sm-12">
            <h1 class="section-title-dark">{{$static_data['strings']['messages']}}</h1>
            @if(Session::has('success_message_sent') )
                <p class="green-color text-centered">{{ $static_data['strings']['success_message_sent'] }}</p>
            @endif
        </div>
        @if(count($threads))
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-inverse">
                        <tr>
                            <th>{{$static_data['strings']['between']}}</th>
                            <th>{{$static_data['strings']['updated']}}</th>
                            <th>{{$static_data['strings']['created']}}</th>
                            <th>{{$static_data['strings']['status']}}</th>
                            <th>{{$static_data['strings']['options']}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($threads as $thread)
                            <tr>
                                <td @if($thread->status == 2) class="red-color" @endif>{{ $thread->user ? $thread->user->username : '' }} - {{  $thread->owner ? $thread->owner->username : '' }}</td>
                                <td>{{ $thread->updated_at->diffForHumans() }}</td>
                                <td>{{ $thread->created_at->diffForHumans() }}</td>
                                <td>{{ $thread->closed ?  $static_data['strings']['closed'] : $static_data['strings']['open'] }}</td>
                                <td class="booking-status">
                                    @if(!$thread->closed) 
                                        <a class="edit-button" href="{{route('message_list', $thread->id)}}"><i class="fa fa-comments-o primary-color"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="col-sm-12">
                <p class="text-centered">{{ $static_data['strings']['no_results'] }}</p>
            </div>
        @endif
    </div>
@endsection