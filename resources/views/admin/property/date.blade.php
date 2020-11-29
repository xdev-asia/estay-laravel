@extends('layouts.admin')

@section('title')
    <title>{{get_string('property_availability') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('property_availability')}} - {{ $property->contentDefault->name }}</h3>
@endsection
<div class="col l6 m6 s12">
    <div id="datepicker"></div>
</div>
<div class="col l6 m6 s12 pull-right">
    <h3 class="page-title mbot10">{{ get_string('legend') }}</h3>
    <div class="boxed-legend-1">
        <span>{{ get_string('past_days') }}</span>
    </div>
    <div class="boxed-legend-2">
        <span>{{ get_string('today') }}</span>
    </div>
    <div class="boxed-legend-3">
        <span>{{ get_string('selected_days') }}</span>
    </div>
    <div class="boxed-legend-1">
        <span>{{ get_string('booked_days') }}</span>
    </div>
    <h3 class="page-title mbot10">{{ get_string('information') }}</h3>
    <p>{{ get_string('dates_explanation') }} </p>
    {!! Form::open(['method' => 'post', 'url' => route('admin_property_update_dates')])!!}
    {{ Form::hidden('dates', null, ['id' => 'dates-input']) }}
    {{ Form::hidden('property_id', $property->id) }}
    <button class="btn waves-effect" type="submit" name="action">{{get_string('update_dates')}}</button>
    {!! Form::close() !!}
</div>
@endsection

@section('footer')
    <script src="{{URL::asset('assets/js/plugins/multidatespicker.min.js')}}"></script>
    <script type="text/javascript">
        var booked_dates = [];
        var dateToday = new Date();

         // Get Booked Dates
            @if(count($property->booking))
                    @foreach($property->booking as $booking)
        var start_date = new Date('{{ $booking->start_date }}');
        var end_date = new Date('{{ $booking->end_date }}');
        while(start_date < end_date){
                booked_dates.push(start_date);
            var newDate = start_date.setDate(start_date.getDate() + 1);
            start_date = new Date(newDate);
        }
                    @endforeach
                @endif

        // Get Owner dates
        var dates = [];
        @if(count($property->prop_dates) && $property->prop_dates->dates)
                @foreach($property->prop_dates->dates as $date)
        var start_date = new Date('{{ $date }}');
        dates.push(start_date);
                @endforeach
        @endif

        // Generate datepicker
        $(document).ready(function(){
            $('#datepicker').multiDatesPicker({
                minDate: dateToday,
                altField: '#dates-input',
                addDisabledDates: booked_dates.length ? booked_dates : '',
                addDates: dates.length ? dates : '',
            });
        });
    </script>
@endsection