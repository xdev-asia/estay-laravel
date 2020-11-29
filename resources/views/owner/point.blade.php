@extends('layouts.owner')

@section('title')
    <title>{{get_string('points') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('page_title')
    <h3 class="page-title mbot10">{{get_string('points')}}</h3>
@endsection
@section('content')
    <div class="row mbot0">
        @if(Session::has('payment_status')) <?php $status = Session::get('payment_status'); ?>
        <div class="col s12">
            <div class="col s12 text-centered">
                <h5 class="@if(!$status['status']) color-red @else color-primary @endif">{{ $status['msg'] }}</h5>
                <p>{{ get_string('redirected_to_dashboard') }}</p>
            </div>
            <?php Session::pull('payment_status') ?>
            <script type="text/javascript">
                setTimeout(function(){window.location = '/owner/points'}, 4000);
            </script>
        </div>
        @else
            <div class="col s12">
                <div class="col s12"><p>{{ get_string('buy_points_text') }}</p>
                    {!! Form::open(['method' => 'post', 'url' => route('owner_point_payment'), 'id' => 'payment-form']) !!}
                    <div class="form-group  {{$errors->has('package') ? 'has-error' : ''}}">
                        {{Form::select('package', $packages, null, ['class' => 'form-control', 'required', 'placeholder' => get_string('choose_your_package')])}}
                        @if($errors->has('package'))
                            <span class="wrong-error">* {{$errors->first('package')}}</span>
                        @endif
                    </div>
                    <div class="form-group  {{$errors->has('gateway') ? 'has-error' : ''}}">
                        {{Form::select('gateway', $gateways, null, ['class' => 'form-control', 'id' => 'type', 'required', 'placeholder' => get_string('choose_payment_method')])}}
                        @if($errors->has('gateway'))
                            <span class="wrong-error">* {{$errors->first('gateway')}}</span>
                        @endif
                    </div>
                    <div class="stripe-payment hidden">
                        <div class="row">
                            <div class="col s12">
                                <p> {{ get_string('enter_your_payment_details') }}</p>
                            </div>
                            <div class="col s6">
                                <div id="card-element"></div>
                                <div id="card-errors"></div>
                            </div>
                        </div>
                    </div>
                    {{Form::hidden('user_id', Auth::user()->id)}}
                    <button class="btn waves-effect" type="submit" name="action">{{get_string('buy_points')}}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        @endif
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