@extends('layouts.admin')

@section('title')
    <title>{{get_string('requests') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('requests')}}</h3>
@endsection
<div class="col s12">
    <h3 class="page-title">{{get_string('users')}}</h3>
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
                    @if($user && $user->user)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$user->id}}" />
                            <label for="{{$user->id}}"></label>
                        </td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>@if($user->user){{$user->user->first_name}}@endif</td>
                        <td>@if($user->user){{$user->user->last_name}}@endif</td>
                        <td class="post-status">{{$user->is_active ? get_string('active') : get_string('pending')}}</td>
                        <td>
                            <div class="icon-options">
                                <a href="#" data-type="1" class="activate-button {{$user->is_active ? 'hidden': ''}}" data-id="{{$user->id}}" title="{{get_string('activate_user')}}"><i class="small material-icons color-primary">done</i></a>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
    {{ csrf_field() }}
    <h3 class="page-title">{{get_string('properties')}}</h3>
    @if($properties->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('property')}}</th>
                    <th>{{get_string('user')}}</th>
                    <th>{{get_string('category')}}</th>
                    <th>{{get_string('location')}}</th>
                    <th>{{get_string('status')}}</th>
                    <th>{{get_string('featured')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($properties as $property)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$property->id}}" />
                            <label for="{{$property->id}}"></label>
                        </td>
                        <td>{{$property->contentDefault->name}}</td>
                        <td>@if($property->user){{$property->user->username}}@else <i class="small material-icons color-red">clear</i> @endif</td>
                        <td>{{$property->category->contentDefault->name}}</td>
                        <td>{{$property->prop_location->contentDefault->location}}</td>
                        <td class="page-status">{{$property->status ? get_string('active') : get_string('pending')}}</td>
                        <td class="page-featured">{{$property->featured ? get_string('yes') : get_string('no')}}</td>
                        <td>
                            <div class="icon-options">
                                <a href="#" data-type="3" class="activate-button {{$property->status ? 'hidden': ''}}" data-id="{{$property->id}}" title="{{get_string('activate_property')}}"><i class="small material-icons color-primary">done</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
    <h3 class="page-title">{{get_string('services')}}</h3>
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
                                <a href="#" data-type="4" class="activate-button {{$service->status ? 'hidden': ''}}" data-id="{{$service->id}}" title="{{get_string('activate_service')}}"><i class="small material-icons color-primary">done</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
@endsection

@section('footer')
    <script>
        $(document).ready(function(){
            $('.activate-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var thisBtn = $(this).parents('.icon-options');
                var status = selector.children('.page-status');
                var token = $('[name="_token"]').val();
                var type = $(this).data('type');
                switch(type){
                    case 1 : var url = '{{ url('/admin/user/activate/') }}/'; break;
                    case 2 : var url = '{{ url('.admin/owner/activate/') }}/'; break;
                    case 3 : var url = '{{ url('/admin/property/activate/') }}/'; break;
                    case 4 : var url = '{{ url('/admin/service/activate/') }}/'; break;
                }
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('activate_item')}}',
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
                                url: url + id,
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
        });
    </script>
@endsection