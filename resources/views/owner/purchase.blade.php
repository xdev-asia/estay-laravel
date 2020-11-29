@extends('layouts.owner')

@section('title')
    <title>{{get_string('purchases') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('purchases')}}</h3>
@endsection
<div class="col s12">
    @if($purchases->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('points_purchased')}}</th>
                    <th>{{get_string('price')}}</th>
                    <th>{{get_string('transaction')}}</th>
                    <th>{{get_string('payment_method')}}</th>
                    <th>{{get_string('date_of_purchase')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($purchases as $purchase)
                    <tr class="{{ $purchase->completed ? 'disabled-style' : '' }}">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$purchase->id}}" />
                            <label for="{{$purchase->id}}"></label>
                        </td>
                        <td>{{ $purchase->points }}</td>
                        <td>{{ $purchase->price }} {{ $currency }}</td>
                        <td>{{ $purchase->transaction }}</td>
                        <td>{{ $purchase->method }}</td>
                        <td>{{ date(get_setting('dateformat', 'site'), strtotime($purchase->created_at)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$purchases->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection
