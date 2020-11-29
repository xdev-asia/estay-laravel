@extends('layouts.admin')

@section('title')
    <title>{{get_string('create_service') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('create_service')}}</h3>
@endsection
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
    {!!Form::open(['method' => 'post', 'url' => route('admin.service.store'), 'files' => 'true'])!!}
        <div class="panel">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="tab active"><a href="#content-panel" data-toggle="tab">{{get_string('content')}}</a></li>
                    <li class="tab"><a href="#data-panel" data-toggle="tab">{{get_string('data')}}</a></li>
                    <li class="tab"><a href="#meta-panel" data-toggle="tab">{{get_string('meta')}}</a></li>
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
                                        <div class="col s12">
                                            <div class="form-group  {{$errors->has('name.'.$language->id.'') ? 'has-error' : ''}}">
                                                {{Form::text('name['.$language->id.']', null, ['class' => 'form-control', 'placeholder' => get_string('enter_service_name')])}}
                                                {{Form::label('name['.$language->id.']', get_string('service_name'))}}
                                                @if($errors->has('name.'.$language->id.''))
                                                    <span class="wrong-error">* {{$errors->first('name.'.$language->id.'')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            {{Form::textarea('description['.$language->id.']', null, ['class' => 'hidden desc-content'])}}
                                            @if($errors->has('description.'.$language->id.''))
                                                <span class="wrong-error">* {{$errors->first('description.'.$language->id.'')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="data-panel" class="tab-pane">
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('general')}}</h5>
                    </div>
                    <div class="col m4 s6">
                        <div class="form-group  {{$errors->has('category_id') ? 'has-error' : ''}}">
                            {{Form::select('category_id', $categories, null, ['class' => 'category-select form-control', 'placeholder' => get_string('choose_category')])}}
                            @if($errors->has('category_id'))
                                <span class="wrong-error">* {{$errors->first('category_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m4 s6">
                        <div class="form-group  {{$errors->has('location_id') ? 'has-error' : ''}}">
                            {{Form::select('location_id', $locations, null, ['class' => 'location-select form-control', 'placeholder' => get_string('choose_location')])}}
                            @if($errors->has('location_id'))
                                <span class="wrong-error">* {{$errors->first('location_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l3 m4 s6 right right-align mbot0">
                        <div class="form-group">
                            <div class="switch">
                                <label>
                                    {{get_string('standard')}}{{ Form::checkbox('featured', 0, false, ['value' => '0', 'id' => 'activeSwitch', 'class' => 'form-control'])}}<span class="lever"></span>{{get_string('featured')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 well checkbox-grid">
                        <p>{{get_string('choose_features')}}</p>
                        @foreach($features as $feature)
                            <div class="col s2">
                                <div class="form-group">
                                    <input type="checkbox" name="features[]" @if(old('features') && in_array_r($feature->id, old('features'))) checked @endif value="{{$feature->id}}" class="filled-in primary-color" id="{{$feature->id}}" />
                                    <label for="{{$feature->id}}"></label>
                                    <span class="checkbox-label">{{$feature->feature[$default_language->id]}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('media')}}</h5>
                    </div>
                    <div class="col l12 m12 s12">
                        <div id="file-dropzone" class="dropzone">
                            <div class="dz-message">{{get_string('upload_images')}}<br/><i class="material-icons medium">cloud_upload</i>
                            </div>
                            <div class="fallback">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col s12">
                        <div class="form-group  {{$errors->has('video') ? 'has-error' : ''}}">
                            {{Form::text('video', null, ['class' => 'form-control', 'placeholder' => get_string('video_id')])}}
                            {{Form::label('video', get_string('video_id'))}}
                            @if($errors->has('video'))
                                <span class="wrong-error">* {{$errors->first('video')}}</span>
                            @endif
                        </div>
                    </div>-->
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('location')}}</h5>
                    </div>
                    <div class="col s12">
                        <div class="row mbot0">
                            <div class="col l6 m12 s12">
                                <div class="row mbot0">
                                    <div class="col l12 m12 s12">
                                        <div class="form-group  {{$errors->has('location.address') ? 'has-error' : ''}}">
                                            {{Form::text('location[address]', null, ['class' => 'form-control', 'placeholder' => get_string('address')])}}
                                            {{Form::label('location[address]', get_string('address'))}}
                                            @if($errors->has('location.address'))
                                                <span class="wrong-error">* {{$errors->first('location.address')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12">
                                        <div class="form-group  {{$errors->has('location.city') ? 'has-error' : ''}}">
                                            {{Form::text('location[city]', null, ['class' => 'form-control', 'placeholder' => get_string('city')])}}
                                            {{Form::label('location[city]', get_string('city'))}}
                                            @if($errors->has('location.city'))
                                                <span class="wrong-error">* {{$errors->first('location.city')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12">
                                        <div class="form-group  {{$errors->has('location.state') ? 'has-error' : ''}}">
                                            {{Form::text('location[state]', null, ['class' => 'form-control', 'placeholder' => get_string('state')])}}
                                            {{Form::label('location[state]', get_string('state'))}}
                                            @if($errors->has('location.state'))
                                                <span class="wrong-error">* {{$errors->first('location.state')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12">
                                        <div class="form-group  {{$errors->has('location.country') ? 'has-error' : ''}}">
                                            {{Form::text('location[country]', null, ['class' => 'form-control', 'placeholder' => get_string('country')])}}
                                            {{Form::label('location[country]', get_string('country'))}}
                                            @if($errors->has('location.country'))
                                                <span class="wrong-error">* {{$errors->first('location.country')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12">
                                        <div class="form-group">
                                            {{Form::text('location[geo_lon]', null, ['class' => 'form-control', 'placeholder' => get_string('geo_lon'), 'readonly'])}}
                                            {{Form::label('location[geo_lon]', get_string('geo_lon'))}}
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12">
                                        <div class="form-group">
                                            {{Form::text('location[geo_lat]', null, ['class' => 'form-control', 'placeholder' => get_string('geo_lat'), 'readonly'])}}
                                            {{Form::label('location[geo_lat]', get_string('geo_lat'))}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col l6 m12 s12">
                                <div class="form-group  {{($errors->has('location.geo_lon') || ($errors->has('location.geo_lon')))  ? 'has-error' : ''}}">
                                    {{Form::text('marker', null, ['class' => 'form-control autocomplete', 'id' => 'address-map', 'placeholder' => get_string('drop_marker')])}}
                                    {{Form::label('marker', get_string('drop_marker'))}}
                                    @if($errors->has('location.geo_lon') || $errors->has('location.geo_lat'))
                                        <span class="wrong-error">* {{get_string('google_address_required')}} </span>
                                    @endif
                                </div>
                                <div id="google-map">
                                </div>
                                <span class="field-info">{{get_string('drag_marker')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <div class="collapsible-header"><span>{{get_string('business_hours')}}</span><i class="material-icons small accordion-active">remove_circle</i><i class="material-icons small accordion-disabled">add_circle</i>
                                    <i class="material-icons small color-red {{($errors->has('business_hours.sun') || $errors->has('business_hours.sat') || $errors->has('business_hours.week')) ? '' : 'hidden'}}">report_problem</i>
                                </div>
                                <div class="collapsible-body">
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('business_hours.week') ? 'has-error' : ''}}">
                                            {{Form::text('business_hours[week]', null, ['class' => 'form-control', 'placeholder' => get_string('business_hours_week')])}}
                                            {{Form::label('business_hours[week]', get_string('business_hours_week'))}}
                                            @if($errors->has('business_hours.week'))
                                                <span class="wrong-error">* {{$errors->first('business_hours.week')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('business_hours.sat') ? 'has-error' : ''}}">
                                            {{Form::text('business_hours[sat]', null, ['class' => 'form-control', 'placeholder' => get_string('business_hours_sat')])}}
                                            {{Form::label('business_hours[sat]', get_string('business_hours_sat'))}}
                                            @if($errors->has('business_hours.sat'))
                                                <span class="wrong-error">* {{$errors->first('business_hours.sat')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('business_hours.sun') ? 'has-error' : ''}}">
                                            {{Form::text('business_hours[sun]', null, ['class' => 'form-control', 'placeholder' => get_string('business_hours_sun')])}}
                                            {{Form::label('business_hours[sun]', get_string('business_hours_sun'))}}
                                            @if($errors->has('business_hours.sun'))
                                                <span class="wrong-error">* {{$errors->first('business_hours.sun')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col s12">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <div class="collapsible-header"><span>{{get_string('contact')}}</span><i class="material-icons small accordion-active">remove_circle</i><i class="material-icons small accordion-disabled">add_circle</i>
                                    <i class="material-icons small color-red {{($errors->has('contact.tel1') || $errors->has('contact.tel2') || $errors->has('contact.fax') || $errors->has('contact.email') || $errors->has('contact.web')) ? '' : 'hidden'}}">report_problem</i>
                                </div>
                                <div class="collapsible-body">
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('contact.tel1') ? 'has-error' : ''}}">
                                            {{Form::text('contact[tel1]', null, ['class' => 'form-control', 'placeholder' => get_string('contact_tel1')])}}
                                            {{Form::label('contact[tel1]', get_string('contact_tel1'))}}
                                            @if($errors->has('contact.tel1'))
                                                <span class="wrong-error">* {{$errors->first('contact.tel1')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('contact.tel2') ? 'has-error' : ''}}">
                                            {{Form::text('contact[tel2]', null, ['class' => 'form-control', 'placeholder' => get_string('contact_tel2')])}}
                                            {{Form::label('contact[tel2]', get_string('contact_tel2'))}}
                                            @if($errors->has('contact.tel3'))
                                                <span class="wrong-error">* {{$errors->first('contact.tel2')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('contact.fax') ? 'has-error' : ''}}">
                                            {{Form::text('contact[fax]', null, ['class' => 'form-control', 'placeholder' => get_string('fax')])}}
                                            {{Form::label('contact[fax]', get_string('fax'))}}
                                            @if($errors->has('contact.fax'))
                                                <span class="wrong-error">* {{$errors->first('contact.fax')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('contact.email') ? 'has-error' : ''}}">
                                            {{Form::text('contact[email]', null, ['class' => 'form-control', 'placeholder' => get_string('email')])}}
                                            {{Form::label('contact[email]', get_string('email'))}}
                                            @if($errors->has('contact.email'))
                                                <span class="wrong-error">* {{$errors->first('contact.email')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('contact.web') ? 'has-error' : ''}}">
                                            {{Form::text('contact[web]', null, ['class' => 'form-control', 'placeholder' => get_string('website')])}}
                                            {{Form::label('contact[web]', get_string('website'))}}
                                            @if($errors->has('contact.web'))
                                                <span class="wrong-error">* {{$errors->first('contact.web')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col s12">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <div class="collapsible-header"><span>{{get_string('social_networks')}}</span><i class="material-icons small accordion-active">remove_circle</i><i class="material-icons small accordion-disabled">add_circle</i></div>
                                <div class="collapsible-body">
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[facebook]') ? 'has-error' : ''}}">
                                            {{Form::text('social[facebook]', null, ['class' => 'form-control', 'placeholder' => get_string('facebook')])}}
                                            {{Form::label('social[facebook]', get_string('facebook'))}}
                                            @if($errors->has('social[facebook]'))
                                                <span class="wrong-error">* {{$errors->first('social[facebook]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[gplus]') ? 'has-error' : ''}}">
                                            {{Form::text('social[gplus]', null, ['class' => 'form-control', 'placeholder' => get_string('google_plus')])}}
                                            {{Form::label('social[gplus]', get_string('google_plus'))}}
                                            @if($errors->has('social[gplus]'))
                                                <span class="wrong-error">* {{$errors->first('social[gplus]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[twitter]') ? 'has-error' : ''}}">
                                            {{Form::text('social[twitter]', null, ['class' => 'form-control', 'placeholder' => get_string('twitter')])}}
                                            {{Form::label('social[twitter]', get_string('twitter'))}}
                                            @if($errors->has('social[twitter]'))
                                                <span class="wrong-error">* {{$errors->first('social[twitter]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[instagram]') ? 'has-error' : ''}}">
                                            {{Form::text('social[instagram]', null, ['class' => 'form-control', 'placeholder' => get_string('instagram')])}}
                                            {{Form::label('social[instagram]', get_string('instagram'))}}
                                            @if($errors->has('social[instagram]'))
                                                <span class="wrong-error">* {{$errors->first('social[instagram]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[pinterest]') ? 'has-error' : ''}}">
                                            {{Form::text('social[pinterest]', null, ['class' => 'form-control', 'placeholder' => get_string('pinterest')])}}
                                            {{Form::label('social[pinterest]', get_string('pinterest'))}}
                                            @if($errors->has('social[pinterest]'))
                                                <span class="wrong-error">* {{$errors->first('social[pinterest]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[linkedin]') ? 'has-error' : ''}}">
                                            {{Form::text('social[linkedin]', null, ['class' => 'form-control', 'placeholder' => get_string('linkedin')])}}
                                            {{Form::label('social[linkedin]', get_string('linkedin'))}}
                                            @if($errors->has('social[linkedin]'))
                                                <span class="wrong-error">* {{$errors->first('social[linkedin]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="hidden-fields hidden">
                    </div>
                </div>
                <div id="meta-panel" class="tab-pane">
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('meta')}}</h5>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group">
                            {{Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => get_string('meta_title')])}}
                            {{Form::label('meta_title', get_string('meta_title'))}}
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group">
                            {{Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => get_string('meta_keywords')])}}
                            {{Form::label('meta_keywords', get_string('meta_keywords'))}}
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="form-group">
                            {{Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => get_string('meta_description')])}}
                            {{Form::label('meta_description', get_string('meta_description'))}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col clearfix s12 mtop10">
                <div class="form-group">
                    <button class="btn waves-effect" type="submit" name="action">{{get_string('create_service')}}</button>
                    <a href="{{route('admin.service.index')}}" class="btn waves-effect">{{get_string('service_all')}}</a>
                </div>
            </div>
            {{Form::hidden('user_id', Auth::user()->id)}}
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="https://maps.googleapis.com/maps/api/js?key={{get_setting('google_map_key', 'site')}}&libraries=places"></script>
    <script>
        $(document).ready(function(){
            $('.desc-content').summernote({
                height: 200,
                maxwidth: false,
                minwidth: false,
                placeholder: '{{get_string('enter_service_content')}}',
                disableDragAndDrop: true,
                toolbar: [
                    ["style", ["style"]],
                    ["font", ["bold", "underline", "clear"]],
                    ["color", ["color"]],
                    ["para", ["ul", "ol", "paragraph"]],
                ],callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
        });

        Dropzone.autoDiscover = false;
        $(document).ready(function(){
            $('#file-dropzone').dropzone({
                url: '{{url('/image_handler/upload')}}',
                paramsName: 'image',
                params: {_token: $('[name=_token]').val()},
                maxFilesize: 100,
                uploadMultiple: false,
                addRemoveLinks: true,
                maxfilesize: 1,
                parallelUploads: 1,
                maxFiles: 6,
                init: function() {

                    this.on('success', function(file, json) {
                        var selector = file._removeLink;
                        $(selector).attr('data-dz-remove', json.data);
                        $('.hidden-fields').append('<input type="hidden" name="images[]" value="'+ json.data +'">');
                    });

                    this.on('addedfile', function(file) {

                    });

                    this.on("removedfile", function(file) {
                        var selector = file._removeLink;
                        var data = $(selector).attr('data-dz-remove');
                        $.ajax({
                            type: 'POST',
                            url: '{{url('/image_handler/delete')}}',
                            data: {data: data, _token: $('[name=_token]').val()},
                            dataType: 'html',
                            success: function(msg){
                                $('.hidden-fields').find('[value="'+ data +'"]').remove();
                            }
                        });
                    });
                }
            });
        });
        // Google Map
        $(document).ready(function() {
            if(typeof google !== 'undefined' && google){
                var map = new google.maps.Map(document.getElementById('google-map'), {
                    center:{
                        lat: 40.118706,
                        lng: -102.796208
                    },
                    zoom:4
                });
                var marker = new google.maps.Marker({
                    position: {
                        lat: 40.118706,
                        lng: -102.796208
                    },
                    map: map,
                    draggable: true
                });
                var infowindow = new google.maps.InfoWindow();
                var searchBox = document.getElementById('address-map');
                var autocomplete = new google.maps.places.Autocomplete(searchBox);

                autocomplete.bindTo('bounds', map);
                autocomplete.addListener('place_changed', function() {
                    infowindow.close();
                    marker.setVisible(false);
                    var place = autocomplete.getPlace();
                    if (!place.geometry) {
                        return;
                    }

                    // If the place has a geometry, then present it on a map.
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(15);
                    }

                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                    var address = '';
                    if (place.address_components) {
                        address = [
                            (place.address_components[0] && place.address_components[0].short_name || ''),
                            (place.address_components[1] && place.address_components[1].short_name || ''),
                            (place.address_components[2] && place.address_components[2].short_name || '')
                        ].join(' ');
                    }

                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                    infowindow.open(map, marker);
                });

                google.maps.event.addListener(marker, 'position_changed', function () {
                    var lat = marker.getPosition().lat();
                    var lng = marker.getPosition().lng();
                    $('[name="location[geo_lon]"]').val(lat);
                    $('[name="location[geo_lat]"]').val(lng);
                });
                $('a[href$="data-panel"]').click(function(){
                    var currCenter = map.getCenter();
                    setTimeout(function(){
                        google.maps.event.trigger($("#google-map")[0], 'resize');
                        map.setCenter(currCenter);
                    }, 50);
                });
            }
        });
    </script>
@endsection