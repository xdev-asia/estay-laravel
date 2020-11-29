@if($properties->count())
    @foreach($properties as $property)

        @include('home.partials.property', ['class' => 'col-md-6 col-sm-12 items-grid'])

    @endforeach
@endif
@if($markers)
    <script type="text/javascript">
        var markers = [@foreach ($markers as $marker)[{{$marker['geo_lon']}}, {{$marker['geo_lat']}}], @endforeach],
                infoWindowContent = [@foreach ($properties as $property)[{"id" : "{{$property->id}}","alias":"{{ $property->alias }}","name":{!! json_encode($property->contentload->name) !!},"address":"{{ $property->location['address'] }}" ,"city":"{{ $property->location['city'] }}" ,"country":"{{ $property->location['country'] }}" ,"phone":"{{ $property->contact['tel1'] }}", "icon":"{{ $property->category->map_icon }}", "featured":"{{ $property->featured }}", "image":@if(count($property->images))"{{ $property->images[0]->image }}" @else "no_image.jpg" @endif}], @endforeach];
        for(var i = 0; i < markers.length; i++ ) {
            addMarkerToMap(markers[i][0], markers[i][1], infoWindowContent[i], 'property');
        }
    </script>
    @endif
