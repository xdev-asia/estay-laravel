@extends('layouts.admin')

@section('title')
    <title>{{get_string('reviews') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('reviews')}}</h3>
@endsection
<div class="col s12">
    @if($reviews->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('username')}}</th>
                    <th>{{get_string('review')}}</th>
                    <th>{{get_string('item')}}</th>
                    <th>{{get_string('status')}}</th>
                    <th>{{get_string('rating')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr class="{{ $review->status ? 'disabled-style' : '' }}">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$review->id}}" />
                            <label for="{{$review->id}}"></label>
                        </td>
                        <td>@if($review->user){{$review->user->username}}@else <i class="small material-icons color-red">clear</i> @endif</td>
                        <td>{{ str_limit($review->review, 50, '...')}} <a href="#review-modal" data-toggle="modal" data-id="{{$review->id}}" class="more-button"><i class="small material-icons color-primary">add</i></a></td>
                        <td>@if($review->property_id && $review->property){{$review->property->contentDefault->name}}@elseif($review->service_id && $review->service){{ $review->service->contentDefault->name }}@else<i class="small material-icons color-red">clear</i> @endif</td>
                        <td class="review-status">{{$review->status ? get_string('approved') : get_string('pending')}}</td>
                        <td><?php for($i = 0; $i < $review->rating; $i++) echo '<i class="small material-icons color-yellow">grade</i>' ?></td>
                        <td>
                            <div class="icon-options">
                                <a href="#" class="confirm-button" data-id="{{$review->id}}" title="{{get_string('accept_review')}}"><i class="small material-icons color-primary">done</i></a>
                                <a href="#" class="delete-button" data-id="{{$review->id}}" title="{{get_string('delete_review')}}"><i class="small material-icons color-red">delete</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$reviews->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection
@section('footer')
    <div id="review-modal" class="modal not-summernote fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                    <strong class="modal-title">{{get_string('full_review')}}</strong>
                </div>
                <div class="modal-body" id="full-review"></div>
                <div class="modal-footer">
                    <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#review-modal").on('hidden.bs.modal', function () {
                $('#full-review').html('');
            });
            $('.confirm-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var status = $('.review-status', selector);
                var token = $('.token').val();
                if(!selector.hasClass('disabled-style')) {
                    bootbox.confirm({
                        title: '{{get_string('confirm_action')}}',
                        message: '{{get_string('approve_review_confirm')}}',
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
                                    url: '{{ url('/admin/review/complete/') }}/' + id,
                                    type: 'post',
                                    data: {_token: token},
                                    success: function (msg) {
                                        selector.addClass('disabled-style');
                                        status.html('{{get_string('approved')}}');
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
            $('.more-button').click(function(){
                var id = $(this).data('id');
                var token = $('.token').val();
                $.ajax({
                    url: '{{ url('/admin/review/getReview') }}/'+id,
                    type: 'post',
                    data: {_token :token},
                    success:function(msg) {
                        $('#full-review').html(msg);
                    },
                    error:function(msg){
                        toastr.error(msg.responseJSON);
                    }
                });
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
                                url: '{{ url('/admin/review/delete') }}/'+id,
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
                var status = $('.review-status', selector);
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
                                    url: '{{ url('/admin/review/dismiss/') }}/'+id,
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
