@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['my_account']}} - {{ $static_data['site_settings']['site_name'] }}</title>
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
            <h1 class="section-title-dark">{{$static_data['strings']['welcome']}} - {{ $static_data['user']->username }}</h1>
        </div>
        @if(Session::has('account_updated') )
            <p class="green-color">{{ $static_data['strings']['account_updated'] }}</p>
        @endif
        @if($request && get_setting('allow_user_requests', 'owner'))
        <div class="col-sm-12 text-centered request-completed  mbot20">
            <p class="section-subtitle-light "> {{ $static_data['strings']['update_account_request'] }} </p>
            <a href="#" class="primary-button request-upgrade" data-toggle="modal" data-target="#confirm-modal">{{ $static_data['strings']['request'] }}</a>
        </div>
        @endif
        <div class="col-sm-12 input-style">
            {!! Form::open(['method' => 'post', 'url' => route('user_update')]) !!}
            <div class="row">
                <div class="col-sm-12"><p class="section-subtitle-light text-centered"> {{ $static_data['strings']['update_account_info'] }} </p></div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('first_name') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-address-card-o input-group-addon"></span>
                            {{Form::text('first_name', $static_data['user']->user->first_name, ['class' => 'form-control', 'placeholder' => $static_data['strings']['first_name']])}}
                        </div>
                        @if($errors->has('first_name'))
                            <span class="wrong-error">* {{$errors->first('first_name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('last_name') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-address-card-o input-group-addon"></span>
                            {{Form::text('last_name', $static_data['user']->user->last_name, ['class' => 'form-control', 'placeholder' => $static_data['strings']['last_name']])}}
                        </div>
                        @if($errors->has('last_name'))
                            <span class="wrong-error">* {{$errors->first('last_name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('username') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-user input-group-addon"></span>
                            {{Form::text('username', $static_data['user']->username, ['class' => 'form-control', 'placeholder' => $static_data['strings']['username']])}}
                        </div>
                        @if($errors->has('username'))
                            <span class="wrong-error">* {{$errors->first('username')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('phone') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-phone input-group-addon"></span>
                            {{Form::text('phone', $static_data['user']->user->phone, ['class' => 'form-control', 'placeholder' => $static_data['strings']['phone']])}}
                        </div>
                        @if($errors->has('phone'))
                            <span class="wrong-error">* {{$errors->first('phone')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group  {{$errors->has('email') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-envelope input-group-addon"></span>
                            {{Form::email('email', $static_data['user']->email, ['class' => 'form-control', 'placeholder' => $static_data['strings']['email_address']])}}
                        </div>
                        @if($errors->has('email'))
                            <span class="wrong-error">* {{$errors->first('email')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('password') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-key input-group-addon"></span>
                            {{Form::password('password', ['class' => 'form-control', 'placeholder' => $static_data['strings']['password']])}}
                        </div>
                        @if($errors->has('password'))
                            <span class="wrong-error">* {{$errors->first('password')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-key input-group-addon"></span>
                            {{Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => $static_data['strings']['password_confirmation']])}}
                        </div>
                        @if($errors->has('password_confirmation'))
                            <span class="wrong-error">* {{$errors->first('password_confirmation')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 text-centered">
                    {!! Form::hidden('id', $static_data['user']->id, ['class' => 'hidden']) !!}
                    <button type="submit" name="action" class="primary-button">{{ $static_data['strings']['update'] }}</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        @if(count($bookings))
            <div class="col-sm-12">
                <h3 class="section-type mtop20">{{ $static_data['strings']['bookings'] }}</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-inverse">
                        <tr>
                            <th>{{$static_data['strings']['property']}}</th>
                            <th>{{$static_data['strings']['start_date']}}</th>
                            <th>{{$static_data['strings']['end_date']}}</th>
                            <th>{{$static_data['strings']['guest_number']}}</th>
                            <th>{{$static_data['strings']['total']}}</th>
                            <th>{{$static_data['strings']['completed']}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>@if($booking->property_id) {{ $booking->property->contentload->name }} @else {{ $booking->service->contentDefault->name }} @endif</td>
                                <td>{{$booking->start_date}}</td>
                                <td>{{$booking->end_date}}</td>
                                <td>{{$booking->guest_number}}</td>
                                <td>{{$booking->total}} {{ $currency }}</td>
                                <td class="booking-status">{{$booking->completed ? $static_data['strings']['yes'] : $static_data['strings']['no']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('footer')
    <!-- Modal -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ $static_data['strings']['confirm_action'] }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $static_data['strings']['request_confirm'] }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="primary-button" data-dismiss="modal">{{ $static_data['strings']['close'] }}</button>
                    <a href="#" data-id="{{ $static_data['user']->id }}" class="primary-button confirm-request" data-dismiss="modal">{{ $static_data['strings']['request'] }}</a>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('.confirm-request').click(function(e){
                            e.preventDefault();
                            var id = $(this).data('id'),
                                    token = $('[name="_token"]').val();
                            $.ajax({
                                url: '{{ url('/user-request') }}',
                                type: 'post',
                                data: {_token: token, id: id},
                                success: function(){
                                    var tmp = '{{ $static_data['strings']['text_for_request'] }}';
                                    $('.request-completed').html('<p class="section-subtitle-light ">' + tmp + '</p>');
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection