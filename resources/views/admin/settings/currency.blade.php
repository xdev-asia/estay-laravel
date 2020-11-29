@extends('layouts.admin')

@section('title')
    <title>{{get_string('currencies') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('currencies')}}</h3>
@endsection
<div class="col l12 m12 s12 right right-align mbot10">
    <a href="#feature-modal" data-toggle="modal" class="add-button btn waves-effect"> {{get_string('add_currency')}} <i class="material-icons small">add_circle</i></a>
</div>
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
    @if($currencies)
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('currency')}}</th>
                    <th>{{get_string('currency_code')}}</th>
                    <th>{{get_string('currency_symbol')}}</th>
                    <th>{{get_string('exchange_rate_label')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($currencies as $currency)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$currency['id']}}" />
                            <label for="{{$currency['id']}}"></label>
                        </td>
                        <td>{{$currency['name']}}</td>
                        <td>{{$currency['code']}}</td>
                        <td>{{$currency['symbol']}}</td>
                        <td>{{$currency['exchange_rate']}}</td>
                        <td>
                            <div class="icon-options">
                                @if($currency['id'] > 1)
                                    <a href="#" class="delete-button" data-id="{{$currency['code']}}" title="{{get_string('delete_currency')}}"><i class="small material-icons color-red">delete</i></a>
                                @endif
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
        <!-- Modal -->
<div id="feature-modal" class="modal not-summernote fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                <strong class="modal-title">{{get_string('add_currency')}}</strong>
            </div>
            {!! Form::open(['method' => 'post', 'url' => route('admin_currency_store')]) !!}
            <div class="modal-body">
                <div class="row mbot0">
                    <div class="col s12">
                        <div class="form-group">
                            {{Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => ''])}}
                            {{Form::label('name', get_string('currency'))}}
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="form-group">
                            {{Form::text('code', null, ['class' => 'form-control', 'required', 'placeholder' => ''])}}
                            {{Form::label('code', get_string('currency_code'))}}
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="form-group">
                            {{Form::text('symbol', null, ['class' => 'form-control', 'required', 'placeholder' => ''])}}
                            {{Form::label('symbol', get_string('currency_symbol'))}}
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="form-group">
                            {{Form::text('exchange_rate', null, ['class' => 'form-control', 'required', 'placeholder' => ''])}}
                            {{Form::label('exchange_rate', get_string('exchange_rate_label'))}}
                        </div>
                    </div>
                </div>
                <span class="field-info">* {{get_string('fill_all_fields')}}</span>
            </div>
            <div class="modal-footer">
                <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
                <button type="submit" name="action" class="update-lang-form waves-effect btn btn-default">{{get_string('create')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
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
                        label: 'No',
                        className: 'btn waves-effect'
                    },
                    confirm: {
                        label: 'Yes',
                        className: 'btn waves-effect'
                    }
                },
                callback: function (result) {
                    if(result){
                        $.ajax({
                            url: '{{ url('/admin/setting/currency/destroy') }}/'+id,
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
    });
</script>
@endsection