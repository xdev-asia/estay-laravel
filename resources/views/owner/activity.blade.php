@extends('layouts.owner')

@section('title')
    <title>{{get_string('activities') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('activities')}}</h3>
@endsection
<div class="col s12">
    @if($activities->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('activity')}}</th>
                    <th>{{ get_string('item')  }}</th>
                    <th>{{get_string('points')}}</th>
                    <th>{{get_string('date')}}</th>
                    <th>{{get_string('end_date')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($activities as $activity)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$activity->id}}" />
                            <label for="{{$activity->id}}"></label>
                        </td>
                        <td>{{ $activity->activity }}</td>
                        <td>@if($activity->property_id && $activity->property) {{ $activity->property->contentDefault->name }} @elseif($activity->service) {{ $activity->service->contentDefault->name }} @endif</td>
                        <td>{{ $activity->points }}</td>
                        <td>{{ date(get_setting('dateformat', 'site'), strtotime($activity->created_at)) }}</td>
                        <td>{{ date(get_setting('dateformat', 'site'), strtotime($activity->end_date)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$activities->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection