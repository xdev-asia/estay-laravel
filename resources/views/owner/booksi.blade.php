@extends('layouts.owner')

@section('title')
    <title>{{ get_string('booksi') }}</title>
@endsection

@section('page_title')
    <h3 class="page-title mbot10">{{get_string('booksi')}}</h3>
@endsection
@section('content')
    <div class="row mbot0">
        <div class="col s12">
            <div class="col s12">
                <ul class="booksi-menu">
                    <li>Script Name: <strong>Booksi</strong></li>
                    <li>Version: <strong>{{ config('app.version') }}</strong></li>
                    <li>Author: <a href="http://abxweb.com"><strong>{{ config('app.author') }}</strong></a></li>
                    <li>Contact: <a href="mailto:{{ config('app.contact') }}"><strong>{{ config('app.contact') }}</strong></a></li>
                    <li>Website: <a href="{{ config('app.website') }}"><strong>{{ config('app.website') }}</strong></a></li>
                    <li>Documentation: <a href="{{ config('app.documentation') }}"><strong>{{ config('app.documentation') }}</strong></a></li>
                    <li>Support: <a href="{{ config('app.support') }}"><strong>{{ config('app.support') }}</strong></a></li>
                    <li>Market: <a href="{{ config('app.market') }}"><strong>{{ config('app.market') }}</strong></a></li>
                    <li><strong>Contact us if you need any customization, we are happy to help you out. Thank you for using our script!</strong></li>
                    <li><strong>Please note that for any copyright infringement we will take legal action!</strong></li>
                </ul>
            </div>
        </div>
    </div>
@endsection