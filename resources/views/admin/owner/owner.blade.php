@extends('layouts.admin')

@section('title')
    <title>{{get_string('owners') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('owners')}}</h3>
@endsection
<div class="col l6 m6 s12 left left-align mbot10">
    {!!Form::open(['method' => 'post', 'url' => route('admin_owner_search')])!!}
    <div class="form-group col s8 autocomplete-fix">
        {{Form::text('term', null, ['class' => 'form-control', 'id' => 'term', 'placeholder' => get_string('search_owners')])}}
    </div>
    <div class="col l4 m4 s4">
        <button class="btn waves-effect" type="submit" name="action">{{get_string('filter')}}</button>
    </div>
    {!!Form::close()!!}
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
                    <th>{{get_string('withdrawals')}}</th>
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
                        <td>{{$owner->user->username}}</td>
                        <td>{{$owner->user->email}}</td>
                        <td>{{$owner->points}}</td>
                        <td><a href="{{ route('admin_owner_services', $owner->user_id) }}"><i class="material-icons">list</i></a></td>
                        <td><a href="{{ route('admin_owner_properties', $owner->user_id) }}"><i class="material-icons">list</i></a></td>
                        <td><a href="{{ route('admin_owner_purchases', $owner->user_id) }}"><i class="material-icons">list</i></a></td>
                        <td><a href="{{ route('admin_owner_activities', $owner->user_id) }}"><i class="material-icons">list</i></a></td>
                        <td><a href="{{ route('admin_owner_withdrawals', $owner->user_id) }}"><i class="material-icons">list</i></a></td>
                        <td>
                            <div class="icon-options">
                                <a href="{{ route('admin_owner_edit', $owner->id) }}" class="edit-button" title="{{get_string('edit_user')}}"><i class="small material-icons color-primary">mode_edit</i></a>
                                <a href="#" class="delete-button" data-id="{{$owner->id}}" title="{{get_string('delete_user')}}"><i class="small material-icons color-red">delete</i></a>
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
        $('#term').autocomplete({
            source: '{{ url('/admin/owner/autocomplete') }}',
            minLength: 0,
            delay: 0,
            focus: function( event, ui ) {
                $('#term').val( ui.item.title );
                return false;
            },
            select: function( event, ui ) {
                $('#term').val( ui.item.title).attr('data-id', ui.item.id);
                return false;
            }}).data("ui-autocomplete")._renderItem = function( ul, item ) {
            return $( "<li></li>" )
                    .append( "<a href='#!'>" + item.title + "</a>" )
                    .appendTo( ul );
        };
    });
</script>
@endsection