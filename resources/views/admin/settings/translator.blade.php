@extends('layouts.admin')

@section('title')
    <title>{{get_string('translator') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('translator')}}</h3>
@endsection
<div class="col s12">
    @if(!$errors->isEmpty())
        @foreach($errors->all() as $error)
            <span class="wrong-error pull-left">* {{ $error }} </span>
        @endforeach
    @endif
    <div class="pull-right">
        <a href="#add-modal" data-toggle="modal" class="add-button btn waves-effect"> {{ get_string('add_string') }} <i class="material-icons small">add_circle</i></a>
        <a href="{{ route('strings_export') }}"class="btn waves-effect"><i class="material-icons small">file_download</i></a>
        <a href="#import-modal" data-toggle="modal" class="import-strings btn waves-effect"><i class="material-icons">file_upload</i></a>
    </div>
        <div class="table-responsive">
        @if(Session::has('error'))
            <p class="wrong-error">{{ get_string('something_happened') }}</p>
        @endif
        <table id="data-table" class="table bordered striped">
            <thead class="thead-inverse">
            <tr>
                <th>#</th>
                <th>{{get_string('key')}}</th>
                <th>{{get_string('string')}}</th>
                <th class="icon-options">{{get_string('options')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($strings as $string)
                <tr>
                    <td>{{ $string->id }}</td>
                    <td>{{ $string->key }}</td>
                    <td class="string-content">{{ $string->string }}</td>
                    <td>
                        <a class="edit-button" data-toggle="modal"  data-key="{{$string->key}}" href="#update-modal" title="{{get_string('edit_string')}}"><i class="small material-icons color-primary">mode_edit</i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('footer')
    <div id="add-modal" class="modal not-summernote fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                    <strong class="modal-title">{{get_string('edit_string')}}</strong>
                </div>
                {!! Form::open(['method' => 'post', 'url' => route('admin_create_string')]) !!}
                <div class="modal-body">
                    <div class="row mbot0">
                        <div class="col s6">
                            <div class="form-group">
                                {{Form::text('key', null, ['class' => 'form-control', 'placeholder' => get_string('enter_string_key')])}}
                                {{Form::label('key', get_string('key'))}}
                            </div>
                        </div>
                        <?php $condition = 0; ?>
                        @foreach($languages as $language)
                            <?php if ($language->code == 'en') $condition = 1; ?>
                            <div class="col s6">
                                <div class="form-group">
                                    {{Form::text('string['.$language->code.']', null, ['class' => 'form-control', 'placeholder' => $language->language])}}
                                    {{Form::label('string['.$language->code.']', $language->language)}}
                                </div>
                            </div>
                        @endforeach
                        @if(!$condition)
                            <div class="col s6">
                                <div class="form-group">
                                    {{Form::text('string[en]', null, ['class' => 'form-control', 'placeholder' => get_string('english')])}}
                                    {{Form::label('string[en]', get_string('english'))}}
                                </div>
                            </div>
                        @endif
                    </div>
                    <span class="field-info">* {{get_string('fill_all_fields_strings')}}</span>
                    <span id="error-form" class="wrong-error"></span>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
                    <button type="submit" href="#" class="waves-effect btn btn-default">{{get_string('create')}}</button>
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
                    <strong class="modal-title">{{get_string('edit_string')}}</strong>
                </div>
                {!! Form::open(['method' => 'post']) !!}
                <div class="modal-body">
                    <div class="row mbot0">
                        {{Form::hidden('key', null, ['id' => 'string_key'])}}
                        @foreach($languages as $language)
                            <div class="col s6">
                                <div class="form-group">
                                    {{Form::text('string['.$language->code.']', null, ['class' => 'form-control', 'id' => 'update_id_'.$language->code, 'placeholder' => $language->language])}}
                                    {{Form::label('string['.$language->code.']', $language->language)}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <span class="field-info">* {{get_string('fill_all_fields_strings')}}</span>
                    <span id="error-form" class="wrong-error"></span>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
                    <a href="#" class="update-string-form waves-effect btn btn-default">{{get_string('update')}}</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div id="import-modal" class="modal not-summernote fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                    <strong class="modal-title">{{get_string('import')}}</strong>
                </div>
                {!! Form::open(['method' => 'post','url' => route('strings_import'), 'id' => 'import-form', 'files' => true])  !!}
                <div class="col l6 m6 s12">
                    <div class="input-group {{$errors->has('file') ? 'has-error' : ''}}">
                        <label class="input-group-btn">
                            <span class="btn btn-primary waves-effect">{{get_string('select_file')}} <i class="material-icons small">file_upload</i>
                                {!! Form::file('file', ['id' => 'file', 'required', 'class' => 'hidden']) !!}
                            </span>
                        </label>
                        <input type="text" name="helper-text" class="form-control" readonly>
                    </div>
                    <span class="field-info">{{get_string('select_exported_file_only')}}</span>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
                    <a href="#" class="import-button waves-effect btn btn-default" data-dismiss="modal">{{get_string('import')}}</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="{{URL::asset('assets/js/plugins/datatables.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/plugins/datatables-bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){

        var selector;
        $('.edit-button').click(function(e){
            e.preventDefault();
            selector = $(this).parents('tr');
            $('[id^="update_id_"]').val('');
            var key = $(this).data('key');
            $('#string_key').val(key);
            var token = $('[name="_token"]').val();
            $.ajax({
                url: '{{ url('admin/settings/translator/getString') }}/' + key,
                type: 'post',
                data: {_token: token},
                success: function(data){
                    $.each(data, function(index){
                       $('#update_id_' + data[index].code).val(data[index].string);
                    });
                },
                error: function(data){
                    toastr.error(msg.responseJSON);
                }
            });
        });

        $('.update-string-form').click(function(e){
            e.preventDefault();
            var data = {};
            @foreach($languages as $language)
                data.{{$language->code}} = $('#update_id_{{$language->code}}').val();
            @endforeach
            var token = $('[name="_token"]').val();
            var key = $('#string_key').val();
            $.ajax({
                url: '{{ url('admin/settings/translator/updateString') }}',
                type: 'post',
                data: {data: data, key: key, _token: token},
                success: function(msg){
                    $('#update-modal').modal('toggle');
                    if(typeof data.en !== 'undefined'){
                        $('.string-content', selector).html(data.en);
                    }
                },
                error: function(data){
                    $('#error-form').html('{{ get_string('please_check_default_language') }}').css('display', 'block');
                }
            });
        });

        $('.import-button').click(function(e){
            e.preventDefault();
            var formData = new FormData($("#import-form")[0]);
            var token = $('[name="_token"]').val();
            // formData.append("file", $('[name="file"]')[0].files[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                beforeSend: function(){
                    $('.table').addClass('loading');
                },
                url: '{{ route('strings_import') }}',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                    toastr.success(data);
                    $('.table').removeClass('loading');
                    setTimeout(function(){location.reload();}, 2000);
                },
                error: function(data){
                    $('.table').removeClass('loading');
                    toastr.error(data.responseJSON);
                }
            });
        });

        $('#data-table').DataTable({
            language: {
                search: "_INPUT_",
                searchPlaceholder: "{{ get_string('search_key_here') }}",
                "paginate": {
                    "first":      "{{ get_string('first') }}",
                    "last":       "{{ get_string('last') }}",
                    "next":       "{{ get_string('next') }}",
                    "previous":   "{{ get_string('previous') }}"
                },
            }
        });
    });
</script>
@endsection