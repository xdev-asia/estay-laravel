@extends('layouts.owner')

@section('title')
    <title>{{get_string('prices') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('prices')}}</h3>
@endsection
<?php $points = get_string('points'); ?>
<div class="col s12">
    <div class="table-responsive">
        <table class="table bordered striped">
            <thead class="thead-inverse">
            <tr>
                <th>
                    <input type="checkbox" class="filled-in primary-color" id="select-all" />
                    <label for="select-all"></label>
                </th>
                <th>{{get_string('item')}}</th>
                <th>{{get_string('price')}}</th>
            </tr>
            </thead>
            <tbody>
            @if(get_setting('owners_entrance_fee', 'owner'))
                <tr>
                    <td>
                        <input type="checkbox" class="filled-in primary-color" id="" />
                        <label for=""></label>
                    </td>
                    <td>{{ get_string('entrance_fee') }}</td>
                    <td>{{ $settings['entrance_fee'] }} {{ $points }}</td>
                </tr>
            @endif
            <tr>
                <td>
                    <input type="checkbox" class="filled-in primary-color" id="" />
                    <label for=""></label>
                </td>
                <td>10 {{ $points }}</td>
                <td>{{ $settings['package_10'] }} {{ $currency }}</td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="filled-in primary-color" id="" />
                    <label for=""></label>
                </td>
                <td>30 {{ $points }}</td>
                <td>{{ $settings['package_30'] }} {{ $currency }}</td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="filled-in primary-color" id="" />
                    <label for=""></label>
                </td>
                <td>50 {{ $points }}</td>
                <td>{{ $settings['package_50'] }} {{ $currency }}</td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="filled-in primary-color" id="" />
                    <label for=""></label>
                </td>
                <td>100 {{ $points }}</td>
                <td>{{ $settings['package_100'] }} {{ $currency }}</td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="filled-in primary-color" id="" />
                    <label for=""></label>
                </td>
                <td>200 {{ $points }}</td>
                <td>{{ $settings['package_200'] }} {{ $currency }}</td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="filled-in primary-color" id="" />
                    <label for=""></label>
                </td>
                <td>{{ get_string('week_featured') }}</td>
                <td>{{ $settings['points_featured_week'] }} {{ $points }}</td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="filled-in primary-color" id="" />
                    <label for=""></label>
                </td>
                <td>{{ get_string('month_featured') }}</td>
                <td>{{ $settings['points_featured_month'] }} {{ $points }}</td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="filled-in primary-color" id="" />
                    <label for=""></label>
                </td>
                <td>{{ get_string('3months_featured') }}</td>
                <td>{{ $settings['points_featured_3months'] }} {{ $points }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
