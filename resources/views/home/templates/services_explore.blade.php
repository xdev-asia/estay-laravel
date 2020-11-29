@if($services->count())
    @foreach($services as $service)
        
        @include('home.partials.service')

    @endforeach
@endif
@if($markers)
    <script type="text/javascript">
        var markers = [@foreach ($markers as $marker)[{{$marker['geo_lon']}}, {{$marker['geo_lat']}}], @endforeach],
                infoWindowContent = [@foreach ($services as $service)[{"id" : "{{$service->id}}","alias":"{{ $service->alias }}","name":{!! json_encode($service->contentload->name) !!},"address":"{{ $service->location['address'] }}" ,"city":"{{ $service->location['city'] }}" ,"country":"{{ $service->location['country'] }}" ,"phone":"{{ $service->contact['tel1'] }}", "icon":"{{ $service->category->map_icon }}", "featured":"{{ $service->featured }}", "image":@if(count($service->images))"{{ $service->images[0]->image }}" @else "no_image.jpg" @endif}], @endforeach];
        for(i = 0; i < markers.length; i++ ) {
            addMarkerToMap(markers[i][0], markers[i][1], infoWindowContent[i], 'service');
        }
    </script>
@endif