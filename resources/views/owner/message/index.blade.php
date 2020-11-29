@extends('layouts.owner')

@section('title')
    <title>{{get_string('messages') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('message_threads')}}</h3>
@endsection
 @if(Session::has('success_message_sent'))
    <div class="col s12">
        <div class="col s12 text-centered">
            <h5 class="color-primary">{{ get_string('success_message_sent') }}</h5>
        </div>
    </div>
 @endif
<div class="col s12">
    @if($threads->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('between')}}</th>
                    <th>{{get_string('updated')}}</th>
                    <th>{{get_string('created')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($threads as $thread)
                    <tr class="{{ $thread->closed ? 'disabled-style' : '' }}">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$thread->id}}" />
                            <label for="{{$thread->id}}"></label>
                        </td>
                        <td @if($thread->status == 1) class="color-red" @endif>
                            {{$thread->user ? $thread->user->username : '' }} - {{  $thread->owner ? $thread->owner->username : '' }}</td>
                        <td>{{ $thread->updated_at->diffForHumans() }}</td>
                        <td>{{ $thread->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="icon-options">
                                @if(!$thread->closed) 
                                    <a class="edit-button" href="{{route('owner_message_list', $thread->id)}}"><i class="small material-icons color-primary">message</i></a>
                                <a href="#" class="close-button" data-id="{{$thread->id}}"><i class="small material-icons color-red">close</i></a>
                                @endif
                                <a href="#" class="delete-button" data-id="{{$thread->id}}"><i class="small material-icons color-red">delete</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$threads->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection

@section('footer')
<script type="text/javascript">
    $(document).ready(function(){

         $('.close-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var status = $('.booking-status', selector);
            var token = $('.token').val();
            if(!selector.hasClass('disabled-style')) {
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('message_close_confirm')}}',
                    onEscape: true,
                    backdrop: true,
                    buttons: {
                        cancel: {
                            label: '{{get_string('no')}}',
                            className: 'btn waves-effect'
                        },
                        confirm: {
                            label: '{{get_string('yes')}}',
                            className: 'btn waves-effect'
                        }
                    },
                    callback: function (result) {
                        if (result) {
                            $.ajax({
                                url: '{{ url('/owner/message/close') }}/' + id,
                                type: 'post',
                                data: {_token: token},
                                beforeSend: function(){
                                    $('.table').addClass('loading');
                                },
                                success: function (msg) {
                                    selector.addClass('disabled-style');
                                    status.html('{{get_string('yes')}}');
                                    toastr.success(msg);
                                    $('.close-button').hide();
                                    $('.edit-button').hide();
                                    $('.table').removeClass('loading');
                                },
                                error: function (msg) {
                                    toastr.error(msg.responseJSON);
                                    $('.table').removeClass('loading');
                                }
                            });
                        }
                    }
                });
            }
        });

        $('.delete-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var token = $('.token').val();
            bootbox.confirm({
                title: '{{get_string('confirm_action')}}',
                message: '{{get_string('delete_confirm')}}',
                onEscape: true,
                backdrop: true,
                buttons: {
                    cancel: {
                        label: '{{get_string('no')}}',
                        className: 'btn waves-effect'
                    },
                    confirm: {
                        label: '{{get_string('yes')}}',
                        className: 'btn waves-effect'
                    }
                },
                callback: function (result) {
                    if(result){
                        $.ajax({
                            url: '{{ url('/owner/message/delete') }}/'+id,
                            type: 'post',
                            data: {_token :token},
                            success:function(msg) {
                                selector.remove();
                                toastr.success(msg);
                            },
                            error:function(msg){
                                toastr.error(msg.responseJSON);
                            }
                        });
                    }
                }
            });
        });
    });
</script>
@endsection