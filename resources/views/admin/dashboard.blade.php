@extends('layouts.admin')

@section('title')
<title>{{get_string('dashboard') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

    @section('page_title')
        <h3 class="page-title mbot10">{{get_string('dashboard')}}</h3>
    @endsection
        @section('content')
            <div class="row mbot0">
                <div class="col s12">
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">payment</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter">{{ $data['new_properties'] }}</strong><br>
                                        <span>{{get_string('new_listings')}}</span>
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
                                        <i class="medium material-icons">thumb_up</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter">{{ $data['new_bookings'] }}</strong><br>
                                        <span>{{get_string('new_bookings')}}</span>
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
                                        <i class="medium material-icons">supervisor_account</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter">{{ $data['new_members'] }}</strong><br>
                                        <span>{{get_string('new_members')}}</span>
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
                                        <i class="medium material-icons">info_outline</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter">{{ $data['new_visits'] }}</strong><br>
                                        <span>{{get_string('visits_today')}}</span>
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
                            <th>{{get_string('user')}}</th>
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
                                <td>@if($purchase->user){{ $purchase->user->username }} @endif</td>
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
            </div>
            <div class="col l4 m12 s12 clearfix">
                <h3 class="page-title">{{get_string('latest_visits')}}</h3>
                <canvas id="visits-chart" width="420" height="297"></canvas>
            </div>
            <div class="col l4 m12 s12">
                <h3 class="page-title">{{get_string('latest_bookings')}}</h3>
                <canvas id="booking-chart" width="420" height="297"></canvas>
            </div>
            <div class="col l4 m12 s12">
                <h3 class="page-title">{{get_string('latest_payments')}}</h3>
                <canvas id="purchases-chart" width="420" height="297"></canvas>
            </div>
@endsection

@section('footer')
    <script src="{{URL::asset('assets/js/plugins/chart.min.js')}}"></script>
    <script>
        $(document).ready(function($) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });

            // Generating chart
            Chart.defaults.global.legend.display = false;
            var ctx = $('#visits-chart');
            if(ctx.length){
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels:[
                                @foreach ($data['data_range'] as $date)
                                    "{{$date}}",
                                @endforeach
                            ],
                        datasets:[ {
                            label: "{{ get_string('data') }}",
                            backgroundColor: "rgba(0,150,136, 0.4)",
                            borderColor: "#009688",
                            pointBorderColor: "#009688",
                            pointBackgroundColor: "#009688",
                            pointHoverBackgroundColor: "#009688",
                            pointHoverBorderColor: "#009688",
                            pointBorderWidth: 1,
                            data: {{$data['visits_data'] }},
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }]
                        }
                    }
                });
            }

            // Generating chart
            Chart.defaults.global.legend.display = false;
            var ctx = $('#booking-chart');
            if(ctx.length){
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels:[
                            @foreach ($data['data_range'] as $date)
                                    "{{$date}}",
                            @endforeach
                        ],
                        datasets:[ {
                            label: "{{ get_string('data') }}",
                            backgroundColor: "rgba(0,150,136, 0.4)",
                            borderColor: "#009688",
                            pointBorderColor: "#009688",
                            pointBackgroundColor: "#009688",
                            pointHoverBackgroundColor: "#009688",
                            pointHoverBorderColor: "#009688",
                            pointBorderWidth: 1,
                            data: {{$data['bookings_data'] }}
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }]
                        }
                    }
                });
            }

            // Generating chart
            Chart.defaults.global.legend.display = false;
            var ctx = $('#purchases-chart');
            if(ctx.length){
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels:[
                            @foreach ($data['data_range'] as $date)
                                "{{$date}}",
                            @endforeach
                        ],
                        datasets:[ {
                            label: "{{ get_string('data') }}",
                            backgroundColor: "rgba(0,150,136, 0.4)",
                            borderColor: "#009688",
                            pointBorderColor: "#009688",
                            pointBackgroundColor: "#009688",
                            pointHoverBackgroundColor: "#009688",
                            pointHoverBorderColor: "#009688",
                            pointBorderWidth: 1,
                            data: {{$data['purchases_data'] }}
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }]
                        }
                    }
                });
            }
        });
    </script>
@endsection
