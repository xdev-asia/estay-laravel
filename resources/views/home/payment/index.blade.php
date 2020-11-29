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
            @if (Session::has('activationSuccess'))
                <p class="section-subtitle-light text-centered green-color"><strong>{{ $static_data['strings']['account_successfully_activated'] }}</strong></p>
            @endif
        </div>
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-inverse">
                    <tr>
                        <th>{{ get_string('property') }}</th>
                        <th>{{ get_string('start_date') }}</th>
                        <th>{{ get_string('end_date') }}</th>
                        <th>{{ get_string('guest_number') }}</th>
                        <th>{{ get_string('total') }}</th>
                        <th>{{ get_string('fees') }}</th>
                        <th>{{ get_string('grand_total') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $property }}</td>
                            <td>{{ $start_date }}</td>
                            <td>{{ $end_date }}</td>
                            <td>{{ $guest_number }}</td>
                            <td>{{ $total .' '. $currency }}</td>
                            <td>{{ $fees .' '. $currency }}</td>
                            <td>{{ $grand_total .' '. $currency }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-12">
            {!! Form::open(['method' => 'post', 'url' => route('booking_pay'), 'id' => 'payment-form']) !!}
                <div class="form-group  {{$errors->has('gateway') ? 'has-error' : ''}}">
                    {{Form::select('gateway', $gateways, null, ['class' => 'form-control', 'id' => 'type', 'required', 'placeholder' => $static_data['strings']['choose_payment_method']] )}}
                    @if($errors->has('gateway'))
                        <span class="wrong-error">* {{$errors->first('gateway')}}</span>
                    @endif
                </div>
                <div class="stripe-payment hidden">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <p> {{ $static_data['strings']['enter_your_payment_details'] }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div id="card-element"></div>
                            <div id="card-errors"></div>
                        </div>
                    </div>
                </div>
                {{ Form::hidden('user_id', $user_id) }}
                {{ Form::hidden('owner_id', $owner_id) }}
                {{ Form::hidden('property_id', $property_id) }}
                {{ Form::hidden('property_name', $property) }}
                {{ Form::hidden('start_date', $start_date) }}
                {{ Form::hidden('end_date', $end_date) }}
                {{ Form::hidden('phone', $phone) }}
                {{ Form::hidden('email', $email) }}
                {{ Form::hidden('guest_number', $guest_number) }}
                {{ Form::hidden('first_name', $first_name) }}
                <button class="primary-button mtop20" type="submit" name="action">{{ $static_data['strings']['book_now'] }}</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('footer')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#type").change(function(){
                var value = $(this).find("option:selected").val();
                var selector = $('.stripe-payment');
                switch (value){
                    case '1': selector.removeClass('hidden'); break;
                    default: selector.addClass('hidden'); break;
                }
            });
            var stripe = Stripe('{{ get_setting('stripe_public_api_key', 'payment') }}');
            var elements = stripe.elements();
            var style = {
                base: {
                    color: '#34495e',
                    lineHeight: '24px',
                    fontFamily: 'PT Sans',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#34495e'
                    }
                },
                invalid: {
                    color: '#D32F2F',
                    iconColor: '#D32F2F'
                }
            };
            var classes = {
                base: 'form-control',
            };
            var card = elements.create('card', {style: style, classes:classes});
            card.mount('#card-element');
            card.addEventListener('change', function(event) {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                if(!$('.stripe-payment').hasClass('hidden')){
                    stripe.createToken(card).then(function(result) {
                        if (result.error) {
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            stripeTokenHandler(result.token);
                        }
                    });
                }else{
                    form.submit();
                }
            });
            function stripeTokenHandler(token) {
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    </script>
@endsection