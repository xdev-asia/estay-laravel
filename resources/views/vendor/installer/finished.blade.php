@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.final.title'))
@section('container')
        <p class="paragraph" style="text-align: center;margin-bottom: 20px;line-height: 20px;">You have installed Booksi but in order to use it you need to activate it first!</p>
    <div class="buttons">
        <a href="http://activate.booksicms.com/" target="_blank" class="button">Activate</a>
        <a href="{{ url('/') }}" class="button">{{ trans('installer_messages.final.exit') }}</a>
    </div>
@stop
