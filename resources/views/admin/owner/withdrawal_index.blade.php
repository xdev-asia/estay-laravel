@extends('layouts.admin')

@section('title')
    <title>{{get_string('withdrawals') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('withdrawals')}} {{ $user }}</h3>
@endsection
<div class="col s12">
    @if($withdrawals->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('username')}}</th>
                    <th>{{get_string('payment_method')}}</th>
                    <th>{{get_string('amount')}}</th>
                    <th>{{get_string('completed')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($withdrawals as $withdrawal)
                    <tr class="{{ $withdrawal->status ? 'disabled-style' : '' }}">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$withdrawal->id}}" />
                            <label for="{{$withdrawal->id}}"></label>
                        </td>
                        <td>@if($withdrawal->user){{ $withdrawal->user->username }}@endif</td>
                        <td>{{ $withdrawal->method }}</td>
                        <td>{{ $withdrawal->amount }} {{ $currency }}</td>
                        <td class="request-status">{{$withdrawal->status ? get_string('yes') : get_string('no')}}</td>
                        <td>
                         <div class="icon-options">
                            <a href="#user-modal" data-toggle="modal" class="user-info" data-id="{{$withdrawal->id}}" title="{{get_string('user_info')}}"><i class="small material-icons color-blue">person</i></a>
                            <a href="#" class="confirm-button" data-id="{{$withdrawal->id}}"><i class="small material-icons color-primary">done</i></a>
                            <a href="#" class="dismiss-button" data-id="{{$withdrawal->id}}"><i class="small material-icons color-red">clear</i></a>
                            <a href="#" class="delete-button" data-id="{{$withdrawal->id}}"><i class="small material-icons color-red">delete</i></a>
                        </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$withdrawals->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection
@section('footer')
     <div id="user-modal" class="modal not-summernote fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                    <strong class="modal-title">{{get_string('user_info')}}</strong>
                </div>
                <div class="modal-body" id="user-details"></div>
                <div class="modal-footer">
                    <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#user-modal").on('hidden.bs.modal', function () {
                $('#user-details').html('');
            });

            $('.user-info').click(function(e){
                e.preventDefault();
                var id = $(this).data('id');
                var token = $('.token').val();
                $.ajax({
                    url: '{{ url('/admin/owner/withdrawal/details') }}/' + id,
                    type: 'post',
                    data: {_token: token},
                    success: function (msg) {
                        $('#user-details').html(msg);
                    },
                    error: function (msg) {
                        toastr.error(msg.responseJSON);
                    }
                });
            });

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
                                    url: '{{ url('/admin/owner/withdrawal/complete/') }}/' + id,
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
                                url: '{{ url('/admin/owner/withdrawal/delete') }}/'+id,
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
                                    url: '{{ url('/admin/owner/withdrawal/dismiss/') }}/'+id,
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