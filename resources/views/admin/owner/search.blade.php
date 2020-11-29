@extends('layouts.admin')

@section('title')
    <title>{{get_string('search_results') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('search_results')}}</h3>
@endsection
<div class="col s8 right right-align mbot10">
    <a href="{{route('admin_owner')}}" class="btn waves-effect"> {{get_string('owner_all')}}</a>
</div>
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
    @if($owners->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('username')}}</th>
                    <th>{{get_string('email')}}</th>
                    <th>{{get_string('points')}}</th>
                    <th>{{get_string('properties')}}</th>
                    <th>{{get_string('services')}}</th>
                    <th>{{get_string('purchases')}}</th>
                    <th>{{get_string('activities')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($owners as $owner)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$owner->id}}" />
                            <label for="{{$owner->id}}"></label>
                        </td>
                        <td>{{$owner->username}}</td>
                        <td>{{$owner->email}}</td>
                        <td>{{$owner->owner->points}}</td>
                        <td><a href="{{ route('admin_owner_services', $owner->id) }}"><i class="material-icons">list</i></a></td>
                        <td><a href="{{ route('admin_owner_properties', $owner->id) }}"><i class="material-icons">list</i></a></td>
                        <td><a href="{{ route('admin_owner_purchases', $owner->id) }}"><i class="material-icons">list</i></a></td>
                        <td><a href="{{ route('admin_owner_activities', $owner->id) }}"><i class="material-icons">list</i></a></td>
                        <td>
                            <div class="icon-options">
                                <a href="{{ route('admin_owner_edit', $owner->owner->id) }}" class="edit-button" title="{{get_string('edit_user')}}"><i class="small material-icons color-primary">mode_edit</i></a>
                                <a href="#" class="delete-button" data-id="{{$owner->owner->id}}" title="{{get_string('delete_user')}}"><i class="small material-icons color-red">delete</i></a>
                                <a href="#" class="activate-button {{$owner->status ? 'hidden': ''}}" data-id="{{$owner->owner->id}}" title="{{get_string('activate_user')}}"><i class="small material-icons color-primary">done</i></a>
                                <a href="#" class="deactivate-button {{$owner->status ? '': 'hidden'}}" data-id="{{$owner->owner->id}}" title="{{get_string('deactivate_user')}}"><i class="small material-icons color-primary">close</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$owners->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
        @endif
        {{ csrf_field() }}
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function(){
        $('.delete-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var token = $('[name=_token]').val();
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
                            url: '{{ url('/admin/owner/destroy') }}/'+id,
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
        $('.activate-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var thisBtn = $(this).parents('.icon-options');
            var status = selector.children('.post-status');
            var token = $('[name=_token]').val();
            bootbox.confirm({
                title: '{{get_string('confirm_action')}}',
                message: '{{get_string('activate_user_confirm')}}',
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
                            url: '{{ url('/admin/owner/activate/') }}/'+id,
                            type: 'post',
                            data: {_token :token},
                            success:function(msg) {
                                thisBtn.children('.activate-button').addClass('hidden');
                                thisBtn.children('.deactivate-button').removeClass('hidden');
                                status.html('{{get_string('active')}}');
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
        $('.deactivate-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var thisBtn = $(this).parents('.icon-options');
            var status = selector.children('.post-status');
            var token = $('[name=_token]').val();
            bootbox.confirm({
                title: '{{get_string('confirm_action')}}',
                message: '{{get_string('deactivate_user_confirm')}}',
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
                            url: '{{ url('/admin/owner/deactivate/') }}/'+id,
                            type: 'post',
                            data: {_token :token},
                            success:function(msg) {
                                thisBtn.children('.deactivate-button').addClass('hidden');
                                thisBtn.children('.activate-button').removeClass('hidden');
                                status.html('{{get_string('pending')}}');
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