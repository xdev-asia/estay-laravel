@extends('layouts.owner')

@section('title')
    <title>{{get_string('booking') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('booking')}}</h3>
@endsection
<div class="col s12">
    @if($bookings->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('property')}}</th>
                    <th>{{get_string('start_date')}}</th>
                    <th>{{get_string('end_date')}}</th>
                    <th>{{get_string('guest_number')}}</th>
                    <th>{{get_string('total')}}</th>
                    <th>{{get_string('completed')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr class="{{ $booking->completed ? 'disabled-style' : '' }}">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$booking->id}}" />
                            <label for="{{$booking->id}}"></label>
                        </td>
                        <td>@if($booking->property_id && $booking->property) {{ $booking->property->contentDefault->name }} @elseif($booking->service) {{ $booking->service->contentDefault->name }} @endif</td>
                        <td>{{$booking->start_date}}</td>
                        <td>{{$booking->end_date}}</td>
                        <td>{{$booking->guest_number}}</td>
                        <td>{{$booking->total}} {{ $currency }}</td>
                        <td class="booking-status">{{$booking->completed ? get_string('yes') : get_string('no')}}</td>
                        <td>
                            <div class="icon-options">
                                <a href="#" class="confirm-button" data-id="{{$booking->id}}" title="{{get_string('approve_booking')}}"><i class="small material-icons color-primary">done</i></a>
                                <a href="#" class="reject-button" data-id="{{$booking->id}}" title="{{get_string('reject_booking')}}"><i class="small material-icons color-red">close</i></a>
                                <a href="#user-modal" data-toggle="modal" class="user-info" data-id="{{$booking->id}}" title="{{get_string('user_info')}}"><i class="small material-icons color-blue">person</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$bookings->links()}}
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
<script type="text/javascript">
    $(document).ready(function(){
        $("#user-modal").on('hidden.bs.modal', function () {
            $('#user-details').html('');
        });
        $('.user-info').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var token = $('.token').val();
            $.ajax({
                url: '{{ url('/owner/booking/user_details') }}/' + id,
                type: 'post',
                data: {_token: token},
                success: function (msg) {
                    var first_name = (typeof msg.first_name !== 'undefined') ? msg.first_name : '';
                    var last_name = (typeof msg.last_name !== 'undefined') ? msg.last_name : '';
                    var phone = (typeof msg.phone !== 'undefined') ? msg.phone : '';
                    var email = (typeof msg.email !== 'undefined') ? msg.email : '';
                    $('#user-details').html('<span class="first-name"><span>{{ get_string('first_name') }}: </span>'+ first_name +'</span><span class="email"><span>{{ get_string('email') }}: </span>'+ email +'</span><span class="phone"><span>{{ get_string('phone') }}: </span>'+ phone +'</span>');
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
            var status = $('.booking-status', selector);
            var token = $('.token').val();
            if(!selector.hasClass('disabled-style')) {
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('activate_booking_confirm')}}',
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
                                url: '{{ url('/owner/booking/activate') }}/' + id,
                                type: 'post',
                                data: {_token: token},
                                beforeSend: function(){
                                    $('.table').addClass('loading');
                                },
                                success: function (msg) {
                                    selector.addClass('disabled-style');
                                    status.html('{{get_string('yes')}}');
                                    toastr.success(msg);
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

        $('.reject-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var status = $('.booking-status', selector);
            var token = $('.token').val();
            if(!selector.hasClass('disabled-style')) {
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('reject_booking_confirm')}} <br/> <div id="reason" class="form-group"><textarea name="reason" class="form-control"></textarea></div>',
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
                        console.log(result, $('[name="reason"]').val() != '');
                        if (result) {
                            $.ajax({
                                url: '{{ url('/owner/booking/reject') }}/' + id,
                                type: 'post',
                                data: {_token: token, reason: $('[name="reason"]').val()},
                                beforeSend: function(){
                                    $('.table').addClass('loading');
                                },
                                success: function (msg) {
                                    selector.addClass('disabled-style');
                                    status.html('{{get_string('yes')}}');
                                    toastr.success(msg);
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
    });
</script>
@endsection