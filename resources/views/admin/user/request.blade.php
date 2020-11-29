@extends('layouts.admin')

@section('title')
    <title>{{get_string('requests') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('requests')}}</h3>
@endsection
<div class="col s12">
    @if($requests->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('username')}}</th>
                    <th>{{get_string('request')}}</th>
                    <th>{{get_string('completed')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($requests as $request)
                    <tr class="{{ $request->completed ? 'disabled-style' : '' }}">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$request->id}}" />
                            <label for="{{$request->id}}"></label>
                        </td>
                        <td>@if($request->user){{$request->user->username}}@else <i class="small material-icons color-red">clear</i> @endif</td>
                        <td>{{$request->request ? '' : get_string('upgrade_request')}}</td>
                        <td class="request-status">{{$request->completed ? get_string('yes') : get_string('no')}}</td>
                        <td>
                            <div class="icon-options">
                                <a href="#" class="confirm-button" data-id="{{$request->id}}" title="{{get_string('accept_request')}}"><i class="small material-icons color-primary">done</i></a>
                                <a href="#" class="dismiss-button" data-id="{{$request->id}}" title="{{get_string('dismiss_request')}}"><i class="small material-icons color-red">clear</i></a>
                                <a href="#" class="delete-button" data-id="{{$request->id}}" title="{{get_string('delete_request')}}"><i class="small material-icons color-red">delete</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$requests->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection
@section('footer')
<script>
    $(document).ready(function(){
        $('.confirm-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var status = $('.request-status', selector);
            var token = $('.token').val();
            if(!selector.hasClass('disabled-style')) {
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('upgrade_confirm')}}',
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
                                url: '{{ url('/admin/user/request/complete/') }}/' + id,
                                type: 'post',
                                data: {_token: token},
                                success: function (msg) {
                                    selector.addClass('disabled-style');
                                    status.html('{{get_string('yes')}}');
                                    toastr.success(msg);
                                },
                                error: function (msg) {
                                    toastr.error(msg.responseJSON);
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
                            url: '{{ url('/admin/user/request/delete') }}/'+id,
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
        $('.dismiss-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var status = $('.request-status', selector);
            var token = $('.token').val();
            if(!selector.hasClass('disabled-style')){
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('upgrade_dismiss')}}',
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
                                url: '{{ url('/admin/user/request/dismiss/') }}/'+id,
                                type: 'post',
                                data: {_token :token},
                                success:function(msg) {
                                    selector.addClass('disabled-style');
                                    status.html('{{get_string('yes')}}');
                                    toastr.success(msg);
                                },
                                error:function(msg){
                                    toastr.error(msg.responseJSON);
                                }
                            });
                        }
                    }
                });
            }
        });
    });
</script>
@endsection