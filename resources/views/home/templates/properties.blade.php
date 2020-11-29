@if($properties->count())
@foreach($properties as $property)
    
    @include('home.partials.property')

@endforeach
@endif