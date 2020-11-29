@extends('layouts.admin')

@section('title')
    <title>{{get_string('languages') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('languages')}}</h3>
@endsection
<div class="col l12 m12 s12 right right-align mbot10">
    <a href="#language-modal" data-toggle="modal" class="add-button btn waves-effect"> {{get_string('add_language')}} <i class="material-icons small">add_circle</i></a>
    <a href="#language-list-modal" data-toggle="modal" class="btn waves-effect"> {{get_string('languages_list')}}</a>
</div>
<div class="col s12">
    @if($languages->count())
        <div class="table-responsive" style="position: relative;">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('language')}}</th>
                    <th>{{get_string('code')}}</th>
                    <th>{{get_string('icon')}}</th>
                    <th class="icon-options">{{get_string('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($languages as $language)
                    <tr>
                        <td class="lang_id">
                            <input type="checkbox" class="filled-in primary-color" id="{{$language->id}}" />
                            <label for="{{$language->id}}"></label>
                        </td>
                        <td class="lang_name">{{$language->language}}</td>
                        <td class="lang_code">{{$language->code}}</td>
                        <td class="lang_flag"><img src="{{$language->flag}}" class="img-responsive"/></td>
                        <td>
                            <div class="icon-options">
                                <a class="edit-button" data-toggle="modal" href="#language-modal" title="{{get_string('edit_language')}}"><i class="small material-icons color-primary">mode_edit</i></a>
                                <a href="#" class="delete-button" data-id="{{$language->id}}" title="{{get_string('delete_language')}}"><i class="small material-icons color-red">delete</i></a>
                                <a href="#" class="make-featured-button {{$language->default ? 'hidden': ''}}" data-id="{{$language->id}}" title="{{get_string('make_default')}}"><i class="small material-icons color-primary">grade</i></a>
                                <a href="#" class="make-default-button {{$language->default ? '': 'hidden'}}" data-id="{{$language->id}}" title="{{get_string('make_non_default')}}"><i class="small material-icons color-yellow">grade</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$languages->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
@endsection

@section('footer')
        <!-- Modal -->
        <div id="language-modal" class="modal not-summernote fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                        <strong class="modal-title">{{get_string('edit_language')}}</strong>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method' => 'post', 'url' => route('admin_language_update'), 'id' => 'create-update-form']) !!}
                            {{ Form::input('hidden', 'id', null, ['class' => 'hidden', 'id' => 'form_lang_id']) }}
                        <div class="row mbot0">
                            <div class="col s12">
                                <div class="form-group  {{$errors->has('language') ? 'has-error' : ''}}">
                                    {{Form::text('language', null, ['required', 'class' => 'form-control', 'placeholder' => get_string('language')])}}
                                    {{Form::label('language', get_string('language'))}}
                                    @if($errors->has('language'))
                                        <span class="wrong-error">* {{$errors->first('language')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col l4 s6">
                                <div class="form-group  {{$errors->has('code') ? 'has-error' : ''}}">
                                    {{Form::text('code', null, ['required', 'class' => 'form-control', 'placeholder' => get_string('code')])}}
                                    {{Form::label('code', get_string('code'))}}
                                    @if($errors->has('code'))
                                        <span class="wrong-error">* {{$errors->first('code')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col l4 s6">
                                <div class="form-group  {{$errors->has('flag') ? 'has-error' : ''}}">
                                    {{Form::text('flag', null, ['class' => 'form-control', 'required', 'placeholder' => get_string('icon')])}}
                                    {{Form::label('flag', get_string('icon'))}}
                                    @if($errors->has('flag'))
                                        <span class="wrong-error">* {{$errors->first('flag')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
                        <button type="submit" name="action" class="update-lang-form waves-effect btn btn-default">{{get_string('update_language')}}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    <div id="language-list-modal" class="modal not-summernote fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 400px; overflow-y: scroll;">
                <div class="modal-header">
                    <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                    <strong class="modal-title">{{get_string('list_all_languages')}}</strong>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                    <table class="table bordered striped">
                        <thead class="thead-inverse">
                            <tr>
                                <th>{{ get_string('language') }}</th>
                                <th>{{ get_string('code') }}</th>
                                <th>{{ get_string('icon') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr><td>Afar</td><td>aa</td><td>aa.png</td></tr>
                        <tr><td>Abkhazian</td><td>ab</td><td>ab.png</td></tr>
                        <tr><td>Afrikaans</td><td>af</td><td>af.png</td></tr>
                        <tr><td>Amharic</td><td>am</td><td>am.png</td></tr>
                        <tr><td>Arabic</td><td>ar</td><td>ar.png</td></tr>
                        <tr><td>Assamese</td><td>as</td><td>as.png</td></tr>
                        <tr><td>Aymara</td><td>ay</td><td>ay.png</td></tr>
                        <tr><td>Azerbaijani</td><td>az</td><td>az.png</td></tr>
                        <tr><td>Bashkir</td><td>ba</td><td>ba.png</td></tr>
                        <tr><td>Byelorussian</td><td>be</td><td>be.png</td></tr>
                        <tr><td>Bulgarian</td><td>bg</td><td>bg.png</td></tr>
                        <tr><td>Bihari</td><td>bh</td><td>bh.png</td></tr>
                        <tr><td>Bislama</td><td>bi</td><td>bi.png</td></tr>
                        <tr><td>Bengali;Bangla</td><td>bn</td><td>bn.png</td></tr>
                        <tr><td>Tibetan</td><td>bo</td><td>bo.png</td></tr>
                        <tr><td>Breton</td><td>br</td><td>br.png</td></tr>
                        <tr><td>Catalan</td><td>ca</td><td>ca.png</td></tr>
                        <tr><td>Corsican</td><td>co</td><td>co.png</td></tr>
                        <tr><td>Czech</td><td>cs</td><td>cs.png</td></tr>
                        <tr><td>Welsh</td><td>cy</td><td>cy.png</td></tr>
                        <tr><td>Danish</td><td>da</td><td>da.png</td></tr>
                        <tr><td>German</td><td>de</td><td>de.png</td></tr>
                        <tr><td>Bhutani</td><td>dz</td><td>dz.png</td></tr>
                        <tr><td>Greek</td><td>el</td><td>el.png</td></tr>
                        <tr><td>English</td><td>en</td><td>en.png</td></tr>
                        <tr><td>Esperanto</td><td>eo</td><td>eo.png</td></tr>
                        <tr><td>Spanish</td><td>es</td><td>es.png</td></tr>
                        <tr><td>Estonian</td><td>et</td><td>et.png</td></tr>
                        <tr><td>Basque</td><td>eu</td><td>eu.png</td></tr>
                        <tr><td>Finnish</td><td>fi</td><td>fi.png</td></tr>
                        <tr><td>Fiji</td><td>fj</td><td>fj.png</td></tr>
                        <tr><td>Faroese</td><td>fo</td><td>fo.png</td></tr>
                        <tr><td>French</td><td>fr</td><td>fr.png</td></tr>
                        <tr><td>Frisian</td><td>fy</td><td>fy.png</td></tr>
                        <tr><td>Irish</td><td>ga</td><td>ga.png</td></tr>
                        <tr><td>Galician</td><td>gl</td><td>gl.png</td></tr>
                        <tr><td>Guarani</td><td>gn</td><td>gn.png</td></tr>
                        <tr><td>Gujarati</td><td>gu</td><td>gu.png</td></tr>
                        <tr><td>Hausa</td><td>ha</td><td>ha.png</td></tr>
                        <tr><td>Hebrew</td><td>he</td><td>he.png</td></tr>
                        <tr><td>Hindi</td><td>hi</td><td>hi.png</td></tr>
                        <tr><td>Croatian</td><td>hr</td><td>hr.png</td></tr>
                        <tr><td>Hungarian</td><td>hu</td><td>hu.png</td></tr>
                        <tr><td>Armenian</td><td>hy</td><td>hy.png</td></tr>
                        <tr><td>Interlingua</td><td>ia</td><td>ia.png</td></tr>
                        <tr><td>Interlingue</td><td>ie</td><td>ie.png</td></tr>
                        <tr><td>Inupiak</td><td>ik</td><td>ik.png</td></tr>
                        <tr><td>Indonesian</td><td>id</td><td>id.png</td></tr>
                        <tr><td>Icelandic</td><td>is</td><td>is.png</td></tr>
                        <tr><td>Italian</td><td>it</td><td>it.png</td></tr>
                        <tr><td>Inuktitut</td><td>iu</td><td>iu.png</td></tr>
                        <tr><td>Japanese</td><td>ja</td><td>ja.png</td></tr>
                        <tr><td>Javanese</td><td>jv</td><td>jv.png</td></tr>
                        <tr><td>Georgian</td><td>ka</td><td>ka.png</td></tr>
                        <tr><td>Kazakh</td><td>kk</td><td>kk.png</td></tr>
                        <tr><td>Greenlandic</td><td>kl</td><td>kl.png</td></tr>
                        <tr><td>Cambodian</td><td>km</td><td>km.png</td></tr>
                        <tr><td>Kannada</td><td>kn</td><td>kn.png</td></tr>
                        <tr><td>Korean</td><td>ko</td><td>ko.png</td></tr>
                        <tr><td>Kashmiri</td><td>ks</td><td>ks.png</td></tr>
                        <tr><td>Kurdish</td><td>ku</td><td>ku.png</td></tr>
                        <tr><td>Kirghiz</td><td>ky</td><td>ky.png</td></tr>
                        <tr><td>Latin</td><td>la</td><td>la.png</td></tr>
                        <tr><td>Lingala</td><td>ln</td><td>ln.png</td></tr>
                        <tr><td>Laothian</td><td>lo</td><td>lo.png</td></tr>
                        <tr><td>Lithuanian</td><td>lt</td><td>lt.png</td></tr>
                        <tr><td>Latvian;Lettish</td><td>lv</td><td>lv.png</td></tr>
                        <tr><td>Malagasy</td><td>mg</td><td>mg.png</td></tr>
                        <tr><td>Maori</td><td>mi</td><td>mi.png</td></tr>
                        <tr><td>Macedonian</td><td>mk</td><td>mk.png</td></tr>
                        <tr><td>Malayalam</td><td>ml</td><td>ml.png</td></tr>
                        <tr><td>Mongolian</td><td>mn</td><td>mn.png</td></tr>
                        <tr><td>Moldavian</td><td>mo</td><td>mo.png</td></tr>
                        <tr><td>Marathi</td><td>mr</td><td>mr.png</td></tr>
                        <tr><td>Malay</td><td>ms</td><td>ms.png</td></tr>
                        <tr><td>Maltese</td><td>mt</td><td>mt.png</td></tr>
                        <tr><td>Burmese</td><td>my</td><td>my.png</td></tr>
                        <tr><td>Nauru</td><td>na</td><td>na.png</td></tr>
                        <tr><td>Nepali</td><td>ne</td><td>ne.png</td></tr>
                        <tr><td>Dutch</td><td>nl</td><td>nl.png</td></tr>
                        <tr><td>Norwegian</td><td>no</td><td>no.png</td></tr>
                        <tr><td>Occitan</td><td>oc</td><td>oc.png</td></tr>
                        <tr><td>Oriya</td><td>or</td><td>or.png</td></tr>
                        <tr><td>Punjabi</td><td>pa</td><td>pa.png</td></tr>
                        <tr><td>Polish</td><td>pl</td><td>pl.png</td></tr>
                        <tr><td>Pashto;Pushto</td><td>ps</td><td>ps.png</td></tr>
                        <tr><td>Portuguese</td><td>pt</td><td>pt.png</td></tr>
                        <tr><td>Quechua</td><td>qu</td><td>qu.png</td></tr>
                        <tr><td>Rhaeto-Romance</td><td>rm</td><td>rm.png</td></tr>
                        <tr><td>Kurundi</td><td>rn</td><td>rn.png</td></tr>
                        <tr><td>Romanian</td><td>ro</td><td>ro.png</td></tr>
                        <tr><td>Russian</td><td>ru</td><td>ru.png</td></tr>
                        <tr><td>Kinyarwanda</td><td>rw</td><td>rw.png</td></tr>
                        <tr><td>Sanskrit</td><td>sa</td><td>sa.png</td></tr>
                        <tr><td>Sindhi</td><td>sd</td><td>sd.png</td></tr>
                        <tr><td>Sangho</td><td>sg</td><td>sg.png</td></tr>
                        <tr><td>Serbo-Croatian</td><td>sh</td><td>sh.png</td></tr>
                        <tr><td>Singhalese</td><td>si</td><td>si.png</td></tr>
                        <tr><td>Slovak</td><td>sk</td><td>sk.png</td></tr>
                        <tr><td>Slovenian</td><td>sl</td><td>sl.png</td></tr>
                        <tr><td>Samoan</td><td>sm</td><td>sm.png</td></tr>
                        <tr><td>Shona</td><td>sn</td><td>sn.png</td></tr>
                        <tr><td>Somali</td><td>so</td><td>so.png</td></tr>
                        <tr><td>Albanian</td><td>sq</td><td>sq.png</td></tr>
                        <tr><td>Serbian</td><td>sr</td><td>sr.png</td></tr>
                        <tr><td>Siswati</td><td>ss</td><td>ss.png</td></tr>
                        <tr><td>Sesotho</td><td>st</td><td>st.png</td></tr>
                        <tr><td>Sundanese</td><td>su</td><td>su.png</td></tr>
                        <tr><td>Swedish</td><td>sv</td><td>sv.png</td></tr>
                        <tr><td>Swahili</td><td>sw</td><td>sw.png</td></tr>
                        <tr><td>Tamil</td><td>ta</td><td>ta.png</td></tr>
                        <tr><td>Telugu</td><td>te</td><td>te.png</td></tr>
                        <tr><td>Tajik</td><td>tg</td><td>tg.png</td></tr>
                        <tr><td>Thai</td><td>th</td><td>th.png</td></tr>
                        <tr><td>Tigrinya</td><td>ti</td><td>ti.png</td></tr>
                        <tr><td>Turkmen</td><td>tk</td><td>tk.png</td></tr>
                        <tr><td>Tagalog</td><td>tl</td><td>tl.png</td></tr>
                        <tr><td>Setswana</td><td>tn</td><td>tn.png</td></tr>
                        <tr><td>Tonga</td><td>to</td><td>to.png</td></tr>
                        <tr><td>Turkish</td><td>tr</td><td>tr.png</td></tr>
                        <tr><td>Tsonga</td><td>ts</td><td>ts.png</td></tr>
                        <tr><td>Tatar</td><td>tt</td><td>tt.png</td></tr>
                        <tr><td>Twi</td><td>tw</td><td>tw.png</td></tr>
                        <tr><td>Uigur</td><td>ug</td><td>ug.png</td></tr>
                        <tr><td>Ukrainian</td><td>uk</td><td>uk.png</td></tr>
                        <tr><td>Urdu</td><td>ur</td><td>ur.png</td></tr>
                        <tr><td>Uzbek</td><td>uz</td><td>uz.png</td></tr>
                        <tr><td>Vietnamese</td><td>vi</td><td>vi.png</td></tr>
                        <tr><td>Volapuk</td><td>vo</td><td>vo.png</td></tr>
                        <tr><td>Wolof</td><td>wo</td><td>wo.png</td></tr>
                        <tr><td>Xhosa</td><td>xh</td><td>xh.png</td></tr>
                        <tr><td>Yiddish</td><td>yi</td><td>yi.png</td></tr>
                        <tr><td>Yoruba</td><td>yo</td><td>yo.png</td></tr>
                        <tr><td>Zhuang</td><td>za</td><td>za.png</td></tr>
                        <tr><td>Chinese</td><td>zh</td><td>zh.png</td></tr>
                        <tr><td>Zulu</td><td>zu</td><td>zu.png</td></tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            <div class="modal-footer">
                <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
            </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function(){
            $('.edit-button').click(function(event){
                var selector = $(this).parents('tr');
                var id = selector.find('.lang_id input').attr('id');
                var name = selector.children('.lang_name').text();
                var code = selector.children('.lang_code').text();
                var status = selector.children('.lang-status').text() == 'Active' ? 1:0;
                var flag = selector.find('.lang_flag img').attr('src').split('/');
                flag = flag[4];

                var form = $('#language-modal');
                form.find('[name="id"]').val(id);
                form.find('[name="language"]').val(name);
                form.find('[name="code"]').val(code);
                form.find('[name="flag"]').val(flag);
                form.find('option[value='+ status +']').prop('selected', true);

            });
            $('.add-button').click(function(){
                var form = $('#language-modal');
                form.find('[name="id"]').val('');
                form.find('[name="language"]').val('');
                form.find('[name="code"]').val('');
                form.find('[name="flag"]').val('');
                form.find('option[value=0]').prop('selected', true);
            });
            $('#create-update-form').submit(function(){
                $('#language-modal .modal-dialog').addClass('loading');
            })
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
                                url: '{{ url('/admin/settings/language/destroy') }}/'+id,
                                type: 'post',
                                data: {_token :token},
                                beforeSend: function(){
                                    $('.table-responsive').addClass('loading');
                                },
                                success:function(msg) {
                                    $('.table-responsive').removeClass('loading');
                                    selector.remove();
                                    toastr.success(msg);
                                },
                                error:function(msg){
                                    $('.table-responsive').removeClass('loading');
                                    toastr.error(msg.responseJSON);
                                }
                            });
                        }
                    }
                });
            });

            $('.make-featured-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var token = $('[name="_token"]').val();
                bootbox.confirm({
                    title: '{{get_string('confirm_action')}}',
                    message: '{{get_string('make_default_confirm')}}',
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
                                url: '{{ url('/admin/settings/language/makeDefault') }}/'+id,
                                type: 'post',
                                data: {_token :token},
                                success:function(msg) {
                                    location.reload();
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