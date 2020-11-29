@extends('layouts.owner')

@section('title')
    <title>{{get_string('payments') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('payments')}}</h3>
@endsection
<div class="col s12">
    @if($payments->count())
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
                    <th>{{get_string('owner')}}</th>
                    <th>{{get_string('payment_method')}}</th>
                    <th>{{get_string('transaction')}}</th>
                    <th>{{get_string('total')}}</th>
                    <th>{{get_string('commission')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$payment->id}}" />
                            <label for="{{$payment->id}}"></label>
                        </td>
                        <td>@if($payment->property_id && $payment->property) {{ $payment->property->contentDefault->name }} @else <i class="small material-icons color-red">clear</i> @endif </td>
                        <td>@if($payment->user && $payment->user_id) {{ $payment->user->username }} @else <i class="small material-icons color-red">clear</i> @endif </td>
                        <td>@if($payment->owner && $payment->owner_id) {{ $payment->owner->username }} @else <i class="small material-icons color-red">clear</i> @endif </td>
                        <td>{{$payment->payment_method}}</td>
                        <td>{{$payment->transaction}}</td>
                        <td>{{$payment->total}} {{ $currency }}</td>
                        <td>{{$payment->host_commission}}%</td>
                        <td>
                            <div class="icon-options">
                                <a href="#user-modal" data-toggle="modal" class="user-info" data-id="{{$payment->id}}" title="{{get_string('user_info')}}"><i class="small material-icons color-blue">person</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$payments->links()}}
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
                url: '{{ url('/owner/list-payment/details') }}/' + id,
                type: 'post',
                data: {_token: token},
                success: function (msg) {
                    $('#user-details').html(msg);
                },
                error: function (msg) {
                    toastr.error(msg.responseJSON);
                }
            });
        });
    });
</script>
@endsection