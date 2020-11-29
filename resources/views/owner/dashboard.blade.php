@extends('layouts.owner')

@section('title')
<title>{{get_string('dashboard') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

    @section('page_title')
        <h3 class="page-title mbot10">{{get_string('dashboard')}}</h3>
    @endsection
        @section('content')
            <div class="row mbot0">
                @if(true)
                 @if(Session::has('payment_status')) <?php $status = Session::get('payment_status'); ?>
                    <div class="col s12">
                        <div class="col s12 text-centered">
                            <h5 class="@if(!$status['status']) color-red @else color-primary @endif">{{ $status['msg'] }}</h5>
                        </div>
                    </div>
                 @endif
                <div class="col s12">
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">payment</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter">{{ $data['properties'] }}</strong><br>
                                        <span>{{get_string('properties')}}</span>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">attach_money</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter">{{ $data['pending_balance'] }}</strong> {{ $currency  }}<br>
                                        <span>{{get_string('pending_balance')}}</span>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">attach_money</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter">{{ $data['active_balance'] }}</strong> {{ $currency  }}<br>
                                        <span>{{ get_string('active_balance')}}</span>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">extension</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter">{{ $data['points'] }}</strong><br>
                                        <span>{{get_string('points')}}</span>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l6 m12 s12">
                <h3 class="page-title">{{get_string('latest_bookings')}}</h3>
                @if(count($bookings))
                <div class="table-responsive">
                <table id="latest-bookings" class="responsive-table bordered striped">
                    <thead class="thead-inverse">
                    <tr>
                        <th>#</th>
                        <th>{{get_string('property')}}</th>
                        <th>{{get_string('start_date')}}</th>
                        <th>{{get_string('end_date')}}</th>
                        <th>{{get_string('guest_number')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>
                                    <input type="checkbox" class="filled-in primary-color" id="{{$booking->id}}" />
                                    <label for="{{$booking->id}}"></label>
                                </td>
                                <td>@if($booking->property_id && $booking->property) {{ $booking->property->contentDefault->name }} @elseif($booking->service) {{ $booking->service->contentDefault->name }} @endif</td>
                                <td>{{ $booking->start_date }}</td>
                                <td>{{ $booking->end_date }}</td>
                                <td>{{ $booking->guest_number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @else
                <strong class="center-align">{{get_string('no_results')}}</strong>
                @endif
            </div>
            <div class="col l6 m12 s12">
                <h3 class="page-title">{{get_string('latest_purchases')}}</h3>
                @if(count($purchases))
                <div class="table-responsive">
                <table id="latest-purchases" class="responsive-table bordered striped">
                        <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>{{get_string('points_purchased')}}</th>
                            <th>{{get_string('price')}}</th>
                            <th>{{get_string('transaction')}}</th>
                            <th>{{get_string('date_of_purchase')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>
                                    <input type="checkbox" class="filled-in primary-color" id="{{$purchase->id}}" />
                                    <label for="{{$purchase->id}}"></label>
                                </td>
                                <td>{{ $purchase->points }}</td>
                                <td>{{ $purchase->price }} {{ $currency }}</td>
                                <td>{{ $purchase->transaction }}</td>
                                <td>{{ date(get_setting('dateformat', 'site'), strtotime($purchase->created_at)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                @else
                    <strong class="center-align">{{get_string('no_results')}}</strong>
                @endif
            @else
                @if(Session::has('payment_status')) <?php $status = Session::get('payment_status'); ?>
                        <div class="col s12">
                            <div class="col s12 text-centered">
                                <h5 class="@if(!$status['status']) color-red @else color-primary @endif">{{ $status['msg'] }}</h5>
                                <p>{{ get_string('redirected_to_dashboard') }}</p>
                            </div>
                            <?php Session::pull('payment_status') ?>
                            <script type="text/javascript">
                                setTimeout(function(){window.location = '/owner/dashboard'}, 4000);
                            </script>
                        </div>
                @else
                <div class="col s12">
                    <div class="col s12"><p>{{ get_string('entrance_fee_text') }}</p>
                    {!! Form::open(['method' => 'post', 'url' => route('owner_payment'), 'id' => 'payment-form']) !!}
                        <strong> {{ get_string('entrance_fee') . ' ' . get_string('is') }}: {{ get_setting('entrance_fee', 'payment') .' '. get_string('points')  }}</strong>
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
            @endif
        </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function($) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        });
    </script>
@endsection