@extends('layouts.admin')

@section('title')
    <title>{{get_string('search_results') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('users')}}</h3>
@endsection
<div class="col l6 m4 s12 right right-align mbot10">
    <a href="{{route('admin_users')}}" class="btn waves-effect"> {{get_string('user_all')}}</a>
    <a href="#" class="mass-delete btn waves-effect btn-red"><i class="material-icons color-white">delete</i></a>
</div>
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
    @if($users->count())
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
                    <th>{{get_string('first_name')}}</th>
                    <th>{{get_string('last_name')}}</th>
                    <th>{{get_string('status')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$user->id}}" />
                            <label for="{{$user->id}}"></label>
                        </td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->user->first_name}}</td>
                        <td>{{$user->user->last_name}}</td>
                        <td class="post-status">{{$user->is_active ? get_string('active') : get_string('pending')}}</td>
                        <td>
                            <div class="icon-options">
                                <a class="edit-button" data-id="{{$user->id}}" data-toggle="modal" href="#user-modal" title="{{get_string('edit_user')}}"><i class="small material-icons color-primary">mode_edit</i></a>
                                <a href="#" class="delete-button" data-id="{{$user->id}}" title="{{get_string('delete_user')}}"><i class="small material-icons color-red">delete</i></a>
                                <a href="#" class="upgrade-button" data-id="{{$user->id}}" title="{{get_string('upgrade_user')}}"><i class="small material-icons color-blue">add_box</i></a>
                                <a href="#" class="activate-button {{$user->is_active ? 'hidden': ''}}" data-id="{{$user->id}}" title="{{get_string('activate_user')}}"><i class="small material-icons color-primary">done</i></a>
                                <a href="#" class="deactivate-button {{$user->is_active ? '': 'hidden'}}" data-id="{{$user->id}}" title="{{get_string('deactivate_user')}}"><i class="small material-icons color-primary">close</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$users->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
@endsection

@section('footer')
        <!-- Modal -->
<div id="user-modal" class="modal not-summernote fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                <strong class="modal-title">{{get_string('edit_user')}}</strong>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'post', 'url' => route('admin_user_update'), 'id' => 'user-form']) !!}
                {{ Form::input('hidden', 'id', null, ['class' => 'hidden', 'id' => 'user_id']) }}
                <div class="row mbot0">
                    <div class="col l6 s12">
                        <div class="form-group  {{$errors->has('first_name') ? 'has-error' : ''}}">
                            {{Form::text('first_name', null, [ 'id' => 'user-first-name', 'class' => 'form-control', 'placeholder' => get_string('first_name')])}}
                            {{Form::label('first_name', get_string('first_name'))}}
                            @if($errors->has('first_name'))
                                <span class="wrong-error">* {{$errors->first('first_name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 s12">
                        <div class="form-group  {{$errors->has('last_name') ? 'has-error' : ''}}">
                            {{Form::text('last_name', null, [ 'id' => 'user-last-name', 'class' => 'form-control', 'placeholder' => get_string('last_name')])}}
                            {{Form::label('last_name', get_string('last_name'))}}
                            @if($errors->has('last_name'))
                                <span class="wrong-error">* {{$errors->first('last_name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 s12 clearfix">
                        <div class="form-group  {{$errors->has('email') ? 'has-error' : ''}}">
                            {{Form::text('email', null, [ 'id' => 'user-email', 'class' => 'form-control', 'placeholder' => get_string('email')])}}
                            {{Form::label('email', get_string('email'))}}
                            @if($errors->has('email'))
                                <span class="wrong-error">* {{$errors->first('email')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 s12">
                        <div class="form-group  {{$errors->has('username') ? 'has-error' : ''}}">
                            {{Form::text('username', null, [ 'id' => 'user-username', 'class' => 'form-control', 'placeholder' => get_string('username')])}}
                            {{Form::label('username', get_string('username'))}}
                            @if($errors->has('username'))
                                <span class="wrong-error">* {{$errors->first('username')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 s12">
                        <div class="form-group  {{$errors->has('password') ? 'has-error' : ''}}">
                            {{Form::password('password', [ 'id' => 'user-password', 'class' => 'form-control', 'placeholder' => get_string('password')])}}
                            {{Form::label('password', get_string('password'))}}
                            @if($errors->has('password'))
                                <span class="wrong-error">* {{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 s12">
                        <div class="form-group  {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
                            {{Form::password('password_confirmation', [ 'id' => 'user-password', 'class' => 'form-control', 'placeholder' => get_string('confirm_password')])}}
                            {{Form::label('password_confirmation', get_string('confirm_password'))}}
                            @if($errors->has('password_confirmation'))
                                <span class="wrong-error">* {{$errors->first('password_confirmation')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="action" class="update-lang-form waves-effect btn btn-default">{{get_string('update')}}</button>
                <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.edit-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var token = $('[name=_token]').val();
            $.ajax({
                url: '{{ url('/admin/user/userinfo') }}',
                type: 'get',
                data: {id: id, _token: token},
                success: function(info){
                    for(var key in info){
                        $('#user-form [name="'+key+'"]').val(info[key]);
                    }
                    $('#user-form [name="id"]').val(id);
                },
                error: function(msg){
                    toastr.error(msg.responseJSON);
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
                            url: '{{ url('/admin/user/activate/') }}/'+id,
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
                            url: '{{ url('/admin/user/deactivate/') }}/'+id,
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
                            url: '{{ url('/admin/user/') }}/'+id,
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
        $('.mass-delete').click(function(event){
            event.preventDefault();
            var id = [];
            var selector = [];
            $("tbody input:checkbox:checked").each(function(){
                id.push($(this).attr('id'));
                selector.push($(this).parents('tr'));
            });
            var token = $('[name=_token]').val();
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
                    if(result) {
                        $.ajax({
                            url: '{{ url('/admin/user/massdestroy') }}',
                            type: 'post',
                            data: {id: id, _token :token},
                            success:function(msg) {
                                $.each(selector, function(index, item){
                                    $(this).remove();
                                });
                                $('#select-all').prop('checked', false);
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