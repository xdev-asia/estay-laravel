@extends('layouts.owner')

@section('title')
    <title>{{get_string('withdrawals') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('withdrawals')}}</h3>
@endsection
<div class="col l6 m4 s12 right right-align mbot10">
    <a href="#request-modal" data-toggle="modal"  class="btn waves-effect"> {{get_string('request_withdrawal')}}</a>
</div>
@if(!$errors->isEmpty())
    <span class="wrong-error">* {{get_string('validation_error')}}</span>
@endif
@if(Session::has('withdrawal_request'))
    <span class="wrong-error">* {{ get_string('not_enough_balance') }}</span>
@endif
<div class="col s12">
    @if($withdrawals->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('username')}}</th>
                    <th>{{get_string('payment_method')}}</th>
                    <th>{{get_string('amount')}}</th>
                    <th>{{get_string('completed')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($withdrawals as $withdrawal)
                    <tr class="{{ $withdrawal->completed ? 'disabled-style' : '' }}">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$withdrawal->id}}" />
                            <label for="{{$withdrawal->id}}"></label>
                        </td>
                        <td>@if($withdrawal->user){{ $withdrawal->user->username }}@endif</td>
                        <td>{{ $withdrawal->method }}</td>
                        <td>{{ $withdrawal->amount }} {{ $currency }}</td>
                        <td class="request-status">{{$withdrawal->status ? get_string('yes') : get_string('no')}}</td>
                        <td>
                         <div class="icon-options">
                            <a href="#user-modal" data-toggle="modal" class="user-info" data-id="{{$withdrawal->id}}" title="{{get_string('user_info')}}"><i class="small material-icons color-blue">person</i></a>
                        </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$withdrawals->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection
@section('footer')
     <div id="request-modal" class="modal not-summernote fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                    <strong class="modal-title">{{get_string('request_withdrawal')}}</strong>
                </div>
                <div class="modal-body" id="user-details">
                    {!! Form::open(['method' => 'post', 'url' => route('request_withdrawal')]) !!}
                    <div class="form-group">
                        {!! Form::select('method', ['0' => 'PayPal', '1' => 'Bank Transfer'], 0, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::number('amount', null, ['class' => 'form-control', 'required', 'min' => 0, 'placeholder' => get_string('amount')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('data', null, ['class' => 'desc-content form-control', 'required', 'placeholder' => get_string('enter_withdrawal_data')]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
                    <button type="submit" name="action" class="waves-effect btn btn-default">{{get_string('submit')}}</button>
                </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
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
    <script>
        $(document).ready(function(){
            $("#user-modal").on('hidden.bs.modal', function () {
                $('#user-modal #user-details').html('');
            });

            $('.user-info').click(function(e){
                e.preventDefault();
                var id = $(this).data('id');
                var token = $('.token').val();
                $.ajax({
                    url: '{{ url('/owner/withdrawal/details') }}/' + id,
                    type: 'post',
                    data: {_token: token},
                    success: function (msg) {
                        $('#user-modal #user-details').html(msg);
                    },
                    error: function (msg) {
                        toastr.error(msg.responseJSON);
                    }
                });
            });
        });
    </script>
@endsection