<div class="item box-shadow">
    <div id="carousel_-{{$service->id}}" class="main-image bg-overlay carousel slide" data-ride="carousel" data-interval="false">
        <div class="featured-sign">
            {{ $static_data['strings']['featured'] }}
        </div>
        @if(count($service->images))
            <div class="carousel-inner" role="listbox">
                <?php $c = 0; ?>
                @foreach($service->images as $image)
                    <div class="carousel-item @if(!$c) active <?php $c++; ?> @endif">
                        <img class="responsive-img" src="{{ URL::asset('images/data').'/'.$image->image }}"/>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carousel_-{{$service->id}}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">{{$static_data['strings']['previous']}}</span>
            </a>
            <a class="carousel-control-next" href="#carousel_-{{$service->id}}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">{{$static_data['strings']['next']}}</span>
            </a>
        @else
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="responsive-img" src="{{ URL::asset('images/').'/no_image.jpg' }}"/>
                </div>
            </div>
        @endif
    </div>
    <div class="data">
        <a href="{{url('/service').'/'.$service->alias}}"><h3 class="item-title primary-color">{{ $service->contentload->name }}</h3></a>
        <div class="item-category">{{$service->location['address'].', '.$service->location['city'] .' - '. $service->location['country']}}</div>
        <div class="item-category">{{$service->category->contentload->name.' - '.$service->ser_location->contentload->location}}</div>
        @if($service->user)<div class="small-text">{{ $static_data['strings']['posted_by'] .': '. $service->user->username }}</div>@endif
    </div>
</div>