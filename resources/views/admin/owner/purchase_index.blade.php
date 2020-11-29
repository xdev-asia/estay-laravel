@extends('layouts.admin')

@section('title')
    <title>{{get_string('purchases') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('purchases')}} - {{ $user }}</h3>
@endsection
<div class="col s8 right right-align mbot10">
    <a href="{{route('admin_owner')}}" class="btn waves-effect"> {{get_string('owner_all')}}</a>
</div>
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
                    <th>{{get_string('username')}}</th>
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
                        <td>@if($purchase->user){{ $purchase->user->username }}@endif</td>
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
@section('footer')
    <script>
        $(document).ready(function(){
            $('.confirm-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var status = $('.purchase-status', selector);
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
                                    url: '{{ url('/admin/user/purchase/complete/') }}/' + id,
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
                                url: '{{ url('/admin/user/purchase/delete') }}/'+id,
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
                var status = $('.purchase-status', selector);
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
                                    url: '{{ url('/admin/user/purchase/dismiss/') }}/'+id,
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