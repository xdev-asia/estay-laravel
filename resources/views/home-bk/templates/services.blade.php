@if($services->count())
    @foreach($services as $service)
        
       @include('home.partials.service', ['class' => 'col-md-6 col-sm-12 items-grid'])

    @endforeach
@endif