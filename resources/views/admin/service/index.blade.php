@extends('layouts.admin')

@section('title')
    <title>{{get_string('services') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('services')}}</h3>
@endsection
    <div class="col l6 m8 s12 left left-align mbot10">
        {{Form::open(['method' => 'post', 'url' => route('admin_service_search')])}}
        <div class="form-group col s8 autocomplete-fix">
            {{Form::text('term', null, ['class' => 'form-control', 'id' => 'term', 'placeholder' => get_string('search_services')])}}
        </div>
        <div class="col l4 m4 s4">
            <button class="btn waves-effect" type="submit" name="action">{{get_string('filter')}}</button>
        </div>
        {{Form::close()}}
    </div>
    <div class="col l6 m4 s12 right right-align mbot10">
        <a href="{{route('admin.service.create')}}" class="btn waves-effect"> {{get_string('create_service')}} <i class="material-icons small">add_circle</i></a>
        <a href="#" class="mass-delete btn waves-effect btn-red"><i class="material-icons color-white">delete</i></a>
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
                                <a href="{{url('service').'/'.$service->alias}}" title="{{get_string('view_service')}}"><i class="small material-icons color-primary">visibility</i></a>
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


        $('.mass-delete').click(function(event){
            event.preventDefault();
            var id = [];
            var selector = [];
            $("tbody input:checkbox:checked").each(function(){
                id.push($(this).attr('id'));
                selector.push($(this).parents('tr'));
            });
            var token = $('[name="_token"]').val();
            bootbox.confirm({
                title: '{{get_string('confirm_action')}}',
                message: '{{get_string('delete_confirm_bulk')}}',
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
                            url: '{{ url('/admin/service/massdestroy') }}',
                            type: 'post',
                            data: {id: id, _token :token},
                            success:function(msg) {
                                $.each(selector, function(index, item){
                                    $(this).remove();
                                });
                                $('#select-all').prop('checked', false);
                                toastr.success(msg);
                            },
                            error: function(msg){
                                toastr.error(msg.responseJSON);
                            }
                        });
                    }
                }
            });
        });
        $('#term').autocomplete({
            source: '{{ url('/admin/service/autocomplete') }}',
            minLength: 0,
            delay: 0,
            focus: function( event, ui ) {
                $('#term').val( ui.item.name );
                return false;
            },
            select: function( event, ui ) {
                $('#term').val( ui.item.name).attr('data-id', ui.item.id);
                return false;
        }}).data("ui-autocomplete")._renderItem = function( ul, item ) {
             return $( "<li></li>" )
             .append( "<a href='#'>" + item.name + "</a>" )
            .appendTo( ul );
         };
    });
</script>
@endsection