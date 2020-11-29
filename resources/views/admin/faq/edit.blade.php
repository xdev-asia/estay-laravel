@extends('layouts.admin')

@section('title')
    <title>{{get_string('edit_faq') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('edit_faq')}}</h3>
@endsection
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
        {!! Form::open(['method' => 'patch', 'url' => route('admin.faq.update', $faq->id), 'files' => 'true']) !!}
    <div class="panel">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a href="#content-panel" data-toggle="tab">{{get_string('content')}}</a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div id="content-panel" class="tab-pane active">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                @foreach($languages as $language)
                                    <li class="tab {{$language->default ? 'active' : ''}}"><a href="#lang{{$language->id}}" data-parent="#content" data-toggle="tab"><img src="{{$language->flag}}"/><span>{{$language->language}}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                @foreach($languages as $language)
                                    <div id="lang{{$language->id}}" class="tab-pane {{$language->default ? 'active' : ''}}">
                                        <div class="col l6 m6 s12">
                                            <div class="form-group  {{$errors->has('title.'.$language->id.'') ? 'has-error' : ''}}">
                                                {{Form::text('title['.$language->id.']', $faq->content($language->id)->question, ['class' => 'form-control', 'placeholder' => get_string('question')])}}
                                                {{Form::label('title['.$language->id.']', get_string('question'))}}
                                                @if($errors->has('title.'.$language->id.''))
                                                    <span class="wrong-error">* {{$errors->first('title.'.$language->id.'')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            <div class="form-group  {{$errors->has('body.'.$language->id.'') ? 'has-error' : ''}}">
                                                {{Form::textarea('body['.$language->id.']', $faq->content($language->id)->answer, ['class' => 'form-control desc-content', 'placeholder' => get_string('answer')])}}
                                                {{Form::label('body['.$language->id.']', get_string('answer'))}}
                                                @if($errors->has('body.'.$language->id.''))
                                                    <span class="wrong-error">{{$errors->first('body.'.$language->id.'')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col clearfix l6 m6 s12 mtop10">
                <div class="form-group">
                    <button class="btn waves-effect" type="submit" name="action">{{get_string('edit_faq')}}</button>
                    <a href="{{route('admin.page.index')}}" class="btn waves-effect">{{get_string('faq_all')}}</a>
                    <a href="#!" class="delete-button btn waves-effect btn-red" data-id="{{$faq->id}}"><i class="material-icons color-white">delete</i></a>
                </div>
            </div>
            {{Form::hidden('user_id', Auth::user()->id)}}
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $(document).ready(function(){
            $('.delete-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
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
                                url: '{{ url('/admin/faq/') }}/'+id,
                                type: 'post',
                                data: {_method: 'delete', _token :token},
                                success:function(msg) {
                                    window.location = "/admin/faq";
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection