@extends('layouts.admin')

@section('title')
    <title>{{get_string('features') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('features')}}</h3>
@endsection
<div class="col l12 m12 s12 right right-align mbot10">
    <a href="#feature-modal" data-toggle="modal" class="add-button btn waves-effect"> {{get_string('add_feature')}} <i class="material-icons small">add_circle</i></a>
</div>
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
    @if($features->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('feature')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($features as $feature)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$feature->id}}" />
                            <label for="{{$feature->id}}"></label>
                        </td>
                        <td class="feature-name">{{$feature->feature[$default_language->id]}}</td>
                        <td>
                            <div class="icon-options">
                                <a class="edit-button" data-toggle="modal"  data-id="{{$feature->id}}" href="#update-modal" title="{{get_string('edit_feature')}}"><i class="small material-icons color-primary">mode_edit</i></a>
                                <a href="#" class="delete-button" data-id="{{$feature->id}}" title="{{get_string('delete_feature')}}"><i class="small material-icons color-red">delete</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$features->links()}}
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
                <strong class="modal-title">{{get_string('add_feature')}}</strong>
            </div>
            {!! Form::open(['method' => 'post', 'url' => route('admin_taxonomy_feature_store')]) !!}
            <div class="modal-body">
                <div class="row mbot0">
                    @foreach($languages as $language)
                    <div class="col s4">
                        <div class="form-group">
                            {{Form::text('feature['.$language->id.']', null, ['class' => 'form-control', 'required', 'placeholder' => $language->language])}}
                            {{Form::label('feature['.$language->id.']', $language->language)}}
                        </div>
                    </div>
                    @endforeach
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
<div id="update-modal" class="modal not-summernote fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                <strong class="modal-title">{{get_string('edit_feature')}}</strong>
            </div>
            {!! Form::open(['method' => 'post', 'url' => route('admin_taxonomy_feature_update')]) !!}
            <div class="modal-body">
                <div class="row mbot0">
                    {{Form::hidden('id', null, ['id' => 'feature_id'])}}
                    @foreach($languages as $language)
                        <div class="col s4">
                            <div class="form-group">
                                {{Form::text('feature['.$language->id.']', null, ['class' => 'form-control', 'required', 'id' => 'update_id_'.$language->id, 'placeholder' => $language->language])}}
                                {{Form::label('feature['.$language->id.']', $language->language)}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <span class="field-info">* {{get_string('fill_all_fields')}}</span>
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
                            url: '{{ url('/admin/taxonomy/feature/destroy') }}/'+id,
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
        $('.edit-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var token = $('[name=_token]').val();
            $.ajax({
                url: '{{ url('/admin/taxonomy/feature/getFeature') }}/'+id,
                type: 'get',
                data: {_token :token},
                success:function(msg) {
                    $('#feature_id').val(id);
                    for(var key in msg){
                        $('#update_id_'+key).val(msg[key]);
                    }
                },
                error:function(msg){
                    toastr.error(msg.responseJSON);
                }
            });
        });
    });
</script>
@endsection