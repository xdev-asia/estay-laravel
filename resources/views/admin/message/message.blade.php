@extends('layouts.admin')

@section('title')
    <title>{{get_string('messages') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('messages')}}</h3>
@endsection
<div class="col s12">
    {!! Form::open(['method' => 'post', 'url' => route('admin_message_reply', $thread->id)]) !!}
    <div class="form-group">
        {!! Form::textarea('message', null, ['class' => 'form-control', 'required', 'placeholder' => get_string('write_your_message')]) !!}
    </div>
    <button class="btn waves-effect" type="submit" name="action">{{get_string('reply')}}</button>
    {!! Form::close() !!}
</div>
<div class="col s12">
    <h3 class="page-title mbot10">{{get_string('messages')}}</h3>
    <div id="messages">
        @foreach($messages as $message)
            <div class="message {{ $message->user ? 'user-message' : 'owner-message' }} ">{{ $message->message }}</div>
        @endforeach  
    </div>
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection
