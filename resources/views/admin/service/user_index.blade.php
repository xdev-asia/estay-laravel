@extends('layouts.admin')

@section('title')
    <title>{{get_string('services') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('services')}} - {{ $user }}</h3>
@endsection
<div class="col l6 m4 s12 right right-align mbot10">
    <a href="{{ route('admin_owner') }}" class="mass-delete btn waves-effect btn-primary">{{ get_string('back_to_owners') }}</a>
</div>
    <div class="col s12">
        @if($services->count())
        <div class="table-responsive">
        <table class="table bordered striped">
            <thead class="thead-inverse">
            <tr>
                <th>
                    <input type="checkbox" class="filled-in primary-color" id="select-all" />
                    <label for="select-all"></label>
                </th>
                <th>{{get_string('user')}}</th>
                <th>{{get_string('category')}}</th>
                <th>{{get_string('name')}}</th>
                <th>{{get_string('status')}}</th>
                <th>{{get_string('featured')}}</th>
                <th class="icon-options">{{get_string('options')}}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$service->id}}" />
                            <label for="{{$service->id}}"></label>
                        </td>
                        <td>@if($service->user){{$service->user->username}}@else <i class="small material-icons color-red">clear</i> @endif</td>
                        <td>{{$service->category->contentDefault->name}}</td>
                        <td>{{$service->contentDefault->name}}</td>
                        <td class="page-status">{{$service->status ? get_string('active') : get_string('pending')}}</td>
                        <td class="page-featured">{{$service->featured ? get_string('yes') : get_string('no')}}</td>
                        <td>
                            <div class="icon-options">
                                <a href="{{route('admin.service.show', $service->id)}}" title="{{get_string('view_service')}}"><i class="small material-icons color-primary">visibility</i></a>
                                <a href="{{route('admin.service.edit', $service->id)}}" title="{{get_string('edit_service')}}"><i class="small material-icons color-primary">mode_edit</i></a>
                                <a href="#" class="delete-button" data-id="{{$service->id}}" title="{{get_string('delete_service')}}"><i class="small material-icons color-red">delete</i></a>
                                <a href="#" class="activate-button {{$service->status ? 'hidden': ''}}" data-id="{{$service->id}}" title="{{get_string('activate_service')}}"><i class="small material-icons color-primary">done</i></a>
                                <a href="#" class="deactivate-button {{$service->status ? '': 'hidden'}}" data-id="{{$service->id}}" title="{{get_string('deactivate_service')}}"><i class="small material-icons color-primary">close</i></a>
                                <a href="#" class="make-featured-button {{$service->featured ? 'hidden': ''}}" data-id="{{$service->id}}" title="{{get_string('make_featured')}}"><i class="small material-icons color-primary">grade</i></a>
                                <a href="#" class="make-default-button {{$service->featured ? '': 'hidden'}}" data-id="{{$service->id}}" title="{{get_string('make_default')}}"><i class="small material-icons color-yellow">grade</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        {{$services->links()}}
        @else
            <strong class="center-align">{{get_string('no_results')}}</strong>
        @endif
        {{  csrf_field() }}
    </div>
@endsection

@section('footer')
<script>
    $(document).ready(function(){
        $('.delete-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var token = $('[name="_token"]').val();
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
                            url: '{{ url('/admin/service/') }}/'+id,
                            type: 'post',
                            data: {_method: 'delete', _token :token},
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
            var status = selector.children('.page-status');
            var token = $('[name="_token"]').val();
            bootbox.confirm({
                title: '{{get_string('confirm_action')}}',
                message: '{{get_string('activate_service_confirm')}}',
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
                            url: '{{ url('/admin/service/activate/') }}/'+id,
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
            var status = selector.children('.page-status');
            var token = $('[name="_token"]').val();
            bootbox.confirm({
                title: '{{get_string('confirm_action')}}',
                message: '{{get_string('deactivate_service_confirm')}}',
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
                            url: '{{ url('/admin/service/deactivate/') }}/'+id,
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

        $('.make-featured-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var thisBtn = $(this).parents('.icon-options');
            var status = selector.children('.page-featured');
            var token = $('[name="_token"]').val();
            bootbox.confirm({
                title: '{{get_string('confirm_action')}}',
                message: '{{get_string('make_featured_confirm')}}',
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
                            url: '{{ url('/admin/service/makefeatured/') }}/'+id,
                            type: 'post',
                            data: {_token :token},
                            success:function(msg) {
                                thisBtn.children('.make-featured-button').addClass('hidden');
                                thisBtn.children('.make-default-button').removeClass('hidden');
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
        });

        $('.make-default-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var thisBtn = $(this).parents('.icon-options');
            var status = selector.children('.page-featured');
            var token = $('[name="_token"]').val();
            bootbox.confirm({
                title: '{{get_string('confirm_action')}}',
                message: '{{get_string('make_default_confirm')}}',
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
                            url: '{{ url('/admin/service/makedefault/') }}/'+id,
                            type: 'post',
                            data: {_token :token},
                            success:function(msg) {
                                thisBtn.children('.make-default-button').addClass('hidden');
                                thisBtn.children('.make-featured-button').removeClass('hidden');
                                status.html('{{get_string('no')}}');
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