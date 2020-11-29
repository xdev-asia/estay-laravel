@extends('layouts.admin')

@section('title')
    <title>{{get_string('activities') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('activities')}}</h3>
@endsection
<div class="col s12">
    @if($activities->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('username')}}</th>
                    <th>{{get_string('activity')}}</th>
                    <th>{{ get_string('item')  }}</th>
                    <th>{{get_string('points')}}</th>
                    <th>{{get_string('date')}}</th>
                    <th>{{get_string('end_date')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($activities as $activity)
                    <tr class="{{ $activity->completed ? 'disabled-style' : '' }}">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$activity->id}}" />
                            <label for="{{$activity->id}}"></label>
                        </td>
                        <td>@if($activity->user){{ $activity->user->username }}@endif</td>
                        <td>{{ $activity->activity }}</td>
                        <td>@if($activity->property_id && $activity->property) {{ $activity->property->contentDefault->name }} @elseif($activity->service) {{ $activity->service->contentDefault->name }} @endif</td>
                        <td>{{ $activity->points }}</td>
                        <td>{{ date(get_setting('dateformat', 'site'), strtotime($activity->created_at)) }}</td>
                        <td>{{ date(get_setting('dateformat', 'site'), strtotime($activity->end_date)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$activities->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            $('.dismiss-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var status = $('.purchase-status', selector);
                var token = $('.token').val();
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
            });
        });
    </script>
@endsection